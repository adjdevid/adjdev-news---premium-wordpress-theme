<?php
/**
 * Enqueue scripts and styles with extreme performance optimization
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue front-end assets
 */
function adjdev_news_scripts() {
	// Base Stylesheet (style.css contains metadata & CSS vars)
	wp_enqueue_style( 'adjdev-news-style', get_stylesheet_uri(), array(), ADJDEV_NEWS_VERSION );

	// Main Framework CSS
	wp_enqueue_style( 'adjdev-news-main', ADJDEV_NEWS_ASSETS_URI . '/css/main.css', array( 'adjdev-news-style' ), ADJDEV_NEWS_VERSION );

	// Modular Header & Footer CSS
	wp_enqueue_style( 'adjdev-news-header', ADJDEV_NEWS_ASSETS_URI . '/css/header.css', array( 'adjdev-news-main' ), ADJDEV_NEWS_VERSION );
	wp_enqueue_style( 'adjdev-news-footer', ADJDEV_NEWS_ASSETS_URI . '/css/footer.css', array( 'adjdev-news-main' ), ADJDEV_NEWS_VERSION );

	// Single Post Assets (Conditionally loaded ONLY on single posts)
	if ( is_singular( 'post' ) ) {
		wp_enqueue_style( 'adjdev-news-single', ADJDEV_NEWS_ASSETS_URI . '/css/single-post.css', array( 'adjdev-news-main' ), ADJDEV_NEWS_VERSION );
		wp_enqueue_script( 'adjdev-news-single', ADJDEV_NEWS_ASSETS_URI . '/js/single-post.js', array(), ADJDEV_NEWS_VERSION, true );
	}

	// Dark Mode CSS
	if ( adjdev_news_get_option( 'dark_mode_enable', true ) ) {
		wp_enqueue_style( 'adjdev-news-dark', ADJDEV_NEWS_ASSETS_URI . '/css/dark-mode.css', array( 'adjdev-news-main' ), ADJDEV_NEWS_VERSION );
	}

	// Main Vanilla JS (No jQuery dependency!)
	wp_enqueue_script( 'adjdev-news-main', ADJDEV_NEWS_ASSETS_URI . '/js/main.js', array(), ADJDEV_NEWS_VERSION, true );

	// Localized script variables for AJAX and dark mode state
	wp_localize_script(
		'adjdev-news-main',
		'adjdevNewsData',
		array(
			'ajaxUrl'        => admin_url( 'admin-ajax.php' ),
			'nonce'          => wp_create_nonce( 'adjdev_news_frontend_nonce' ),
			'darkModeDefault'=> adjdev_news_get_option( 'dark_mode_default', 'system' ),
			'stickyHeader'   => (bool) adjdev_news_get_option( 'header_sticky', true ),
			'i18n'           => array(
				'copied'      => esc_html__( 'Link copied to clipboard!', 'adjdev-news' ),
				'readingTime' => esc_html__( 'min read', 'adjdev-news' ),
			),
		)
	);

	// Comment reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'adjdev_news_scripts' );

/**
 * Add defer attribute to ADJDEV News frontend scripts for Non-Blocking Performance
 */
function adjdev_news_defer_scripts( $tag, $handle ) {
	if ( in_array( $handle, array( 'adjdev-news-main', 'adjdev-news-single' ), true ) ) {
		return str_replace( ' src', ' defer="defer" src', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'adjdev_news_defer_scripts', 10, 2 );

/**
 * Remove WordPress Core Emoji scripts if enabled in Performance settings
 */
function adjdev_news_disable_emojis() {
	if ( ! adjdev_news_get_option( 'perf_disable_emojis', true ) ) {
		return;
	}

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'adjdev_news_disable_emojis' );
