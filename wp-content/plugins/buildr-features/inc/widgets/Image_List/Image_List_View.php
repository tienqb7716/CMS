<?php 
namespace buildr;

$this->css['#' . $args['widget_id'] ] = array(
    'background-color'  => $values['bg_color'],
    'padding'           => $values['padding'] . 'px 0',
);

$this->css['#'. $args['widget_id'] . ' h2'] = array(
    'color'             => $values['text_color'],
    'text-align'        => $values['text_align'],
);

$this->css['#'. $args['widget_id'] . ' h6'] = array(
    'color'             => $values['text_color'],
    'text-align'        => $values['text_align'],
);

if ( empty( $values['drop_shadow'] ) || $values['drop_shadow'] == 'on' ) :
    $this->css['#'. $args['widget_id'] . ' .image-list-item img'] = array(
        'box-shadow'        => '0 0 10px 0 rgba(0,0,0,0.25)',
    );
endif;

$this->css['#'. $args['widget_id'] . ' .image-list-item h4'] = array(
    'text-align'        => $values['text_align_content'],
);

$this->css['#'. $args['widget_id'] . ' .image-list-item h4 a'] = array(
    'color'             => $values['text_color'],
);

?>


<div class="buildr-module image-list" id="<?php attr( $args['widget_id' ] ); ?>">
    
    <div class="container">
        
        <div class="row">
        
            <div class="col-sm-12">
                
                <?php if( $values['title'] ) : ?>
                    <h2 class="title"><?php attr( $values['title'] ); ?></h2>
                <?php endif; ?>
                
                <?php if( $values['subtitle'] ) : ?>
                    <h6 class="subtitle"><?php html( $values['subtitle'] ); ?></h6>
                <?php endif; ?>
                
            </div>
            
            <div class="clear"></div>
            
            <?php
            
            $images = array();
            $ctr = 0;
            $clear_ctr = 0;
            
            if ( !empty( $values['image_1'] ) ) { 
                $ctr++; 
            }
            if ( !empty( $values['image_2'] ) ) { 
                $ctr++; 
            }
            if ( !empty( $values['image_3'] ) ) { 
                $ctr++; 
            }
            if ( !empty( $values['image_4'] ) ) { 
                $ctr++; 
            }
            
            if ( $ctr > 0 ) : ?>
                
                <div class="image-list-wrapper columns-<?php attr( $ctr ); ?>">
                
                    <?php for ( $i = 1; $i < 5; $i++ ) : ?>

                        <?php include get_plugin_path( 'inc/widgets/Image_List/partials/partial_card.php' ); ?>

                        <?php $clear_ctr++; ?>

                        <?php if ( $clear_ctr == 2 ) : ?>
                            <div class="clear-tablet"></div>
                        <?php endif; ?>

                        <?php if ( $ctr != 3 && $clear_ctr != 0 && $clear_ctr % 2 == 0 ) : ?>
<!--                            <div class="clear"></div>-->
                        <?php endif;

                    endfor; ?>
                    
                </div>
                 
            <?php endif; ?>
            
        </div>
        
    </div>
    
</div>