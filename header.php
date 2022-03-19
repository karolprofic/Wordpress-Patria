<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
    <meta name="description" content="<?php bloginfo('description') ?>" />
	<meta charset="<?php bloginfo( 'charset' ) ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header id="main-heder-<?php echo esc_attr(get_theme_mod('menu_type', '1')) ?>">

	<section class="header-logo">

		<a href="<?php echo home_url() ?>">
			<?php 
				if (has_custom_logo()) {
					the_custom_logo();
				} else {
					echo '<h1>', bloginfo('name'), '</h1>';
					echo '<p>', bloginfo('description'), '</p>';
				}
			?>
		</a>

	</section>

	<section class="container-main-nav-<?php echo esc_attr(get_theme_mod('menu_type', '1')) ?>">
		<nav id="main-nav">
			<div>
				<input type="checkbox" id="input-toggle">
				<h1 id="input-toggle-h1"><?php echo esc_html__( 'Menu', 'patria' ); ?></h1>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'ul', 'menu_class'=> 'menu' ) ); ?>
			</div>
		</nav>
	</section>

</header>
