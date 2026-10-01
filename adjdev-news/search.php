<?php
/**
 * The template for displaying search results pages
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$sidebar_position = adjdev_news_get_option( 'search_sidebar_position', 'right' );
$search_layout    = adjdev_news_get_option( 'search_layout', 'list' );
?>

<main id="primary" class="site-main adjdev-main-wrap search-main">
	<div class="adjdev-container">

		<?php
		if ( adjdev_news_get_option( 'breadcrumbs_enable', true ) ) {
			adjdev_news_render_breadcrumbs();
		}
		?>

		<header class="page-header adjdev-search-header">
			<h1 class="page-title adjdev-search-title">
				<?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search Results for: %s', 'adjdev-news' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
				?>
			</h1>
			<p class="search-meta">
				<?php
				global $wp_query;
				printf(
					/* translators: %d: results count */
					esc_html( _n( 'Found %d article matching your keyword', 'Found %d articles matching your keyword', $wp_query->found_posts, 'adjdev-news' ) ),
					(int) $wp_query->found_posts
				);
				?>
			</p>
			
			<div class="adjdev-search-form-wrap">
				<?php get_search_form(); ?>
			</div>
		</header><!-- .page-header -->

		<div class="adjdev-content-layout layout-sidebar-<?php echo esc_attr( $sidebar_position ); ?>">
			
			<div class="adjdev-primary-content">

				<?php
				if ( have_posts() ) :
					echo '<div class="adjdev-posts-loop layout-' . esc_attr( $search_layout ) . '">';

					while ( have_posts() ) :
						the_post();

						if ( 'list' === $search_layout ) {
							get_template_part( 'template-parts/post/content-list' );
						} elseif ( 'overlay' === $search_layout ) {
							get_template_part( 'template-parts/post/content-overlay' );
						} else {
							get_template_part( 'template-parts/post/content-card' );
						}

					endwhile;

					echo '</div>';

					adjdev_news_pagination();

				else :
					get_template_part( 'template-parts/post/content-none' );
				endif;
				?>

			</div><!-- .adjdev-primary-content -->

			<?php if ( 'none' !== $sidebar_position && is_active_sidebar( 'adjdev-sidebar-search' ) ) : ?>
				<aside id="secondary" class="widget-area adjdev-sidebar">
					<?php dynamic_sidebar( 'adjdev-sidebar-search' ); ?>
				</aside>
			<?php elseif ( 'none' !== $sidebar_position && is_active_sidebar( 'adjdev-sidebar-main' ) ) : ?>
				<aside id="secondary" class="widget-area adjdev-sidebar">
					<?php dynamic_sidebar( 'adjdev-sidebar-main' ); ?>
				</aside>
			<?php endif; ?>

		</div><!-- .adjdev-content-layout -->
	</div><!-- .adjdev-container -->
</main><!-- #primary -->

<?php
get_footer();
