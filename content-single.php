<section class="row">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
	<?php get_template_part( 'content', get_post_format() ); ?> 

	<?php 

		if ( get_theme_mod('author_post') == true ){
			get_template_part('author-info');
		}
		else{
			echo '<div class="line"></div>';
		}
	?>

	<section id="comments">
				
		<?php comments_template(); ?>

	</section>
			
	<?php endwhile; endif; ?>
			
	<div class="clear-both"></div>
		
</section>