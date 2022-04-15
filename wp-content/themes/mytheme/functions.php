<?php
// Social
if(!function_exists('shortcode_social')){
    function shortcode_social($atts, $content){
        $icon = $link = '';
        $attr = shortcode_atts( array(
            'icon' => 'fa-facebook',
            'link' => '#',
        ), $atts );

        echo '<a href="'. $link .'"><i class="fa '.$icon.'"></i>'. $content .'</a>';
    }
    add_shortcode('social', 'shortcode_social');
}

	
add_theme_support( 'post-thumbnails' );

/**
@ Chèn CSS và Javascript vào theme
@ sử dụng hook wp_enqueue_scripts() để hiển thị nó ra ngoài front-end
**/
function my_styles() {
    /*
    * Hàm get_stylesheet_uri() sẽ trả về giá trị dẫn đến file style.css của theme
    * Nếu sử dụng child theme, thì file style.css này vẫn load ra từ theme mẹ
    */
    wp_register_style( 'main-style', get_template_directory_uri() . '/style.css',
    'all' );
    wp_enqueue_style( 'main-style' );
    }
    add_action( 'wp_enqueue_scripts', 'my_styles' );