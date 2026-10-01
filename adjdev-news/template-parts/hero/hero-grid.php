<?php
/**
 * Hero Grid Section (1 Lead + 4 Sub-featured)
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_count    = intval( adjdev_news_get_option( 'homepage_hero_count', 5 ) );
$hero_category = adjdev_news_get_option( 'homepage_hero_category', '' );

$args = array(
	'posts_per_page'      => $hero_count,
	'post_status'         => 'publish',
	'ignore_sticky_posts' => 1,
);

if ( ! empty( $hero_category ) ) {
	$args['category_name'] = sanitize_title( $hero_category );
}

$hero_query = new WP_Query( $args );

if ( ! $hero_query->have_posts() ) {
	return;
}

$posts = $hero_query->posts;
$lead_post = array_shift( $posts );
?>

<section class="adjdev-hero-section adjdev-hero-grid-layout" aria-label="<?php esc_attr_e( 'Featured News', 'adjdev-news' ); ?>">
	<div class="hero-grid-container">
		
		<!-- Large Lead Feature -->
		<?php if ( $lead_post ) :
			$thumb_id = get_post_thumbnail_id( $lead_post->ID );
			$thumb_url = wp_get_attachment_image_url( $thumb_id, 'adjdev-news-hero' );
			if ( ! $thumb_url ) {
				$thumb_url = ADJDEV_NEWS_ASSETS_URI . '/images/default-placeholder.svg';
			}
		?>
			<div class="hero-lead-card" style="background-image: linear-gradient(180deg, rgba(15,23,42,0.1) 0%, rgba(15,23,42,0.92) 100%), url('<?php echo esc_url( $thumb_url ); ?>');">
				<div class="hero-lead-content">
					<div class="adjdev-category-badges">
						<?php
						$cats = get_the_category( $lead_post->ID );
						if ( ! empty( $cats ) ) {
							echo '<a href="' . esc_url( get_category_link( $cats[0]->term_id ) ) . '" class="cat-badge" style="background:#1062fe; color:#fff;">' . esc_html( $cats[0]->name ) . '</a>';
						}
						?>
					</div>
					<h2 class="hero-lead-title">
						<a href="<?php echo esc_url( get_permalink( $lead_post->ID ) ); ?>"><?php echo esc_html( get_the_title( $lead_post->ID ) ); ?></a>
					</h2>
					<div class="post-meta" style="color: #cbd5e1;">
						<span><?php echo esc_html( get_the_date( '', $lead_post->ID ) ); ?></span>
						<span>•</span>
						<span><?php echo esc_html( adjdev_news_reading_time( $lead_post->ID ) ); ?></span>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<!-- Sub-featured List Grid (Up to 4 posts) -->
		<div class="hero-sub-grid">
			<?php foreach ( $posts as $sub_post ) :
				$sub_thumb_id = get_post_thumbnail_id( $sub_post->ID );
				$sub_thumb_url = wp_get_attachment_image_url( $sub_thumb_id, 'adjdev-news-thumb' );
				if ( ! $sub_thumb_url ) {
					$sub_thumb_url = ADJDEV_NEWS_ASSETS_URI . '/images/default-placeholder.svg';
				}
			?>
				<div class="hero-sub-card">
					<div class="sub-card-thumb">
						<a href="<?php echo esc_url( get_permalink( $sub_post->ID ) ); ?>">
							<img src="<?php echo esc_url( $sub_thumb_url ); ?>" alt="<?php echo esc_attr( get_the_title( $sub_post->ID ) ); ?>" loading="lazy" />
						</a>
					</div>
					<div class="sub-card-info">
						<h3 class="sub-card-title">
							<a href="<?php echo esc_url( get_permalink( $sub_post->ID ) ); ?>"><?php echo esc_html( get_the_title( $sub_post->ID ) ); ?></a>
						</h3>
						<div class="post-meta" style="font-size: 0.78rem;">
							<span><?php echo esc_html( get_the_date( '', $sub_post->ID ) ); ?></span>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>

<style>
.adjdev-hero-section {
  margin-bottom: 36px;
}
.hero-grid-container {
  display: grid;
  grid-template-columns: 1fr;
  gap: 24px;
}
@media (min-width: 992px) {
  .hero-grid-container {
    grid-template-columns: 1.35fr 1fr;
    min-height: 480px;
  }
}
.hero-lead-card {
  position: relative;
  border-radius: var(--adjdev-radius);
  background-size: cover;
  background-position: center;
  min-height: 380px;
  display: flex;
  align-items: flex-end;
  padding: 32px;
  color: #ffffff;
  overflow: hidden;
}
.hero-lead-title {
  font-size: 1.85rem;
  font-weight: 800;
  line-height: 1.25;
  margin: 12px 0;
}
.hero-lead-title a {
  color: #ffffff;
}
.hero-lead-title a:hover {
  color: #60a5fa;
}
.hero-sub-grid {
  display: flex;
  flex-direction: column;
  gap: 16px;
}
.hero-sub-card {
  display: grid;
  grid-template-columns: 110px 1fr;
  gap: 14px;
  background: var(--adjdev-surface-card);
  border: 1px solid var(--adjdev-border);
  border-radius: var(--adjdev-radius-sm);
  padding: 10px;
  align-items: center;
}
.sub-card-thumb {
  aspect-ratio: 16 / 11;
  border-radius: var(--adjdev-radius-sm);
  overflow: hidden;
}
.sub-card-thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.sub-card-title {
  font-size: 0.98rem;
  line-height: 1.35;
  margin: 0 0 6px 0;
}
.sub-card-title a {
  color: var(--adjdev-text-heading);
}
.sub-card-title a:hover {
  color: var(--adjdev-primary);
}
</style>
