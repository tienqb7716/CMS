<?php

namespace buildr;


//add_action( 'admin_init', 'buildr\pro_announce' );


function pro_announce() {
    
    if( ! get_option( 'buildr_pro_announce') ) {
        
        update_option( 'buildr_pro_announce', true );
        wp_safe_redirect( admin_url( 'themes.php?page=buildr-theme-upgrade' ) );
        exit();
    }
    
}