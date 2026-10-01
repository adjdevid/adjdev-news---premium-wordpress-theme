<?php
/**
 * Header Layout: Minimal Clean
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header id="masthead" class="site-header header-layout-minimal">
	<div class="adjdev-container">
		<div class="header-main-inner" style="height: 60px;">
			<div class="site-branding">
				<h1 class="site-title" style="font-size: 1.35rem;"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			</div>

			<nav class="main-navigation">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'primary-menu', 'container' => false ) );
				}
				?>
			</nav>

			<div class="header-actions">
				<button type="button" class="header-action-btn adjdev-search-trigger" aria-label="<?php esc_attr_e( 'Search', 'adjdev-news' ); ?>">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
				</button>
			</div>
		</div>
	</div>
</header>
