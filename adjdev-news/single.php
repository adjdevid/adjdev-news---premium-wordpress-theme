<?php
/**
 * The template for displaying all single posts
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Track post view
adjdev_news_track_post_views( get_the_ID() );

$sidebar_position = adjdev_news_get_option( 'single_sidebar_position', 'right' );
?>

<main id="primary" class="site-main adjdev-main-wrap single-post-main">
	<div class="adjdev-container">

		<?php
		// Breadcrumbs
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
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'adjdev-single-article' ); ?>>
						
						<?php
						// Post Header (Categories, Title, Subtitle, Meta)
						get_template_part( 'template-parts/single/entry-header' );

						// Featured Media / Image / Video
						get_template_part( 'template-parts/single/entry-media' );

						// Top Share Bar
						if ( adjdev_news_get_option( 'single_share_top', true ) ) {
							get_template_part( 'template-parts/single/entry-share' );
						}

						// Before Content Ad Slot
						adjdev_news_render_ad_slot( 'before_content' );
						?>

						<div class="entry-content adjdev-article-body">
							<?php
							// Automated Table of Contents
							if ( adjdev_news_get_option( 'single_toc_enable', true ) ) {
								get_template_part( 'template-parts/single/entry-toc' );
							}

							the_content(
								sprintf(
									wp_kses(
										/* translators: %s: Name of current post. Only visible to screen readers */
										__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'adjdev-news' ),
										array(
											'span' => array(
												'class' => array(),
											),
										)
									),
									wp_kses_post( get_the_title() )
								)
							);

							wp_link_pages(
								array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'adjdev-news' ),
									'after'  => '</div>',
								)
							);
							?>
						</div><!-- .entry-content -->

						<?php
						// After Content Ad Slot
						adjdev_news_render_ad_slot( 'after_content' );

						// Post Tags
						if ( has_tag() && adjdev_news_get_option( 'single_tags_enable', true ) ) :
						?>
							<div class="adjdev-post-tags">
								<span class="tags-label"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"/><path d="M7 7h.01"/></svg> <?php esc_html_e( 'Tags:', 'adjdev-news' ); ?></span>
								<div class="tags-list">
									<?php the_tags( '', ' ', '' ); ?>
								</div>
							</div>
						<?php endif; ?>

						<?php
						// Bottom Share Bar
						if ( adjdev_news_get_option( 'single_share_bottom', true ) ) {
							get_template_part( 'template-parts/single/entry-share' );
						}

						// Post Navigation (Previous / Next)
						if ( adjdev_news_get_option( 'single_navigation_enable', true ) ) {
							get_template_part( 'template-parts/single/entry-navigation' );
						}

						// Author Box
						if ( adjdev_news_get_option( 'single_author_box_enable', true ) ) {
							get_template_part( 'template-parts/single/entry-author' );
						}

						// Newsletter Subscription Box
						if ( adjdev_news_get_option( 'single_newsletter_enable', true ) ) {
							get_template_part( 'template-parts/single/entry-newsletter' );
						}

						// Related Posts
						if ( adjdev_news_get_option( 'single_related_posts_enable', true ) ) {
							get_template_part( 'template-parts/single/entry-related' );
						}

						// Comments
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>

					</article><!-- #post-<?php the_ID(); ?> -->
				<?php endwhile; ?>

			</div><!-- .adjdev-primary-content -->

			<?php if ( 'none' !== $sidebar_position && is_active_sidebar( 'adjdev-sidebar-single' ) ) : ?>
				<aside id="secondary" class="widget-area adjdev-sidebar <?php echo esc_attr( adjdev_news_get_option( 'single_sidebar_sticky', true ) ? 'sidebar-sticky' : '' ); ?>">
					<?php dynamic_sidebar( 'adjdev-sidebar-single' ); ?>
				</aside>
			<?php elseif ( 'none' !== $sidebar_position && is_active_sidebar( 'adjdev-sidebar-main' ) ) : ?>
				<aside id="secondary" class="widget-area adjdev-sidebar <?php echo esc_attr( adjdev_news_get_option( 'single_sidebar_sticky', true ) ? 'sidebar-sticky' : '' ); ?>">
					<?php dynamic_sidebar( 'adjdev-sidebar-main' ); ?>
				</aside>
			<?php endif; ?>

		</div><!-- .adjdev-content-layout -->
	</div><!-- .adjdev-container -->
</main><!-- #primary -->

<?php
get_footer();
