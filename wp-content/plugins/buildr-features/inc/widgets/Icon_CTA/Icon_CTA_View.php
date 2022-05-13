<?php 
namespace buildr;


$this->css['#' . $args['widget_id'] ] = array(
    'background-color'  => $values['bg_color'],
    'padding'           => $values['padding'] . 'px 0',
);

$this->css['#'. $args['widget_id'] . ' span.icon-cta-icon'] = array(
    'font-size'         => $values['icon_size'] . 'px',
    'width'             => ( $values['icon_size'] + 100 ) . 'px',
    'height'            => ( $values['icon_size'] + 100 ) . 'px',
    'line-height'       => ( $values['icon_size'] + 100 ) . 'px',
);

$this->css['#'. $args['widget_id'] . ' span.icon-cta-icon']['background-color'] = $values['icon_bg_color'];
$this->css['#'. $args['widget_id'] . ' span.icon-cta-icon']['color'] = $values['icon_color'];

if( $values['icon_style'] != 'square' ) {
    if( $values['icon_style'] == 'circle' ) {
        $this->css['#'. $args['widget_id'] . ' span.icon-cta-icon']['border-radius'] = '50%';
    } else {
        $this->css['#'. $args['widget_id'] . ' span.icon-cta-icon']['border-radius'] = '5px';
    }
}

$this->css['#'. $args['widget_id'] . ' h3'] = array(
    'color'   => $values['text_color']
);

$this->css['#'. $args['widget_id'] . ' p'] = array(
    'color'   => $values['text_color']
);

if( $values['text_align'] ) {
    $this->css['#'. $args['widget_id']]['text-align'] = $values['text_align'];
} else {
    $this->css['#'. $args['widget_id']]['text-align'] = 'center';
}

?>

<div class="buildr-module icon-cta" id="<?php echo attr( $args['widget_id' ] ); ?>">
    
    <div class="container">
        
        <div class="row">
            
            <?php 
            if( 'left' == $values['icon_location'] ) :
                render_template( 'Icon_CTA/partials/partial_left.php', $values );
            elseif( 'right' == $values['icon_location'] ) :
                render_template( 'Icon_CTA/partials/partial_right.php', $values );
            else:
                render_template( 'Icon_CTA/partials/partial_stacked.php', $values );
            endif;
            ?>    
            
        </div>
        
    </div>
    
</div>