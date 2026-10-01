<?php
/**
 * ADJDEV News functions and definitions
 *
 * @package ADJDEV_News
 * @version 1.0.0
 * @author ADJDEV Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Theme Constants
 */
define( 'ADJDEV_NEWS_VERSION', '1.0.0' );
define( 'ADJDEV_NEWS_THEME_DIR', get_template_directory() );
define( 'ADJDEV_NEWS_THEME_URI', get_template_directory_uri() );
define( 'ADJDEV_NEWS_TEXTDOMAIN', 'adjdev-news' );
define( 'ADJDEV_NEWS_MIN_PHP_VERSION', '8.1.0' );

/**
 * Check PHP Version Compatibility
 */
if ( version_compare( PHP_VERSION, ADJDEV_NEWS_MIN_PHP_VERSION, '<' ) ) {
	add_action( 'admin_notices', 'adjdev_news_php_version_notice' );
	function adjdev_news_php_version_notice() {
		echo '<div class="notice notice-error"><p>' . esc_html__( 'ADJDEV News requires PHP version 8.1.0 or higher. Please upgrade your PHP version.', 'adjdev-news' ) . '</p></div>';
	}
	return;
}

/**
 * Modular Includes
 */
require_once ADJDEV_NEWS_THEME_DIR . '/inc/core-constants.php';
require_once ADJDEV_NEWS_THEME_DIR . '/inc/theme-setup.php';
require_once ADJDEV_NEWS_THEME_DIR . '/inc/theme-options-defaults.php';
require_once ADJDEV_NEWS_THEME_DIR . '/inc/theme-options-framework.php';
require_once ADJDEV_NEWS_THEME_DIR . '/inc/theme-assets.php';
require_once ADJDEV_NEWS_THEME_DIR . '/inc/template-tags.php';
require_once ADJDEV_NEWS_THEME_DIR . '/inc/template-functions.php';
require_once ADJDEV_NEWS_THEME_DIR . '/inc/template-library-scanner.php';
require_once ADJDEV_NEWS_THEME_DIR . '/inc/builder-api.php';
require_once ADJDEV_NEWS_THEME_DIR . '/inc/ads-manager.php';
require_once ADJDEV_NEWS_THEME_DIR . '/inc/seo-schema.php';
require_once ADJDEV_NEWS_THEME_DIR . '/inc/breadcrumbs.php';
require_once ADJDEV_NEWS_THEME_DIR . '/inc/reading-progress.php';
require_once ADJDEV_NEWS_THEME_DIR . '/inc/post-views.php';
require_once ADJDEV_NEWS_THEME_DIR . '/inc/ajax-handlers.php';

// Blocks & Widgets
require_once ADJDEV_NEWS_THEME_DIR . '/blocks/patterns.php';
require_once ADJDEV_NEWS_THEME_DIR . '/widgets/class-widget-recent-posts.php';
require_once ADJDEV_NEWS_THEME_DIR . '/widgets/class-widget-trending.php';
require_once ADJDEV_NEWS_THEME_DIR . '/widgets/class-widget-author.php';
require_once ADJDEV_NEWS_THEME_DIR . '/widgets/class-widget-ad.php';

// Admin Theme Options & Template Library
if ( is_admin() ) {
	require_once ADJDEV_NEWS_THEME_DIR . '/admin/admin-init.php';
	require_once ADJDEV_NEWS_THEME_DIR . '/admin/class-theme-options.php';
	require_once ADJDEV_NEWS_THEME_DIR . '/admin/class-template-library.php';
	require_once ADJDEV_NEWS_THEME_DIR . '/admin/class-system-info.php';
	require_once ADJDEV_NEWS_THEME_DIR . '/admin/class-import-export.php';
}

/**
 * Fires after the ADJDEV News theme is fully loaded and initialized.
 * Allows plugins like "ADJDEV Builder" to bind their visual editor, hooks, and components.
 */
do_action( 'adjdev_news_loaded' );
