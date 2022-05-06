<?php 
namespace buildr;
?>

<div class="col-sm-12">

    <div class="float-simple">
    
        <div class="flxbx center mid">

            <div>

                <h2><?php attr( $cta_title ); ?></h2>
                <h6><?php html( $cta_subtitle ); ?></h6>

            </div>

            <div>

                <?php button( $cta_btn_text, $cta_btn_url, $cta_btn_style, $btn_size ); ?>

            </div>

        </div>
        
    </div>
    
</div>
