<?php get_header(); ?>
<section class="row">
<?php get_template_part('loop'); ?>
</section>
<?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?>
<?php get_sidebar(); ?>	
<?php get_footer(); ?>
