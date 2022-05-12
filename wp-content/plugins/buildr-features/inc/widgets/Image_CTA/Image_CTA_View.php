<?php 
namespace buildr;


$this->css['#' . $args['widget_id'] ] = array(
    'background-color'  => $values['bg_color'],
    'padding'           => $values['padding'] . 'px 0 ' . $values['padding'] . 'px 0',
);

$this->css['#'. $args['widget_id'] . ' h3'] = array(
    'color'   => $values['text_color']
);

$this->css['#'. $args['widget_id'] . ' p'] = array(
    'color'   => $values['text_color']
);

$this->css['#'. $args['widget_id'] . ' img.image-cta-img'] = array(
    'width'   => '100%',
    'height'   => 'auto',
);

if( $values['text_align'] ) {
    $this->css['#'. $args['widget_id']]['text-align'] = $values['text_align'];
} else {
    $this->css['#'. $args['widget_id']]['text-align'] = 'center';
}

if( $values['image_rounded'] == 'on' ) {
    $this->css['#'. $args['widget_id'] . ' img.image-cta-img']['border-radius'] = '100%';
}

if( 'stacked' == $values['image_location'] ) {
    $this->css['#'. $args['widget_id'] . ' img.image-cta-img']['text-align'] = 'center';
    $this->css['#'. $args['widget_id'] . ' img.image-cta-img']['max-width'] = '50%';
    $this->css['#'. $args['widget_id'] . ' img.image-cta-img']['display'] = 'block';
    $this->css['#'. $args['widget_id'] . ' img.image-cta-img']['margin'] = '0 auto 30px';
}

?>

<div class="buildr-module image-cta" id="<?php echo attr( $args['widget_id' ] ); ?>">
    
    <div class="container">
        
        <div class="row">
            
            <?php 
            if( 'left' == $values['image_location'] ) :
                render_template( 'Image_CTA/partials/partial_left.php', $values );
            elseif( 'right' == $values['image_location'] ) :
                render_template( 'Image_CTA/partials/partial_right.php', $values );
            else:
                render_template( 'Image_CTA/partials/partial_stacked.php', $values );
            endif;
            ?>    
            
        </div>
        
    </div>
    
</div>