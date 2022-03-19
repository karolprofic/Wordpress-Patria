<article class="article-container" id="post-<?php the_ID(); ?>">

	<section class="article-extended-content article-extended-link" >

		<div class="article-link" style="background-image: url(<?php echo esc_url( the_post_thumbnail_url() ); ?>); background-position: center; ">

			<?php
				$link = patria_grab_url();
				esc_html(the_title( '<h1><a href="' . $link . '" target="_blank">', '</a></h1>'));
			?>

		</div>

	</section>

</article>
