<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage mytheme
 * @since mytheme 1.0
 */
$post = get_post();
get_header();
?>


<div id="primary" class="content-area">
	<img class="img-fluid w-50"  src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID))[0]; ?>" alt="">
	
	<?php
	// Start the loop.
	while (have_posts()) : the_post();

		/*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
		get_template_part('content', get_post_format());

		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) :
			comments_template();
		endif;

		// Previous/next post navigation.
		the_post_navigation(array(
			'next_text' => '<span class="meta-nav" aria-hidden="true">' . __('Next', 'twentyfifteen') . '</span> ' .
				'<span class="screen-reader-text">' . __('Next post:', 'twentyfifteen') . '</span> ' .
				'<span class="post-title">%title</span>',
			'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __('Previous', 'twentyfifteen') . '</span> ' .
				'<span class="screen-reader-text">' . __('Previous post:', 'twentyfifteen') . '</span> ' .
				'<span class="post-title">%title</span>',
		));

	// End the loop.
	endwhile;
	?>

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php
get_footer();
