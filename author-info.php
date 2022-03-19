<aside class="author-box">

	<section class="author-details">

		<h3><?php echo esc_html__( 'Published by ', 'patria' ); ?><?php echo get_the_author();?></h3>

		<?php echo get_avatar(get_the_author_meta('email'), get_the_author()); ?>

		<section class="author-bio">

			<p><?php echo the_author_meta('description'); ?></p>

			<div class="author-bio-link"><?php the_author_posts_link(); ?></div>

		</section>

		<div class="clear-both"></div>

	</section>

</aside>