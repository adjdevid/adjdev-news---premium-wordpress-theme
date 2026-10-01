<?php
/**
 * Header Layout: Magazine Portal & Minimal
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header id="masthead" class="site-header header-layout-magazine">
	<div class="adjdev-container">
		<div class="header-main-inner">
			<button type="button" class="header-action-btn mobile-menu-trigger" aria-label="<?php esc_attr_e( 'Open Navigation', 'adjdev-news' ); ?>">
				<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
			</button>

			<div class="site-branding">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?><span>MAG</span></a></h1>
			</div>

			<div class="header-magazine-ad" style="display: none;">
				<?php adjdev_news_render_ad_slot( 'header' ); ?>
			</div>

			<div class="header-actions">
				<button type="button" class="header-action-btn adjdev-search-trigger" aria-label="<?php esc_attr_e( 'Search', 'adjdev-news' ); ?>">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
				</button>
				<?php if ( adjdev_news_get_option( 'dark_mode_enable', true ) ) : ?>
					<button type="button" class="header-action-btn adjdev-theme-toggle" aria-label="<?php esc_attr_e( 'Toggle Theme Mode', 'adjdev-news' ); ?>">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
					</button>
				<?php endif; ?>
			</div>
		</div>

		<div class="magazine-nav-bar" style="border-top: 1px solid var(--adjdev-border); padding: 4px 0;">
			<nav class="main-navigation">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'primary-menu', 'container' => false ) );
				}
				?>
			</nav>
		</div>
	</div>
</header>
