<?php
/**
 * Single Post Author Bio Box
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$author_id  = get_the_author_meta( 'ID' );
$author_bio = get_the_author_meta( 'description' );

if ( empty( $author_bio ) ) {
	$author_bio = esc_html__( 'Staff journalist and contributor covering latest news and verified insights.', 'adjdev-news' );
}
?>
<div class="adjdev-author-box">
	<div class="author-box-avatar">
		<?php echo get_avatar( $author_id, 72, '', esc_attr( get_the_author() ), array( 'class' => 'author-avatar' ) ); ?>
	</div>
	<div class="author-box-content">
		<h4 class="author-box-title">
			<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>"><?php the_author(); ?></a>
		</h4>
		<p class="author-box-bio"><?php echo esc_html( $author_bio ); ?></p>
	</div>
</div>
