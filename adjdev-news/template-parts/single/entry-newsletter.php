<?php
/**
 * Single Post In-Article Newsletter Subscription Box
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="adjdev-newsletter-box" style="background: var(--adjdev-surface); border: 2px dashed var(--adjdev-primary); border-radius: var(--adjdev-radius); padding: 32px; margin: 36px 0; text-align: center;">
	<div style="max-width: 480px; margin: 0 auto;">
		<span class="dashicons dashicons-email-alt" style="font-size: 32px; width: 32px; height: 32px; color: var(--adjdev-primary); margin-bottom: 8px;"></span>
		<h3 style="font-size: 1.3rem; margin: 0 0 8px 0;"><?php esc_html_e( 'Stay Ahead With Our Daily Digest', 'adjdev-news' ); ?></h3>
		<p style="font-size: 0.92rem; color: var(--adjdev-text-muted); margin-bottom: 20px;"><?php esc_html_e( 'Get verified scoops, investigative briefings, and tech updates straight to your inbox.', 'adjdev-news' ); ?></p>
		<form class="newsletter-form" onsubmit="event.preventDefault(); alert('Subscribed successfully!');" style="display: flex; gap: 8px; flex-wrap: wrap; justify-content: center;">
			<input type="email" placeholder="<?php esc_attr_e( 'Enter your email address...', 'adjdev-news' ); ?>" required style="flex-grow: 1; min-width: 240px; padding: 10px 14px; border: 1px solid var(--adjdev-border); border-radius: var(--adjdev-radius-sm);" />
			<button type="submit" class="button" style="background: var(--adjdev-primary); color: #fff; border: none; padding: 10px 22px; border-radius: var(--adjdev-radius-sm); font-weight: 600; cursor: pointer;"><?php esc_html_e( 'Subscribe', 'adjdev-news' ); ?></button>
		</form>
	</div>
</div>
