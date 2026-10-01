<?php
/**
 * The template for displaying all pages
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$sidebar_position = adjdev_news_get_option( 'page_sidebar_position', 'none' );
?>

<main id="primary" class="site-main adjdev-main-wrap page-main">
	<div class="adjdev-container">

		<?php
		if ( adjdev_news_get_option( 'breadcrumbs_enable', true ) ) {
			adjdev_news_render_breadcrumbs();
		}
		?>

		<div class="adjdev-content-layout layout-sidebar-<?php echo esc_attr( $sidebar_position ); ?>">
			
			<div class="adjdev-primary-content">

				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'adjdev-page-article' ); ?>>
						
						<header class="entry-header adjdev-page-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header>

						<?php if ( has_post_thumbnail() && adjdev_news_get_option( 'page_featured_image', true ) ) : ?>
							<div class="entry-media adjdev-page-thumbnail">
								<?php the_post_thumbnail( 'adjdev-news-large' ); ?>
							</div>
						<?php endif; ?>

						<div class="entry-content adjdev-article-body">
							<?php
							the_content();

							wp_link_pages(
								array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'adjdev-news' ),
									'after'  => '</div>',
								)
							);
							?>
						</div><!-- .entry-content -->

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>

					</article><!-- #post-<?php the_ID(); ?> -->
				<?php endwhile; ?>

			</div><!-- .adjdev-primary-content -->

			<?php if ( 'none' !== $sidebar_position && is_active_sidebar( 'adjdev-sidebar-page' ) ) : ?>
				<aside id="secondary" class="widget-area adjdev-sidebar">
					<?php dynamic_sidebar( 'adjdev-sidebar-page' ); ?>
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
