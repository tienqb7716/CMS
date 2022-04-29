<?php
/*
Plugin Name: Take new post plugin
Plugin URI: https://wordpress.com/
Description: Test plugin 
Version: 1.0
Author: Automattic
Author URI: google.com
*/
if ( ! function_exists( 'group_6_print_random_post' ) ) {
    function group_6_print_random_post()
    {
        $args = array(
            'post_status' => 'publish', // Chỉ lấy những bài viết được publish
            'showposts' => 5, // số lượng bài viết
        );
         $the_query = new WP_Query( $args );
         if ($the_query->have_posts()):
            while ($the_query->have_posts()):
                $the_query->the_post();
                the_title(); // lấy tiêu đề bài post
	            the_excerpt(); // Lấy mô tả ngắn của bài post 
	            the_category(); // lấy category của bài post này 
            endwhile;endif;
    }

  }
add_action('init','group_6_print_random_post');
?>