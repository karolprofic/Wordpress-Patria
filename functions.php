<?php
/*
 * 1. Setup                               Line: 14
 * 2. Add filter                          Line: 49
 * 3. Widgets init                        Line: 80
 * 4. Patria recent posts widget          Line: 96
 * 5. Post type                           Line: 206
 * 6. Custom comments                     Line: 235
 * 7. Other                               Line: 261
 * 8. Customize                           Line: 284
 * 9. Register styles                     Line: 509
 */
/*
 * 1. Setup
 */
if ( ! function_exists( 'patria_setup' ) ) :

function patria_setup() {
	// Make theme available for translation
	load_theme_textdomain( 'patria' );

	// Add WordPress option, custom header
	add_theme_support( "custom-header" );

	// Add WordPress option, custom background
	add_theme_support( "custom-background" );

	// Add support for title tag
	add_theme_support( 'title-tag' );

	// Add support post thumbnails
	add_theme_support( 'post-thumbnails');

	// Post form
	add_theme_support( 'post-formats', array( 'image', 'video', 'audio', 'quote', 'link', 'gallery' ) );

	// Automatic feed links
	add_theme_support( 'automatic-feed-links' );

	// Custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 155,
        'width'       => 320,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

	// Register nav
	register_nav_menu( 'primary', ( __( 'Primary Menu', 'patria' ) ) );

	// Add editor style
	add_editor_style();

} endif;
add_action( 'after_setup_theme', 'patria_setup' );

/*
 * 2. Add filter
 50 */
// Add filter for HTML title tag
function patria_filter_wp_title( $title ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	$site_description = get_bloginfo( 'description' );
	$filtered_title = $title . get_bloginfo( 'name' );
	$filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
	$filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( ( "Page %s" ), max( $paged, $page ) ) : '';

	return $filtered_title;
}
add_filter( 'wp_title', 'patria_filter_wp_title' );

// Font size in tag cloud
function patria_tag_cloud_sizes($args) {

	$args['smallest'] = 9;
	$args['largest'] = 9;
	$args['number'] = 25;

	return $args;

}
add_filter( 'widget_tag_cloud_args', 'patria_tag_cloud_sizes' );

/*
 * 3. Widgets init
 */
function patria_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'patria' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Widgets in this area will be shown on the bottom side.', 'patria' ),
		'before_widget' => '<section class="widget">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>'
	));
}
add_action( 'widgets_init', 'patria_widgets_init' );

/*
 * 4. Patria recent posts widget
 */
class PatriaRecentPost extends WP_Widget {

	// Widget constructor
	function __construct() {
		parent::__construct(
			// Base ID of widget
			'PatriaRecentPost',
			// Widget name
			__('Patria recent posts', 'patria')
		);
	}

	// Creating widget front-end
	function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$number = apply_filters( 'widget_number', $instance['number'] );

		// Title
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];

		// Widget
		echo '<ul class="recent-post">';

		$args = array( 'numberposts' => $number );

		$recent_posts = wp_get_recent_posts($args);

		foreach( $recent_posts as $recent ){
			?>
			<li>
				<div class="rp-lft">
					<?php
						if ( has_post_thumbnail( $recent["ID"]) ) {
							echo get_the_post_thumbnail($recent["ID"],'thumbnail');
						} else {
							echo '<div class="rp-lft-alt"></div>';
						}
					?>
				</div>
				<div class="rp-rlg">
					<a href="<?php echo esc_url(get_permalink($recent['ID'])); ?>" title="<?php echo esc_attr($recent['post_title']); ?>">
						<?php echo esc_html($recent['post_title']); ?>
					</a>
					<span class="post-date"><?php echo get_the_date( 'j F Y', $recent['ID'] ) ?></span><div class="clear-both"></div>
				</div>
				<div class="clear-both"></div>
			</li>
			<?php

		}

		echo '</ul>';

		$args['after_widget'] = '</section>';

		if ($args['after_widget']) {
			echo $args['after_widget'];
		}

	}

	// Updating widget replacing old instances with new
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
		return $instance;
	}

	// Widget Backend
	function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'patria' );
		}
		if ( isset( $instance[ 'number' ] ) ) {
			$number = $instance[ 'number' ];
		}
		else {
			$number = 5;
		}
		// Widget admin form
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ) ?>"><?php echo __( 'Title:', 'patria' ) ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ) ?>" name="<?php echo $this->get_field_name( 'title' ) ?>" type="text" value="<?php echo esc_attr( $title ) ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'number' ) ?>"><?php echo __( 'Number of posts to show:', 'patria' ) ?></label>
				<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ) ?>" name="<?php echo $this->get_field_name( 'number' ) ?>" step="1" min="1" value="<?php echo esc_attr( $number ) ?>" size="3" type="number">
			</p>
		<?php
	}

}

function patria_register_custom_recent_posts() {
	register_widget( 'PatriaRecentPost' );
}

add_action( 'widgets_init', 'patria_register_custom_recent_posts' );


/*
 * 5. Post type
 */
// Post audio/video/gallery
function patria_get_embedded_media( $type = array() ){
	$content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
	$embed = get_media_embedded_in_content( $content, $type );

	$max = sizeof($embed);
	$filter_array = array();
	for( $i=0; $i<$max; $i++) {
		if( isset($embed[$i]) ) {
			$filter_array = array();
			array_push($filter_array, $embed[$i]);
		}
	}
	$return = current($filter_array);
	return $return;
}

// Post link
function patria_grab_url() {
	if( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links ) ){
		return false;
	}
	return esc_url_raw( $links[1] );
}


/*
 * 6. Custom comments
 */
 function patria_format_comment($comment, $args, $depth) {

	$single['comment'] = $comment;

	?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

			<article class="comments-article">
				<section class="comments-article-left">
					<?php echo get_avatar( $comment ); ?>
				</section>
				<section class="comments-article-right">
					<h4><?php printf( get_comment_author_link()) ?></h4>
					<span><?php printf( get_comment_date()) ?></span>
					<?php comment_text(); ?>
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</section>
				<div class="clear-both"></div>
			</article>
	<?php

}

/*
 * 7. Other
 */
// Link pages
wp_link_pages( array(
	'before'           => '<p>' . __( 'Pages:', 'patria' ),
	'after'            => '</p>',
	'link_before'      => '',
	'link_after'       => '',
	'next_or_number'   => 'number',
	'separator'        => ' ',
	'nextpagelink'     => __('Next page', 'patria'),
	'previouspagelink' => __('Previous page', 'patria'),
	'pagelink'         => '%',
	'echo'             => 1
) );

// Comment reply in singular
if ( is_singular() ) wp_enqueue_script( "comment-reply" );

// Defined content width
if ( ! isset( $content_width ) ) $content_width = 1000;

/*
 * 8. Customize
 */
////////////////////
//  Menu
////////////////////
add_action( 'customize_register', 'patria_menu_type' );
function patria_menu_type( $wp_customize ){
	$wp_customize->add_section( 'patria_menu_type_section', array(
		'title'             => __( 'The method of displaying the menu', 'patria' ),
		'priority'          => 30
	));

	$wp_customize->add_setting( 'menu_type', array(
		'default'           => '1',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'menu_type', array(
		'label'          => __( 'Choose one of the three methods of displaying the menu.', 'patria' ),
		'description'    => __( 'Each of the three methods of displaying the menu is fully responsive.', 'patria' ),
		'section'        => 'patria_menu_type_section',
		'settings'       => 'menu_type',
		'type'           => 'radio',
		'choices'        => array(
			'1'   => __( '1) The menu is extended to the entire width of the page.', 'patria' ),
			'2'   => __( '2) The menu has a predetermined width.', 'patria' ),
			'3'   => __( '3) The menu has a certain width, and whole page is preceded by a distance from the top of the page.', 'patria' )
		)
	)));
}

////////////////////
//  Social icons
////////////////////
add_action('customize_register','patria_social_icons');
function patria_social_icons( $wp_customize ) {
	// Add section
	$wp_customize->add_section( 'patria_social_icons_section', array(
		'title'             => __( 'Social icons in footer of the page', 'patria' ),
		'description'       => __( 'To add a link to a social networking site place the link to your profile in the field reserved for the appropriate service. If you do not want to some icon appeared there, do not complement the field, however, if the icon displayed itself, check whether the field does not contain spaces or tabs.', 'patria' ),
		'priority'          => 20
	));

	// Facebook
	$wp_customize->add_setting( 'patria_facebook', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'patria_facebook', array(
		'label'          => __( 'Facebook URL', 'patria' ),
		'section'        => 'patria_social_icons_section',
		'settings'       => 'patria_facebook'
	)));

	// Twitter
	$wp_customize->add_setting( 'patria_twitter', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'patria_twitter', array(
		'label'          => __( 'Twitter URL', 'patria' ),
		'section'        => 'patria_social_icons_section',
		'settings'       => 'patria_twitter'
	)));

	// Google
	$wp_customize->add_setting( 'patria_google', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'patria_google', array(
		'label'          => __( 'Google Plus URL', 'patria' ),
		'section'        => 'patria_social_icons_section',
		'settings'       => 'patria_google'
	)));

	// LinkedIn
	$wp_customize->add_setting( 'patria_linkedin', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'patria_linkedin', array(
		'label'          => __( 'LinkedIn URL', 'patria' ),
		'section'        => 'patria_social_icons_section',
		'settings'       => 'patria_linkedin'
	)));

	// YouTube
	$wp_customize->add_setting( 'patria_youtube', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'patria_youtube', array(
		'label'          => __( 'YouTube URL', 'patria' ),
		'section'        => 'patria_social_icons_section',
		'settings'       => 'patria_youtube'
	)));

	// Pinterest
	$wp_customize->add_setting( 'patria_pinterest', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'patria_pinterest', array(
		'label'          => __( 'Pinterest URL', 'patria' ),
		'section'        => 'patria_social_icons_section',
		'settings'       => 'patria_pinterest'
	)));

	// GitHub
	$wp_customize->add_setting( 'patria_github', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'patria_github', array(
		'label'          => __( 'GitHub URL', 'patria' ),
		'section'        => 'patria_social_icons_section',
		'settings'       => 'patria_github'
	)));

	// Vimeo
	$wp_customize->add_setting( 'patria_vimeo', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'patria_vimeo', array(
		'label'          => __( 'Vimeo URL', 'patria' ),
		'section'        => 'patria_social_icons_section',
		'settings'       => 'patria_vimeo'
	)));

	// Flickr
	$wp_customize->add_setting( 'patria_flickr', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'patria_flickr', array(
		'label'          => __( 'Flickr URL', 'patria' ),
		'section'        => 'patria_social_icons_section',
		'settings'       => 'patria_flickr'
	)));

	// SoundCloud
	$wp_customize->add_setting( 'patria_soundcloud', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'patria_soundcloud', array(
		'label'          => __( 'SoundCloud URL', 'patria' ),
		'section'        => 'patria_social_icons_section',
		'settings'       => 'patria_soundcloud'
	)));

	// Twitch
	$wp_customize->add_setting( 'patria_twitch', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'patria_twitch', array(
		'label'          => __( 'Twitch URL', 'patria' ),
		'section'        => 'patria_social_icons_section',
		'settings'       => 'patria_twitch'
	)));

	// Tumblr
	$wp_customize->add_setting( 'patria_tumblr', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'patria_tumblr', array(
		'label'          => __( 'Tumblr URL', 'patria' ),
		'section'        => 'patria_social_icons_section',
		'settings'       => 'patria_tumblr'
	)));
}

////////////////////
//  Author box
////////////////////
add_action( 'customize_register', 'patria_author' );
function patria_author( $wp_customize ){
	// Add section
	$wp_customize->add_section( 'patria_author_section', array(
		'title'             => __( 'Information about author ', 'patria' ),
		'description'       => __( 'Option to enable / disable the displaying of information about the author of the posts/pages.', 'patria' ),
		'priority'          => 20
	));

	// Author box in post
	$wp_customize->add_setting( 'author_post', array(
		'default'           => true,
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'author_post', array(
		'label'          => __( 'Display in posts:', 'patria' ),
		'section'        => 'patria_author_section',
		'settings'       => 'author_post',
		'type'           => 'radio',
		'choices'        => array(
			true    => __( 'Yes', 'patria' ),
			false   => __( 'No', 'patria' )
		)
	)));

	// Author box in page
	$wp_customize->add_setting( 'author_page', array(
		'default'           => false,
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'author_page', array(
		'label'          => __( 'Display in pages:', 'patria' ),
		'section'        => 'patria_author_section',
		'settings'       => 'author_page',
		'type'           => 'radio',
		'choices'        => array(
			true    => __( 'Yes', 'patria' ),
			false   => __( 'No', 'patria' )
		)
	)));
}

/**
 * 9. Register style sheet
 */
function patria_register_theme_styles() {
	// register
	wp_register_style( 'reset-style', get_template_directory_uri() . '/css/reset.css' );
	wp_register_style( 'icons-style', get_template_directory_uri() . '/fonts/css/fontello.css' );
	wp_register_style( 'fonts-style', 'https://fonts.googleapis.com/css?family=Open+Sans|Montserrat' );
	wp_register_style( 'main-style', get_template_directory_uri() . '/css/main.css' );
	// enqueue
	wp_enqueue_style( 'reset-style' );
	wp_enqueue_style( 'icons-style' );
	wp_enqueue_style( 'fonts-style' );
	wp_enqueue_style( 'main-style' );
}

// Register style sheet.
add_action( 'wp_enqueue_scripts', 'patria_register_theme_styles' );

?>
