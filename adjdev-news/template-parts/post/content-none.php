<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="no-results not-found text-center" style="padding: 40px 0;">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'adjdev-news' ); ?></h1>
	</header>

	<div class="page-content" style="max-width: 500px; margin: 0 auto;">
		<p><?php esc_html_e( 'It seems we can’t find what you’re looking for. Perhaps searching can help.', 'adjdev-news' ); ?></p>
		<div style="margin-top: 20px;">
			<?php get_search_form(); ?>
		</div>
	</div>
</section>
