<?php
// Social
if (!function_exists('shortcode_social')) {
    function shortcode_social($atts, $content)
    {
        $icon = $link = '';
        $attr = shortcode_atts(array(
            'icon' => 'fa-facebook',
            'link' => '#',
        ), $atts);

        echo '<a href="' . $link . '"><i class="fa ' . $icon . '"></i>' . $content . '</a>';
    }
    add_shortcode('social', 'shortcode_social');
}


add_theme_support('post-thumbnails');

/**
@ Chèn CSS và Javascript vào theme
@ sử dụng hook wp_enqueue_scripts() để hiển thị nó ra ngoài front-end
 **/
function my_styles()
{
    /*
    * Hàm get_stylesheet_uri() sẽ trả về giá trị dẫn đến file style.css của theme
    * Nếu sử dụng child theme, thì file style.css này vẫn load ra từ theme mẹ
    */
    wp_register_style(
        'main-style',
        get_template_directory_uri() . '/style.css',
        'all'
    );
    wp_enqueue_style('main-style');
}
add_action('wp_enqueue_scripts', 'my_styles');

function append_query_string($url, $post, $leavename = false)
{
    if ($post->post_type == 'post') {
        $url = add_query_arg('id', get_the_ID(), $url);
    }
<<<<<<< HEAD
    return $url;
}
add_filter('post_link', 'append_query_string', 10, 3);
=======
    add_action( 'wp_enqueue_scripts', 'my_styles' );
/**
@ Tạo menu vào theme
@ sử dụng hook wp_enqueue_scripts() để hiển thị nó ra ngoài front-end
**/
add_theme_support( 'menus' );

function register_menus() {
  register_nav_menus(
    array(
      'top-menu' => 'Top Menu',
      'main-menu' => 'Main Menu' ,
      'footer-menu' => 'Footer Menu' ,
    )
  );
}
add_action( 'init', 'register_menus' ); 

//Logo
// function theme_name_custom_logo_setup() {
//   $defaults = array(
//       'height'               => 100,
//       'width'                => 400,
//       'flex-height'          => true,
//       'flex-width'           => true,
//       'header-text'          => array( 'site-title', 'site-description' ),
//       'unlink-homepage-logo' => true, 
//   );

//   add_theme_support( 'custom-logo', $defaults );
// }
add_theme_support( 'custom-logo' );


?>
>>>>>>> afc9af6003e3bd041682b70f434509e3fbe56e38
