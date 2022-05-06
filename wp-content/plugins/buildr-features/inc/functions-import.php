<?php

namespace buildr;

add_filter( 'pt-ocdi/import_files', 'buildr\import_files' );

add_action( 'pt-ocdi/after_import', 'buildr\after_import_setup' );

add_filter( 'pt-ocdi/plugin_page_setup', 'buildr\import_page_title' );

add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

function import_files() {

    $free_presets = array(
        array (
            'import_file_name' => 'Buildr Standard',
            'categories' => array ( 'Free' ),
            'import_file_url' => get_plugin_url( 'presets/preset1/content.xml' ),
            'import_widget_file_url' => get_plugin_url( 'presets/preset1/widgets.wie' ),
            'import_customizer_file_url' => get_plugin_url( 'presets/preset1/customizer.dat' ),
            'import_preview_image_url' => 'https://i.imgur.com/J6Cr0tL.jpg',
            'import_notice' => __( 'After you import this demo, you will have to setup the slider separately.', 'buildr' ),
            'preview_url' => 'http://buildr.preset1.smartcatthemes.com/',
        ),
        array (
            'import_file_name' => 'Buildr Startup',
            'categories' => array ( 'Free' ),
            'import_file_url' => get_plugin_url( 'presets/preset2/content.xml' ),
            'import_widget_file_url' => get_plugin_url( 'presets/preset2/widgets.wie' ),
            'import_customizer_file_url' => get_plugin_url( 'presets/preset2/customizer.dat' ),
            'import_preview_image_url' => 'https://i.imgur.com/Q21l2Tg.jpg',
            'import_notice' => __( 'After you import this demo, you will have to setup the slider separately.', 'buildr' ),
            'preview_url' => 'http://buildr.preset2.smartcatthemes.com/',
        ),
        array (
            'import_file_name' => 'Buildr Marketing',
            'categories' => array ( 'Free' ),
            'import_file_url' => get_plugin_url( 'presets/preset3/content.xml' ),
            'import_widget_file_url' => get_plugin_url( 'presets/preset3/widgets.wie' ),
            'import_customizer_file_url' => get_plugin_url( 'presets/preset3/customizer.dat' ),
            'import_preview_image_url' => 'https://i.imgur.com/qITjPXT.jpg',
            'import_notice' => __( 'After you import this demo, you will have to setup the slider separately.', 'buildr' ),
            'preview_url' => 'http://buildr.preset3.smartcatthemes.com/',
        ),
    );
    
    return apply_filters( 'buildr_presets', $free_presets );
    
}

function pro_import_files(){
    
    return array(
        array (
            'import_file_name' => 'Buildr Agency',
            'categories' => array ( 'Pro' ),
            'import_file_url' => get_plugin_url( 'presets/preset5/content.xml' ),
            'import_widget_file_url' => get_plugin_url( 'presets/preset5/widgets.wie' ),
            'import_customizer_file_url' => get_plugin_url( 'presets/preset5/customizer.dat' ),
            'import_preview_image_url' => 'https://i.imgur.com/nJHSD5W.jpg',
            'import_notice' => __( 'After you import this demo, you will have to setup the slider separately.', 'buildr' ),
            'preview_url' => 'http://buildr.pro1.smartcatthemes.com/',
        ),
        array (
            'import_file_name' => 'Buildr Product',
            'categories' => array ( 'Pro' ),
            'import_file_url' => get_plugin_url( 'presets/preset4/content.xml' ),
            'import_widget_file_url' => get_plugin_url( 'presets/preset4/widgets.wie' ),
            'import_customizer_file_url' => get_plugin_url( 'presets/preset4/customizer.dat' ),
            'import_preview_image_url' => 'https://i.imgur.com/289U0DN.jpg',
            'import_notice' => __( 'After you import this demo, you will have to setup the slider separately.', 'buildr' ),
            'preview_url' => 'http://buildr.pro.smartcatthemes.com/',
        ),
        array (
            'import_file_name' => 'Buildr Business',
            'categories' => array ( 'Pro' ),
            'import_file_url' => get_plugin_url( 'presets/preset6/content.xml' ),
            'import_widget_file_url' => get_plugin_url( 'presets/preset6/widgets.wie' ),
            'import_customizer_file_url' => get_plugin_url( 'presets/preset6/customizer.dat' ),
            'import_preview_image_url' => 'https://i.imgur.com/yuPJhxg.jpg',
            'import_notice' => __( 'After you import this demo, you will have to setup the slider separately.', 'buildr' ),
            'preview_url' => 'http://buildr.pro2.smartcatthemes.com/',
        ),
        array (
            'import_file_name' => 'Buildr Restaurant',
            'categories' => array ( 'Pro' ),
            'import_file_url' => get_plugin_url( 'presets/preset7/content.xml' ),
            'import_widget_file_url' => get_plugin_url( 'presets/preset7/widgets.wie' ),
            'import_customizer_file_url' => get_plugin_url( 'presets/preset7/customizer.dat' ),
            'import_preview_image_url' => 'https://i.imgur.com/zW4zdpF.jpg',
            'import_notice' => __( 'After you import this demo, you will have to setup the slider separately.', 'buildr' ),
            'preview_url' => 'http://buildr-food.smartcatdev.wpengine.com/',
        ),

    );
    
}

function get_page_url( $title ) {

    $page = get_page_by_title( $title );
    
    return get_the_permalink( $page->ID );
    
}


function after_import_setup( $selected_import ) {
    
    $primary_nav = 'Primary';
    $custom_header_nav = 'Custom Header';
    $primary_left_nav = 'Primary - Left';
    $primary_right_nav = 'Primary - Right';
    
    if( wp_get_nav_menu_object( $primary_nav ) 
            && wp_get_nav_menu_object( $custom_header_nav ) 
            && wp_get_nav_menu_object( $primary_left_nav )
            && wp_get_nav_menu_object( $primary_right_nav ) ) {
        
        $primary_nav = get_term_by( 'name', $primary_nav, 'nav_menu' );
        $custom_header_nav = get_term_by( 'name', $custom_header_nav, 'nav_menu' );
        $primary_left_nav = get_term_by( 'name', $primary_left_nav, 'nav_menu' );
        $primary_right_nav = get_term_by( 'name', $primary_right_nav, 'nav_menu' );
        
        set_theme_mod( 'nav_menu_locations', array(
            'primary-menu'              => $primary_nav->term_id,
            'split-primary-left'        => $primary_left_nav->term_id,
            'split-primary-right'       => $primary_right_nav->term_id,
            'mobile-menu'               => $primary_nav->term_id,
            'custom-header'             => $custom_header_nav->term_id,
        ));        
        
    }

//	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
        
        if( $front_page_id ) {
            update_option( 'page_on_front', $front_page_id->ID );
        }
        
        if( $blog_page_id ) {
            update_option( 'page_for_posts', $blog_page_id->ID );
        }
        
	if ( 'Demo Import 1' === $selected_import['import_file_name'] ) {
            
	}


}

function import_page_title( $title ) {
    
    $title['menu_title'] = esc_html__( 'Theme Presets' , 'buildr' );
    
    return $title;
}
