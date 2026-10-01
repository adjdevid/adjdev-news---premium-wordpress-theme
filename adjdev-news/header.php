<?php
/**
 * The header template for ADJDEV News
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!doctype html>
<html <?php language_attributes(); ?> data-theme="<?php echo esc_attr( adjdev_news_get_default_theme_mode() ); ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'adjdev-news' ); ?></a>

<?php
/**
 * Hook: adjdev_news_before_site_wrapper
 * Used by ADJDEV Builder or add-ons for top alerts, modals, etc.
 */
do_action( 'adjdev_news_before_site_wrapper' );
?>

<div id="page" class="site-wrapper">

	<?php
	// Reading Progress Bar
	if ( is_singular( 'post' ) && adjdev_news_get_option( 'reading_progress_enable', true ) ) {
		get_template_part( 'template-parts/single/reading-progress' );
	}

	// Top Bar
	if ( adjdev_news_get_option( 'header_topbar_enable', true ) ) {
		get_template_part( 'template-parts/header/topbar' );
	}

	// Main Header (Selected Layout: default, classic, center-logo, magazine, minimal, transparent)
	$header_layout = adjdev_news_get_option( 'header_layout', 'default' );
	get_template_part( 'template-parts/header/header', $header_layout );

	// Breaking News Ticker
	if ( adjdev_news_get_option( 'breaking_news_enable', true ) && ( is_home() || is_front_page() || adjdev_news_get_option( 'breaking_news_all_pages', false ) ) ) {
		get_template_part( 'template-parts/header/breaking-news' );
	}

	// Header Advertisement Slot
	adjdev_news_render_ad_slot( 'header' );

	/**
	 * Hook: adjdev_news_after_header
	 */
	do_action( 'adjdev_news_after_header' );
	?>

	<div id="content" class="site-content">
