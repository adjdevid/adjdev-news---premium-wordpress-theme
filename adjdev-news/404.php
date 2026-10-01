<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main adjdev-main-wrap not-found-main">
	<div class="adjdev-container adjdev-container-narrow">
		<section class="error-404 not-found text-center">
			
			<div class="error-code-badge">404</div>

			<header class="page-header">
				<h1 class="page-title">
					<?php echo esc_html( adjdev_news_get_option( 'error_404_title', __( 'Oops! That page can’t be found.', 'adjdev-news' ) ) ); ?>
				</h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p>
					<?php echo esc_html( adjdev_news_get_option( 'error_404_desc', __( 'It looks like nothing was found at this location. Maybe try searching with a keyword or check our latest headlines below.', 'adjdev-news' ) ) ); ?>
				</p>

				<div class="adjdev-search-form-wrap">
					<?php get_search_form(); ?>
				</div>

				<div class="adjdev-404-actions">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="adjdev-button adjdev-button-primary">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
						<?php esc_html_e( 'Back to Homepage', 'adjdev-news' ); ?>
					</a>
				</div>

				<?php if ( adjdev_news_get_option( 'error_404_recent_posts', true ) ) : ?>
					<div class="adjdev-404-latest-news">
						<h2 class="section-title"><?php esc_html_e( 'Latest Articles', 'adjdev-news' ); ?></h2>
						<?php
						$recent_query = new WP_Query(
							array(
								'posts_per_page'      => 4,
								'post_status'         => 'publish',
								'ignore_sticky_posts' => 1,
							)
						);

						if ( $recent_query->have_posts() ) :
							echo '<div class="adjdev-posts-loop layout-grid">';
							while ( $recent_query->have_posts() ) :
								$recent_query->the_post();
								get_template_part( 'template-parts/post/content-card' );
							endwhile;
							echo '</div>';
							wp_reset_postdata();
						endif;
						?>
					</div>
				<?php endif; ?>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->
	</div><!-- .adjdev-container -->
</main><!-- #primary -->

<?php
get_footer();
