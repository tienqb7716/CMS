<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package group-6
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if (is_home() && !is_front_page()) { ?>
		<header class="entry-header">
			<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
		</header><!-- .entry-header -->
	<?php }; ?>

	<div class="entry-content">
		<?php
		the_content();
		if (is_front_page()) {
			do_shortcode('[group6_new_post]');
		}
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'group-6'),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->