<?php
/**
 * The template for displaying the footer
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	</div><!-- #content -->

	<?php
	// Footer Advertisement Slot
	adjdev_news_render_ad_slot( 'footer' );

	/**
	 * Hook: adjdev_news_before_footer
	 */
	do_action( 'adjdev_news_before_footer' );
	?>

	<footer id="colophon" class="site-footer <?php echo esc_attr( adjdev_news_get_option( 'footer_dark_mode', true ) ? 'footer-dark' : 'footer-light' ); ?>">
		<?php get_template_part( 'template-parts/footer/footer-default' ); ?>
		<?php get_template_part( 'template-parts/footer/footer-bottom' ); ?>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php
// Back to Top Button
if ( adjdev_news_get_option( 'back_to_top_enable', true ) ) :
?>
	<button id="adjdev-back-to-top" class="adjdev-back-to-top" aria-label="<?php esc_attr_e( 'Back to top', 'adjdev-news' ); ?>">
		<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
	</button>
<?php endif; ?>

<?php
// Search Modal
get_template_part( 'template-parts/header/search-modal' );

// Mobile Offcanvas Drawer
get_template_part( 'template-parts/header/mobile-drawer' );

/**
 * Hook: adjdev_news_after_site_wrapper
 */
do_action( 'adjdev_news_after_site_wrapper' );

wp_footer();
?>
</body>
</html>
