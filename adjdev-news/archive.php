<?php
/**
 * The template for displaying archive pages
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$sidebar_position = adjdev_news_get_option( 'archive_sidebar_position', 'right' );
$archive_layout   = adjdev_news_get_option( 'archive_layout', 'grid' );
?>

<main id="primary" class="site-main adjdev-main-wrap archive-main">
	<div class="adjdev-container">

		<?php
		if ( adjdev_news_get_option( 'breadcrumbs_enable', true ) ) {
			adjdev_news_render_breadcrumbs();
		}
		?>

		<header class="page-header adjdev-archive-header">
			<?php
			the_archive_title( '<h1 class="page-title adjdev-archive-title">', '</h1>' );
			the_archive_description( '<div class="archive-description adjdev-archive-desc">', '</div>' );
			?>
			<div class="adjdev-archive-meta">
				<span class="posts-count">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
					<?php
					global $wp_query;
					printf(
						/* translators: %d: number of articles */
						esc_html( _n( '%d Article', '%d Articles', $wp_query->found_posts, 'adjdev-news' ) ),
						(int) $wp_query->found_posts
					);
					?>
				</span>
			</div>
		</header><!-- .page-header -->

		<div class="adjdev-content-layout layout-sidebar-<?php echo esc_attr( $sidebar_position ); ?>">
			
			<div class="adjdev-primary-content">

				<?php
				if ( have_posts() ) :
					echo '<div class="adjdev-posts-loop layout-' . esc_attr( $archive_layout ) . '">';

					while ( have_posts() ) :
						the_post();

						if ( 'list' === $archive_layout ) {
							get_template_part( 'template-parts/post/content-list' );
						} elseif ( 'overlay' === $archive_layout ) {
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

			<?php if ( 'none' !== $sidebar_position && is_active_sidebar( 'adjdev-sidebar-archive' ) ) : ?>
				<aside id="secondary" class="widget-area adjdev-sidebar">
					<?php dynamic_sidebar( 'adjdev-sidebar-archive' ); ?>
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
