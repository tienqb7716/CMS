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
    'background-color'  => $values['cta_bg_color'],
    'padding'           => $values['cta_padding'] . 'px 0 ' . $values['cta_padding'] . 'px 0',
    'text-align'        => $values['cta_text_align']
);

$this->css['#'. $args['widget_id'] . ' h2'] = array(
    'color'   => $values['cta_text_color']
);

$this->css['#'. $args['widget_id'] . ' h6'] = array(
    'color'   => $values['cta_text_color']
);

?>

<div class="buildr-module simple-cta" id="<?php echo esc_attr( $args['widget_id' ] ); ?>">
    
    <div class="container">
        
        <div class="row">
            <?php 
            if( 'float' == $values['cta_layout'] ) :
                render_template( 'Simple_CTA/partials/partial_float.php', $values );
            else :
                render_template( 'Simple_CTA/partials/partial_stacked.php', $values );
            endif;
            ?>    
        </div>
        
    </div>
    
</div>