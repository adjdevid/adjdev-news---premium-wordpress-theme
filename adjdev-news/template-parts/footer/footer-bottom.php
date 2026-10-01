<?php
/**
 * Footer Bottom Copyright & Social Links
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="footer-bottom-bar">
	<div class="adjdev-container">
		<div class="footer-bottom-inner">
			
			<div class="footer-copyright">
				<?php echo esc_html( adjdev_news_get_option( 'footer_copyright', '© ' . gmdate( 'Y' ) . ' ADJDEV News. All Rights Reserved.' ) ); ?>
			</div>

			<?php if ( adjdev_news_get_option( 'footer_social_enable', true ) ) : ?>
				<div class="footer-social-links">
					<?php
					$socials = array(
						'facebook'  => '<svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
						'twitter'   => '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
						'instagram' => '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>',
						'youtube'   => '<svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
					);

					foreach ( $socials as $network => $icon_svg ) {
						$url = adjdev_news_get_option( 'social_' . $network, '' );
						if ( ! empty( $url ) ) {
							echo '<a href="' . esc_url( $url ) . '" target="_blank" rel="noopener noreferrer" class="footer-social-link" aria-label="' . esc_attr( ucfirst( $network ) ) . '">' . $icon_svg . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
					}
					?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</div>
