<?php
/**
 * Header Layout: Classic (Logo & Ad Top, Primary Nav Fullwidth Below)
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header id="masthead" class="site-header header-layout-classic">
	<div class="header-classic-top">
		<div class="adjdev-container">
			<div class="header-main-inner">
				<div class="site-branding">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?><span>.</span></a></h1>
				</div>
				<div class="header-classic-banner">
					<?php adjdev_news_render_ad_slot( 'header' ); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="header-classic-nav-bar">
		<div class="adjdev-container">
			<div class="nav-bar-inner">
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
	</div>
</header>
