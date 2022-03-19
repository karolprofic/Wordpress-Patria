<article class="article-container" id="post-<?php the_ID(); ?>">

	<section class="article-extended-content article-extended-gallery" >

		<div class="slideshow-container">

		<?php if ( get_post_gallery() ) :
			$gallery = get_post_gallery( get_the_ID(), false );

			foreach( $gallery['src'] as $src ) : ?>

			<div class="mySlides fade">
				<img src="<?php echo esc_attr($src); ?>" style="width:100%" /></li>
			</div>

			<?php endforeach; endif; ?>

			<a class="prev-gallery" onclick="plusSlides(-1)">&#10094;</a>
			<a class="next-gallery" onclick="plusSlides(1)">&#10095;</a>

		</div>

	</section>

	<header class="article-header-standard-post">

		<h1><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h1>

		<p><?php echo esc_html__( 'Posted on ', 'patria' ); ?><?php echo esc_html(get_the_date());?><?php echo esc_html__( ' by ', 'patria' );?><a><?php the_author_posts_link(); ?></a></p>

	</header>

	<section class="article-content article-content-gallery">

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

<script type="application/javascript">

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
	showSlides(slideIndex += n);
}

function currentSlide(n) {
	showSlides(slideIndex = n);
}

function showSlides(n) {
	var i;
	var slides = document.querySelectorAll(".mySlides");

	if (slides.length !== 0) {
		if (n > slides.length) {
			slideIndex = 1
		}
		if (n < 1) {
			slideIndex = slides.length
		}
		for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";
		}
		slides[slideIndex-1].style.display = "block";
	} else {
		var arrow = document.querySelectorAll(".slideshow-container");
		arrow[0].innerHTML = "";
	}

}

</script>
