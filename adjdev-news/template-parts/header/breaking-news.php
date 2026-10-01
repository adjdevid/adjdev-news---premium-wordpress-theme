<?php
/**
 * Breaking News Ticker Component
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$breaking_query = new WP_Query(
	array(
		'posts_per_page'      => intval( adjdev_news_get_option( 'breaking_news_count', 5 ) ),
		'post_status'         => 'publish',
		'ignore_sticky_posts' => 1,
	)
);

if ( ! $breaking_query->have_posts() ) {
	return;
}
?>
<div class="adjdev-breaking-news">
	<div class="adjdev-container">
		<div class="breaking-news-inner">
			<span class="breaking-badge"><?php echo esc_html( adjdev_news_get_option( 'breaking_news_title', __( 'Breaking News', 'adjdev-news' ) ) ); ?></span>
			<div class="breaking-list">
				<?php
				$count = 0;
				while ( $breaking_query->have_posts() ) :
					$breaking_query->the_post();
					$count++;
					?>
					<a href="<?php the_permalink(); ?>" class="breaking-item">
						<?php the_title(); ?>
					</a>
					<?php
					if ( $count < $breaking_query->post_count ) {
						echo ' <span class="breaking-sep" style="margin: 0 12px; opacity:0.4;">•</span> ';
					}
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
</div>
