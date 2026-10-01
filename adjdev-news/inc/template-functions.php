<?php
/**
 * Additional features and template functions
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function adjdev_news_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Site layout class
	$classes[] = 'layout-' . sanitize_html_class( adjdev_news_get_option( 'site_layout', 'fullwidth' ) );

	// Header layout class
	$classes[] = 'header-style-' . sanitize_html_class( adjdev_news_get_option( 'header_layout', 'default' ) );

	// Dark mode default
	if ( 'dark' === adjdev_news_get_default_theme_mode() ) {
		$classes[] = 'dark-mode';
	}

	return $classes;
}
add_filter( 'body_class', 'adjdev_news_body_classes' );

/**
 * Custom excerpt length
 */
function adjdev_news_custom_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}
	return intval( adjdev_news_get_option( 'blog_excerpt_length', 20 ) );
}
add_filter( 'excerpt_length', 'adjdev_news_custom_excerpt_length', 999 );

/**
 * Custom excerpt more string
 */
function adjdev_news_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'adjdev_news_excerpt_more' );

/**
 * Render social share buttons for single posts
 *
 * @param int $post_id
 */
function adjdev_news_render_share_buttons( $post_id = 0 ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$url   = rawurlencode( get_permalink( $post_id ) );
	$title = rawurlencode( html_entity_decode( get_the_title( $post_id ), ENT_COMPAT, 'UTF-8' ) );
	?>
	<div class="adjdev-share-bar" data-url="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
		<span class="share-label"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg> <?php esc_html_e( 'Share:', 'adjdev-news' ); ?></span>
		
		<div class="share-buttons-list">
			<!-- WhatsApp -->
			<a href="https://api.whatsapp.com/send?text=<?php echo esc_attr( $title . '%20' . $url ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-whatsapp" aria-label="<?php esc_attr_e( 'Share on WhatsApp', 'adjdev-news' ); ?>">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2m.01 1.67c2.2 0 4.26.86 5.82 2.42a8.225 8.225 0 0 1 2.41 5.83c0 4.54-3.7 8.24-8.24 8.24-1.48 0-2.93-.4-4.2-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.196 8.196 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24m4.52 11.66c-.25-.13-1.47-.72-1.7-.81-.23-.08-.39-.13-.56.13-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.13-1.06-.39-2.02-1.25-.75-.67-1.26-1.5-1.4-1.76-.14-.25-.01-.39.11-.51.11-.11.25-.29.37-.44.13-.15.17-.25.25-.42.08-.17.04-.32-.02-.44-.06-.13-.56-1.35-.77-1.85-.2-.49-.41-.42-.56-.43h-.48c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1 0 1.24.9 2.44 1.03 2.61.13.17 1.77 2.7 4.29 3.79.6.26 1.07.41 1.44.53.6.19 1.15.16 1.58.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.06-.11-.22-.18-.47-.3Z"/></svg>
			</a>

			<!-- X (Twitter) -->
			<a href="https://twitter.com/intent/tweet?text=<?php echo esc_attr( $title ); ?>&url=<?php echo esc_attr( $url ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-twitter" aria-label="<?php esc_attr_e( 'Share on X', 'adjdev-news' ); ?>">
				<svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
			</a>

			<!-- Facebook -->
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_attr( $url ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-facebook" aria-label="<?php esc_attr_e( 'Share on Facebook', 'adjdev-news' ); ?>">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
			</a>

			<!-- Telegram -->
			<a href="https://t.me/share/url?url=<?php echo esc_attr( $url ); ?>&text=<?php echo esc_attr( $title ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-telegram" aria-label="<?php esc_attr_e( 'Share on Telegram', 'adjdev-news' ); ?>">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="m20.665 3.717-17.73 6.837c-1.21.486-1.203 1.161-.222 1.462l4.552 1.42 10.532-6.645c.498-.303.953-.14.579.192l-8.533 7.701h-.002l-.313 4.672c.46 0 .663-.211.921-.46l2.211-2.15 4.599 3.397c.848.467 1.457.227 1.668-.785l3.019-14.228c.309-1.239-.473-1.8-1.282-1.42z"/></svg>
			</a>

			<!-- Copy Link -->
			<button type="button" class="share-btn share-copy-link" data-copied-text="<?php esc_attr_e( 'Copied!', 'adjdev-news' ); ?>" aria-label="<?php esc_attr_e( 'Copy Link', 'adjdev-news' ); ?>">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
			</button>
		</div>
	</div>
	<?php
}

/**
 * Filter the content to insert in-content ads after paragraph N
 */
function adjdev_news_insert_in_content_ad( $content ) {
	if ( ! is_singular( 'post' ) || is_admin() ) {
		return $content;
	}

	if ( ! adjdev_news_get_option( 'ad_in_content_enable', false ) ) {
		return $content;
	}

	$ad_code = adjdev_news_get_option( 'ad_in_content_code', '' );
	if ( empty( $ad_code ) ) {
		return $content;
	}

	$paragraph_number = intval( adjdev_news_get_option( 'ad_in_content_paragraph', 3 ) );
	$paragraphs       = explode( '</p>', $content );

	if ( count( $paragraphs ) > $paragraph_number ) {
		$ad_markup = '<div class="adjdev-ad-slot adjdev-ad-in-content">' . $ad_code . '</div>';
		$paragraphs[ $paragraph_number - 1 ] .= '</p>' . $ad_markup;
		return implode( '', $paragraphs );
	}

	return $content;
}
add_filter( 'the_content', 'adjdev_news_insert_in_content_ad' );
