<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package group-6
 */

if (!is_active_sidebar('buzzsidebarone')) {
	return;
}


if (is_active_sidebar('buzzsidebarone')) {
?>
	<section id="secondaryright" class="widget-area" role="complementary">
		<?php dynamic_sidebar('buzzsidebarone'); ?>
	</section><!-- #secondary -->
<?php
}

if (is_active_sidebar('buzzstorefooterone')) {
?>
	<div class="rightsidebar">
		<section id="secondaryright" class="widget-area" role="complementary">
			<?php dynamic_sidebar('buzzstorefooterone'); ?>
		</section><!-- #secondary -->
	</div>

<?php
}
