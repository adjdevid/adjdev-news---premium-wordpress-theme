<?php
/**
 * Dynamic Template Library Scanner & Manager
 *
 * Scans /templates-library/ directory automatically, reads metadata from template.json,
 * validates against strict schema, caches results via Transients, and safely applies configuration.
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ADJDEV_News_Template_Library {

	/**
	 * Transient key for caching scanned templates
	 */
	const CACHE_KEY = 'adjdev_news_scanned_templates_cache';

	/**
	 * Cache TTL: 12 hours (refreshed automatically on admin actions)
	 */
	const CACHE_TTL = 43200;

	/**
	 * Scan the /templates-library/ directory for templates
	 *
	 * @param bool $force_refresh
	 * @return array
	 */
	public static function get_templates( $force_refresh = false ) {
		if ( ! $force_refresh ) {
			$cached = get_transient( self::CACHE_KEY );
			if ( false !== $cached && is_array( $cached ) ) {
				return $cached;
			}
		}

		$templates   = array();
		$library_dir = ADJDEV_NEWS_TEMPLATES_LIB_DIR;

		if ( ! is_dir( $library_dir ) ) {
			return $templates;
		}

		// Open directory safely
		$dir_items = scandir( $library_dir );
		if ( ! is_array( $dir_items ) ) {
			return $templates;
		}

		foreach ( $dir_items as $item ) {
			// Skip dot files and parent dirs
			if ( '.' === $item || '..' === $item ) {
				continue;
			}

			// Prevent directory traversal
			$clean_folder = sanitize_file_name( $item );
			$template_path = $library_dir . '/' . $clean_folder;

			if ( ! is_dir( $template_path ) ) {
				continue;
			}

			$json_file = $template_path . '/template.json';
			if ( ! file_exists( $json_file ) || ! is_readable( $json_file ) ) {
				continue;
			}

			$json_content = file_get_contents( $json_file );
			$metadata     = json_decode( $json_content, true );

			if ( ! is_array( $metadata ) || ! self::validate_template_metadata( $metadata ) ) {
				continue;
			}

			// Resolve preview images
			$preview_img = '';
			if ( ! empty( $metadata['preview'] ) && file_exists( $template_path . '/' . $metadata['preview'] ) ) {
				$preview_img = ADJDEV_NEWS_TEMPLATES_LIB_URI . '/' . $clean_folder . '/' . $metadata['preview'];
			} elseif ( file_exists( $template_path . '/preview.jpg' ) ) {
				$preview_img = ADJDEV_NEWS_TEMPLATES_LIB_URI . '/' . $clean_folder . '/preview.jpg';
			} elseif ( file_exists( $template_path . '/screenshot.jpg' ) ) {
				$preview_img = ADJDEV_NEWS_TEMPLATES_LIB_URI . '/' . $clean_folder . '/screenshot.jpg';
			} else {
				$preview_img = ADJDEV_NEWS_ASSETS_URI . '/images/default-placeholder.svg';
			}

			$config_file = $template_path . '/config.json';
			$has_config  = file_exists( $config_file );

			$templates[ $metadata['id'] ] = array(
				'id'                     => sanitize_key( $metadata['id'] ),
				'name'                   => sanitize_text_field( $metadata['name'] ),
				'description'            => sanitize_text_field( $metadata['description'] ?? '' ),
				'version'                => sanitize_text_field( $metadata['version'] ?? '1.0.0' ),
				'author'                 => sanitize_text_field( $metadata['author'] ?? 'ADJDEV' ),
				'category'               => sanitize_text_field( $metadata['category'] ?? 'General' ),
				'preview'                => esc_url( $preview_img ),
				'folder'                 => $clean_folder,
				'supported_features'     => is_array( $metadata['supported_features'] ?? null ) ? $metadata['supported_features'] : array(),
				'required_theme_version' => sanitize_text_field( $metadata['required_theme_version'] ?? '1.0.0' ),
				'has_config'             => $has_config,
				'active'                 => ( self::get_active_template_id() === $metadata['id'] ),
			);
		}

		set_transient( self::CACHE_KEY, $templates, self::CACHE_TTL );
		return $templates;
	}

	/**
	 * Validate required keys in template.json
	 *
	 * @param array $meta
	 * @return bool
	 */
	private static function validate_template_metadata( $meta ) {
		return ! empty( $meta['id'] ) && ! empty( $meta['name'] );
	}

	/**
	 * Get the currently active template ID
	 *
	 * @return string
	 */
	public static function get_active_template_id() {
		return get_option( ADJDEV_NEWS_ACTIVE_TEMPLATE_KEY, 'news-modern' );
	}

	/**
	 * Safely activate a template by ID
	 *
	 * Imports layout and preset configurations into Theme Options.
	 * IMPORTANT: Never deletes posts, pages, or user content!
	 *
	 * @param string $template_id
	 * @return array Array with success status and message
	 */
	public static function activate_template( $template_id ) {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return array(
				'success' => false,
				'message' => esc_html__( 'Unauthorized. You do not have permission to change themes.', 'adjdev-news' ),
			);
		}

		$clean_id    = sanitize_key( $template_id );
		$templates   = self::get_templates( true );

		if ( ! isset( $templates[ $clean_id ] ) ) {
			return array(
				'success' => false,
				'message' => esc_html__( 'Template not found in library.', 'adjdev-news' ),
			);
		}

		$template_info = $templates[ $clean_id ];
		$config_file   = ADJDEV_NEWS_TEMPLATES_LIB_DIR . '/' . $template_info['folder'] . '/config.json';

		if ( file_exists( $config_file ) ) {
			$raw_config = file_get_contents( $config_file );
			$config     = json_decode( $raw_config, true );

			if ( is_array( $config ) ) {
				$current_options = adjdev_news_get_options();
				// Merge preset options into current options
				$merged = wp_parse_args( $config, $current_options );
				$merged['active_template'] = $clean_id;

				$sanitized = adjdev_news_sanitize_options( $merged );
				update_option( ADJDEV_NEWS_OPTIONS_KEY, $sanitized );
			}
		}

		update_option( ADJDEV_NEWS_ACTIVE_TEMPLATE_KEY, $clean_id );
		delete_transient( self::CACHE_KEY );

		// Hook for extensions or builder
		do_action( 'adjdev_news_after_template_activated', $clean_id, $template_info );

		return array(
			'success' => true,
			'message' => sprintf(
				/* translators: %s: template name */
				esc_html__( 'Template "%s" activated successfully! Layout presets have been applied.', 'adjdev-news' ),
				$template_info['name']
			),
		);
	}
}
