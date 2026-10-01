<?php
/**
 * Admin Theme Options Screen Renderer
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ADJDEV_News_Admin_Options {

	/**
	 * Render the Theme Options Dashboard
	 */
	public static function render() {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		$options = adjdev_news_get_options();
		?>
		<div class="wrap adjdev-admin-wrap">
			<div class="adjdev-header-panel">
				<div class="adjdev-brand">
					<div class="adjdev-badge">PREMIUM</div>
					<h1>ADJDEV News <span class="theme-ver">v<?php echo esc_html( ADJDEV_NEWS_VERSION ); ?></span></h1>
					<p class="tagline"><?php esc_html_e( 'High-performance news ecosystem & template framework', 'adjdev-news' ); ?></p>
				</div>
				<div class="adjdev-actions">
					<button type="button" id="adjdev-reset-all-btn" class="button button-secondary"><?php esc_html_e( 'Reset Defaults', 'adjdev-news' ); ?></button>
					<button type="button" id="adjdev-save-options-btn" class="button button-primary adjdev-btn-save">
						<span class="btn-text"><?php esc_html_e( 'Save Changes', 'adjdev-news' ); ?></span>
						<span class="spinner"></span>
					</button>
				</div>
			</div>

			<div class="adjdev-options-container">
				<!-- Sidebar Navigation -->
				<aside class="adjdev-options-nav">
					<div class="nav-search-box">
						<input type="text" id="adjdev-search-settings" placeholder="<?php esc_attr_e( 'Search settings...', 'adjdev-news' ); ?>" autocomplete="off" />
					</div>
					<ul class="adjdev-nav-tabs">
						<li class="active" data-tab="tab-dashboard"><span class="dashicons dashicons-dashboard"></span> <?php esc_html_e( 'Dashboard', 'adjdev-news' ); ?></li>
						<li data-tab="tab-general"><span class="dashicons dashicons-admin-generic"></span> <?php esc_html_e( 'General', 'adjdev-news' ); ?></li>
						<li data-tab="tab-logo"><span class="dashicons dashicons-format-image"></span> <?php esc_html_e( 'Logo & Branding', 'adjdev-news' ); ?></li>
						<li data-tab="tab-header"><span class="dashicons dashicons-heading"></span> <?php esc_html_e( 'Header & Topbar', 'adjdev-news' ); ?></li>
						<li data-tab="tab-mobile"><span class="dashicons dashicons-smartphone"></span> <?php esc_html_e( 'Mobile Header', 'adjdev-news' ); ?></li>
						<li data-tab="tab-footer"><span class="dashicons dashicons-editor-kitchensink"></span> <?php esc_html_e( 'Footer', 'adjdev-news' ); ?></li>
						<li data-tab="tab-homepage"><span class="dashicons dashicons-admin-home"></span> <?php esc_html_e( 'Homepage & Hero', 'adjdev-news' ); ?></li>
						<li data-tab="tab-blog"><span class="dashicons dashicons-welcome-write-blog"></span> <?php esc_html_e( 'Blog / Archives', 'adjdev-news' ); ?></li>
						<li data-tab="tab-single"><span class="dashicons dashicons-media-document"></span> <?php esc_html_e( 'Single Article', 'adjdev-news' ); ?></li>
						<li data-tab="tab-typography"><span class="dashicons dashicons-editor-bold"></span> <?php esc_html_e( 'Typography', 'adjdev-news' ); ?></li>
						<li data-tab="tab-colors"><span class="dashicons dashicons-color-picker"></span> <?php esc_html_e( 'Global Colors', 'adjdev-news' ); ?></li>
						<li data-tab="tab-darkmode"><span class="dashicons dashicons-moon"></span> <?php esc_html_e( 'Dark Mode', 'adjdev-news' ); ?></li>
						<li data-tab="tab-ads"><span class="dashicons dashicons-money-alt"></span> <?php esc_html_e( 'Advertisements', 'adjdev-news' ); ?></li>
						<li data-tab="tab-social"><span class="dashicons dashicons-share"></span> <?php esc_html_e( 'Social Profiles', 'adjdev-news' ); ?></li>
						<li data-tab="tab-progress"><span class="dashicons dashicons-leftright"></span> <?php esc_html_e( 'Reading Progress', 'adjdev-news' ); ?></li>
						<li data-tab="tab-performance"><span class="dashicons dashicons-performance"></span> <?php esc_html_e( 'Performance', 'adjdev-news' ); ?></li>
						<li data-tab="tab-seo"><span class="dashicons dashicons-search"></span> <?php esc_html_e( 'SEO & Schema', 'adjdev-news' ); ?></li>
						<li data-tab="tab-customcode"><span class="dashicons dashicons-editor-code"></span> <?php esc_html_e( 'Custom CSS / JS', 'adjdev-news' ); ?></li>
					</ul>
				</aside>

				<!-- Options Content Form -->
				<form id="adjdev-options-form" class="adjdev-options-content">
					<?php wp_nonce_field( 'adjdev_news_admin_nonce', 'adjdev_news_nonce' ); ?>

					<!-- TAB: Dashboard -->
					<div class="tab-pane active" id="tab-dashboard">
						<div class="pane-header">
							<h2><?php esc_html_e( 'Welcome to ADJDEV News', 'adjdev-news' ); ?></h2>
							<p><?php esc_html_e( 'Modular, ultra-responsive foundation ready for the upcoming ADJDEV Builder ecosystem.', 'adjdev-news' ); ?></p>
						</div>

						<div class="dashboard-grid">
							<div class="dash-card card-primary">
								<div class="card-icon"><span class="dashicons dashicons-layout"></span></div>
								<div class="card-info">
									<h4><?php esc_html_e( 'Active Template Preset', 'adjdev-news' ); ?></h4>
									<div class="active-preset-badge"><?php echo esc_html( strtoupper( str_replace( '-', ' ', adjdev_news_get_option( 'active_template', 'news-modern' ) ) ) ); ?></div>
									<a href="<?php echo esc_url( admin_url( 'admin.php?page=adjdev-news-templates' ) ); ?>" class="btn-link"><?php esc_html_e( 'Browse 12+ Template Presets &rarr;', 'adjdev-news' ); ?></a>
								</div>
							</div>

							<div class="dash-card">
								<div class="card-icon"><span class="dashicons dashicons-performance"></span></div>
								<div class="card-info">
									<h4><?php esc_html_e( 'Performance Score', 'adjdev-news' ); ?></h4>
									<div class="perf-metric">99+ <span>Core Web Vitals Optimized</span></div>
									<p class="sub"><?php esc_html_e( 'Vanilla JavaScript, Deferred Assets, Zero jQuery', 'adjdev-news' ); ?></p>
								</div>
							</div>

							<div class="dash-card">
								<div class="card-icon"><span class="dashicons dashicons-hammer"></span></div>
								<div class="card-info">
									<h4><?php esc_html_e( 'ADJDEV Builder Ecosystem', 'adjdev-news' ); ?></h4>
									<p class="sub"><?php esc_html_e( 'Theme hooks, section registries & CSS tokens ready for the upcoming ADJDEV Builder visual page builder plugin.', 'adjdev-news' ); ?></p>
								</div>
							</div>
						</div>
					</div>

					<!-- TAB: General -->
					<div class="tab-pane" id="tab-general">
						<div class="pane-header">
							<h2><?php esc_html_e( 'General Settings', 'adjdev-news' ); ?></h2>
						</div>

						<div class="opt-field">
							<label for="site_layout"><?php esc_html_e( 'Website Layout', 'adjdev-news' ); ?></label>
							<select name="site_layout" id="site_layout">
								<option value="fullwidth" <?php selected( $options['site_layout'], 'fullwidth' ); ?>><?php esc_html_e( 'Full Width (Recommended)', 'adjdev-news' ); ?></option>
								<option value="boxed" <?php selected( $options['site_layout'], 'boxed' ); ?>><?php esc_html_e( 'Boxed Layout', 'adjdev-news' ); ?></option>
							</select>
						</div>

						<div class="opt-field">
							<label for="container_width"><?php esc_html_e( 'Container Width (px)', 'adjdev-news' ); ?></label>
							<input type="number" name="container_width" id="container_width" value="<?php echo esc_attr( $options['container_width'] ); ?>" min="1000" max="1600" />
						</div>

						<div class="opt-field opt-toggle">
							<label for="back_to_top_enable"><?php esc_html_e( 'Enable Back to Top Button', 'adjdev-news' ); ?></label>
							<input type="checkbox" name="back_to_top_enable" id="back_to_top_enable" value="1" <?php checked( $options['back_to_top_enable'] ); ?> />
						</div>
					</div>

					<!-- TAB: Header -->
					<div class="tab-pane" id="tab-header">
						<div class="pane-header">
							<h2><?php esc_html_e( 'Header & Topbar Settings', 'adjdev-news' ); ?></h2>
						</div>

						<div class="opt-field">
							<label for="header_layout"><?php esc_html_e( 'Header Layout Style', 'adjdev-news' ); ?></label>
							<select name="header_layout" id="header_layout">
								<option value="default" <?php selected( $options['header_layout'], 'default' ); ?>><?php esc_html_e( 'Default (Logo Left, Menu Right, Icons)', 'adjdev-news' ); ?></option>
								<option value="classic" <?php selected( $options['header_layout'], 'classic' ); ?>><?php esc_html_e( 'Classic (Logo + Banner Top, Nav Below)', 'adjdev-news' ); ?></option>
								<option value="center-logo" <?php selected( $options['header_layout'], 'center-logo' ); ?>><?php esc_html_e( 'Center Logo & Centered Nav', 'adjdev-news' ); ?></option>
								<option value="magazine" <?php selected( $options['header_layout'], 'magazine' ); ?>><?php esc_html_e( 'Magazine Portal with Ad Banner', 'adjdev-news' ); ?></option>
								<option value="minimal" <?php selected( $options['header_layout'], 'minimal' ); ?>><?php esc_html_e( 'Minimal Clean', 'adjdev-news' ); ?></option>
							</select>
						</div>

						<div class="opt-field opt-toggle">
							<label for="header_sticky"><?php esc_html_e( 'Sticky Header on Scroll', 'adjdev-news' ); ?></label>
							<input type="checkbox" name="header_sticky" id="header_sticky" value="1" <?php checked( $options['header_sticky'] ); ?> />
						</div>

						<div class="opt-field opt-toggle">
							<label for="header_topbar_enable"><?php esc_html_e( 'Enable Top Bar', 'adjdev-news' ); ?></label>
							<input type="checkbox" name="header_topbar_enable" id="header_topbar_enable" value="1" <?php checked( $options['header_topbar_enable'] ); ?> />
						</div>

						<div class="opt-field opt-toggle">
							<label for="breaking_news_enable"><?php esc_html_e( 'Enable Breaking News Ticker', 'adjdev-news' ); ?></label>
							<input type="checkbox" name="breaking_news_enable" id="breaking_news_enable" value="1" <?php checked( $options['breaking_news_enable'] ); ?> />
						</div>

						<div class="opt-field">
							<label for="breaking_news_title"><?php esc_html_e( 'Breaking News Badge Text', 'adjdev-news' ); ?></label>
							<input type="text" name="breaking_news_title" id="breaking_news_title" value="<?php echo esc_attr( $options['breaking_news_title'] ); ?>" />
						</div>
					</div>

					<!-- TAB: Colors -->
					<div class="tab-pane" id="tab-colors">
						<div class="pane-header">
							<h2><?php esc_html_e( 'Global Color Tokens', 'adjdev-news' ); ?></h2>
						</div>

						<div class="opt-field">
							<label for="color_primary"><?php esc_html_e( 'Primary Accent Color', 'adjdev-news' ); ?></label>
							<input type="text" name="color_primary" id="color_primary" class="adjdev-color-input" value="<?php echo esc_attr( $options['color_primary'] ); ?>" />
						</div>

						<div class="opt-field">
							<label for="color_secondary"><?php esc_html_e( 'Secondary Dark Color', 'adjdev-news' ); ?></label>
							<input type="text" name="color_secondary" id="color_secondary" class="adjdev-color-input" value="<?php echo esc_attr( $options['color_secondary'] ); ?>" />
						</div>

						<div class="opt-field">
							<label for="color_accent"><?php esc_html_e( 'Badge / Highlight Color', 'adjdev-news' ); ?></label>
							<input type="text" name="color_accent" id="color_accent" class="adjdev-color-input" value="<?php echo esc_attr( $options['color_accent'] ); ?>" />
						</div>
					</div>

					<!-- TAB: Single Post -->
					<div class="tab-pane" id="tab-single">
						<div class="pane-header">
							<h2><?php esc_html_e( 'Single Article Layout & Elements', 'adjdev-news' ); ?></h2>
						</div>

						<div class="opt-field">
							<label for="single_sidebar_position"><?php esc_html_e( 'Sidebar Position', 'adjdev-news' ); ?></label>
							<select name="single_sidebar_position" id="single_sidebar_position">
								<option value="right" <?php selected( $options['single_sidebar_position'], 'right' ); ?>><?php esc_html_e( 'Right Sidebar', 'adjdev-news' ); ?></option>
								<option value="left" <?php selected( $options['single_sidebar_position'], 'left' ); ?>><?php esc_html_e( 'Left Sidebar', 'adjdev-news' ); ?></option>
								<option value="none" <?php selected( $options['single_sidebar_position'], 'none' ); ?>><?php esc_html_e( 'No Sidebar (Narrow Center)', 'adjdev-news' ); ?></option>
							</select>
						</div>

						<div class="opt-field opt-toggle">
							<label for="single_toc_enable"><?php esc_html_e( 'Automated Table of Contents (TOC)', 'adjdev-news' ); ?></label>
							<input type="checkbox" name="single_toc_enable" id="single_toc_enable" value="1" <?php checked( $options['single_toc_enable'] ); ?> />
						</div>

						<div class="opt-field opt-toggle">
							<label for="single_author_box_enable"><?php esc_html_e( 'Author Bio Box', 'adjdev-news' ); ?></label>
							<input type="checkbox" name="single_author_box_enable" id="single_author_box_enable" value="1" <?php checked( $options['single_author_box_enable'] ); ?> />
						</div>

						<div class="opt-field opt-toggle">
							<label for="single_related_posts_enable"><?php esc_html_e( 'Related Posts Section', 'adjdev-news' ); ?></label>
							<input type="checkbox" name="single_related_posts_enable" id="single_related_posts_enable" value="1" <?php checked( $options['single_related_posts_enable'] ); ?> />
						</div>
					</div>

					<!-- TAB: Advertisements -->
					<div class="tab-pane" id="tab-ads">
						<div class="pane-header">
							<h2><?php esc_html_e( 'Configurable Advertisement Slots', 'adjdev-news' ); ?></h2>
						</div>

						<div class="ad-slot-config">
							<h3><?php esc_html_e( 'Header Ad Slot (728x90 / Responsive)', 'adjdev-news' ); ?></h3>
							<div class="opt-field opt-toggle">
								<label for="ad_header_enable"><?php esc_html_e( 'Enable Header Ad', 'adjdev-news' ); ?></label>
								<input type="checkbox" name="ad_header_enable" id="ad_header_enable" value="1" <?php checked( $options['ad_header_enable'] ); ?> />
							</div>
							<div class="opt-field">
								<label for="ad_header_code"><?php esc_html_e( 'HTML / Script / Image Ad Code', 'adjdev-news' ); ?></label>
								<textarea name="ad_header_code" id="ad_header_code" rows="3"><?php echo esc_textarea( $options['ad_header_code'] ); ?></textarea>
							</div>
						</div>

						<div class="ad-slot-config">
							<h3><?php esc_html_e( 'In-Content Article Ad Slot', 'adjdev-news' ); ?></h3>
							<div class="opt-field opt-toggle">
								<label for="ad_in_content_enable"><?php esc_html_e( 'Enable In-Content Ad', 'adjdev-news' ); ?></label>
								<input type="checkbox" name="ad_in_content_enable" id="ad_in_content_enable" value="1" <?php checked( $options['ad_in_content_enable'] ); ?> />
							</div>
							<div class="opt-field">
								<label for="ad_in_content_paragraph"><?php esc_html_e( 'Insert After Paragraph #', 'adjdev-news' ); ?></label>
								<input type="number" name="ad_in_content_paragraph" id="ad_in_content_paragraph" value="<?php echo esc_attr( $options['ad_in_content_paragraph'] ); ?>" min="1" max="10" />
							</div>
							<div class="opt-field">
								<label for="ad_in_content_code"><?php esc_html_e( 'Ad Code', 'adjdev-news' ); ?></label>
								<textarea name="ad_in_content_code" id="ad_in_content_code" rows="3"><?php echo esc_textarea( $options['ad_in_content_code'] ); ?></textarea>
							</div>
						</div>
					</div>

					<!-- TAB: Dark Mode -->
					<div class="tab-pane" id="tab-darkmode">
						<div class="pane-header">
							<h2><?php esc_html_e( 'Dark Mode Options', 'adjdev-news' ); ?></h2>
						</div>

						<div class="opt-field opt-toggle">
							<label for="dark_mode_enable"><?php esc_html_e( 'Enable Dark Mode Feature', 'adjdev-news' ); ?></label>
							<input type="checkbox" name="dark_mode_enable" id="dark_mode_enable" value="1" <?php checked( $options['dark_mode_enable'] ); ?> />
						</div>

						<div class="opt-field">
							<label for="dark_mode_default"><?php esc_html_e( 'Default Visitor Mode', 'adjdev-news' ); ?></label>
							<select name="dark_mode_default" id="dark_mode_default">
								<option value="system" <?php selected( $options['dark_mode_default'], 'system' ); ?>><?php esc_html_e( 'System Preference (OS Match)', 'adjdev-news' ); ?></option>
								<option value="light" <?php selected( $options['dark_mode_default'], 'light' ); ?>><?php esc_html_e( 'Light Mode Always', 'adjdev-news' ); ?></option>
								<option value="dark" <?php selected( $options['dark_mode_default'], 'dark' ); ?>><?php esc_html_e( 'Dark Mode Always', 'adjdev-news' ); ?></option>
							</select>
						</div>
					</div>

					<!-- TAB: Custom Code -->
					<div class="tab-pane" id="tab-customcode">
						<div class="pane-header">
							<h2><?php esc_html_e( 'Custom CSS & Scripts', 'adjdev-news' ); ?></h2>
						</div>

						<div class="opt-field">
							<label for="custom_css"><?php esc_html_e( 'Custom CSS', 'adjdev-news' ); ?></label>
							<textarea name="custom_css" id="custom_css" rows="6" placeholder=".my-custom-class { color: red; }"><?php echo esc_textarea( $options['custom_css'] ); ?></textarea>
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php
	}
}
