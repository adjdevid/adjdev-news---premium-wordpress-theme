<?php
/**
 * Core Constants Definition for ADJDEV News
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'ADJDEV_NEWS_VERSION' ) ) {
	define( 'ADJDEV_NEWS_VERSION', '1.0.0' );
}

define( 'ADJDEV_NEWS_INC_DIR', ADJDEV_NEWS_THEME_DIR . '/inc' );
define( 'ADJDEV_NEWS_ADMIN_DIR', ADJDEV_NEWS_THEME_DIR . '/admin' );
define( 'ADJDEV_NEWS_ASSETS_URI', ADJDEV_NEWS_THEME_URI . '/assets' );
define( 'ADJDEV_NEWS_TEMPLATES_LIB_DIR', ADJDEV_NEWS_THEME_DIR . '/templates-library' );
define( 'ADJDEV_NEWS_TEMPLATES_LIB_URI', ADJDEV_NEWS_THEME_URI . '/templates-library' );
define( 'ADJDEV_NEWS_OPTIONS_KEY', 'adjdev_news_theme_options' );
define( 'ADJDEV_NEWS_ACTIVE_TEMPLATE_KEY', 'adjdev_news_active_template' );
