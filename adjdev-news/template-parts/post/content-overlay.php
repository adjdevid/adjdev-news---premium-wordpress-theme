<?php
/**
 * Post Content: Image Overlay Card
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$thumb_id  = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_url( $thumb_id, 'adjdev-news-thumb' );
if ( ! $thumb_url ) {
	$thumb_url = ADJDEV_NEWS_ASSETS_URI . '/images/default-placeholder.svg';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'adjdev-post-overlay-card' ); ?> style="background-image: linear-gradient(180deg, rgba(15,23,42,0.1) 0%, rgba(15,23,42,0.9) 100%), url('<?php echo esc_url( $thumb_url ); ?>');">
	<div class="overlay-card-content">
		<?php adjdev_news_categories( 1 ); ?>
		<h2 class="card-title" style="margin: 8px 0; color: #ffffff;">
			<a href="<?php the_permalink(); ?>" style="color: #ffffff;"><?php the_title(); ?></a>
		</h2>
		<div class="post-meta" style="color: #cbd5e1; font-size: 0.8rem;">
			<?php adjdev_news_posted_on(); ?>
		</div>
	</div>
</article>

<style>
.adjdev-post-overlay-card {
  position: relative;
  border-radius: var(--adjdev-radius);
  background-size: cover;
  background-position: center;
  min-height: 280px;
  display: flex;
  align-items: flex-end;
  padding: 20px;
  overflow: hidden;
}
.adjdev-post-overlay-card .card-title a:hover {
  color: #60a5fa !important;
}
</style>
