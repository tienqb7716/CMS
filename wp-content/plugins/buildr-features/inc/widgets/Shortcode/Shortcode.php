<?php

namespace buildr;

class Shortcode extends \AcidWidget{
    
    function __construct() {
        
        $args = array(
            'id'            => 'buildr_shortcode', // 1. Edit the widget ID
            'title'         => 'Buildr: Shortcode', // 2. Edit the Widget Title
            'description'   => 'Allows you to enter a shortcode and output the result on your site', // 3. Edit the widget description
            'output_file'   => get_plugin_path( 'inc/widgets/Shortcode/Shortcode_View.php' ), // 4. Set the location of the frontend widget display
            'widget_title'  => false, // 5. Set to True if you want the built in Widget Title to be used
        );
        
        /**
        * Edit this array to specify your widget form fields
        * Make sure to set the ID to something easier for you to remember, 
        * Also set the type, which determines the datatype and form field type
        * 
        * This list is a sample of all possible options
        */
       $fields = array (
           'shortcode-content' => array(
               'label'      => 'Content',
               'id'         => '',
               'default'    => '',
               'type'       => 'section',
           ),
           'shortcode' => array (
               'label'      => 'Shortcode',
               'id'         => 'shortcode',
               'default'    => '',
               'type'       => 'text',
           ),
           'shortcode-appearance' => array(
               'label'      => 'Appearance',
               'id'         => '',
               'default'    => '',
               'type'       => 'section',
           ),
           'container_wrap' => array (
               'label'      => 'Wrap Shortcode Output in a Container?',
               'id'         => 'container_wrap',
               'default'    => 'on',
               'type'       => 'toggle',
           ),
           'bg_color' => array (
               'label'      => 'Background Color',
               'id'         => 'bg_color',
               'default'    => '#ffffff',
               'type'       => 'colorpicker',
           ),
           'vertical_padding' => array(
               'label'      => 'Vertical Padding',
               'id'         => 'vertical_padding',
               'default'    => '60',
               'type'       => 'number'
           ),
           
       );
        
        parent::__construct( $args, $fields );
        
    }
    
    
}

function register_shortcode() {
    register_widget( 'buildr\Shortcode' );
}

add_action( 'widgets_init', 'buildr\register_shortcode' );
