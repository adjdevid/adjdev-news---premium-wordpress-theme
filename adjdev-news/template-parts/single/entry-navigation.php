<?php
/**
 * Single Post Previous / Next Navigation
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$prev_post = get_previous_post();
$next_post = get_next_post();

if ( ! $prev_post && ! $next_post ) {
	return;
}
?>
<nav class="adjdev-post-navigation" aria-label="<?php esc_attr_e( 'Articles navigation', 'adjdev-news' ); ?>">
	<div class="nav-links-grid">
		<?php if ( $prev_post ) : ?>
			<div class="nav-previous">
				<span class="nav-label">&larr; <?php esc_html_e( 'Previous Article', 'adjdev-news' ); ?></span>
				<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="nav-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></a>
			</div>
		<?php else : ?>
			<div></div>
		<?php endif; ?>

		<?php if ( $next_post ) : ?>
			<div class="nav-next text-right">
				<span class="nav-label"><?php esc_html_e( 'Next Article', 'adjdev-news' ); ?> &rarr;</span>
				<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="nav-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></a>
			</div>
		<?php endif; ?>
	</div>
</nav>

<style>
.adjdev-post-navigation {
  margin: 32px 0;
  padding: 20px 0;
  border-top: 1px solid var(--adjdev-border);
  border-bottom: 1px solid var(--adjdev-border);
}
.nav-links-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 24px;
}
.nav-label {
  font-size: 0.78rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  color: var(--adjdev-text-subtle);
  display: block;
  margin-bottom: 4px;
}
.nav-title {
  font-size: 0.98rem;
  font-weight: 600;
  color: var(--adjdev-text-heading);
}
.nav-title:hover {
  color: var(--adjdev-primary);
}
.text-right {
  text-align: right;
}
</style>
