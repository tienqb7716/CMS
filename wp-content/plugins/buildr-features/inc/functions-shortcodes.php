<?php

namespace buildr;

// Shortcode Registration ------------------------------------------------------
// -----------------------------------------------------------------------------

add_shortcode( 'buildr-icon', 'buildr\shortcode_fa_icon' );

// Shortcode Definitions -------------------------------------------------------
// -----------------------------------------------------------------------------

/**
 * Font Awesome Icon Shortcode
 * 
 * @since 1.1.1
 * @param type $atts
 * @return type
 */
function shortcode_fa_icon( $atts ) {
    
    $params = shortcode_atts( array(
        'icon'      => 'fas fa-star',
        'id'        => '',
        'size'      => '',
        'color'     => '',
    ), $atts );

    ob_start();
    
    render_shortcode_fa_icon( $params );
    $output = ob_get_clean();
    return $output;
    
}

// Shortcode Rendering ---------------------------------------------------------
// -----------------------------------------------------------------------------

/**
 * Render the Font Awesome Icon Shortcode
 * 
 * @since 1.1.1
 * @param type $params
 */
function render_shortcode_fa_icon( $params ) { ?>

    <span id="<?php attr( $params['id'] ); ?>" 
        class="<?php attr( $params['icon'] ); ?>" 
        style="
        <?php echo intval( $params['size'] ) ? 'font-size: ' . intval( $params['size'] ) . 'px;' : ''; ?> 
        <?php echo !empty( $params['color'] ) ? 'color: ' . sanitize_hex_color( $params['color'] ) . ';' : ''; ?>">
    </span>
    
<?php }
