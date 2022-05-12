<?php 
namespace buildr;

$this->css['#' . $args['widget_id'] ] = array(
    'background-color'  => $values['bg_color'],
    'padding'           => $values['padding'] . 'px 0 ' . $values['padding'] . 'px 0',
    'text-align'        => $values['text_align']
);

$this->css['#'. $args['widget_id'] . ' h2'] = array(
    'color'             => $values['text_color'],
    'margin-top'        => '0px',
    'margin-bottom'     => '0px'
);

$this->css['#'. $args['widget_id'] . ' h6'] = array(
    'color'             => $values['text_color'],
    'margin-top'        => '15px',
    'margin-bottom'     => '0px'
);


?>


<div class="buildr-module heading" id="<?php echo esc_attr( $args['widget_id' ] ); ?>">
    
    <div class="container">
        
        <div class="row">
        
            <div class="col-sm-12">
                
                <?php if( $values['title'] ) : ?>
                    <h2><?php attr( $values['title'] ); ?></h2>
                <?php endif; ?>
                
                <?php if( $values['subtitle'] ) : ?>
                    <h6><?php html( $values['subtitle'] ); ?></h6>
                <?php endif; ?>
                
            </div>

        </div>
        
    </div>
    
</div>