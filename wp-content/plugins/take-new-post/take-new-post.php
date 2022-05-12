<?php
/*
Plugin Name: Take new post plugin
Plugin URI: https://wordpress.com/
Description: Lấy 3 bài viết mới nhất và hiện ra 
Version: 1.0
Author: LinhTrang
Author URI: google.com
*/
add_shortcode('group6_new_post','group_6_print_new_post');
if (!function_exists('group_6_print_new_post')) {
    function group_6_print_new_post()
    {  if(function_exists('add_shortcode')){?>
        <div class="card-columns">
            <?php
            $args = array(
                'post_status' => 'publish', // Chỉ lấy những bài viết được publish
                'showposts' => 3, // số lượng bài viết
            );
            $postquerys = new WP_Query($args);
            
            if ($postquerys->have_posts()) {
                while ($postquerys->have_posts()) : $postquerys->the_post();
            ?>
                    <div class="card px-2 border-0">
                        <div class="border">
                            <div class="card-img-top">
                                <?php
                                the_post_thumbnail('full', array('class' => 'img-fluid'));
                                ?>
                            </div>

                            <div class="card-body">
                                <a href="<?php the_permalink(); ?>"></a>
                                <h5 class="card-title fs-3"><a href=" <?php the_permalink(); ?> " class="text-decoration-none " title=" <?php the_title(); ?> "><?php the_title(); ?></a></h5>
                                <span class="badge rounded-pill bg-info text-dark"><?php echo get_the_date(); ?></span>
                                <p class="card-text mt-3"> <?php echo get_the_excerpt() ?></p>
                                <a href="the_permalink();" class="btn btn-sm btn-primary">Read more</a>
                            </div>
                        </div>
                    </div>
            <?php endwhile;
            } ?>
        </div>
        <?php  }

           

    };
};

 register_activation_hook(__FILE__, 'group_6_print_new_post' );
 register_uninstall_hook(__FILE__, 'group_6_print_new_post' );

add_action('after_setup_theme', 'group_6_print_new_post');
