<?php
/**
 * Advertisement Manager for ADJDEV News
 *
 * Provides configurable ad slots for Header, Before Content, In Content,
 * After Content, Sidebar, Footer, Mobile, and Desktop with responsive controls.
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render an advertisement slot by slot identifier
 *
 * @param string $slot_id
 * @param array  $custom_classes
 */
function adjdev_news_render_ad_slot( $slot_id, $custom_classes = array() ) {
	$slot_id = sanitize_key( $slot_id );

	$enable_key = "ad_{$slot_id}_enable";
	$code_key   = "ad_{$slot_id}_code";

	// Check if this slot is enabled in Theme Options
	if ( ! adjdev_news_get_option( $enable_key, false ) ) {
		return;
	}

	$ad_code = adjdev_news_get_option( $code_key, '' );
	if ( empty( $ad_code ) ) {
		return;
	}

	$classes   = array( 'adjdev-ad-slot', 'adjdev-ad-' . $slot_id );
	if ( ! empty( $custom_classes ) ) {
		$classes = array_merge( $classes, (array) $custom_classes );
	}

	$class_attr = implode( ' ', array_map( 'sanitize_html_class', $classes ) );

	echo '<div class="' . esc_attr( $class_attr ) . '" data-ad-slot="' . esc_attr( $slot_id ) . '">';
	echo '<div class="adjdev-ad-inner">';
	echo '<span class="adjdev-ad-badge">' . esc_html__( 'Advertisement', 'adjdev-news' ) . '</span>';
	
	// If administrator has saved script or iframe, output safely
	echo do_shortcode( $ad_code ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	echo '</div>';
	echo '</div>';
}
