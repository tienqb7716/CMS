<section id="ArchivePost">
  <div class="archive__container">
    <div class="archive__background container">
      <?php if (is_author()): ?>
        <div class="post__author-name">
          <h2>Tác giả: <span class="name__author"><?php the_author(); ?></span> </h2>
        </div>
        <ul class="grid__item-background">
        <?php
        while(have_posts()){
          the_post();
          ?>
          <li class="grid__item">
            <div class="wrapper__post-item">
              <div class="post-item-contain">
                <div class="post-item-image">
                    <div class="kenburns-top">
                      <?php echo get_the_post_thumbnail( get_the_ID(), 'medium', null );?>
                    </div>
                </div>
                <div class="wrapper-author--date">
                  <span class="wrapper__date-calendar"><i class="far fa-calendar-alt"></i><span><?php echo get_the_date() ?></span></span>
                </div>
                <div class="post-item-content">
                  <div class="wrapper-post--title">
                    <a href="<?php echo get_permalink(); ?>"><h2 class="post--title"><?php echo get_the_title() ?></h2></a>
                  </div>
                  <div class="read-more">
                    <a href="<?php echo get_permalink(); ?>">Đọc Tiếp</a>
                  </div>
                </div>
              </div>
            </div>
            </li>
            <?php
      }?>
    </ul>
      <?php endif; ?>
      <?php if (is_category()): ?>
        <div class="post__categories-name">
          <h2>Categories: <span class="name__categories"><?php single_cat_title(); ?></span> </h2>
        </div>
        <ul class="grid__item-background">
        <?php
        while(have_posts()){
          the_post();
          ?>
          <li class="grid__item">
            <div class="wrapper__post-item">
              <div class="post-item-contain">
                <div class="post-item-image">
                    <div class="kenburns-top">
                      <?php echo get_the_post_thumbnail( get_the_ID(), 'medium', null );?>
                    </div>
                </div>
                <div class="wrapper-author--date">
                  <span class="wrapper__date-calendar"><i class="far fa-calendar-alt"></i><span><?php echo get_the_date() ?></span></span>
                </div>
                <div class="post-item-content">
                  <div class="wrapper-post--title">
                    <a href="<?php echo get_permalink(); ?>"><h2 class="post--title"><?php echo get_the_title() ?></h2></a>
                  </div>
                  <div class="read-more">
                    <a href="<?php echo get_permalink(); ?>">Đọc Tiếp</a>
                  </div>
                </div>
              </div>
            </div>
            </li>
            <?php
      }?>
    </ul>
      <?php endif; ?>
    </div>
  </div>
</section>