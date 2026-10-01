<?php
/**
 * Post Content: Standard Card
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'adjdev-post-card' ); ?>>
	
	<div class="card-thumbnail">
		<?php adjdev_news_post_thumbnail( 'adjdev-news-thumb' ); ?>
		<?php adjdev_news_categories( 1 ); ?>
	</div>

	<div class="card-content">
		<h2 class="card-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>

		<div class="card-excerpt">
			<?php the_excerpt(); ?>
		</div>

		<div class="post-meta">
			<?php adjdev_news_posted_by(); ?>
			<span>•</span>
			<?php adjdev_news_posted_on(); ?>
			<span>•</span>
			<span class="reading-time"><?php echo esc_html( adjdev_news_reading_time() ); ?></span>
		</div>
	</div>

</article>
