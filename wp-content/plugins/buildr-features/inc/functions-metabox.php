<?php

namespace buildr;

// create a metabox on page
add_action( 'add_meta_boxes', 'buildr\page_metabox' );


function page_metabox() {
    add_meta_box( 
            'buildr-page-metabox', 
            __( 'Page Widgets', 'buildr' ), 
            'buildr\render_post_metabox', 
            'page',
            'side',
            'high' );
    
}

function render_post_metabox() {
    
    global $post;
    
    $query['autofocus[panel]'] = 'widgets';
    $query['url'] = get_the_permalink( $post->ID );
    $panel_link = add_query_arg( $query, admin_url( 'customize.php' ) );
    ?>

    <p><?php _e( 'Add widgets to this page using Buildr\'s Drag & Drop widgets.', 'buildr' ) ?></p>
    
    <a class="button button-primary" 
       style="width: 100%;line-height: 40px;height: 40px;text-align: center;font-size: 18px;" 
       href="<?php echo esc_url( $panel_link ); ?>"><?php _e( 'Buildr Widgets', 'buildr' ); ?></a>
    
    <p><?php _e( 'Page templates share their widgets. To create unique widgets for each page, select a new page '
            . 'template from the <strong>Template</strong> dropdown, under <strong>Page Attributes</strong>') ?></p>
    
    <p>
        <a href="<?php echo esc_url( admin_url( 'themes.php?page=buildr-theme-info#page-templates' ) ); ?>"><?php _e( 'Click here ', 'buildr' ) ?></a>
        <?php _e( 'to read the docs on page templates', 'buildr' ); ?>
    </p>
    
    <?php
}

new Buildr_EDD_Extra_Details_Meta_Box;
class Buildr_EDD_Extra_Details_Meta_Box {

    public function __construct() {

        if ( is_admin() ) {
            add_action( 'load-post.php',        array ( $this, 'init_metabox' ) );
            add_action( 'load-post-new.php',    array ( $this, 'init_metabox' ) );
        }
        
    }

    public function init_metabox() {

        add_action( 'add_meta_boxes',           array ( $this, 'add_metabox' ) );
        add_action( 'save_post',                array ( $this, 'save_metabox' ), 10, 2 );
        
    }

    public function add_metabox() {

        add_meta_box( 'buildr_edd_extra_details_meta', __( 'Additional Product Details', 'buildr' ), array ( $this, 'render_edd_extra_details_metabox' ), array( 'download' ), 'normal', 'high' );
        
    }

    public function render_edd_extra_details_metabox( $post ) {

        // Add nonce for security and authentication.
        wp_nonce_field( 'edd_extra_details_meta_box_nonce_action', 'edd_extra_details_meta_box_nonce' );

        // Retrieve an existing value from the database.
        $edd_category           = get_post_meta( $post->ID, \BUILDR_META::EDD_CATEGORY, true );
        $edd_button_label       = get_post_meta( $post->ID, \BUILDR_META::EDD_SECOND_BUTTON_LABEL, true );
        $edd_button_url         = get_post_meta( $post->ID, \BUILDR_META::EDD_SECOND_BUTTON_URL, true );
        $edd_button_target      = get_post_meta( $post->ID, \BUILDR_META::EDD_SECOND_BUTTON_TARGET, true );
        $edd_additional_info    = get_post_meta( $post->ID, \BUILDR_META::EDD_ADDITIONAL_INFO, true );
        $edd_gallery            = get_post_meta( $post->ID, \BUILDR_META::EDD_GALLERY, true );
        $edd_video_id           = get_post_meta( $post->ID, \BUILDR_META::EDD_VIDEO_ID, true );
        $edd_video_gallery      = get_post_meta( $post->ID, \BUILDR_META::EDD_VIDEO_AUTOPLAY, true );
        
        // Set default values.
        if ( empty( $edd_category ) )           { $edd_category = ''; } 
        if ( empty( $edd_button_label ) )       { $edd_button_label = ''; } 
        if ( empty( $edd_button_url ) )         { $edd_button_url = ''; } 
        if ( empty( $edd_button_target ) )      { $edd_button_target = 'new'; } 
        if ( empty( $edd_additional_info ) )    { $edd_additional_info = ''; }
        if ( empty( $edd_gallery ) )            { $edd_gallery = array(); }
        if ( empty( $edd_video_id ) )           { $edd_video_id = ''; }
        if ( empty( $edd_video_autoplay ) )     { $edd_video_autoplay = 'manual'; }
            
        // Form fields.
        echo '<table class="form-table">';

        echo '	<tr>';
        echo '		<th><label for="' . esc_attr( \BUILDR_META::EDD_CATEGORY ) . '" class="' . esc_attr( \BUILDR_META::EDD_CATEGORY ) . '_label">' . __( 'Product Category Label', 'buildr' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="text" id="' . esc_attr( \BUILDR_META::EDD_CATEGORY ) . '" name="' . esc_attr( \BUILDR_META::EDD_CATEGORY ) . '" class="widefat ' . esc_attr( \BUILDR_META::EDD_CATEGORY ) . '_field" value="' . esc_attr( $edd_category ) . '">'; 
        echo '		</td>';
        echo '	</tr>';
        
        echo '	<tr>';
        echo '		<th><label for="' . esc_attr( \BUILDR_META::EDD_SECOND_BUTTON_LABEL ) . '" class="' . esc_attr( \BUILDR_META::EDD_SECOND_BUTTON_LABEL ) . '_label">' . __( 'Second Button - Label', 'buildr' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="text" id="' . esc_attr( \BUILDR_META::EDD_SECOND_BUTTON_LABEL ) . '" name="' . esc_attr( \BUILDR_META::EDD_SECOND_BUTTON_LABEL ) . '" class="widefat ' . esc_attr( \BUILDR_META::EDD_SECOND_BUTTON_LABEL ) . '_field" value="' . esc_attr( $edd_button_label ) . '">'; 
        echo '		</td>';
        echo '	</tr>';
        
        echo '	<tr>';
        echo '		<th><label for="' . esc_attr( \BUILDR_META::EDD_SECOND_BUTTON_URL ) . '" class="' . esc_attr( \BUILDR_META::EDD_SECOND_BUTTON_URL ) . '_label">' . __( 'Second Button - URL', 'buildr' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="text" id="' . esc_attr( \BUILDR_META::EDD_SECOND_BUTTON_URL ) . '" name="' . esc_attr( \BUILDR_META::EDD_SECOND_BUTTON_URL ) . '" class="widefat ' . esc_attr( \BUILDR_META::EDD_SECOND_BUTTON_URL ) . '_field" value="' . esc_attr( $edd_button_url ) . '">'; 
        echo '		</td>';
        echo '	</tr>';
        
        echo '	<tr>';
        echo '		<th><label for="' . esc_attr( \BUILDR_META::EDD_SECOND_BUTTON_TARGET ) . '" class="' . esc_attr( \BUILDR_META::EDD_SECOND_BUTTON_TARGET ) . '_label">' . __( 'Second Button - Target', 'buildr' ) . '</label></th>';
        echo '		<td>';
        echo '			<select id="' . esc_attr( \BUILDR_META::EDD_SECOND_BUTTON_TARGET ) . '" name="' . esc_attr( \BUILDR_META::EDD_SECOND_BUTTON_TARGET ) . '" class="' . esc_attr( \BUILDR_META::EDD_SECOND_BUTTON_TARGET ) . '_field">'; 
        echo '                      <option value="same" '  . selected( $edd_button_target, 'same', false ) . ' >'  . __( 'Open in Current Window', 'buildr' ) . '</option>';
        echo '                      <option value="new" ' . selected( $edd_button_target, 'new', false ) . ' >'  . __( 'Open in New Window', 'buildr' ) . '</option>';
        echo '			</select>';
        echo '		</td>';
        echo '	</tr>';

        echo '	<tr>';
        echo '		<th><label for="' . esc_attr( \BUILDR_META::EDD_ADDITIONAL_INFO ) . '" class="' . esc_attr( \BUILDR_META::EDD_ADDITIONAL_INFO ) . '_label">' . __( 'Additional Information', 'buildr' ) . '</label></th>';
        echo '		<td>';
        echo '			<textarea id="' . esc_attr( \BUILDR_META::EDD_ADDITIONAL_INFO ) . '" name="' . esc_attr( \BUILDR_META::EDD_ADDITIONAL_INFO ) . '" class="widefat ' . esc_attr( \BUILDR_META::EDD_ADDITIONAL_INFO ) . '_field">' . esc_textarea( $edd_additional_info ) . '</textarea>'; 
        echo '		</td>';
        echo '	</tr>';
        
        echo '	<tr>';
        echo '      <th><label>' . __( 'Product Images', 'buildr' ) . '</label></th>';
        echo '      <td>';
        echo '          <div class="form-group smartcat-multiple-uploader">';                            
        echo '          </div>';
        echo '          <div>';
        echo '              <ul id="mfi_images">';
                
            foreach ( $edd_gallery as $edd_gallery_item ) :
                
                echo '<li class="mfi_image_item" style="background-image:url(' . $edd_gallery_item . ')" >';
                echo '  <input type="hidden" name="' . esc_attr( \BUILDR_META::EDD_GALLERY ) . '[]" value="' . $edd_gallery_item . '" />';
                echo '  <span class="remove_mfi_image">X</span>';
                echo '</li>';
                
            endforeach;
                            
        echo '              </ul>';        
        echo '          </div>';
        echo '      </td>';
        echo '	</tr>';
                
        echo '	<tr>';
        echo '		<th><label for="' . esc_attr( \BUILDR_META::EDD_VIDEO_ID ) . '" class="' . esc_attr( \BUILDR_META::EDD_VIDEO_ID ) . '_label">' . __( 'YouTube Video ID (From your YouTube URL: "watch?v=JUST_THIS_CODE"', 'buildr' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="text" id="' . esc_attr( \BUILDR_META::EDD_VIDEO_ID ) . '" name="' . esc_attr( \BUILDR_META::EDD_VIDEO_ID ) . '" class="widefat ' . esc_attr( \BUILDR_META::EDD_VIDEO_ID ) . '_field" value="' . esc_attr( $edd_video_id ) . '">'; 
        echo '		</td>';
        echo '	</tr>';
        
        echo '	<tr>';
        echo '		<th><label for="' . esc_attr( \BUILDR_META::EDD_VIDEO_AUTOPLAY ) . '" class="' . esc_attr( \BUILDR_META::EDD_VIDEO_AUTOPLAY ) . '_label">' . __( 'Second Button - Target', 'buildr' ) . '</label></th>';
        echo '		<td>';
        echo '			<select id="' . esc_attr( \BUILDR_META::EDD_VIDEO_AUTOPLAY ) . '" name="' . esc_attr( \BUILDR_META::EDD_VIDEO_AUTOPLAY ) . '" class="' . esc_attr( \BUILDR_META::EDD_VIDEO_AUTOPLAY ) . '_field">'; 
        echo '                      <option value="manual" '  . selected( $edd_video_autoplay, 'manual', false ) . ' >'  . __( 'Click Video to Play', 'buildr' ) . '</option>';
        echo '                      <option value="autoplay" ' . selected( $edd_video_autoplay, 'autoplay', false ) . ' >'  . __( 'Play Video Automatically', 'buildr' ) . '</option>';
        echo '			</select>';
        echo '		</td>';
        echo '	</tr>';

        echo '</table>';
        
    }
    
    public function save_metabox( $post_id, $post ) {

        // Add nonce for security and authentication.
        $nonce_name     = isset( $_POST[ 'edd_extra_details_meta_box_nonce' ] ) ? $_POST[ 'edd_extra_details_meta_box_nonce' ] : '';
        $nonce_action   = 'edd_extra_details_meta_box_nonce_action';

        // Check if a nonce is set and valid
        if ( !isset( $nonce_name ) ) { return; }
        if ( !wp_verify_nonce( $nonce_name, $nonce_action ) ) { return; }
            
        // Sanitize user input.
        $edd_category           = isset( $_POST[ \BUILDR_META::EDD_CATEGORY ] ) ? sanitize_text_field( $_POST[ \BUILDR_META::EDD_CATEGORY ] ) : '';
        $edd_button_label       = isset( $_POST[ \BUILDR_META::EDD_SECOND_BUTTON_LABEL ] ) ? sanitize_text_field( $_POST[ \BUILDR_META::EDD_SECOND_BUTTON_LABEL ] ) : '';
        $edd_button_url         = isset( $_POST[ \BUILDR_META::EDD_SECOND_BUTTON_URL ] ) ? sanitize_text_field( $_POST[ \BUILDR_META::EDD_SECOND_BUTTON_URL ] ) : '';
        $edd_button_target      = isset( $_POST[ \BUILDR_META::EDD_SECOND_BUTTON_TARGET ] ) ? sanitize_text_field( $_POST[ \BUILDR_META::EDD_SECOND_BUTTON_TARGET ] ) : '';
        $edd_additional_info    = isset( $_POST[ \BUILDR_META::EDD_ADDITIONAL_INFO ] ) ? sanitize_textarea_field( $_POST[ \BUILDR_META::EDD_ADDITIONAL_INFO ] ) : '';
        $edd_gallery            = isset( $_POST[ \BUILDR_META::EDD_GALLERY ] ) ? $_POST[ \BUILDR_META::EDD_GALLERY ] : '';
        $edd_video_id           = isset( $_POST[ \BUILDR_META::EDD_VIDEO_ID ] ) ? $_POST[ \BUILDR_META::EDD_VIDEO_ID ] : '';
        $edd_video_autoplay     = isset( $_POST[ \BUILDR_META::EDD_VIDEO_AUTOPLAY ] ) ? $_POST[ \BUILDR_META::EDD_VIDEO_AUTOPLAY ] : '';

        // Update the meta field in the database.
        update_post_meta( $post_id, \BUILDR_META::EDD_CATEGORY, $edd_category );
        update_post_meta( $post_id, \BUILDR_META::EDD_SECOND_BUTTON_LABEL, $edd_button_label );
        update_post_meta( $post_id, \BUILDR_META::EDD_SECOND_BUTTON_URL, $edd_button_url );
        update_post_meta( $post_id, \BUILDR_META::EDD_SECOND_BUTTON_TARGET, $edd_button_target );
        update_post_meta( $post_id, \BUILDR_META::EDD_ADDITIONAL_INFO, $edd_additional_info );
        update_post_meta( $post_id, \BUILDR_META::EDD_GALLERY, $edd_gallery );
        update_post_meta( $post_id, \BUILDR_META::EDD_VIDEO_ID, $edd_video_id );
        update_post_meta( $post_id, \BUILDR_META::EDD_VIDEO_AUTOPLAY, $edd_video_autoplay );
        
    }
    
}
