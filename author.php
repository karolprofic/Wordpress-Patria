<?php get_header(); ?>

<section class="row row-author-1">

	<?php if ( have_posts() ) : ?>

		<?php
		
			echo get_template_part('author-info');

			echo '<div class="author-box-padding-bottom"></div>';

			get_template_part('loop');

		?>

	<?php else : ?>
		<header class="article-header-standard-post article-header-no-post">
			<h1><?php echo esc_html__( 'Sorry, no posts matched your criteria.', 'patria' ); ?></h1>
		</header>
	<?php endif; ?>

</section>

<?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
