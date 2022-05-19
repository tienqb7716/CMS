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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php echo do_shortcode('[product]') ?>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
			<div class="buzz-container buzz-clearfix">
				<div class="buzz-site-branding">
					<button class="buzz-toggle mobile-only" data-toggle-target=".header-mobile-menu" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
						<div class="one"></div>
						<div class="two"></div>
						<div class="three"></div>
					</button>


				</div><!-- .site-branding -->

				<?php do_action('buzzstore_search'); ?>
				<!-- search section -->

			</div>
		
		<nav class="buzz-menulink" id="content">
			<div class="logo-custom">
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
