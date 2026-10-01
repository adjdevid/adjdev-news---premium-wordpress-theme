<?php
/**
 * Author Profile Widget
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ADJDEV_News_Widget_Author extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'adjdev_author_widget',
			esc_html__( 'ADJDEV - Editor / Author Profile', 'adjdev-news' ),
			array( 'description' => esc_html__( 'Displays editor avatar, bio, and social badge in the sidebar.', 'adjdev-news' ) )
		);
	}

	public function widget( $args, $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Chief Editor', 'adjdev-news' );
		$bio   = ! empty( $instance['bio'] ) ? $instance['bio'] : esc_html__( 'Independent investigative journalist and editor-in-chief.', 'adjdev-news' );

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( $title ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		?>
		<div class="widget-author-profile" style="text-align: center; padding: 10px 0;">
			<div style="width: 84px; height: 84px; margin: 0 auto 12px auto; border-radius: 50%; overflow: hidden; border: 3px solid var(--adjdev-border);">
				<img src="<?php echo esc_url( ADJDEV_NEWS_ASSETS_URI . '/images/default-placeholder.svg' ); ?>" alt="Author" style="width:100%; height:100%; object-fit:cover;" />
			</div>
			<h4 style="font-size: 1.1rem; margin: 0 0 6px 0;"><?php esc_html_e( 'Editorial Board', 'adjdev-news' ); ?></h4>
			<p style="font-size: 0.88rem; color: var(--adjdev-text-muted); line-height: 1.5; margin: 0;"><?php echo esc_html( $bio ); ?></p>
		</div>
		<?php
		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$bio   = ! empty( $instance['bio'] ) ? $instance['bio'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'adjdev-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'bio' ) ); ?>"><?php esc_html_e( 'Bio / Description:', 'adjdev-news' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bio' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'bio' ) ); ?>" rows="3"><?php echo esc_textarea( $bio ); ?></textarea>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['bio']   = ( ! empty( $new_instance['bio'] ) ) ? sanitize_textarea_field( $new_instance['bio'] ) : '';
		return $instance;
	}
}

function adjdev_news_register_author_widget() {
	register_widget( 'ADJDEV_News_Widget_Author' );
}
add_action( 'widgets_init', 'adjdev_news_register_author_widget' );
