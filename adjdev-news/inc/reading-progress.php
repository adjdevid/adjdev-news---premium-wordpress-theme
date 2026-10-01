<?php
/**
 * Reading Progress Indicator
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render reading progress bar container
 */
function adjdev_news_render_reading_progress() {
	if ( ! is_singular( 'post' ) || ! adjdev_news_get_option( 'reading_progress_enable', true ) ) {
		return;
	}

	$height = intval( adjdev_news_get_option( 'reading_progress_height', 3 ) );
	$color  = sanitize_hex_color( adjdev_news_get_option( 'reading_progress_color', '#1062fe' ) );
	?>
	<div id="adjdev-reading-progress" class="adjdev-reading-progress" style="height: <?php echo esc_attr( $height ); ?>px;">
		<div class="adjdev-reading-progress-fill" style="background-color: <?php echo esc_attr( $color ); ?>; width: 0%;"></div>
	</div>
	<?php
}
