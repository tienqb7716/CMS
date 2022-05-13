<?php

namespace buildr;

class Icon_CTA extends \AcidWidget{
    
    function __construct() {
        
        $args = array(
            'id'            => 'buildr_icon_cta',
            'title'         => 'Buildr: Icon CTA',
            'description'   => 'Output a single featured icon and text, in various ways', 
            'output_file'   => get_plugin_path( 'inc/widgets/Icon_CTA/Icon_CTA_View.php' ),
            'widget_title'  => false, 
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
           
           'icon' => array(
               'label'      => 'Icon',
               'id'         => 'icon',
               'default'    => '',
               'type'       => 'select',
               'options'    => fa_icons()
           ),
           'icon_size' => array(
               'label'      => 'Icon - Size in Pixels',
               'id'         => 'icon_size',
               'default'    => 100,
               'type'       => 'number',
           ),
           'icon_style' => array (
               'label'      => 'Icon - Shape',
               'id'         => 'icon_style',
               'default'    => 'circle',
               'type'       => 'select',
               'options'    => array(
                    'square'    => 'Square',
                    'circle'    => 'Circle',
                    'rounded'   => 'Rounded Corners',
               ),
           ),
           'icon_color' => array (
               'label'      => 'Icon - Color',
               'id'         => 'icon_color',
               'default'    => '#ffffff',
               'type'       => 'colorpicker',
           ),
           'icon_bg_color' => array (
               'label'      => 'Icon - Background Color',
               'id'         => 'icon_bg_color',
               'default'    => '#141414',
               'type'       => 'colorpicker',
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
           
           'icon_location' => array(
               'label'      => 'Icon Location',
               'id'         => 'icon_location',
               'default'    => 'left',
               'type'       => 'select',
               'options'    => array(
                    'left'      => 'Left',
                    'right'     => 'Right',
                    'center'    => 'Stacked',
                ),
            ),

           'text_align' => array(
               'label'      => 'Text Align',
               'id'         => 'text_align',
               'default'    => '',
               'type'       => 'select',
               'options'    => alignment_options()
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
               'label'      => 'Background Color',
               'id'         => 'bg_color',
               'default'    => '#ffffff',
               'type'       => 'colorpicker',
           ),
           'text_color' => array (
               'label'      => 'Text Color',
               'id'         => 'text_color',
               'default'    => '#333333',
               'type'       => 'colorpicker',
           ),
           'padding' => array(
               'label'      => 'Vertical Padding',
               'id'         => 'padding',
               'default'    => '30',
               'type'       => 'number'
           ),
           
       );
        
        parent::__construct( $args, $fields, array(
            'buildr-icon-cta' => get_plugin_url( 'inc/widgets/Icon_CTA/assets/icon-cta.css' )
        ) );
        
    }
    
    
}

function register_icon_cta() {
    register_widget( 'buildr\Icon_CTA' );
}

add_action( 'widgets_init', 'buildr\register_icon_cta' );