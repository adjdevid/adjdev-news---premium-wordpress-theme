<?php
/**
 * Admin Initialization for ADJDEV News
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Admin Menus
 */
function adjdev_news_register_admin_menus() {
	// Main Menu
	add_menu_page(
		esc_html__( 'ADJDEV News', 'adjdev-news' ),
		esc_html__( 'ADJDEV News', 'adjdev-news' ),
		'edit_theme_options',
		'adjdev-news-options',
		array( 'ADJDEV_News_Admin_Options', 'render' ),
		'dashicons-superhero',
		30
	);

	// Submenu: Theme Options
	add_submenu_page(
		'adjdev-news-options',
		esc_html__( 'Theme Options', 'adjdev-news' ),
		esc_html__( 'Theme Options', 'adjdev-news' ),
		'edit_theme_options',
		'adjdev-news-options',
		array( 'ADJDEV_News_Admin_Options', 'render' )
	);

	// Submenu: Template Library
	add_submenu_page(
		'adjdev-news-options',
		esc_html__( 'Template Library', 'adjdev-news' ),
		esc_html__( 'Template Library', 'adjdev-news' ),
		'edit_theme_options',
		'adjdev-news-templates',
		array( 'ADJDEV_News_Admin_Templates', 'render' )
	);

	// Submenu: System Info
	add_submenu_page(
		'adjdev-news-options',
		esc_html__( 'System Info', 'adjdev-news' ),
		esc_html__( 'System Info', 'adjdev-news' ),
		'edit_theme_options',
		'adjdev-news-system-info',
		array( 'ADJDEV_News_Admin_System_Info', 'render' )
	);

	// Submenu: Import / Export
	add_submenu_page(
		'adjdev-news-options',
		esc_html__( 'Import / Export', 'adjdev-news' ),
		esc_html__( 'Import / Export', 'adjdev-news' ),
		'edit_theme_options',
		'adjdev-news-import-export',
		array( 'ADJDEV_News_Admin_Import_Export', 'render' )
	);
}
add_action( 'admin_menu', 'adjdev_news_register_admin_menus' );

/**
 * Enqueue Admin Assets for ADJDEV News screens
 */
function adjdev_news_admin_assets( $hook ) {
	if ( ! str_contains( $hook, 'adjdev-news' ) ) {
		return;
	}

	// WordPress color picker
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );

	// Admin Options CSS & JS
	wp_enqueue_style( 'adjdev-news-admin-css', ADJDEV_NEWS_THEME_URI . '/admin/css/admin-options.css', array(), ADJDEV_NEWS_VERSION );
	wp_enqueue_script( 'adjdev-news-admin-js', ADJDEV_NEWS_THEME_URI . '/admin/js/admin-options.js', array( 'jquery', 'wp-color-picker' ), ADJDEV_NEWS_VERSION, true );

	wp_localize_script(
		'adjdev-news-admin-js',
		'adjdevAdminData',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'adjdev_news_admin_nonce' ),
			'i18n'    => array(
				'confirmReset'    => esc_html__( 'Are you sure you want to reset all options? Customizations will be lost.', 'adjdev-news' ),
				'confirmActivate' => esc_html__( 'Are you sure you want to activate this template layout? Your posts will be preserved.', 'adjdev-news' ),
				'saving'          => esc_html__( 'Saving changes...', 'adjdev-news' ),
				'saved'           => esc_html__( 'Saved successfully!', 'adjdev-news' ),
				'activating'      => esc_html__( 'Activating template...', 'adjdev-news' ),
			),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'adjdev_news_admin_assets' );
