<?php

namespace buildr;

class Video_CTA extends \AcidWidget{
    
    function __construct() {
        
        $args = array(
            'id'            => 'buildr_video_cta', // 1. Edit the widget ID
            'title'         => 'Buildr: YouTube Video CTA', // 2. Edit the Widget Title
            'description'   => 'Output a single video, with some text in various ways', // 3. Edit the widget description
            'output_file'   => get_plugin_path( 'inc/widgets/Video_CTA/Video_CTA_View.php' ), // 4. Set the location of the frontend widget display
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
           
           'cta-content'    => array(
               'label'  => 'Content',
               'id'     => '',
               'default'=> '',
               'type'   => 'section',
           ),
           
           'video'  => array(
               'label'  => 'Youtube Video ID',
               'id'     => 'video',
               'default'=> 'nDiaRSklhMo',
               'type'   => 'text'
           ),
           
           'title'  => array (
               'label' => 'Title',
               'id' => 'title',
               'default' => '',
               'type' => 'text',
           ),
           'details'    => array (
               'label' => 'Details',
               'id' => 'details',
               'default' => '',
               'type' => 'textarea',
           ),
           
           'btn_text'   => array (
               'label' => 'Button Text',
               'id' => 'btn_text',
               'default' => '',
               'type' => 'text',
           ),
           
           'btn_url'    => array (
               'label' => 'Button URL',
               'id' => 'btn_url',
               'default' => '',
               'type' => 'url',
           ),
           
           'cta-appearance' => array(
               'label'  => 'Appearance',
               'id'     => '',
               'default'=> '',
               'type'   => 'section',
           ),
           
           'autoplay'       => array(
               'label'      => 'Autoplay?',
               'id'         => 'autoplay',
               'default'    => 'on',
               'type'       => 'toggle'
           ),
           
           'loop'       => array(
               'label'      => 'Loop?',
               'id'         => 'loop',
               'default'    => 'on',
               'type'       => 'toggle'
           ),
           
           'controls'       => array(
               'label'      => 'Show controls?',
               'id'         => 'controls',
               'default'    => 'off',
               'type'       => 'toggle'
           ),
           
           'height'         => array(
               'label'      => 'Video height',
               'id'         => 'height',
               'default'    => 350,
               'type'       => 'number'
           ),
           
           'video_location' => array(
               'label'  => 'Video Location',
               'id'     => 'video_location',
               'default'=> 'left',
               'type'   => 'select',
               'options'=> array(
                   'left'       => 'Left',
                   'right'      => 'Right',
                   'stacked'    => 'Stacked',
               )
           ),
           
           'text_align' => array(
               'label'  => 'Text align',
               'id'     => 'text_align',
               'default'=> 'right',
               'type'   => 'select',
               'options'=> array(
                   'left'       => 'Left',
                   'right'      => 'Right',
                   'center'   => 'Centered',
               )
           ),
           'btn_style'  => array(
               'label'  => 'Button style',
               'id'     => 'btn_style',
               'default'=> 'primary',
               'type'   => 'select',
               'options'=> button_options()
           ),
           'btn_size'   => array(
               'label'  => 'Button size',
               'id'     => 'btn_size',
               'default'=> 'medium',
               'type'   => 'select',
               'options'=> button_sizes()
           ),
           'bg_color'   => array (
               'label' => 'Background color',
               'id' => 'bg_color',
               'default' => '#ffffff',
               'type' => 'colorpicker',
           ),
           'text_color' => array (
               'label' => 'Text color',
               'id' => 'text_color',
               'default' => '#333333',
               'type' => 'colorpicker',
           ),
           'padding'    => array(
               'label'  => 'Vertical Padding',
               'id'     => 'padding',
               'default'=> '60',
               'type'   => 'number'
           ),
           
        );
        
        parent::__construct( $args, $fields, array(
            'buildr-video-cta' => get_plugin_url( 'inc/widgets/Video_CTA/assets/video-cta.css' )
        ) );
        
    }
    
}

function register_video_cta() {
    register_widget( 'buildr\Video_CTA' );
}

add_action( 'widgets_init', 'buildr\register_video_cta' );