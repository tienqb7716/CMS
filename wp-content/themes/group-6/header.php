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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'group-6'); ?></a>

		<header id="masthead" class="site-header">

			<nav class="navbar navbar-expand-md navbar-light " style="background: #ffd400;">
			<div class="container">
			<?php
				the_custom_logo();
				if (is_front_page() && is_home()) :
				?>
					<h1 class="site-title navbar-brand"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
				<?php
				else :
				?>
					<p class="site-title navbar-brand"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
				<?php
				endif;
				/*
				$group_6_description = get_bloginfo('description', 'display');
				if ($group_6_description || is_customize_preview()) : */
				?>
					<!-- <p class="site-description"><?php //echo $group_6_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
												?></p> -->
				<?php //endif; ?>
				<button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="collapsibleNavId">
					<ul class="navbar-nav me-auto mt-2 mt-lg-0">
						<li class="nav-item fw-bold ">
							<a class="nav-link" href="#">Home <span class="visually-hidden">(current)</span></a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
							<div class="dropdown-menu" aria-labelledby="dropdownId">
								<a class="dropdown-item" href="#">Action 1</a>
								<a class="dropdown-item" href="#">Action 2</a>
							</div>
						</li>
					</ul>
					<form class="d-flex my-2 my-lg-0">
						<input class="form-control me-sm-2" type="text" placeholder="Nhập sản phẩm cần tìm">
						<button class="btn btn-outline-success btn-sm my-2 my-sm-0" type="submit">Tìm</button>
					</form>
				</div>
			</div>
		</nav>
		</header><!-- #masthead -->