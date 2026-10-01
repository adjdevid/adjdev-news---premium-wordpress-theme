<?php
/**
 * Theme Options Default Settings
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the master array of default options
 *
 * @return array
 */
function adjdev_news_get_default_options() {
	return array(
		// General
		'site_layout'                => 'fullwidth', // fullwidth, boxed
		'container_width'            => 1240,
		'back_to_top_enable'         => true,
		'smooth_scroll_enable'       => true,

		// Logo & Branding
		'logo_type'                  => 'text', // text, image
		'logo_image'                 => '',
		'logo_image_dark'            => '',
		'logo_image_mobile'          => '',
		'logo_width'                 => 180,
		'logo_tagline_enable'        => true,

		// Header
		'header_layout'              => 'default', // default, classic, center-logo, magazine, minimal, transparent
		'header_sticky'              => true,
		'header_sticky_mobile'       => true,
		'header_topbar_enable'       => true,
		'header_topbar_date'         => true,
		'header_search_enable'       => true,
		'header_dark_mode_toggle'    => true,
		'header_cta_enable'          => false,
		'header_cta_text'            => esc_html__( 'Subscribe', 'adjdev-news' ),
		'header_cta_url'             => '#',

		// Breaking News
		'breaking_news_enable'       => true,
		'breaking_news_title'        => esc_html__( 'Breaking News', 'adjdev-news' ),
		'breaking_news_category'     => '',
		'breaking_news_count'        => 5,
		'breaking_news_all_pages'    => false,

		// Navigation
		'nav_uppercase'              => false,
		'nav_indicator'              => true,

		// Mobile Header
		'mobile_header_sticky'       => true,
		'mobile_drawer_social'       => true,

		// Footer
		'footer_columns'             => 4,
		'footer_dark_mode'           => true,
		'footer_logo_enable'         => true,
		'footer_description'         => esc_html__( 'ADJDEV News is a trusted digital media platform delivering fast, accurate, and insightful news covering national affairs, technology, lifestyle, and business.', 'adjdev-news' ),
		'footer_copyright'           => '© ' . gmdate( 'Y' ) . ' ADJDEV News. All Rights Reserved. Built with high performance.',
		'footer_social_enable'       => true,

		// Homepage
		'homepage_hero_enable'       => true,
		'homepage_hero_style'        => 'grid', // grid, slider, classic
		'homepage_hero_category'     => '',
		'homepage_hero_count'        => 5,
		'homepage_trending_enable'   => true,
		'homepage_popular_enable'    => true,

		// Blog
		'blog_layout'                => 'grid', // grid, list, overlay
		'blog_sidebar_position'      => 'right', // right, left, none
		'blog_excerpt_length'        => 20,
		'blog_pagination_type'       => 'numeric', // numeric, ajax_load_more, infinite_scroll

		// Single Post
		'single_sidebar_position'    => 'right',
		'single_sidebar_sticky'      => true,
		'single_featured_image'      => true,
		'single_post_meta_author'    => true,
		'single_post_meta_date'      => true,
		'single_post_meta_updated'   => true,
		'single_post_meta_reading'   => true,
		'single_post_meta_views'     => true,
		'single_post_meta_comments'  => true,
		'single_breadcrumbs'         => true,
		'single_share_top'           => true,
		'single_share_bottom'        => true,
		'single_tags_enable'         => true,
		'single_navigation_enable'   => true,
		'single_author_box_enable'   => true,
		'single_toc_enable'          => true,
		'single_toc_min_headings'    => 3,
		'single_newsletter_enable'   => true,
		'single_related_posts_enable'=> true,
		'single_related_posts_count' => 3,

		// Page
		'page_sidebar_position'      => 'none',
		'page_featured_image'        => true,

		// Category
		'category_layout'            => 'grid',
		'category_columns'           => 3,

		// Tag
		'tag_layout'                 => 'grid',

		// Author
		'author_layout'              => 'list',
		'author_box_enable'          => true,

		// Search
		'search_layout'              => 'list',
		'search_sidebar_position'    => 'right',

		// Archives
		'archive_layout'             => 'grid',
		'archive_sidebar_position'   => 'right',

		// 404 Page
		'error_404_title'            => esc_html__( 'Oops! That page can’t be found.', 'adjdev-news' ),
		'error_404_desc'             => esc_html__( 'It looks like nothing was found at this location. Maybe try searching with a keyword or check our latest headlines below.', 'adjdev-news' ),
		'error_404_recent_posts'     => true,

		// Typography
		'font_body'                  => 'system',
		'font_heading'               => 'system',
		'body_font_size'             => 16,
		'heading_font_weight'        => '700',

		// Colors
		'color_primary'              => '#1062fe',
		'color_primary_hover'        => '#004fe8',
		'color_secondary'            => '#0f172a',
		'color_accent'               => '#f43f5e',
		'color_text'                 => '#181d27',
		'color_background'           => '#ffffff',
		'color_border'               => '#e4e7ec',

		// Dark Mode
		'dark_mode_enable'           => true,
		'dark_mode_default'          => 'system', // system, light, dark
		'dark_mode_bg'               => '#0b0f19',
		'dark_mode_surface'          => '#121826',
		'dark_mode_text'             => '#e6edf3',

		// Reading Progress Bar
		'reading_progress_enable'    => true,
		'reading_progress_height'    => 3,
		'reading_progress_color'     => '#1062fe',

		// Advertisements
		'ad_header_enable'           => false,
		'ad_header_code'             => '',
		'ad_before_content_enable'   => false,
		'ad_before_content_code'     => '',
		'ad_in_content_enable'       => false,
		'ad_in_content_code'         => '',
		'ad_in_content_paragraph'    => 3,
		'ad_after_content_enable'    => false,
		'ad_after_content_code'      => '',
		'ad_sidebar_enable'          => false,
		'ad_sidebar_code'            => '',
		'ad_footer_enable'           => false,
		'ad_footer_code'             => '',
		'ad_in_feed_enable'          => false,
		'ad_in_feed_code'            => '',

		// Social Media Profiles
		'social_facebook'            => '',
		'social_twitter'             => '',
		'social_instagram'           => '',
		'social_youtube'             => '',
		'social_tiktok'              => '',
		'social_linkedin'            => '',
		'social_telegram'            => '',
		'social_whatsapp'            => '',

		// Breadcrumbs
		'breadcrumbs_enable'         => true,
		'breadcrumbs_separator'      => '›',

		// Performance
		'perf_lazy_load'             => true,
		'perf_disable_emojis'        => true,
		'perf_defer_scripts'         => true,

		// SEO
		'seo_schema_enable'          => true,
		'seo_opengraph_fallback'     => true,

		// Custom CSS / JS
		'custom_css'                 => '',
		'custom_js'                  => '',

		// Active Template
		'active_template'            => 'news-modern',
	);
}
