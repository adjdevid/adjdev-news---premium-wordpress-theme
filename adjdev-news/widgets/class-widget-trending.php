<?php
/**
 * Trending News Widget with Numerical Ranking
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ADJDEV_News_Widget_Trending extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'adjdev_trending_posts',
			esc_html__( 'ADJDEV - Trending Ranked Posts', 'adjdev-news' ),
			array( 'description' => esc_html__( 'Displays trending articles with numerical rankings (1, 2, 3, etc.).', 'adjdev-news' ) )
		);
	}

	public function widget( $args, $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Trending Now', 'adjdev-news' );
		$count = ! empty( $instance['count'] ) ? absint( $instance['count'] ) : 5;

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( $title ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		$query = new WP_Query(
			array(
				'posts_per_page'      => $count,
				'meta_key'            => 'adjdev_post_views_count',
				'orderby'             => 'meta_value_num',
				'order'               => 'DESC',
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 1,
			)
		);

		if ( ! $query->have_posts() ) {
			$query = new WP_Query( array( 'posts_per_page' => $count, 'post_status' => 'publish' ) );
		}

		if ( $query->have_posts() ) {
			echo '<div class="widget-trending-list">';
			$rank = 0;
			while ( $query->have_posts() ) {
				$query->the_post();
				$rank++;
				?>
				<div class="trending-rank-item" style="display: flex; gap: 14px; margin-bottom: 16px; align-items: flex-start;">
					<div class="rank-number" style="font-size: 1.4rem; font-weight: 800; color: var(--adjdev-primary); min-width: 28px; line-height: 1;">
						<?php echo esc_html( sprintf( '%02d', $rank ) ); ?>
					</div>
					<div class="rank-content">
						<h4 style="font-size: 0.95rem; line-height: 1.35; margin: 0 0 4px 0;">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h4>
						<span style="font-size: 0.78rem; color: var(--adjdev-text-subtle);"><?php echo esc_html( adjdev_news_reading_time() ); ?></span>
					</div>
				</div>
				<?php
			}
			echo '</div>';
			wp_reset_postdata();
		}

		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$count = ! empty( $instance['count'] ) ? absint( $instance['count'] ) : 5;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'adjdev-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'adjdev-news' ); ?></label>
			<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $count ); ?>" size="3">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? absint( $new_instance['count'] ) : 5;
		return $instance;
	}
}

function adjdev_news_register_trending_widget() {
	register_widget( 'ADJDEV_News_Widget_Trending' );
}
add_action( 'widgets_init', 'adjdev_news_register_trending_widget' );
