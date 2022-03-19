<?php get_header(); ?>

<section class="row">

	<header class="article-header-standard-post article-header-404">

		<h1><?php echo esc_html__( '404', 'patria' ); ?></h1>

		<p><?php echo esc_html__( 'Sorry, the page not found.', 'patria' ); ?></p>

		<section class="article-description-404">
			<p><?php echo esc_html__( 'Looks like the page you&rsquo;re trying to visit doesn&rsquo;t exist.', 'patria' ); ?></p>
			<p><?php echo esc_html__( 'Place check the URL and try luck again.', 'patria' ); ?></p>
		</section>

	</header>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
