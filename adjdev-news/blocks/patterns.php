<?php
/**
 * Register Gutenberg Block Patterns
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function adjdev_news_register_block_patterns() {
	if ( ! function_exists( 'register_block_pattern_category' ) ) {
		return;
	}

	register_block_pattern_category(
		'adjdev-news',
		array( 'label' => esc_html__( 'ADJDEV News Patterns', 'adjdev-news' ) )
	);

	// Pattern 1: Magazine Column Grid
	register_block_pattern(
		'adjdev-news/magazine-columns',
		array(
			'title'       => esc_html__( 'ADJDEV 3-Column Magazine Section', 'adjdev-news' ),
			'description' => esc_html__( 'Three column layout for category highlights.', 'adjdev-news' ),
			'categories'  => array( 'adjdev-news' ),
			'content'     => '<!-- wp:columns {"className":"adjdev-magazine-block"} -->
			<div class="wp-block-columns adjdev-magazine-block">
				<!-- wp:column -->
				<div class="wp-block-column"><!-- wp:heading {"level":3} --><h3>National News</h3><!-- /wp:heading --><!-- wp:latest-posts {"postsToShow":4,"displayPostDate":true,"displayFeaturedImage":true,"featuredImageAlign":"left"} /--></div>
				<!-- /wp:column -->
				<!-- wp:column -->
				<div class="wp-block-column"><!-- wp:heading {"level":3} --><h3>Tech & Gadgets</h3><!-- /wp:heading --><!-- wp:latest-posts {"postsToShow":4,"displayPostDate":true,"displayFeaturedImage":true,"featuredImageAlign":"left"} /--></div>
				<!-- /wp:column -->
				<!-- wp:column -->
				<div class="wp-block-column"><!-- wp:heading {"level":3} --><h3>Lifestyle</h3><!-- /wp:heading --><!-- wp:latest-posts {"postsToShow":4,"displayPostDate":true,"displayFeaturedImage":true,"featuredImageAlign":"left"} /--></div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->',
		)
	);

	// Pattern 2: Callout Alert / Breaking Announcement
	register_block_pattern(
		'adjdev-news/callout-banner',
		array(
			'title'       => esc_html__( 'ADJDEV Breaking Callout Banner', 'adjdev-news' ),
			'description' => esc_html__( 'High-contrast breaking news callout banner.', 'adjdev-news' ),
			'categories'  => array( 'adjdev-news' ),
			'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"24px","bottom":"24px","left":"28px","right":"28px"}}},"backgroundColor":"black","textColor":"white","className":"adjdev-callout-banner"} -->
			<div class="wp-block-group adjdev-callout-banner has-white-color has-black-background-color has-text-color has-background" style="padding-top:24px;padding-right:28px;padding-bottom:24px;padding-left:28px">
				<!-- wp:heading {"level":3,"textColor":"white"} --><h3 class="has-white-color has-text-color">Live Coverage: Important Policy Updates</h3><!-- /wp:heading -->
				<!-- wp:paragraph --><p>Stay updated with our continuously updated field report from our parliamentary correspondents.</p><!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->',
		)
	);
}
add_action( 'init', 'adjdev_news_register_block_patterns' );
