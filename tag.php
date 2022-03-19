<?php get_header(); ?>

<section class="row row-4">

<?php if ( have_posts() ) : ?>

	<header class="article-header-standard-post article-header-category <?php if ( !category_description() ) : ?> article-header-category-2<?php endif; ?>">

		<h1 class="archive-title"><?php the_archive_title(); ?></h1>

		<?php if ( the_archive_description() ) : ?>
			<?php echo the_archive_description(); ?>
		<?php endif; ?>

	</header>

	<?php get_template_part('loop'); ?>

<?php else : ?>
	<header class="article-header-standard-post article-header-no-post">
		<h1><?php echo esc_html__( 'Sorry, no posts matched your criteria.', 'patria' ); ?></h1>
	</header>
<?php endif; ?>

</section>

<?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
