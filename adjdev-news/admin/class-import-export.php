<?php
/**
 * Admin Import / Export Options
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ADJDEV_News_Admin_Import_Export {

	public static function render() {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		$options_json = wp_json_encode( adjdev_news_get_options(), JSON_PRETTY_PRINT );
		?>
		<div class="wrap adjdev-admin-wrap">
			<div class="adjdev-header-panel">
				<div class="adjdev-brand">
					<div class="adjdev-badge">DATA</div>
					<h1><?php esc_html_e( 'Import / Export Theme Options', 'adjdev-news' ); ?></h1>
					<p class="tagline"><?php esc_html_e( 'Backup your customizations or migrate settings across websites.', 'adjdev-news' ); ?></p>
				</div>
			</div>

			<div class="import-export-grid">
				<div class="import-export-card">
					<h3><?php esc_html_e( 'Export Settings', 'adjdev-news' ); ?></h3>
					<p><?php esc_html_e( 'Copy or download this JSON string to backup your Theme Options configuration.', 'adjdev-news' ); ?></p>
					<textarea readonly class="large-text code" rows="12"><?php echo esc_textarea( $options_json ); ?></textarea>
				</div>

				<div class="import-export-card">
					<h3><?php esc_html_e( 'Import Settings', 'adjdev-news' ); ?></h3>
					<p><?php esc_html_e( 'Paste a valid JSON backup here to restore Theme Options.', 'adjdev-news' ); ?></p>
					<form method="post" action="">
						<?php wp_nonce_field( 'adjdev_import_nonce', 'adjdev_import_security' ); ?>
						<textarea name="adjdev_import_data" class="large-text code" rows="10" placeholder="<?php esc_attr_e( 'Paste JSON here...', 'adjdev-news' ); ?>"></textarea>
						<p><input type="submit" name="adjdev_import_submit" class="button button-primary" value="<?php esc_attr_e( 'Import Configuration', 'adjdev-news' ); ?>" /></p>
					</form>
				</div>
			</div>
		</div>
		<?php
	}
}
