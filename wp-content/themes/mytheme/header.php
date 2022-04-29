<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="profile" href="https://gmpg.org/xfn/11" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../mytheme/myStyle.css" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-scrolling-animations="true">
    <?php wp_body_open(); ?>
    <div id="page" class="site">

        <nav class="buzz-menulink" id="content">
            <div class="logo-custom">
                <?php if (function_exists('the_custom_logo')) {
                    the_custom_logo();
                } ?>
            </div>

            <div class="box-header-nav main-menu-wapper">

                <?php wp_nav_menu(array(
                    'theme_location' => 'top-menu',
                )); ?>
            </div>
        </nav>