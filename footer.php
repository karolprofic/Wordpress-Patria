<footer class="footer">
	<section class="footer-lft">
		<p><?php esc_html__( 'Copyright ', 'patria' ); ?><a href="mailto:<?php bloginfo( 'admin_email' ); ?>" target="_top"><?php bloginfo( 'name' ) ?></a> &copy; <?php esc_html__( 'All Rights Reserved.', 'patria' ); ?></p>
	</section>
	<section class="footer-rlg">

		<?php if ( get_theme_mod('patria_facebook') != '' ): ?>
			<a href="<?php echo esc_url(get_theme_mod('patria_facebook')) ?>" target="_blank" title="Facebook" class="icon-facebook"></a>
		<?php endif; ?>

		<?php if ( get_theme_mod('patria_twitter') != '' ): ?>
			<a href="<?php echo esc_url(get_theme_mod('patria_twitter')) ?>" target="_blank" title="Twitter" class="icon-twitter"></a>
		<?php endif; ?>

		<?php if ( get_theme_mod('patria_google') != '' ): ?>
			<a href="<?php echo esc_url(get_theme_mod('patria_google')) ?>" target="_blank" title="Google+" class="icon-gplus"></a>
		<?php endif; ?>

		<?php if ( get_theme_mod('patria_linkedin') != '' ): ?>
			<a href="<?php echo esc_url(get_theme_mod('patria_linkedin')) ?>" target="_blank" title="Linkedin" class="icon-linkedin"></a>
		<?php endif; ?>

		<?php if ( get_theme_mod('patria_youtube') != '' ): ?>
			<a href="<?php echo esc_url(get_theme_mod('patria_youtube')) ?>" target="_blank" title="Youtube" class="icon-youtube"></a>
		<?php endif; ?>

		<?php if ( get_theme_mod('patria_pinterest') != '' ): ?>
			<a href="<?php echo esc_url(get_theme_mod('patria_pinterest')) ?>" target="_blank" title="Pinterest" class="icon-pinterest"></a>
		<?php endif; ?>

		<?php if ( get_theme_mod('patria_github') != '' ): ?>
			<a href="<?php echo esc_url(get_theme_mod('patria_github')) ?>" target="_blank" title="GitHub" class="icon-github-circled"></a>
		<?php endif; ?>

		<?php if ( get_theme_mod('patria_vimeo') != '' ): ?>
			<a href="<?php echo esc_url(get_theme_mod('patria_vimeo')) ?>" target="_blank" title="Vimeo" class="icon-vimeo"></a>
		<?php endif; ?>

		<?php if ( get_theme_mod('patria_flickr') != '' ): ?>
			<a href="<?php echo esc_url(get_theme_mod('patria_flickr')) ?>" target="_blank" title="Flickr" class="icon-flickr"></a>
		<?php endif; ?>

		<?php if ( get_theme_mod('patria_soundcloud') != '' ): ?>
			<a href="<?php echo esc_url(get_theme_mod('patria_soundcloud')) ?>" target="_blank" title="SoundCloud" class="icon-soundcloud"></a>
		<?php endif; ?>

		<?php if ( get_theme_mod('patria_twitch') != '' ): ?>
			<a href="<?php echo esc_url(get_theme_mod('patria_twitch')) ?>" target="_blank" title="Twitch" class="icon-twitch"></a>
		<?php endif; ?>

		<?php if ( get_theme_mod('patria_tumblr') != '' ): ?>
			<a href="<?php echo esc_url(get_theme_mod('patria_tumblr')) ?>" target="_blank" title="Tumblr" class="icon-tumblr"></a>
		<?php endif; ?>

	</section>
	<div class="clear-both"></div>
</footer>

<div class="padding-bottom-on"></div>

<?php wp_footer(); ?>

</body>
</html>
