<?php 
namespace buildr;
?>

<div class="col-sm-12">

    <div class="flxbx center mid <?php attr( $image_location ); ?>-align-image <?php attr( $text_align ); ?>-align-text">

        <div>
            
            <img class="image-cta-img" src="<?php url( $image ); ?>" />
            
        </div>
        
        <div>
            
            <h3><?php attr( $title ); ?></h3>
            <p><?php html( $details ); ?></p>

            <?php button( $btn_text, $btn_url, $btn_style, $btn_size ); ?>
            
        </div>
        
    </div>
    
</div>
