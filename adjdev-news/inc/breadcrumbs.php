<?php
/**
 * Original Lightweight Breadcrumbs
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render Breadcrumbs
 */
function adjdev_news_render_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}

	$separator = esc_html( adjdev_news_get_option( 'breadcrumbs_separator', '›' ) );
	?>
	<nav class="adjdev-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumbs', 'adjdev-news' ); ?>">
		<ol class="breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">
			<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="item">
					<span itemprop="name"><?php esc_html_e( 'Home', 'adjdev-news' ); ?></span>
				</a>
				<meta itemprop="position" content="1" />
			</li>

			<span class="breadcrumb-sep"><?php echo esc_html( $separator ); ?></span>

			<?php
			$position = 2;

			if ( is_singular( 'post' ) ) {
				$categories = get_the_category();
				if ( ! empty( $categories ) ) {
					$cat = $categories[0];
					?>
					<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
						<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" itemprop="item">
							<span itemprop="name"><?php echo esc_html( $cat->name ); ?></span>
						</a>
						<meta itemprop="position" content="<?php echo esc_attr( $position ); ?>" />
					</li>
					<span class="breadcrumb-sep"><?php echo esc_html( $separator ); ?></span>
					<?php
					$position++;
				}
				?>
				<li class="breadcrumb-item current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<span itemprop="name"><?php echo esc_html( wp_trim_words( get_the_title(), 8 ) ); ?></span>
					<meta itemprop="position" content="<?php echo esc_attr( $position ); ?>" />
				</li>
				<?php
			} elseif ( is_page() ) {
				?>
				<li class="breadcrumb-item current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<span itemprop="name"><?php the_title(); ?></span>
					<meta itemprop="position" content="<?php echo esc_attr( $position ); ?>" />
				</li>
				<?php
			} elseif ( is_category() ) {
				?>
				<li class="breadcrumb-item current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<span itemprop="name"><?php single_cat_title(); ?></span>
					<meta itemprop="position" content="<?php echo esc_attr( $position ); ?>" />
				</li>
				<?php
			} elseif ( is_tag() ) {
				?>
				<li class="breadcrumb-item current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<span itemprop="name"><?php single_tag_title(); ?></span>
					<meta itemprop="position" content="<?php echo esc_attr( $position ); ?>" />
				</li>
				<?php
			} elseif ( is_search() ) {
				?>
				<li class="breadcrumb-item current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<span itemprop="name"><?php esc_html_e( 'Search Results', 'adjdev-news' ); ?></span>
					<meta itemprop="position" content="<?php echo esc_attr( $position ); ?>" />
				</li>
				<?php
			} elseif ( is_404() ) {
				?>
				<li class="breadcrumb-item current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<span itemprop="name"><?php esc_html_e( 'Page Not Found', 'adjdev-news' ); ?></span>
					<meta itemprop="position" content="<?php echo esc_attr( $position ); ?>" />
				</li>
				<?php
			}
			?>
		</ol>
	</nav>
	<?php
}
