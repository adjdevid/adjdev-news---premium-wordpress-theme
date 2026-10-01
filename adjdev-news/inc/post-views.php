<?php
/**
 * Lightweight Post View Counter
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Track post view on single post load
 *
 * @param int $post_id
 */
function adjdev_news_track_post_views( $post_id ) {
	if ( ! is_single() || empty( $post_id ) ) {
		return;
	}

	if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) {
		return; // Do not count admin views
	}

	$count_key = 'adjdev_post_views_count';
	$count     = get_post_meta( $post_id, $count_key, true );

	if ( '' === $count ) {
		$count = 1;
		delete_post_meta( $post_id, $count_key );
		add_post_meta( $post_id, $count_key, 1 );
	} else {
		$count = intval( $count ) + 1;
		update_post_meta( $post_id, $count_key, $count );
	}
}

/**
 * Get formatted post view count
 *
 * @param int $post_id
 * @return string
 */
function adjdev_news_get_post_views( $post_id = 0 ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$count = get_post_meta( $post_id, 'adjdev_post_views_count', true );
	if ( empty( $count ) ) {
		return '0 ' . esc_html__( 'Views', 'adjdev-news' );
	}

	$count = intval( $count );

	if ( $count >= 1000000 ) {
		return round( $count / 1000000, 1 ) . 'M ' . esc_html__( 'Views', 'adjdev-news' );
	} elseif ( $count >= 1000 ) {
		return round( $count / 1000, 1 ) . 'K ' . esc_html__( 'Views', 'adjdev-news' );
	}

	return number_format_i18n( $count ) . ' ' . esc_html__( 'Views', 'adjdev-news' );
}
