<?php
/**
 * The main template file
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$sidebar_position = adjdev_news_get_option( 'blog_sidebar_position', 'right' );
$blog_layout      = adjdev_news_get_option( 'blog_layout', 'grid' ); // grid, list, masonry, standard
?>

<main id="primary" class="site-main adjdev-main-wrap">
	<div class="adjdev-container">

		<?php
		// Homepage Hero Section if front/home
		if ( ( is_home() || is_front_page() ) && adjdev_news_get_option( 'homepage_hero_enable', true ) ) {
			get_template_part( 'template-parts/hero/hero-grid' );
		}
		?>

		<div class="adjdev-content-layout layout-sidebar-<?php echo esc_attr( $sidebar_position ); ?>">
			
			<div class="adjdev-primary-content">

				<?php if ( is_home() && ! is_front_page() ) : ?>
					<header class="page-header adjdev-page-header">
						<h1 class="page-title"><?php single_post_title(); ?></h1>
					</header>
				<?php endif; ?>

				<?php
				if ( have_posts() ) :
					echo '<div class="adjdev-posts-loop layout-' . esc_attr( $blog_layout ) . '">';

					$post_counter = 0;
					while ( have_posts() ) :
						the_post();
						$post_counter++;

						// In-feed advertisement slot after post #3
						if ( 3 === $post_counter && adjdev_news_get_option( 'ad_in_feed_enable', false ) ) {
							adjdev_news_render_ad_slot( 'in_feed' );
						}

						if ( 'list' === $blog_layout ) {
							get_template_part( 'template-parts/post/content-list' );
						} elseif ( 'overlay' === $blog_layout ) {
							get_template_part( 'template-parts/post/content-overlay' );
						} else {
							get_template_part( 'template-parts/post/content-card' );
						}

					endwhile;

					echo '</div>';

					// Pagination
					adjdev_news_pagination();

				else :
					get_template_part( 'template-parts/post/content-none' );
				endif;
				?>

			</div><!-- .adjdev-primary-content -->

			<?php if ( 'none' !== $sidebar_position && is_active_sidebar( 'adjdev-sidebar-main' ) ) : ?>
				<aside id="secondary" class="widget-area adjdev-sidebar">
					<?php dynamic_sidebar( 'adjdev-sidebar-main' ); ?>
				</aside>
			<?php endif; ?>

		</div><!-- .adjdev-content-layout -->
	</div><!-- .adjdev-container -->
</main><!-- #primary -->

<?php
get_footer();
