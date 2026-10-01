<?php
/**
 * Single Post Related Posts
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id    = get_the_ID();
$categories = wp_get_post_categories( $post_id );

if ( empty( $categories ) ) {
	return;
}

$related_count = intval( adjdev_news_get_option( 'single_related_posts_count', 3 ) );

$related_query = new WP_Query(
	array(
		'category__in'        => $categories,
		'post__not_in'        => array( $post_id ),
		'posts_per_page'      => $related_count,
		'ignore_sticky_posts' => 1,
	)
);

if ( ! $related_query->have_posts() ) {
	return;
}
?>
<section class="adjdev-related-posts">
	<h3 class="related-section-title">
		<span><?php esc_html_e( 'Related Articles', 'adjdev-news' ); ?></span>
	</h3>

	<div class="adjdev-posts-loop layout-grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
		<?php
		while ( $related_query->have_posts() ) :
			$related_query->the_post();
			get_template_part( 'template-parts/post/content-card' );
		endwhile;
		wp_reset_postdata();
		?>
	</div>
</section>
