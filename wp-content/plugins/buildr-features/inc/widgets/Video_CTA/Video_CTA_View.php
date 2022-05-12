<?php 
namespace buildr;

// CSS
$this->css['#' . $args['widget_id'] ] = array(
    'background-color'  => $values['bg_color'],
    'padding'           => $values['padding'] . 'px 0 ' . $values['padding'] . 'px 0',
    'text-align'        => $values['text_align']
);

$this->css['#'. $args['widget_id'] . ' h3'] = array(
    'color'   => $values['text_color']
);

$this->css['#'. $args['widget_id'] . ' p'] = array(
    'color'   => $values['text_color']
);

$this->css['#'. $args['widget_id'] . ' img.video-cta-img'] = array(
    'width'   => '100%',
    'height'   => 'auto',
);

$this->css['#'. $args['widget_id'] . ' .video-cta-wrapper'] = array(
    'position'  => 'relative',
    
);

$this->css['#'. $args['widget_id'] . ' .video-cta-wrapper .video-cta-icon'] = array(
    'position'      => 'absolute',
    'top'           => '0',
    'left'          => '0',
    'bottom'        => '0',
    'right'         => '0',
    'margin'        => 'auto',
    'z-index'       => '99',
    'text-align'    => 'center'
);

$this->css['#'. $args['widget_id'] . ' .video-cta-wrapper .video-cta-icon:before'] = array(
    'top'       => '50%',
    'position'  => 'absolute',
    'color'     => '#fff',
    'font-size' => '56px',
    
);


if( 'stacked' == $values['video_location'] ) {
    $this->css['#'. $args['widget_id'] . ' img.video-cta-img']['text-align'] = 'center';
    $this->css['#'. $args['widget_id'] . ' img.video-cta-img']['max-width'] = '50%';
    $this->css['#'. $args['widget_id'] . ' img.video-cta-img']['display'] = 'block';
    $this->css['#'. $args['widget_id'] . ' img.video-cta-img']['margin'] = '0 auto';
}

?>

<div class="buildr-module video-cta" id="<?php echo esc_attr( $args['widget_id' ] ); ?>">
    
    <div class="container">
        
        <div class="row">
            
            <?php 
            if( 'left' == $values['video_location'] ) :
                render_template( 'Video_CTA/partials/partial_left.php', $values );
            elseif( 'right' == $values['video_location'] ) :
                render_template( 'Video_CTA/partials/partial_right.php', $values );
            else:
                render_template( 'Video_CTA/partials/partial_stacked.php', $values );
            endif;
            ?>    
            
        </div>
    </div>
    
</div>