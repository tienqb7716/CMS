<?php if ( !empty( $instance['slider_visibility'] ) && $instance['slider_visibility'] ) : ?>

    <div class="buildr-module">

        <?php if ( !empty( $instance['slider_height_style'] ) ) : ?>

            <?php if ( $instance['slider_height_style'] == 'fixed' ) : ?>

                <style type="text/css" scoped>

                    @media (max-width:991px) {
                        .buildr-module .slider.instance-<?php echo esc_attr( $widget_id ); ?>,
                        .buildr-module .slider.instance-<?php echo esc_attr( $widget_id ); ?> .slide {
                            height: <?php echo !empty( $instance['slider_height_mobile'] ) ? esc_attr( $instance['slider_height_mobile'] ) : 400; ?>px !important;
                        }
                    }

                </style>

                <div class="slider arrowed-slider instance-<?php echo esc_attr( $widget_id ); ?>" style="height: <?php echo !empty( $instance['slider_height'] ) ? esc_attr( $instance['slider_height'] ) : 600; ?>px;">

            <?php else : ?>

                <div class="slider arrowed-slider instance-<?php echo esc_attr( $widget_id ); ?>" style="height: <?php echo intval( $instance['slider_height_style'] ); ?>vw;">

            <?php endif; ?>

        <?php else : ?>

            <div class="slider arrowed-slider instance-<?php echo esc_attr( $widget_id ); ?>" style="height: 42vw;">

        <?php endif; ?>

            <?php for ( $slide = 1; $slide < apply_filters( 'buildr_slide_count', 3 ); $slide++ ) : ?>

                <?php if ( !empty( $instance['slide_image_' . $slide] ) ) : ?>

                    <?php include 'partials/partial_slide.php'; ?>

                <?php endif; ?>

            <?php endfor; ?>

        </div>
                    
    </div>

<?php endif; ?>