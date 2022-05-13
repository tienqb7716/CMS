<?php

namespace buildr;

class SimpleCta extends \AcidWidget{
    
    function __construct() {
        
        $args = array(
            'id'            => 'buildr_simple_cta', // 1. Edit the widget ID
            'title'         => 'Buildr: Simple CTA', // 2. Edit the Widget Title
            'description'   => 'Creates a simple horizontal call to action with title, subtitle and button', // 3. Edit the widget description
            'output_file'   => get_plugin_path( 'inc/widgets/SimpleCta/simple_cta_view.php' ) // 4. Set the location of the frontend widget display
        );
        
        /**
        * Edit this array to specify your widget form fields
        * Make sure to set the ID to something easier for you to remember, 
        * Also set the type, which determines the datatype and form field type
        * 
        * This list is a sample of all possible options
        */
       $fields = array (
           array (
               'label' => 'Text Field',
               'id' => 'textfield_61055',
               'default' => 'Text field default',
               'type' => 'text',
           ),
           array(
               'label'  => 'Title',
               'id'     => null,
               'default'=> null,
               'type'   => 'title'
           ),
           array(
               'label'  => 'Section Header',
               'id'     => null,
               'default'=> null,
               'type'   => 'section'
           ),
           array (
               'label' => 'Text Area',
               'id' => 'textarea_76714',
               'default' => 'Text area default',
               'type' => 'textarea',
           ),
           array (
               'id'         => null,
               'default'    => null,
               'type' => 'seperator',
           ),
           array (
               'label' => 'Checkbox',
               'id' => 'checkbox_75243',
               'default' => '1',
               'type' => 'checkbox',
           ),
           array (
               'label' => 'Toggle',
               'id' => 'toggle_75243',
               'default' => 'on',
               'type' => 'toggle',
           ),
           array (
               'label' => 'Image upload',
               'id' => 'imageupload_82814',
               'default'   => '',
               'type' => 'media',
           ),
           array (
               'label' => 'Email',
               'id' => 'email_39459',
               'default' => 'admin@smartcat.ca',
               'type' => 'email',
           ),
           array (
               'label' => 'URL',
               'id' => 'url_61666',
               'default' => 'https://smartcatdesign.net',
               'type' => 'url',
           ),
           array (
               'label' => 'Password',
               'id' => 'password_33742',
               'default' => 'password',
               'type' => 'password',
           ),
           array (
               'label' => 'Number',
               'id' => 'number_87178',
               'default' => '9',
               'type' => 'number',
           ),
           array (
               'label' => 'Telephone',
               'id' => 'telephone_31629',
               'default' => '8881239898',
               'type' => 'tel',
           ),
           array (
               'label' => 'Date',
               'id' => 'date_35159',
               'default' => '01-01-2018',
               'type' => 'date',
           ),
           array (
               'label' => 'Color',
               'id' => 'color1',
               'default'   => 'cc0000',
               'type' => 'colorpicker',
           ),
       );
        
        parent::__construct( $args, $fields );
        
    }
    
    
}

function register_simple_cta() {
    register_widget( 'buildr\SimpleCta' );
}

add_action( 'widgets_init', 'buildr\register_simple_cta' );