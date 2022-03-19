<article class="article-container article-container-quote" id="post-<?php the_ID(); ?>">

	<section class="article-content article-content-quote">

		<i class="icon-quote-left"></i>
		
			<?php 

				$readmore = __( 'Read More...', 'patria' );
				the_content($readmore); 
				wp_link_pages(); 
				
			?>
		
		<div class="clear-both"></div>
		
	</section>

</article>  
