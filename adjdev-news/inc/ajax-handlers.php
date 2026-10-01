<?php
/**
 * Admin AJAX Handlers with strict Nonce & Capability Checks
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle Theme Options AJAX Save
 */
function adjdev_news_ajax_save_options() {
	check_ajax_referer( 'adjdev_news_admin_nonce', 'security' );

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Unauthorized user.', 'adjdev-news' ) ) );
	}

	$options_raw = isset( $_POST['options'] ) ? wp_unslash( $_POST['options'] ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	if ( is_string( $options_raw ) ) {
		parse_str( $options_raw, $options_data );
	} else {
		$options_data = (array) $options_raw;
	}

	$sanitized = adjdev_news_sanitize_options( $options_data );
	update_option( ADJDEV_NEWS_OPTIONS_KEY, $sanitized );

	wp_send_json_success( array( 'message' => esc_html__( 'Settings saved successfully!', 'adjdev-news' ) ) );
}
add_action( 'wp_ajax_adjdev_news_save_options', 'adjdev_news_ajax_save_options' );

/**
 * Handle Theme Options Reset
 */
function adjdev_news_ajax_reset_options() {
	check_ajax_referer( 'adjdev_news_admin_nonce', 'security' );

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Unauthorized user.', 'adjdev-news' ) ) );
	}

	$section = isset( $_POST['section'] ) ? sanitize_key( $_POST['section'] ) : 'all';

	if ( 'all' === $section ) {
		$defaults = adjdev_news_get_default_options();
		update_option( ADJDEV_NEWS_OPTIONS_KEY, $defaults );
		wp_send_json_success( array( 'message' => esc_html__( 'All options have been reset to defaults.', 'adjdev-news' ) ) );
	}

	wp_send_json_error( array( 'message' => esc_html__( 'Invalid reset section.', 'adjdev-news' ) ) );
}
add_action( 'wp_ajax_adjdev_news_reset_options', 'adjdev_news_ajax_reset_options' );

/**
 * Handle Template Library Activation via AJAX
 */
function adjdev_news_ajax_activate_template() {
	check_ajax_referer( 'adjdev_news_admin_nonce', 'security' );

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Unauthorized user.', 'adjdev-news' ) ) );
	}

	$template_id = isset( $_POST['template_id'] ) ? sanitize_key( $_POST['template_id'] ) : '';

	if ( empty( $template_id ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'No template specified.', 'adjdev-news' ) ) );
	}

	$result = ADJDEV_News_Template_Library::activate_template( $template_id );

	if ( $result['success'] ) {
		wp_send_json_success( $result );
	} else {
		wp_send_json_error( $result );
	}
}
add_action( 'wp_ajax_adjdev_news_activate_template', 'adjdev_news_ajax_activate_template' );
