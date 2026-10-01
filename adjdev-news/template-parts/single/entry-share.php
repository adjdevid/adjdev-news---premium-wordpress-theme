<?php
/**
 * Single Post Share Bar
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

adjdev_news_render_share_buttons( get_the_ID() );
