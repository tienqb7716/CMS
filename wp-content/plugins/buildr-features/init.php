<?php
/**
 * Plugin Name: Buildr Features
 * Author: Smartcat
 * Description: Advanced Widgets for Buildr theme.
 * Version: 1.3.0
 * Author: Smartcat
 * Author URI: https://smartcatdesign.net/
 * License: GPL V2
 * Text Domain: buildr
 * Domain Path: /languages 
 *
 * @package buildr
 * @since 1.0.0
 */
namespace buildr;

/**
 * Exit if accessed directly for security
 */
if( !defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Constant Declarations
 */
const BUILDR_MODULES_VERSION = '1.3.0';
const BUILD_MIN_VERSION = '1.1.0';

/**
 * @since 1.0.0
 * @param string $path
 * @return string
 */
function get_plugin_path( $path = '' ) {
    return plugin_dir_path( __FILE__ ) . $path;
}

/**
 * @since 1.0.0
 * @param string $url
 * @return string
 */
function get_plugin_url( $url = '' ) {
    return plugin_dir_url( __FILE__ ) . $url;
}


// initialize the plugin
add_action( 'plugins_loaded', 'buildr\plugins_loaded', 99 );

/**
 * Checks if Buildr is active as a parent or child theme
 */
function buildr_flag() {
    
    if ( function_exists( 'wp_get_theme' ) ) {

        $active_theme = wp_get_theme();

        $active_theme_name = strtolower( $active_theme->get( 'Name' ) );
        $parent_theme_name = strtolower( $active_theme->get( 'Template' ) );

    } else {

        $active_theme_name = strtolower( get_option( 'current_theme') );
        $parent_theme_name = strtolower( get_option( 'current_theme') );

    }
    
    if( $active_theme_name == 'buildr' || $parent_theme_name == 'buildr' ) {
        return true;
    }
    
    return false;
}

/**
 * @since 1.0.0
 * @return null
 */
function after_setup_theme() {

    if( BUILDR_VERSION < BUILD_MIN_VERSION ) {

        $message = 'Please update your Buildr theme. This is a required update. <a href="' . esc_url( admin_url( 'themes.php' ) ) . '">Click here</a> then click Update on the Buildr Theme Icon';

        make_admin_notice( __( $message, 'error', false ) );

        return;
    }
    
   /**
    * Load Necessary Includes
    */
    require get_plugin_path() . 'inc/functions-fontawesome.php';
    require get_plugin_path() . 'inc/functions-general.php';
    require get_plugin_path() . 'inc/functions-metabox.php';
    require get_plugin_path() . 'inc/functions-shortcodes.php';
    require get_plugin_path() . 'inc/functions-customizer.php';
    require get_plugin_path() . 'inc/functions-widgets.php';
    require get_plugin_path() . 'inc/functions-enqueue.php';
    require get_plugin_path() . 'inc/functions-css.php';
    
    require get_plugin_path() . 'inc/functions-tgmpa.php';
    
    if ( !function_exists( '\buildr_pro\init' ) ) {
        require get_plugin_path() . 'inc/functions-updates.php';
        require get_plugin_path() . 'inc/customizer/class-buildr-pro-customize.php';
    }
    
    do_action( 'buildr_after_setup_theme' );
    
}

function plugins_loaded() {
    
    
    if( ! buildr_flag() ) {
        return false;
    }
    
    if( is_admin() ) {
        require get_plugin_path() . 'inc/functions-admin.php';
    }
    
    require get_plugin_path() . 'inc/functions-import.php';
    
    do_action( 'buildr_plugins_loaded' );
    
    add_action( 'after_setup_theme', 'buildr\after_setup_theme', 99 );  
    
}

function make_admin_notice( $message, $type = 'error', $dismissible = true ) {
    add_action( 'admin_notices', function () use ( $message, $type, $dismissible ) {
        echo '<div class="notice notice-' . esc_attr( $type ) . ' ' . ( $dismissible ? 'is-dismissible' : '' ) . '">';
        echo '<p>' . $message . '</p>';
        echo '</div>';
    } );
}

function init() {
    return;
}
