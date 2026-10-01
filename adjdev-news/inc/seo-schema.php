<?php
/**
 * SEO & Schema.org Structured Data
 *
 * Generates valid JSON-LD schema markup for NewsArticle, WebSite, and BreadcrumbList
 * without conflicting with dedicated SEO plugins like Yoast, Rank Math, or All in One SEO.
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check if a known 3rd party SEO plugin is active
 *
 * @return bool
 */
function adjdev_news_has_active_seo_plugin() {
	return (
		defined( 'WPSEO_VERSION' ) ||             // Yoast SEO
		defined( 'RANK_MATH_VERSION' ) ||         // Rank Math
		defined( 'AIOSEO_VERSION' ) ||            // All in One SEO
		defined( 'SEOPRESS_VERSION' ) ||          // SEOPress
		defined( 'THE_SEO_FRAMEWORK_VERSION' )    // The SEO Framework
	);
}

/**
 * Output Schema.org JSON-LD in wp_head
 */
function adjdev_news_output_schema_jsonld() {
	if ( ! adjdev_news_get_option( 'seo_schema_enable', true ) ) {
		return;
	}

	// Gracefully yield to dedicated SEO plugins
	if ( adjdev_news_has_active_seo_plugin() ) {
		return;
	}

	$schema = array();

	if ( is_singular( 'post' ) ) {
		$post_id   = get_the_ID();
		$author_id = get_post_field( 'post_author', $post_id );

		$image_url = '';
		if ( has_post_thumbnail( $post_id ) ) {
			$thumb_id  = get_post_thumbnail_id( $post_id );
			$image_src = wp_get_attachment_image_src( $thumb_id, 'full' );
			$image_url = $image_src ? $image_src[0] : '';
		}

		$schema = array(
			'@context'         => 'https://schema.org',
			'@type'            => 'NewsArticle',
			'mainEntityOfPage' => array(
				'@type' => 'WebPage',
				'@id'   => esc_url( get_permalink( $post_id ) ),
			),
			'headline'         => wp_strip_all_tags( get_the_title( $post_id ) ),
			'datePublished'    => get_the_date( DATE_W3C, $post_id ),
			'dateModified'     => get_the_modified_date( DATE_W3C, $post_id ),
			'author'           => array(
				'@type' => 'Person',
				'name'  => get_the_author_meta( 'display_name', $author_id ),
				'url'   => esc_url( get_author_posts_url( $author_id ) ),
			),
			'publisher'        => array(
				'@type' => 'Organization',
				'name'  => get_bloginfo( 'name' ),
				'url'   => esc_url( home_url( '/' ) ),
			),
			'description'      => wp_strip_all_tags( get_the_excerpt( $post_id ) ),
		);

		if ( ! empty( $image_url ) ) {
			$schema['image'] = array(
				'@type' => 'ImageObject',
				'url'   => esc_url( $image_url ),
			);
		}
	} elseif ( is_front_page() || is_home() ) {
		$schema = array(
			'@context'        => 'https://schema.org',
			'@type'           => 'WebSite',
			'name'            => get_bloginfo( 'name' ),
			'url'             => esc_url( home_url( '/' ) ),
			'potentialAction' => array(
				'@type'       => 'SearchAction',
				'target'      => esc_url( home_url( '/?s={search_term_string}' ) ),
				'query-input' => 'required name=search_term_string',
			),
		);
	}

	if ( ! empty( $schema ) ) {
		echo "\n<!-- ADJDEV News Schema JSON-LD -->\n";
		echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
	}
}
add_action( 'wp_head', 'adjdev_news_output_schema_jsonld', 1 );
