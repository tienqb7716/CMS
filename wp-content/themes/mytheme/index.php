<?php
get_header();
get_slidebar();

$args = array(
   'post_type'=>'post', //Loại là post
   'orderby' => 'rand', //Lấy ngẫu nhiên
   'posts_per_page' => 5 //Lấy 5 bài post 1 trang
);
$the_query = new WP_Query( $args );
if ($the_query->have_posts()):
   while ($the_query->have_posts()):
       $the_query->the_post();
       echo the_title("<br>");
   endwhile;endif;
?>
