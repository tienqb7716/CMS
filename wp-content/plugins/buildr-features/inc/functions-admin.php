<?php

namespace buildr;

add_filter( 'user_contactmethods', 'buildr\modify_user_contact_methods' );
add_action( 'wp_ajax_reset_content', '\buildr\reset_content' );
//add_action( 'admin_menu', 'buildr\add_tools_page' );
add_action( 'admin_menu', 'buildr\add_upgrade_page' );


function reset_content() {
    
    if( ! wp_verify_nonce( $_POST['nonce'], 'buildr_reset_content' ) ) {
        die('un-authorized');
    }
    
    global $wpdb;
    
    $wpdb->query( 'delete from ' . $wpdb->prefix . 'posts where post_type in ("post","page","buildr_faq","buildr_service","buildr_testimonial","buildr_event")');
    
    update_option( 'sidebars_widgets','' );
    
    exit();
}



    
function add_upgrade_page() {

    if ( function_exists( '\buildr_pro\init' ) ) {
        return;
    }

    add_theme_page( __( 'Buildr Pro', 'buildr' ), __( 'Buildr Pro', 'buildr' ), 'edit_theme_options', 'buildr-theme-upgrade', function() {
        include_once get_plugin_path() . '/admin/buildr-upgrade.php';
    });

}



function add_tools_page() {

    add_theme_page( __( 'Theme Tools', 'buildr' ), __( 'Theme Tools', 'buildr' ), 'edit_theme_options', 'buildr-theme-tools', function() {
        include_once get_plugin_path() . '/admin/buildr-tools.php';
    });
    
}


function modify_user_contact_methods( $user_contact ) {

    // Add additional user meta contact fields
    $user_contact['job_title']      = __( 'Job Title', 'buildr' );
    $user_contact['location']       = __( 'Location', 'buildr' );
    $user_contact['facebook']       = __( 'Facebook', 'buildr' );
    $user_contact['twitter']        = __( 'Twitter', 'buildr' );
    $user_contact['linkedin']       = __( 'LinkedIn', 'buildr' );
    $user_contact['pinterest']      = __( 'Pinterest', 'buildr' );
    $user_contact['instagram']      = __( 'Instagram', 'buildr' );
    $user_contact['author_banner']  = __( 'Author Banner Image URL', 'buildr' );

    return $user_contact;
    
}
