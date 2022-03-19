<section class="row">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<article class="article-container" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="article-header-standard-post padding-1 header-page">

			<h1><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h1>

		</header>

		<section class="article-content article-content-post">

			<?php 

				$readmore = __( 'Read More...', 'patria' );
				the_content($readmore); 
				wp_link_pages(); 
				
			?>

		<div class="clear-both"></div>

		</section>

		<div class="clear-both"></div>

	</article>

	<?php
		if ( get_theme_mod('author_page') == true ){
			get_template_part('author-info');
		}
	?>

<?php endwhile; endif; ?>

<div class="clear-both"></div>

</section>
