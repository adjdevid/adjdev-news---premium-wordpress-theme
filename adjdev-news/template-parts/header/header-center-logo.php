<?php
/**
 * Header Layout: Center Logo
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header id="masthead" class="site-header header-layout-center-logo">
	<div class="adjdev-container">
		<div class="header-center-top" style="text-align: center; padding: 24px 0 16px 0;">
			<div class="site-branding">
				<h1 class="site-title" style="font-size: 2.4rem;"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?><span>.</span></a></h1>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			</div>
		</div>

		<div class="header-center-nav" style="border-top: 1px solid var(--adjdev-border); display: flex; justify-content: center; padding: 6px 0;">
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
