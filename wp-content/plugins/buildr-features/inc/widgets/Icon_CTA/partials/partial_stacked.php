<?php 
namespace buildr;
?>
<div class="col-sm-12">
    
    <div class="<?php attr( $icon_location ); ?>-align-image">  
        <span class="icon-cta-icon <?php attr( $icon ); ?>"></span>
    </div>
    
    <h3><?php attr( $title ); ?></h3>
    <p><?php html( $details ); ?></p>
    
    <?php button( $btn_text, $btn_url, $btn_style, $btn_size ); ?>    
    
</div>


