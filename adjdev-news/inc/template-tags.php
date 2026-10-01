<?php
/**
 * Custom template tags for this theme
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'adjdev_news_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function adjdev_news_posted_on() {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) && adjdev_news_get_option( 'single_post_meta_updated', true ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated screen-reader-text" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		echo '<span class="posted-on"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> ' . $time_string . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'adjdev_news_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function adjdev_news_posted_by() {
		$author_id = get_the_author_meta( 'ID' );
		$byline    = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'adjdev-news' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( $author_id ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline">' . get_avatar( $author_id, 24, '', esc_attr( get_the_author() ), array( 'class' => 'author-mini-avatar' ) ) . ' ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'adjdev_news_categories' ) ) :
	/**
	 * Display styled category badges
	 *
	 * @param int $limit
	 */
	function adjdev_news_categories( $limit = 2 ) {
		$categories = get_the_category();
		if ( empty( $categories ) ) {
			return;
		}

		echo '<div class="adjdev-category-badges">';
		$count = 0;
		foreach ( $categories as $cat ) {
			if ( $count >= $limit ) {
				break;
			}
			$category_link = get_category_link( $cat->term_id );
			echo '<a href="' . esc_url( $category_link ) . '" class="cat-badge cat-badge-' . esc_attr( $cat->slug ) . '">' . esc_html( $cat->name ) . '</a>';
			$count++;
		}
		echo '</div>';
	}
endif;

if ( ! function_exists( 'adjdev_news_reading_time' ) ) :
	/**
	 * Calculate and return estimated reading time
	 *
	 * @param int $post_id
	 * @return string
	 */
	function adjdev_news_reading_time( $post_id = 0 ) {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$content    = get_post_field( 'post_content', $post_id );
		$word_count = str_word_count( wp_strip_all_tags( $content ) );
		$minutes    = max( 1, ceil( $word_count / 200 ) );

		/* translators: %d: reading time in minutes */
		return sprintf( esc_html__( '%d min read', 'adjdev-news' ), $minutes );
	}
endif;

if ( ! function_exists( 'adjdev_news_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail with lazy loading and decoding attributes.
	 *
	 * @param string $size
	 * @param string $class
	 */
	function adjdev_news_post_thumbnail( $size = 'adjdev-news-thumb', $class = '' ) {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		$post_title = get_the_title();
		?>
		<a class="post-thumbnail <?php echo esc_attr( $class ); ?>" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail(
				$size,
				array(
					'alt'      => the_title_attribute( array( 'echo' => false ) ),
					'loading'  => 'lazy',
					'decoding' => 'async',
				)
			);
			?>
		</a>
		<?php
	}
endif;

if ( ! function_exists( 'adjdev_news_pagination' ) ) :
	/**
	 * Displays numeric pagination
	 */
	function adjdev_news_pagination() {
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg> <span class="screen-reader-text">' . esc_html__( 'Previous', 'adjdev-news' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next', 'adjdev-news' ) . '</span> <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>',
			)
		);
	}
endif;
