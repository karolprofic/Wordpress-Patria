<article class="article-container" id="post-<?php the_ID(); ?>">

	<section class="article-extended-content" >

		<?php echo patria_get_embedded_media( array(esc_html('img')) ); ?>

	</section>

	<header class="article-header-standard-post">

		<h1><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h1>

		<p><?php echo esc_html__( 'Posted on ', 'patria' ); ?><?php echo esc_html(get_the_date());?><?php echo esc_html__( ' by ', 'patria' );?><a><?php the_author_posts_link(); ?></a></p>

	</header>

	<section class="article-content article-content-image">

		<?php

			$readmore = __( 'Read More...', 'patria' );
			the_content($readmore);
			wp_link_pages(); 
			
		?>

		<div class="clear-both"></div>

	</section>

	<div class="article-separator-line"></div>

	<footer class="article-footer">

		<div class="article-footer-left">
			<i class="icon-folder-empty"></i>
			<?php the_category('') ?>
			<div class="clear-both"></div>
		</div>

		<div class="article-footer-right">
			<i class="icon-comment-empty"></i>
			<a href="<?php esc_url(comments_link()); ?>"><?php comments_number( __('Comments 0', 'patria'), __('Comments 1', 'patria'), __('Comments %', 'patria') ); ?></a>
		</div>

		<div class="article-footer-tags">
			<?php the_tags(); ?>
		</div>

	</footer>

	<div class="clear-both"></div>

</article>
