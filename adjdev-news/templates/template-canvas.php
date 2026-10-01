<?php
/**
 * Template Name: ADJDEV Builder Canvas (Blank)
 * Template Post Type: post, page
 *
 * Blank canvas template providing a clean slate for the upcoming "ADJDEV Builder" visual page builder plugin.
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
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'adjdev-builder-canvas-mode' ); ?>>
<?php wp_body_open(); ?>

<main id="primary" class="site-main adjdev-builder-canvas-wrapper">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>

<?php wp_footer(); ?>
</body>
</html>
