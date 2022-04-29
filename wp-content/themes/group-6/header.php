<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package group-6
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<?php
		/**
		 * @see  buzzstore_skip_links() - 5
		 */
		do_action('buzzstore_header_before');

		/**
		 * @see  buzzstore_top_header() - 15
		 * @see  buzzstore_main_header() - 20
		 */
		do_action('buzzstore_header');

		do_action('buzzstore_header_after');
		?>
		<nav class="buzz-menulink" id="content">
			<div class="buzz-logo">
				<?php if (function_exists('the_custom_logo')) {
					the_custom_logo();
				} ?>
			</div>

			<div class="box-header-nav main-menu-wapper">
				<?php wp_nav_menu(array(
					'theme_location' => 'top-menu',
					'menu' => 'Header menu',
					'menu_id'        => 'header-menu',
					'menu_class'      => 'main-menu',
				)); ?>
			</div>
		</nav>