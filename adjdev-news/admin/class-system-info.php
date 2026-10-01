<?php
/**
 * Admin System Info Diagnostic Screen
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ADJDEV_News_Admin_System_Info {

	public static function render() {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		$theme = wp_get_theme();
		?>
		<div class="wrap adjdev-admin-wrap">
			<div class="adjdev-header-panel">
				<div class="adjdev-brand">
					<div class="adjdev-badge">DIAGNOSTICS</div>
					<h1><?php esc_html_e( 'System & Environment Info', 'adjdev-news' ); ?></h1>
					<p class="tagline"><?php esc_html_e( 'Verify server compatibility, PHP extensions, and directory write permissions.', 'adjdev-news' ); ?></p>
				</div>
			</div>

			<div class="system-info-table-wrap">
				<table class="widefat striped system-info-table">
					<thead>
						<tr>
							<th colspan="2"><?php esc_html_e( 'WordPress & Theme Environment', 'adjdev-news' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><strong><?php esc_html_e( 'Theme Name & Version', 'adjdev-news' ); ?></strong></td>
							<td><?php echo esc_html( $theme->get( 'Name' ) . ' v' . $theme->get( 'Version' ) ); ?></td>
						</tr>
						<tr>
							<td><strong><?php esc_html_e( 'WordPress Version', 'adjdev-news' ); ?></strong></td>
							<td><?php echo esc_html( get_bloginfo( 'version' ) ); ?></td>
						</tr>
						<tr>
							<td><strong><?php esc_html_e( 'PHP Version', 'adjdev-news' ); ?></strong></td>
							<td><?php echo esc_html( PHP_VERSION ); ?> (<?php echo version_compare( PHP_VERSION, '8.1.0', '>=' ) ? '<span class="status-ok">✔ Supported</span>' : '<span class="status-warn">⚠ PHP 8.1+ Recommended</span>'; ?>)</td>
						</tr>
						<tr>
							<td><strong><?php esc_html_e( 'Memory Limit', 'adjdev-news' ); ?></strong></td>
							<td><?php echo esc_html( ini_get( 'memory_limit' ) ); ?></td>
						</tr>
						<tr>
							<td><strong><?php esc_html_e( 'Template Library Directory', 'adjdev-news' ); ?></strong></td>
							<td><code><?php echo esc_html( ADJDEV_NEWS_TEMPLATES_LIB_DIR ); ?></code> (<?php echo is_readable( ADJDEV_NEWS_TEMPLATES_LIB_DIR ) ? '<span class="status-ok">✔ Readable</span>' : '<span class="status-bad">✖ Unreadable</span>'; ?>)</td>
						</tr>
						<tr>
							<td><strong><?php esc_html_e( 'Active Template ID', 'adjdev-news' ); ?></strong></td>
							<td><code><?php echo esc_html( ADJDEV_News_Template_Library::get_active_template_id() ); ?></code></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<?php
	}
}
