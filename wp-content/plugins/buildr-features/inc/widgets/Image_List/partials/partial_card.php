<?php namespace buildr; ?>

<?php if ( !empty( $values[ 'image_' . $i ] ) ) : ?> 

    <div class="image-list-item">

        <div class="featured-inner">

            <?php if ( !empty( $values[ 'url_' . $i ] ) ) : ?> 
                <a href="<?php url( $values[ 'url_' . $i ] ); ?>">
            <?php endif; ?>

                <img src="<?php url( $values[ 'image_' . $i ] ); ?>" alt="<?php echo !empty( $values[ 'title_' . $i ] ) ? $values[ 'title_' . $i ] : __( 'Image', 'buildr' ); ?>">

            <?php if ( !empty( $values[ 'url_' . $i ] ) ) : ?> 
                </a>
            <?php endif; ?>

            <?php if ( !empty( $values[ 'title_' . $i ] ) ) : ?> 

                <h4>
                    <?php if ( !empty( $values[ 'url_' . $i ] ) ) : ?> 
                        <a href="<?php url( $values[ 'url_' . $i ] ); ?>">
                    <?php endif; ?>

                        <?php html( $values[ 'title_' . $i ] ); ?>

                    <?php if ( !empty( $values[ 'url_' . $i ] ) ) : ?> 
                        </a>
                    <?php endif; ?>                                        
                </h4>

            <?php endif; ?> 

        </div>

    </div>

<?php endif; ?> 
