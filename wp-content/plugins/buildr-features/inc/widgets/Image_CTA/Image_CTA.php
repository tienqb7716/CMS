<?php

namespace buildr;

class Image_CTA extends \AcidWidget{
    
    function __construct() {
        
        $args = array(
            'id'            => 'buildr_image_cta', // 1. Edit the widget ID
            'title'         => 'Buildr: Image CTA', // 2. Edit the Widget Title
            'description'   => 'Output a single image, with some text in various ways', // 3. Edit the widget description
            'output_file'   => get_plugin_path( 'inc/widgets/Image_CTA/Image_CTA_View.php' ), // 4. Set the location of the frontend widget display
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
           
           'image' => array(
               'label'      => 'Image',
               'id'         => 'image',
               'default'    => '',
               'type'       => 'media'
           ),
           
           'title' => array (
               'label'      => 'Title',
               'id'         => 'title',
               'default'    => '',
               'type'       => 'text',
           ),
           'details' => array (
               'label'      => 'Details',
               'id'         => 'details',
               'default'    => '',
               'type'       => 'textarea',
           ),
           
           'btn_text' => array (
               'label'      => 'Button Text',
               'id'         => 'btn_text',
               'default'    => '',
               'type'       => 'text',
           ),
           
           'btn_url' => array (
               'label'      => 'Button URL',
               'id'         => 'btn_url',
               'default'    => '',
               'type'       => 'url',
           ),
           
           'cta-appearance' => array(
               'label'      => 'Appearance',
               'id'         => '',
               'default'    => '',
               'type'       => 'section',
           ),
           
           'image_location' => array(
               'label'      => 'Image Location',
               'id'         => 'image_location',
               'default'    => 'left',
               'type'       => 'select',
               'options'    => alignment_options()
           ),

           'text_align' => array(
               'label'      => 'Text align',
               'id'         => 'text_align',
               'default'    => '',
               'type'       => 'select',
               'options'    => array(
                   'left'       => 'Left',
                   'right'      => 'Right',
                   'center'     => 'Centered',
               )
           ),
           
           'image_rounded' => array(
               'label'      => 'Rounded image? (must be square 1:1 image)',
               'id'         => 'image_rounded',
               'default'    => 'off',
               'type'       => 'toggle'
           ),
           'btn_style' => array(
               'label'      => 'Button style',
               'id'         => 'btn_style',
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
           'bg_color' => array (
               'label'      => 'Background color',
               'id'         => 'bg_color',
               'default'    => '#ffffff',
               'type'       => 'colorpicker',
           ),
           'text_color' => array (
               'label'      => 'Text color',
               'id'         => 'text_color',
               'default'    => '#333333',
               'type'       => 'colorpicker',
           ),
           'padding' => array(
               'label'      => 'Vertical Padding',
               'id'         => 'padding',
               'default'    => '0',
               'type'       => 'number'
           ),
           
       );
        
        parent::__construct( $args, $fields, array(
            'buildr-image-cta' => get_plugin_url( 'inc/widgets/Image_CTA/assets/image-cta.css' )
        ) );
        
    }
    
    
}

function register_image_cta() {
    register_widget( 'buildr\Image_CTA' );
}

add_action( 'widgets_init', 'buildr\register_image_cta' );