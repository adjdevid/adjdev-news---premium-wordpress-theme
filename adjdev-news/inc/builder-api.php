<?php
/**
 * ADJDEV Builder Foundation API
 *
 * Provides hooks, filters, section registry, design tokens, dynamic data API,
 * and canvas rendering hooks so the upcoming "ADJDEV Builder" plugin can seamlessly
 * take control of page rendering, custom sections, and dynamic queries without modifying theme core.
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ADJDEV_News_Builder_API {

	/**
	 * Registered builder sections
	 *
	 * @var array
	 */
	private static $registered_sections = array();

	/**
	 * Registered dynamic data tags
	 *
	 * @var array
	 */
	private static $dynamic_tags = array();

	/**
	 * Initialize Builder API hooks
	 */
	public static function init() {
		add_filter( 'theme_page_templates', array( __CLASS__, 'register_canvas_template' ) );
		self::register_default_dynamic_tags();
	}

	/**
	 * Register blank canvas template for visual builder
	 *
	 * @param array $templates
	 * @return array
	 */
	public static function register_canvas_template( $templates ) {
		$templates['templates/template-canvas.php'] = esc_html__( 'ADJDEV Builder Canvas (Blank)', 'adjdev-news' );
		$templates['templates/template-fullwidth.php'] = esc_html__( 'ADJDEV Fullwidth Page', 'adjdev-news' );
		return $templates;
	}

	/**
	 * Register a custom section for the builder
	 *
	 * @param string   $id       Unique Section ID
	 * @param array    $args     Section configuration { title, category, icon, render_callback }
	 */
	public static function register_section( $id, $args = array() ) {
		$clean_id = sanitize_key( $id );
		self::$registered_sections[ $clean_id ] = wp_parse_args(
			$args,
			array(
				'title'           => $clean_id,
				'category'        => 'general',
				'icon'            => 'dashicons-grid-view',
				'render_callback' => null,
			)
		);

		do_action( 'adjdev_news_builder_section_registered', $clean_id, self::$registered_sections[ $clean_id ] );
	}

	/**
	 * Render a registered builder section
	 *
	 * @param string $id
	 * @param array  $settings
	 */
	public static function render_section( $id, $settings = array() ) {
		$clean_id = sanitize_key( $id );

		// Filter settings before render
		$settings = apply_filters( "adjdev_news_builder_section_settings_{$clean_id}", $settings );

		do_action( "adjdev_news_builder_before_section_{$clean_id}", $settings );

		if ( isset( self::$registered_sections[ $clean_id ]['render_callback'] ) && is_callable( self::$registered_sections[ $clean_id ]['render_callback'] ) ) {
			call_user_func( self::$registered_sections[ $clean_id ]['render_callback'], $settings );
		} else {
			// Check if a template part exists in template-parts/builder/
			$template_part = 'template-parts/builder/' . $clean_id;
			get_template_part( $template_part, null, $settings );
		}

		do_action( "adjdev_news_builder_after_section_{$clean_id}", $settings );
	}

	/**
	 * Register standard Dynamic Data tags
	 */
	private static function register_default_dynamic_tags() {
		self::register_dynamic_tag( 'post_title', function( $post_id ) {
			return get_the_title( $post_id );
		} );

		self::register_dynamic_tag( 'post_excerpt', function( $post_id ) {
			return get_the_excerpt( $post_id );
		} );

		self::register_dynamic_tag( 'post_date', function( $post_id ) {
			return get_the_date( '', $post_id );
		} );

		self::register_dynamic_tag( 'author_name', function( $post_id ) {
			$post = get_post( $post_id );
			return $post ? get_the_author_meta( 'display_name', $post->post_author ) : '';
		} );

		self::register_dynamic_tag( 'site_title', function() {
			return get_bloginfo( 'name' );
		} );
	}

	/**
	 * Register a dynamic tag handler
	 *
	 * @param string   $tag_id
	 * @param callable $callback
	 */
	public static function register_dynamic_tag( $tag_id, $callback ) {
		self::$dynamic_tags[ sanitize_key( $tag_id ) ] = $callback;
	}

	/**
	 * Retrieve evaluated dynamic tag value
	 *
	 * @param string $tag_id
	 * @param int    $post_id
	 * @return string
	 */
	public static function get_dynamic_tag_value( $tag_id, $post_id = 0 ) {
		$clean_tag = sanitize_key( $tag_id );
		if ( isset( self::$dynamic_tags[ $clean_tag ] ) && is_callable( self::$dynamic_tags[ $clean_tag ] ) ) {
			return call_user_func( self::$dynamic_tags[ $clean_tag ], $post_id ?: get_the_ID() );
		}
		return apply_filters( "adjdev_news_builder_dynamic_tag_{$clean_tag}", '', $post_id );
	}

	/**
	 * Return Design Tokens array for Builder sync
	 *
	 * @return array
	 */
	public static function get_design_tokens() {
		return array(
			'colors' => array(
				'primary'    => 'var(--adjdev-primary)',
				'secondary'  => 'var(--adjdev-secondary)',
				'accent'     => 'var(--adjdev-accent)',
				'text'       => 'var(--adjdev-text)',
				'background' => 'var(--adjdev-background)',
				'border'     => 'var(--adjdev-border)',
			),
			'typography' => array(
				'fontBody'    => 'var(--adjdev-font-body)',
				'fontHeading' => 'var(--adjdev-font-heading)',
			),
			'container' => array(
				'default' => 'var(--adjdev-container)',
				'narrow'  => 'var(--adjdev-container-narrow)',
				'wide'    => 'var(--adjdev-container-wide)',
			),
			'radius' => array(
				'sm'   => 'var(--adjdev-radius-sm)',
				'base' => 'var(--adjdev-radius)',
				'lg'   => 'var(--adjdev-radius-lg)',
			),
		);
	}
}

ADJDEV_News_Builder_API::init();
