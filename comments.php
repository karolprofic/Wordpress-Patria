<?php
	if ( post_password_required() ) {
		return;
	}
?>

<?php if ( have_comments() ) : ?>

	<section id="comments-number">
		<h1>
			<?php 
				$comments_number = get_comments_number();
				if($comments_number === '1') {
					echo esc_html__('One comment', 'patria');
				} else {
					echo esc_html__('Comments: ', 'patria'), $comments_number;
				}
			?>
		</h1>
	</section>

	<section id="comments-list">

		<?php 
			wp_list_comments( $args = array(
				'callback' => 'patria_format_comment'
			)); 
		?>

	</section>

	<?php
		the_comments_navigation( $args = array(
			'prev_text'          => __( 'Older comments', 'patria' ),
			'next_text'          => __( 'Newer comments', 'patria' )
		) );
	?>

<?php endif; // Check for have_comments(). ?>

<section id="comments-reply">

	<?php comment_form(); ?>

</section>
