<?php
/**
 * Single Post Featured Media
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! has_post_thumbnail() || ! adjdev_news_get_option( 'single_featured_image', true ) ) {
	return;
}
?>
<div class="entry-media adjdev-single-featured-media">
	<?php the_post_thumbnail( 'adjdev-news-large' ); ?>
	<?php
	$caption = get_the_post_thumbnail_caption();
	if ( ! empty( $caption ) ) :
	?>
		<div class="media-caption"><?php echo esc_html( $caption ); ?></div>
	<?php endif; ?>
</div>
