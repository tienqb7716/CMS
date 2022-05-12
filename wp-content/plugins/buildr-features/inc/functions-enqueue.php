<?php

namespace buildr;

/**
 * Load CSS & JS for the front-end
 * 
 * @since 1.0.0
 * @return void
 */
function enqueue_plugin_styles_scripts() {
    
    // Styles
    wp_enqueue_style( 'slick', get_plugin_url() . 'assets/lib/slick/slick.css', null, BUILDR_MODULES_VERSION );
    wp_enqueue_style( 'buildr-features-common', get_plugin_url() . 'assets/css/common.css', null, BUILDR_MODULES_VERSION );
    
    // Scripts
    wp_enqueue_script( 'slick', get_plugin_url() . 'assets/lib/slick/slick.min.js', array( 'jquery' ), BUILDR_MODULES_VERSION );

    if( current_user_can( 'edit_theme_options' ) ) {
        wp_enqueue_style( 'buildr-admin-css', get_plugin_url() . 'assets/admin/admin.css', null, BUILDR_MODULES_VERSION );
    }
    
}
add_action( 'wp_enqueue_scripts', 'buildr\enqueue_plugin_styles_scripts' );

/**
 * Load Admin JS & CSS for the back-end
 * 
 * @since 1.0.0
 * @return void
 */
function enqueue_admin_styles() {
    
    // Styles
    wp_enqueue_style( 'buildr-customize', get_plugin_url() . 'assets/admin/customizer.css', null, BUILDR_MODULES_VERSION );
    
    // Scripts
    wp_enqueue_media();
    wp_enqueue_script( 'wp-media-uploader', get_plugin_url() . 'assets/lib/wp-media-uploader/wp_media_uploader.js', array( 'jquery' ), BUILDR_MODULES_VERSION );
    wp_enqueue_script( 'buildr-admin', get_plugin_url() . 'assets/admin/admin.js', array( 'jquery' ), BUILDR_MODULES_VERSION );
    
}
add_action( 'customize_controls_enqueue_scripts', 'buildr\enqueue_admin_styles' );
add_action( 'admin_print_styles-post-new.php', 'buildr\enqueue_admin_styles' );
add_action( 'admin_print_styles-post.php', 'buildr\enqueue_admin_styles' );
add_action( 'admin_print_styles-widgets.php', 'buildr\enqueue_admin_styles' );

add_action( 'admin_enqueue_scripts', 'buildr\buildr_load_upgrade_css' );
function buildr_load_upgrade_css( $hook ) {
    
    // Enqueue fonts and css only on this page
    if( 
            'appearance_page_buildr-theme-upgrade' == $hook 
            || 'appearance_page_pt-one-click-demo-import' == $hook 
            || 'appearance_page_buildr-theme-tools' == $hook 
    ) {
        wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );
        wp_enqueue_style( 'buildr-admin-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700,900' );
        wp_enqueue_style( 'buildr-admin-css', get_plugin_url() . 'assets/admin/upgrade.css' );
        
        wp_enqueue_script( 'buildr-reset-content', get_plugin_url() . 'assets/admin/reset-content.js', array( 'jquery' ), BUILDR_MODULES_VERSION );
        
        wp_localize_script( 'buildr-reset-content', 'buildr', array(
            'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
            'nonce'     => wp_create_nonce('buildr_reset_content'),
        ) );
        
    }
    
}