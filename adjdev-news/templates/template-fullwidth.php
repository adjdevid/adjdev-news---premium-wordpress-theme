<?php
/**
 * Template Name: ADJDEV Fullwidth Page
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main adjdev-fullwidth-page">
	<div class="adjdev-container-wide">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</div>
</main>

<?php
get_footer();
