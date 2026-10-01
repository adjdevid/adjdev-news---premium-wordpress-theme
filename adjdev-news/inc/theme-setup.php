<?php
/**
 * Theme setup and resource registration
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'adjdev_news_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function adjdev_news_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'adjdev-news', ADJDEV_NEWS_THEME_DIR . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Custom image sizes tailored for news and magazine layouts
		add_image_size( 'adjdev-news-thumb', 400, 260, true );    // Grid card / list thumb
		add_image_size( 'adjdev-news-medium', 760, 430, true );   // Medium highlight / 2-column
		add_image_size( 'adjdev-news-large', 1200, 675, true );   // Single featured (16:9)
		add_image_size( 'adjdev-news-hero', 1400, 700, true );    // Hero headline lead

		// Register Navigation Menus
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Main Menu', 'adjdev-news' ),
				'topbar'  => esc_html__( 'Top Bar Utility Menu', 'adjdev-news' ),
				'mobile'  => esc_html__( 'Mobile Drawer Menu', 'adjdev-news' ),
				'footer'  => esc_html__( 'Footer Navigation Menu', 'adjdev-news' ),
			)
		);

		// Switch default core markup to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Custom Logo Support
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 80,
				'width'       => 260,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Selective Refresh for Widgets in Customizer
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Gutenberg Align Wide & Full Support
		add_theme_support( 'align-wide' );

		// Responsive Embedded Content
		add_theme_support( 'responsive-embeds' );

		// Editor Styles
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', 'adjdev_news_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function adjdev_news_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'adjdev_news_content_width', 1200 );
}
add_action( 'after_setup_theme', 'adjdev_news_content_width', 0 );

/**
 * Register Widget Areas (Sidebars)
 */
function adjdev_news_widgets_init() {
	// Main Global Sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Main Global Sidebar', 'adjdev-news' ),
			'id'            => 'adjdev-sidebar-main',
			'description'   => esc_html__( 'Widgets added here appear in the primary sidebar across standard pages.', 'adjdev-news' ),
			'before_widget' => '<section id="%1$s" class="widget adjdev-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title adjdev-widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// Single Post Sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Single Post Sidebar', 'adjdev-news' ),
			'id'            => 'adjdev-sidebar-single',
			'description'   => esc_html__( 'Widgets specific to single article views. Falls back to Main Sidebar if empty.', 'adjdev-news' ),
			'before_widget' => '<section id="%1$s" class="widget adjdev-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title adjdev-widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// Page Sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Page Sidebar', 'adjdev-news' ),
			'id'            => 'adjdev-sidebar-page',
			'description'   => esc_html__( 'Widgets for standard static pages.', 'adjdev-news' ),
			'before_widget' => '<section id="%1$s" class="widget adjdev-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title adjdev-widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// Archive Sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Archive Sidebar', 'adjdev-news' ),
			'id'            => 'adjdev-sidebar-archive',
			'description'   => esc_html__( 'Widgets for category, tag, author, and date archives.', 'adjdev-news' ),
			'before_widget' => '<section id="%1$s" class="widget adjdev-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title adjdev-widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// Footer 4-Column Widgets
	for ( $i = 1; $i <= 4; $i++ ) {
		register_sidebar(
			array(
				/* translators: %d: footer column number */
				'name'          => sprintf( esc_html__( 'Footer Column %d', 'adjdev-news' ), $i ),
				'id'            => 'adjdev-footer-col-' . $i,
				'description'   => sprintf( esc_html__( 'Widgets added here appear in column %d of the footer.', 'adjdev-news' ), $i ),
				'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title footer-widget-title"><span>',
				'after_title'   => '</span></h4>',
			)
		);
	}
}
add_action( 'widgets_init', 'adjdev_news_widgets_init' );
