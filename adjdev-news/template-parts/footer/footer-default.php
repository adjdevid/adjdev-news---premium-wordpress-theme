<?php
/**
 * Footer Default Columns Component
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$columns = intval( adjdev_news_get_option( 'footer_columns', 4 ) );
?>
<div class="footer-main-widgets">
	<div class="adjdev-container">
		<div class="footer-widgets-grid footer-cols-<?php echo esc_attr( $columns ); ?>">
			
			<!-- Column 1: About / Brand -->
			<div class="footer-widget widget-about">
				<div class="site-branding">
					<h3 class="footer-brand-title" style="font-size: 1.4rem; font-weight: 800; margin-bottom: 12px; color: inherit;">
						<?php bloginfo( 'name' ); ?><span>.</span>
					</h3>
					<p><?php echo esc_html( adjdev_news_get_option( 'footer_description', __( 'Trusted news and insights portal built for high speed and accuracy.', 'adjdev-news' ) ) ); ?></p>
				</div>
			</div>

			<!-- Columns 2 to 4: Dynamic Sidebars -->
			<?php for ( $i = 2; $i <= $columns; $i++ ) : ?>
				<div class="footer-widget">
					<?php
					if ( is_active_sidebar( 'adjdev-footer-col-' . $i ) ) {
						dynamic_sidebar( 'adjdev-footer-col-' . $i );
					} else {
						// Fallback default menu or links
						echo '<h4 class="footer-widget-title">' . esc_html__( 'Categories', 'adjdev-news' ) . '</h4>';
						echo '<ul class="footer-default-links">';
						$cats = get_categories( array( 'number' => 5 ) );
						foreach ( $cats as $cat ) {
							echo '<li><a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a></li>';
						}
						echo '</ul>';
					}
					?>
				</div>
			<?php endfor; ?>

		</div><!-- .footer-widgets-grid -->
	</div><!-- .adjdev-container -->
</div>
