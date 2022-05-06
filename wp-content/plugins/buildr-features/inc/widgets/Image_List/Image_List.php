<?php

namespace buildr;

class Image_List extends \AcidWidget{
    
    function __construct() {
        
        $args = array(
            'id'            => 'buildr_image_list', 
            'title'         => 'Buildr: Image List', 
            'description'   => 'A widget to output up to 4 images with optional links', 
            'output_file'   => get_plugin_path( 'inc/widgets/Image_List/Image_List_View.php' ), 
            'widget_title'  => false, 
        );
        
        /**
        * Widget Fields
        */
        $fields = array (
           
            'heading_content' => array(
                'label'             => 'Content',
                'id'                => '',
                'default'           => '',
                'type'              => 'section',
            ),
           
            'title' => array (
                'label'             => 'Title',
                'id'                => 'title',
                'default'           => '',
                'type'              => 'text',
            ),
            'subtitle' => array (
                'label'             => 'Subtitle',
                'id'                => 'subtitle',
                'default'           => '',
                'type'              => 'textarea',
            ),
            
            'heading_appearance' => array(
                'label'          => 'Appearance',
                'id'             => '',
                'default'        => '',
                'type'           => 'section',
            ),           
            
            'text_align' => array(
                'label'          => 'Text Align - Headings',
                'id'             => 'text_align',
                'default'        => 'center',
                'type'           => 'select',
                'options'       => \buildr\alignment_options()
            ),
            'text_align_content' => array(
                'label'          => 'Text Align - Image Content',
                'id'             => 'text_align_content',
                'default'        => 'left',
                'type'           => 'select',
                'options'       => \buildr\alignment_options()
            ),
            'drop_shadow' => array (
                'label'          => 'Include a shadow at image edges?',
                'id'             => 'drop_shadow',
                'default'        => 'on',
                'type'           => 'toggle',
            ),
            'bg_color' => array (
                'label'          => 'Background Color',
                'id'             => 'bg_color',
                'default'        => '#ffffff',
                'type'           => 'colorpicker',
            ),
            'text_color' => array (
                'label'          => 'Text Color',
                'id'             => 'text_color',
                'default'        => '#333333',
                'type'           => 'colorpicker',
            ),
            'padding' => array(
                'label'          => 'Vertical Padding',
                'id'             => 'padding',
                'default'        => '50',
                'type'           => 'number'
            ),

        );
        
        for ( $i = 1; $i < 5; $i++ ) :
            
            $fields[ 'image_' . $i ]['label']       = 'Image #' . $i;
            $fields[ 'image_' . $i ]['id']          = 'image_'  . $i;
            $fields[ 'image_' . $i ]['default']     = '';
            $fields[ 'image_' . $i ]['type']        = 'media';
            
            $fields[ 'url_' . $i ]['label']         = 'Image #' . $i . ' - Link/URL';
            $fields[ 'url_' . $i ]['id']            = 'url_'  . $i;
            $fields[ 'url_' . $i ]['default']       = '';
            $fields[ 'url_' . $i ]['type']          = 'url';
            
            $fields[ 'title_' . $i ]['label']       = 'Image #' . $i . ' - Title';
            $fields[ 'title_' . $i ]['id']          = 'title_'  . $i;
            $fields[ 'title_' . $i ]['default']     = '';
            $fields[ 'title_' . $i ]['type']        = 'text';
                
        endfor;
        
        parent::__construct( $args, $fields, array(
            'buildr-image-list' => get_plugin_url( 'inc/widgets/Image_List/assets/image-list.css' )
        ) );
        
    }
    
}

function register_image_list_widget() {
    register_widget( 'buildr\Image_List' );
}
add_action( 'widgets_init', 'buildr\register_image_list_widget' );