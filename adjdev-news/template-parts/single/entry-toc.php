<?php
/**
 * Single Post Automated Table of Contents (TOC)
 *
 * Scans content for h2 and h3 headings and automatically outputs an accessible TOC
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$content = get_post_field( 'post_content', get_the_ID() );
preg_match_all( '/<h([2-3])[^>]*>(.*?)<\/h\1>/i', $content, $matches, PREG_SET_ORDER );

$min_headings = intval( adjdev_news_get_option( 'single_toc_min_headings', 3 ) );

if ( count( $matches ) < $min_headings ) {
	return;
}
?>
<div class="adjdev-toc-box">
	<div class="toc-header">
		<h4 class="toc-title">
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
			<?php esc_html_e( 'Table of Contents', 'adjdev-news' ); ?>
		</h4>
		<button type="button" class="toc-toggle-btn">[Hide]</button>
	</div>
	
	<ol class="toc-list">
		<?php
		$counter = 0;
		foreach ( $matches as $match ) {
			$counter++;
			$level = $match[1];
			$title = wp_strip_all_tags( $match[2] );
			$slug  = sanitize_title( $title ) ?: 'heading-' . $counter;
			echo '<li class="toc-item toc-level-' . esc_attr( $level ) . '"><a href="#' . esc_attr( $slug ) . '">' . esc_html( $title ) . '</a></li>';
		}
		?>
	</ol>
</div>
