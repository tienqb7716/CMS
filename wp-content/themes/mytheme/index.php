<?php
get_header();
?>
<div class="container mt-5 pt-5">
   <div class="new-post">
      <h3 class="title-news">Bài viết mới</h3>
      <div class="card-columns">
         <?php $postquery = new WP_Query(array('posts_per_page' => 5));
         if ($postquery->have_posts()) {
            while ($postquery->have_posts()) : $postquery->the_post();
               $do_not_duplicate = $post->ID; ?>
               <div class="card px-2 border-0">
                  <div class="border">
                     <div class="card-img-top">
                     <?php
                     the_post_thumbnail('full', array('class' => 'img-fluid'));
                     ?>
                     </div>
                    
                     <div class="card-body">
                        <a href="<?php the_permalink(); ?>"><?php /* the_title() */ ?></a>
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
   </div>
</div>
<?php
get_footer(); ?>