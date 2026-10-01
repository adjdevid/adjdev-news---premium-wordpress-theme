<?php
/**
 * Lightweight, high-performance Theme Options Framework
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Retrieve all theme options merged with defaults
 *
 * @return array
 */
function adjdev_news_get_options() {
	static $cached_options = null;

	if ( null !== $cached_options ) {
		return $cached_options;
	}

	$defaults = adjdev_news_get_default_options();
	$saved    = get_option( ADJDEV_NEWS_OPTIONS_KEY, array() );

	if ( ! is_array( $saved ) ) {
		$saved = array();
	}

	$cached_options = wp_parse_args( $saved, $defaults );
	return $cached_options;
}

/**
 * Retrieve a specific option with fallback
 *
 * @param string $key
 * @param mixed  $default
 * @return mixed
 */
function adjdev_news_get_option( $key, $default = null ) {
	$options = adjdev_news_get_options();

	if ( isset( $options[ $key ] ) ) {
		return $options[ $key ];
	}

	if ( null !== $default ) {
		return $default;
	}

	$defaults = adjdev_news_get_default_options();
	return isset( $defaults[ $key ] ) ? $defaults[ $key ] : null;
}

/**
 * Sanitize theme options safely
 *
 * @param array $input
 * @return array
 */
function adjdev_news_sanitize_options( $input ) {
	if ( ! is_array( $input ) ) {
		return array();
	}

	$sanitized = array();
	$defaults  = adjdev_news_get_default_options();

	foreach ( $defaults as $key => $default_val ) {
		if ( ! isset( $input[ $key ] ) ) {
			// For boolean checkboxes not present in POST, set false
			if ( is_bool( $default_val ) ) {
				$sanitized[ $key ] = false;
			} else {
				$sanitized[ $key ] = $default_val;
			}
			continue;
		}

		$val = $input[ $key ];

		if ( is_bool( $default_val ) ) {
			$sanitized[ $key ] = (bool) $val;
		} elseif ( is_numeric( $default_val ) ) {
			$sanitized[ $key ] = is_float( $default_val ) ? floatval( $val ) : intval( $val );
		} elseif ( in_array( $key, array( 'ad_header_code', 'ad_before_content_code', 'ad_in_content_code', 'ad_after_content_code', 'ad_sidebar_code', 'ad_footer_code', 'ad_in_feed_code', 'custom_css', 'custom_js' ), true ) ) {
			// Allow safe code / scripts for administrators with unfiltered_html
			if ( current_user_can( 'unfiltered_html' ) ) {
				$sanitized[ $key ] = ( 'custom_css' === $key ) ? wp_strip_all_tags( $val ) : $val;
			} else {
				$sanitized[ $key ] = wp_kses_post( $val );
			}
		} elseif ( in_array( $key, array( 'social_facebook', 'social_twitter', 'social_instagram', 'social_youtube', 'social_tiktok', 'social_linkedin', 'social_telegram', 'social_whatsapp', 'logo_image', 'logo_image_dark', 'logo_image_mobile' ), true ) ) {
			$sanitized[ $key ] = esc_url_raw( $val );
		} elseif ( str_starts_with( $key, 'color_' ) ) {
			$sanitized[ $key ] = sanitize_hex_color( $val ) ?: $default_val;
		} else {
			$sanitized[ $key ] = sanitize_text_field( $val );
		}
	}

	return $sanitized;
}

/**
 * Generate Dynamic CSS Variables from theme options
 */
function adjdev_news_dynamic_css() {
	$primary       = adjdev_news_get_option( 'color_primary', '#1062fe' );
	$primary_hover = adjdev_news_get_option( 'color_primary_hover', '#004fe8' );
	$secondary     = adjdev_news_get_option( 'color_secondary', '#0f172a' );
	$accent        = adjdev_news_get_option( 'color_accent', '#f43f5e' );
	$text          = adjdev_news_get_option( 'color_text', '#181d27' );
	$bg            = adjdev_news_get_option( 'color_background', '#ffffff' );
	$border        = adjdev_news_get_option( 'color_border', '#e4e7ec' );
	$container     = adjdev_news_get_option( 'container_width', 1240 );

	$dark_bg       = adjdev_news_get_option( 'dark_mode_bg', '#0b0f19' );
	$dark_surface  = adjdev_news_get_option( 'dark_mode_surface', '#121826' );
	$dark_text     = adjdev_news_get_option( 'dark_mode_text', '#e6edf3' );

	$custom_css    = adjdev_news_get_option( 'custom_css', '' );

	$css = ":root {
		--adjdev-primary: {$primary};
		--adjdev-primary-hover: {$primary_hover};
		--adjdev-secondary: {$secondary};
		--adjdev-accent: {$accent};
		--adjdev-text: {$text};
		--adjdev-background: {$bg};
		--adjdev-border: {$border};
		--adjdev-container: {$container}px;
	}
	[data-theme='dark'], .dark-mode {
		--adjdev-background: {$dark_bg};
		--adjdev-surface: {$dark_surface};
		--adjdev-text: {$dark_text};
	}";

	if ( ! empty( $custom_css ) ) {
		$css .= "\n" . $custom_css;
	}

	wp_add_inline_style( 'adjdev-news-main', $css );
}
add_action( 'wp_enqueue_scripts', 'adjdev_news_dynamic_css', 20 );

/**
 * Get default theme mode (light, dark, or system)
 *
 * @return string
 */
function adjdev_news_get_default_theme_mode() {
	$mode = adjdev_news_get_option( 'dark_mode_default', 'system' );
	if ( 'dark' === $mode ) {
		return 'dark';
	}
	return 'light';
}
