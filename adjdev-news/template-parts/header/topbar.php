<?php
/**
 * Header Topbar Component
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="adjdev-topbar">
	<div class="adjdev-container">
		<div class="adjdev-topbar-inner">
			
			<div class="topbar-left">
				<?php if ( adjdev_news_get_option( 'header_topbar_date', true ) ) : ?>
					<div class="topbar-date">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
						<span><?php echo esc_html( date_i18n( get_option( 'date_format' ) ) ); ?></span>
					</div>
				<?php endif; ?>
			</div>

			<div class="topbar-right">
				<?php
				if ( has_nav_menu( 'topbar' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'topbar',
							'menu_class'     => 'topbar-menu',
							'container'      => false,
							'depth'          => 1,
						)
					);
				}
				?>
			</div>

		</div>
	</div>
</div>
