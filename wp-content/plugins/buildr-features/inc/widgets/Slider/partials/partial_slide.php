<?php if ( !empty( $instance['slider_height_style'] ) ) : ?>

    <?php if ( $instance['slider_height_style'] == 'fixed' ) : ?>

        <div class="slide" style="height: <?php echo !empty( $instance['slider_height'] ) ? esc_attr( $instance['slider_height'] ) : 600; ?>px; background-image: url(<?php echo esc_url( $instance['slide_image_' . $slide] ); ?>);">
        
    <?php else : ?>

        <div class="slide" style="height: <?php echo intval( $instance['slider_height_style'] ); ?>vw; background-image: url(<?php echo esc_url( $instance['slide_image_' . $slide] ); ?>);">
        
    <?php endif; ?>

<?php else : ?>

    <div class="slide" style="height: 42vw; background-image: url(<?php echo esc_url( $instance['slide_image_' . $slide] ); ?>);">

<?php endif; ?>
        
    <?php if ( empty( $instance['slide_overlay_opacity_' . $slide] ) ) : ?>
        <div class="slide-inner">
    <?php else : ?>    
        <div class="slide-inner" style="background-color: rgba(0,0,0,<?php echo esc_attr( $instance['slide_overlay_opacity_' . $slide] ); ?>);">
    <?php endif; ?>
        
        <div class="flex-container-wrap">
            
            <div class="container">

                <div class="row">

                    <div class="col-sm-9 col-md-6">

                        <div class="slide-content">

                            <?php if ( !empty( $instance['slide_pre_title_' . $slide] ) ) : ?>
                                <span class="pre-title wow fadeIn">
                                    <?php echo esc_html( $instance['slide_pre_title_' . $slide] ); ?>
                                </span>
                            <?php endif; ?>

                            <?php if ( !empty( $instance['slide_title_' . $slide] ) ) : ?>
                                <h2 class="slide-title wow fadeIn">
                                    <?php echo esc_html( $instance['slide_title_' . $slide] ); ?>
                                </h2>
                            <?php endif; ?>

                            <?php if ( !empty( $instance['slide_caption_' . $slide] ) ) : ?>
                                <p class="wow fadeIn">
                                    <?php echo esc_html( $instance['slide_caption_' . $slide] ); ?>
                                </p>
                            <?php endif; ?>

                            <?php if ( !empty( $instance['slide_button_label_' . $slide] ) && !empty( $instance['slide_button_url_' . $slide] ) ) : ?>
                                <a class="button wow fadeIn" href="<?php echo esc_url( $instance['slide_button_url_' . $slide] ); ?>">
                                    <?php echo esc_html( $instance['slide_button_label_' . $slide] ); ?>
                                </a>
                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            </div>
            
        </div>

    </div>

</div>