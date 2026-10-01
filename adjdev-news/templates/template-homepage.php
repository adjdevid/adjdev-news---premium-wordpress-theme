<?php
/**
 * Template Name: ADJDEV Modular Homepage
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main adjdev-modular-homepage">
	<div class="adjdev-container">

		<?php
		// 1. Featured Hero
		if ( adjdev_news_get_option( 'homepage_hero_enable', true ) ) {
			get_template_part( 'template-parts/hero/hero-grid' );
		}

		// 2. In-Between Advertisement
		adjdev_news_render_ad_slot( 'before_content' );
		?>

		<div class="adjdev-content-layout layout-sidebar-right">
			
			<div class="adjdev-primary-content">
				
				<!-- Section: Latest News Loop -->
				<div class="adjdev-section-header" style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 24px; padding-bottom: 12px; border-bottom: 2px solid var(--adjdev-border-subtle);">
					<h2 class="section-title" style="font-size: 1.4rem; margin: 0; position: relative;">
						<span><?php esc_html_e( 'Latest News & Updates', 'adjdev-news' ); ?></span>
					</h2>
				</div>

				<div class="adjdev-posts-loop layout-grid">
					<?php
					$home_query = new WP_Query(
						array(
							'posts_per_page'      => 8,
							'post_status'         => 'publish',
							'ignore_sticky_posts' => 1,
						)
					);

					if ( $home_query->have_posts() ) :
						while ( $home_query->have_posts() ) :
							$home_query->the_post();
							get_template_part( 'template-parts/post/content-card' );
						endwhile;
						wp_reset_postdata();
					endif;
					?>
				</div>

				<?php adjdev_news_pagination(); ?>

			</div><!-- .adjdev-primary-content -->

			<!-- Sidebar -->
			<aside id="secondary" class="widget-area adjdev-sidebar">
				<?php
				if ( is_active_sidebar( 'adjdev-sidebar-main' ) ) {
					dynamic_sidebar( 'adjdev-sidebar-main' );
				}
				?>
			</aside>

		</div><!-- .adjdev-content-layout -->

	</div><!-- .adjdev-container -->
</main>

<?php
get_footer();
