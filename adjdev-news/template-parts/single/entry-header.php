<?php
/**
 * Single Post Entry Header
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header class="entry-header adjdev-single-header">
	
	<?php adjdev_news_categories( 3 ); ?>

	<h1 class="entry-title"><?php the_title(); ?></h1>

	<?php
	// Post Subtitle (from excerpt or custom meta)
	$subtitle = get_the_excerpt();
	if ( ! empty( $subtitle ) ) :
	?>
		<p class="entry-subtitle"><?php echo esc_html( $subtitle ); ?></p>
	<?php endif; ?>

	<div class="entry-meta">
		<?php if ( adjdev_news_get_option( 'single_post_meta_author', true ) ) : ?>
			<?php adjdev_news_posted_by(); ?>
			<span>•</span>
		<?php endif; ?>

		<?php if ( adjdev_news_get_option( 'single_post_meta_date', true ) ) : ?>
			<?php adjdev_news_posted_on(); ?>
			<span>•</span>
		<?php endif; ?>

		<?php if ( adjdev_news_get_option( 'single_post_meta_reading', true ) ) : ?>
			<span class="reading-time">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
				<?php echo esc_html( adjdev_news_reading_time() ); ?>
			</span>
			<span>•</span>
		<?php endif; ?>

		<?php if ( adjdev_news_get_option( 'single_post_meta_views', true ) ) : ?>
			<span class="views-count">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
				<?php echo esc_html( adjdev_news_get_post_views() ); ?>
			</span>
		<?php endif; ?>
	</div>

</header>
