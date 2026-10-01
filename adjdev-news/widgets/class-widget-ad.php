<?php
/**
 * Responsive Advertisement Widget
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ADJDEV_News_Widget_Ad extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'adjdev_ad_widget',
			esc_html__( 'ADJDEV - Advertisement Box (300x250 / Responsive)', 'adjdev-news' ),
			array( 'description' => esc_html__( 'Easily display custom ad codes or banners in any widget area.', 'adjdev-news' ) )
		);
	}

	public function widget( $args, $instance ) {
		$code = ! empty( $instance['code'] ) ? $instance['code'] : '';

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		echo '<div class="adjdev-ad-slot adjdev-widget-ad" style="text-align: center;">';
		echo '<div class="adjdev-ad-inner">';
		echo '<span class="adjdev-ad-badge">' . esc_html__( 'Sponsored', 'adjdev-news' ) . '</span>';
		if ( ! empty( $code ) ) {
			echo do_shortcode( $code ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			echo '<div style="background:#e2e8f0; color:#64748b; padding:40px 20px; border-radius:4px; font-weight:600; font-size:13px;">300x250 / Responsive Ad Unit</div>';
		}
		echo '</div>';
		echo '</div>';

		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	public function form( $instance ) {
		$code = ! empty( $instance['code'] ) ? $instance['code'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'code' ) ); ?>"><?php esc_html_e( 'HTML / JS Ad Code:', 'adjdev-news' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'code' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'code' ) ); ?>" rows="5"><?php echo esc_textarea( $code ); ?></textarea>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['code'] = ! empty( $new_instance['code'] ) ? $new_instance['code'] : '';
		} else {
			$instance['code'] = ! empty( $new_instance['code'] ) ? wp_kses_post( $new_instance['code'] ) : '';
		}
		return $instance;
	}
}

function adjdev_news_register_ad_widget() {
	register_widget( 'ADJDEV_News_Widget_Ad' );
}
add_action( 'widgets_init', 'adjdev_news_register_ad_widget' );
