<?php
/**
 * Admin Template Library Screen
 *
 * Scans /templates-library/ automatically and renders interactive template cards.
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ADJDEV_News_Admin_Templates {

	/**
	 * Render the Template Library Admin Screen
	 */
	public static function render() {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		$templates = ADJDEV_News_Template_Library::get_templates( true );
		$active_id = ADJDEV_News_Template_Library::get_active_template_id();
		?>
		<div class="wrap adjdev-admin-wrap">
			<div class="adjdev-header-panel">
				<div class="adjdev-brand">
					<div class="adjdev-badge">TEMPLATES</div>
					<h1><?php esc_html_e( 'ADJDEV Template Library', 'adjdev-news' ); ?></h1>
					<p class="tagline"><?php esc_html_e( 'Auto-detected layouts from /templates-library/. Switch presets safely with zero data loss.', 'adjdev-news' ); ?></p>
				</div>
				<div class="adjdev-actions">
					<span class="lib-counter"><?php echo count( $templates ); ?> <?php esc_html_e( 'Templates Detected', 'adjdev-news' ); ?></span>
				</div>
			</div>

			<!-- Notice Banner on Extensibility -->
			<div class="adjdev-extensibility-notice">
				<span class="dashicons dashicons-info"></span>
				<div class="notice-body">
					<strong><?php esc_html_e( 'Dynamic Extensibility:', 'adjdev-news' ); ?></strong>
					<?php esc_html_e( 'To add a new template, simply create a folder in', 'adjdev-news' ); ?>
					<code>/wp-content/themes/adjdev-news/templates-library/your-template/</code>
					<?php esc_html_e( 'with a valid', 'adjdev-news' ); ?> <code>template.json</code>.
					<?php esc_html_e( 'The theme detects it immediately with zero code changes!', 'adjdev-news' ); ?>
				</div>
			</div>

			<!-- Template Cards Grid -->
			<div class="adjdev-templates-grid">
				<?php if ( empty( $templates ) ) : ?>
					<div class="no-templates-found">
						<p><?php esc_html_e( 'No templates found in /templates-library/. Please check your installation.', 'adjdev-news' ); ?></p>
					</div>
				<?php else : ?>
					<?php foreach ( $templates as $tpl ) :
						$is_active = ( $tpl['id'] === $active_id );
					?>
						<div class="adjdev-template-card <?php echo $is_active ? 'is-active' : ''; ?>" data-id="<?php echo esc_attr( $tpl['id'] ); ?>">
							<div class="template-thumb">
								<img src="<?php echo esc_url( $tpl['preview'] ); ?>" alt="<?php echo esc_attr( $tpl['name'] ); ?>" loading="lazy" />
								<?php if ( $is_active ) : ?>
									<span class="badge-active"><span class="dashicons dashicons-yes"></span> <?php esc_html_e( 'Active Layout', 'adjdev-news' ); ?></span>
								<?php endif; ?>
							</div>

							<div class="template-details">
								<div class="template-header">
									<h3 class="template-name"><?php echo esc_html( $tpl['name'] ); ?></h3>
									<span class="template-version">v<?php echo esc_html( $tpl['version'] ); ?></span>
								</div>
								
								<p class="template-desc"><?php echo esc_html( $tpl['description'] ); ?></p>

								<?php if ( ! empty( $tpl['supported_features'] ) ) : ?>
									<div class="template-features">
										<?php foreach ( $tpl['supported_features'] as $feature ) : ?>
											<span class="feature-tag"><?php echo esc_html( $feature ); ?></span>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>

								<div class="template-footer">
									<span class="template-category"><?php echo esc_html( $tpl['category'] ); ?></span>
									<div class="template-actions">
										<?php if ( $is_active ) : ?>
											<button type="button" class="button button-disabled" disabled><?php esc_html_e( 'Activated', 'adjdev-news' ); ?></button>
										<?php else : ?>
											<button type="button" class="button button-primary adjdev-activate-tpl-btn" data-id="<?php echo esc_attr( $tpl['id'] ); ?>" data-name="<?php echo esc_attr( $tpl['name'] ); ?>">
												<span class="btn-text"><?php esc_html_e( 'Activate', 'adjdev-news' ); ?></span>
												<span class="spinner"></span>
											</button>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
