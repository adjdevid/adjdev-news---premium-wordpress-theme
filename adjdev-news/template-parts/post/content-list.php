<?php
/**
 * Post Content: Compact List Item
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'adjdev-post-list' ); ?>>
	
	<div class="list-thumbnail">
		<?php adjdev_news_post_thumbnail( 'adjdev-news-thumb' ); ?>
	</div>

	<div class="list-content">
		<?php adjdev_news_categories( 1 ); ?>
		
		<h2 class="card-title" style="margin: 8px 0;">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>

		<div class="card-excerpt" style="font-size: 0.88rem; margin-bottom: 10px;">
			<?php echo wp_trim_words( get_the_excerpt(), 18 ); ?>
		</div>

		<div class="post-meta">
			<?php adjdev_news_posted_on(); ?>
			<span>•</span>
			<span><?php echo esc_html( adjdev_news_reading_time() ); ?></span>
		</div>
	</div>

</article>
