<?php 
namespace buildr;
/**
 * 
 * $args['widget_id'] provides the ID of the widget instance, useful for uniquely identifying the widget
 * for CSS or JS purposes
 * 
 * $values is a mixed array containing all values of the widget
 * and it already handles setting up defaults
 * 
 */

$this->css['#' . $args['widget_id'] ] = array(
    'background-color'  => $values['bg_color'],
    'padding'           => $values['vertical_padding'] . 'px 0 ' . $values['vertical_padding'] . 'px 0',
);

?>

<div class="buildr-module shortcode" id="<?php echo esc_attr( $args['widget_id' ] ); ?>">
    
    <?php if ( !empty( $values['container_wrap'] ) && $values['container_wrap'] == 'on' ) : ?>
    
        <div class="container">

            <div class="row">

                <div class="col-sm-12">
            
    <?php endif; ?>
                
    <?php echo do_shortcode( $values['shortcode'] ); ?>    
                
    <?php if ( !empty( $values['container_wrap'] ) && $values['container_wrap'] == 'on' ) : ?>
                    
                </div>

            </div>

        </div>
    
    <?php endif; ?>
    
</div>
