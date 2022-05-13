<?php

namespace buildr;

class Simple_CTA extends \AcidWidget{
    
    function __construct() {
        
        $args = array(
            'id'            => 'buildr_simple_cta', // 1. Edit the widget ID
            'title'         => 'Buildr: Simple CTA', // 2. Edit the Widget Title
            'description'   => 'Creates a simple horizontal call to action with title, subtitle and button', // 3. Edit the widget description
            'output_file'   => get_plugin_path( 'inc/widgets/Simple_CTA/Simple_CTA_View.php' ), // 4. Set the location of the frontend widget display
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
           'cta-content' => array(
               'label'      => 'Content',
               'id'         => '',
               'default'    => '',
               'type'       => 'section',
           ),
           'cta_title' => array (
               'label'      => 'Title',
               'id'         => 'cta_title',
               'default'    => '',
               'type'       => 'text',
           ),
           'cta_subtitle' => array (
               'label'      => 'Subtitle',
               'id'         => 'cta_subtitle',
               'default'    => '',
               'type'       => 'textarea',
           ),
           'cta_btn_text' => array (
               'label'      => 'Button Text',
               'id'         => 'cta_btn_text',
               'default'    => '',
               'type'       => 'text',
           ),
           'cta_btn_url' => array (
               'label'      => 'Button URL',
               'id'         => 'cta_btn_url',
               'default'    => '',
               'type'       => 'url',
           ),
           'cta-appearance' => array(
               'label'      => 'Appearance',
               'id'         => '',
               'default'    => '',
               'type'       => 'section',
           ),
           'cta_layout' => array(
               'label'      => 'Layout',
               'id'         => 'cta_layout',
               'default'    => 'float',
               'type'       => 'select',
               'options'    => array(
                   'float'      => 'Float',
                   'stacked'    => 'Stack',
               )
           ),
           'cta_text_align' => array(
               'label'      => 'Text align',
               'id'         => 'cta_text_align',
               'default'    => 'center',
               'type'       => 'select',
               'options'    => alignment_options()
           ),
    
           'cta_btn_style' => array(
               'label'      => 'Button style',
               'id'         => 'cta_btn_style',
               'default'    => 'primary',
               'type'       => 'select',
               'options'    => button_options()
           ),
           'btn_size'   => array(
               'label'  => 'Button size',
               'id'     => 'btn_size',
               'default'=> 'medium',
               'type'   => 'select',
               'options'=> button_sizes()
           ),
           'cta_bg_color' => array (
               'label'      => 'Background color',
               'id'         => 'cta_bg_color',
               'default'    => '#ffffff',
               'type'       => 'colorpicker',
           ),
           'cta_text_color' => array (
               'label'      => 'Text color',
               'id'         => 'cta_text_color',
               'default'    => '#333333',
               'type'       => 'colorpicker',
           ),
           'cta_padding' => array(
               'label'      => 'Vertical Padding',
               'id'         => 'cta_padding',
               'default'    => '60',
               'type'       => 'number'
           ),
           
       );
        
        parent::__construct( $args, $fields, array(
            'buildr-simple-cta' => get_plugin_url( 'inc/widgets/Simple_CTA/assets/simple-cta.css' )
        ) );
        
    }
    
    
}

function register_simple_cta() {
    register_widget( 'buildr\Simple_CTA' );
}

add_action( 'widgets_init', 'buildr\register_simple_cta' );