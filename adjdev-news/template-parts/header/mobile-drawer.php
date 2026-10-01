<?php
/**
 * Mobile Drawer Navigation
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="adjdev-mobile-drawer" class="adjdev-mobile-drawer" aria-hidden="true">
	<div class="mobile-drawer-overlay"></div>
	<div class="mobile-drawer-inner">
		
		<div class="mobile-drawer-header">
			<div class="site-branding">
				<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?><span>.</span></a></h2>
			</div>
			<button type="button" class="mobile-drawer-close" aria-label="<?php esc_attr_e( 'Close navigation', 'adjdev-news' ); ?>">
				<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
			</button>
		</div>

		<nav class="mobile-nav-menu">
			<?php
			if ( has_nav_menu( 'mobile' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'mobile',
						'menu_class'     => 'mobile-menu-items',
						'container'      => false,
					)
				);
			} elseif ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_class'     => 'mobile-menu-items',
						'container'      => false,
					)
				);
			}
			?>
		</nav>

		<div class="mobile-drawer-footer">
			<?php if ( adjdev_news_get_option( 'dark_mode_enable', true ) ) : ?>
				<div class="drawer-theme-toggle">
					<span><?php esc_html_e( 'Dark Mode', 'adjdev-news' ); ?></span>
					<button type="button" class="header-action-btn adjdev-theme-toggle">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
					</button>
				</div>
			<?php endif; ?>
		</div>

	</div>
</div>

<style>
.adjdev-mobile-drawer {
  position: fixed;
  inset: 0;
  z-index: 99999;
  visibility: hidden;
  transition: visibility 0.3s ease;
}
.adjdev-mobile-drawer.is-open {
  visibility: visible;
}
.mobile-drawer-overlay {
  position: absolute;
  inset: 0;
  background: rgba(15, 23, 42, 0.7);
  opacity: 0;
  transition: opacity 0.3s ease;
}
.adjdev-mobile-drawer.is-open .mobile-drawer-overlay {
  opacity: 1;
}
.mobile-drawer-inner {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  width: 82%;
  max-width: 340px;
  background: var(--adjdev-surface-card);
  box-shadow: var(--adjdev-shadow-lg);
  transform: translateX(-100%);
  transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  display: flex;
  flex-direction: column;
  padding: 24px;
  overflow-y: auto;
}
.adjdev-mobile-drawer.is-open .mobile-drawer-inner {
  transform: translateX(0);
}
.mobile-drawer-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-bottom: 20px;
  border-bottom: 1px solid var(--adjdev-border);
}
.mobile-drawer-close {
  background: transparent;
  border: none;
  cursor: pointer;
  color: var(--adjdev-text);
}
.mobile-nav-menu ul {
  list-style: none;
  padding: 20px 0;
  margin: 0;
}
.mobile-nav-menu ul li {
  margin-bottom: 14px;
}
.mobile-nav-menu ul li a {
  font-size: 1.1rem;
  font-weight: 600;
  color: var(--adjdev-text-heading);
}
.mobile-drawer-footer {
  margin-top: auto;
  padding-top: 20px;
  border-top: 1px solid var(--adjdev-border);
}
.drawer-theme-toggle {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-weight: 600;
}
</style>
