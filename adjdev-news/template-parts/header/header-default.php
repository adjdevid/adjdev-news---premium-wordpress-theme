<?php
/**
 * Header Layout: Default (Logo Left, Nav Center, Actions Right)
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header id="masthead" class="site-header header-layout-default">
	<div class="adjdev-container">
		<div class="header-main-inner">
			
			<!-- Mobile Hamburger -->
			<button type="button" class="header-action-btn mobile-menu-trigger" aria-label="<?php esc_attr_e( 'Open Navigation Menu', 'adjdev-news' ); ?>">
				<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
			</button>

			<!-- Branding & Logo -->
			<div class="site-branding">
				<?php if ( has_custom_logo() ) : ?>
					<div class="site-logo"><?php the_custom_logo(); ?></div>
				<?php else : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?><span>.</span></a></h1>
					<?php if ( adjdev_news_get_option( 'logo_tagline_enable', true ) ) : ?>
						<p class="site-description"><?php bloginfo( 'description' ); ?></p>
					<?php endif; ?>
				<?php endif; ?>
			</div>

			<!-- Main Navigation -->
			<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'adjdev-news' ); ?>">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_class'     => 'primary-menu',
							'container'      => false,
							'depth'          => 3,
						)
					);
				} else {
					echo '<ul class="primary-menu"><li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'adjdev-news' ) . '</a></li></ul>';
				}
				?>
			</nav>

			<!-- Header Actions (Search, Dark Mode, CTA) -->
			<div class="header-actions">
				<?php if ( adjdev_news_get_option( 'header_search_enable', true ) ) : ?>
					<button type="button" class="header-action-btn adjdev-search-trigger" aria-label="<?php esc_attr_e( 'Search Articles', 'adjdev-news' ); ?>">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
					</button>
				<?php endif; ?>

				<?php if ( adjdev_news_get_option( 'dark_mode_enable', true ) && adjdev_news_get_option( 'header_dark_mode_toggle', true ) ) : ?>
					<button type="button" class="header-action-btn adjdev-theme-toggle" aria-label="<?php esc_attr_e( 'Toggle Theme Mode', 'adjdev-news' ); ?>">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
					</button>
				<?php endif; ?>

				<?php if ( adjdev_news_get_option( 'header_cta_enable', false ) ) : ?>
					<a href="<?php echo esc_url( adjdev_news_get_option( 'header_cta_url', '#' ) ); ?>" class="header-cta-btn">
						<?php echo esc_html( adjdev_news_get_option( 'header_cta_text', __( 'Subscribe', 'adjdev-news' ) ) ); ?>
					</a>
				<?php endif; ?>
			</div>

		</div><!-- .header-main-inner -->
	</div><!-- .adjdev-container -->
</header>
