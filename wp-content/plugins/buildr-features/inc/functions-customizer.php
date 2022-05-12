<?php

/**
 * Buildr Theme Customizer
 *
 * @package Buildr
 */
include_once buildr\get_plugin_path( '/inc/lib/Acid/acid.php' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function buildr_customize_register( $wp_customize ) {
    
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    
    
    // Housekeeping ------------------------------------------------------------
    $wp_customize->get_section( 'header_image' )->panel = 'panel_custom_header';
    $wp_customize->get_section( 'title_tagline' )->title = __( 'General Settings', 'buildr' );
    $wp_customize->get_section( 'title_tagline' )->panel = 'panel_title_tagline';
//    $wp_customize->get_panel('widgets')->title = __( 'Page Builder & Widgets' );
    // End Housekeeping --------------------------------------------------------
    
    
    // Priority ----------------------------------------------------------------
    $wp_customize->get_section( 'title_tagline' )->priority = 1;
    $wp_customize->get_panel( 'panel_title_tagline' )->priority = 1;
    $wp_customize->get_panel( 'panel_navbar' )->priority = 2;
    $wp_customize->get_panel( 'panel_custom_header' )->priority = 3;
    $wp_customize->get_panel( 'panel_blog' )->priority = 4;
    $wp_customize->get_panel( 'panel_appearance' )->priority = 5;
    // End Priority ------------------------------------------------------------
    
    // Selective Refresh -------------------------------------------------------
    if ( isset( $wp_customize->selective_refresh ) ) {
        
        $wp_customize->selective_refresh->add_partial( 'blogname', array (
            'selector' => '.site-title a',
            'render_callback' => 'buildr_customize_partial_blogname',
        ) );
        
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array (
            'selector' => '.site-description',
            'render_callback' => 'buildr_customize_partial_blogdescription',
        ) );
        
        $wp_customize->selective_refresh->add_partial( BUILDR_OPTIONS::NAVBAR_SHOW_SOCIAL, array(
            'selector'  => '.navbar-social'
        ) );
        
        $wp_customize->selective_refresh->add_partial( BUILDR_OPTIONS::CUSTOM_HEADER_STYLE_TOGGLE, array(
            'selector'  => '#custom-header-content'
        ) );
        
        $wp_customize->selective_refresh->add_partial( BUILDR_OPTIONS::BLOG_SHOW_DATE, array(
            'selector'  => '.masonry_card_blog .post-date'
        ) );
        
        $wp_customize->selective_refresh->add_partial( BUILDR_OPTIONS::BLOG_CARD_FONT_SIZE_DSK, array(
            'selector'  => '.masonry_card_blog .entry-title'
        ) );
        
        $wp_customize->selective_refresh->add_partial( BUILDR_OPTIONS::BLOG_SHOW_COMMENT_COUNT, array(
            'selector'  => '.masonry_card_blog .meta-stats'
        ) );
        
    }
    // End Selective Refresh ---------------------------------------------------
}

add_action( 'customize_register', 'buildr_customize_register', 99 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function buildr_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function buildr_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function buildr_customize_preview_js() {
    wp_enqueue_style( 'buildr-customizer-preview-style', buildr\get_plugin_url( '/assets/admin/customizer-preview.css' ), BUILDR_VERSION, null );
    wp_enqueue_script( 'buildr-customizer-preview-script', buildr\get_plugin_url( '/assets/admin/customizer-preview.js' ), array ( 'jquery', 'customize-preview' ), BUILDR_VERSION, true );
}
add_action( 'customize_preview_init', 'buildr_customize_preview_js' );


function buildr_customize_controls_js() {
    wp_enqueue_script( 'buildr-customizer-control', buildr\get_plugin_url( '/assets/admin/customizer-control.js' ), array ( 'jquery', 'customize-controls' ), BUILDR_VERSION, true );
    wp_enqueue_style( 'buildr-customizer-style', buildr\get_plugin_url( '/assets/admin/customizer-alt.css' ), BUILDR_VERSION, null );
}
add_action( 'customize_controls_enqueue_scripts', 'buildr_customize_controls_js' );


$acid = acid_instance( buildr\get_plugin_url( '/inc/lib/' ) );

$data = array (
    
    'sections'  => array(
        
        'static_front_page'  => array(
            
            'title'         => __( 'Homepage Settings', 'buildr' ),
            'desciption'    => __( 'You can choose what\'s displayed on the homepage of your site. It can be posts in reverse chronological order (classic blog), or a fixed/static page. To set a static homepage, you first need to create two Pages. One will become the homepage, and the other will be where your posts are displayed.', 'buildr' ),
            'options'       => array(
                
                BUILDR_OPTIONS::HOMEPAGE_SHOW_CONTENT => array (
                    'type'          => 'toggle',
                    'label'         => __( 'Show the Frontpage Content?', 'buildr' ),
                    'description'   => __( 'While this is on, the content of the page set as the static Homepage will be visible', 'buildr' ),
                    'default'       => BUILDR_DEFAULTS::HOMEPAGE_SHOW_CONTENT,
                ),
                
            ),
            
        ),
        
    ),

    'panels' => array (

        // Panel: Site Title & Logo --------------------------------------------
        'panel_title_tagline' => array (

            'title'         => __( 'Site Title & Logo', 'buildr' ),
            'sections'      => array (
                
                // Section : Site Title & Logo: Advanced -----------------------
                'section_title_tagline' => array (

                    'title' => __( 'Advanced Settings', 'buildr' ),
                    'options' => array (
                        
                        BUILDR_OPTIONS::NAVBAR_BRANDING_WHAT_TO_SHOW => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Navbar Branding', 'buildr' ),
                            'description'   => __( 'Set whether the Navbar shows Site Title & Tagline or the custom Logo (if one is set).', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_BRANDING_WHAT_TO_SHOW,
                            'choices'   => array (
                                'title_tagline'     => __( 'Title & Tagline', 'buildr' ),
                                'logo'              => __( 'Logo', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::NAVBAR_ALWAYS_SHOW_LOGO => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Logo - Always Visible?', 'buildr' ),
                            'description'   => __( 'If on, the logo will be visible even when Slim Navbar is collapsed / unstuck', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_ALWAYS_SHOW_LOGO,
                        ),
                        BUILDR_OPTIONS::NAVBAR_LOGO_HORIZONTAL_PADDING => array (
                            'type'          => 'number',
                            'label'         => __( 'Logo - Horizontal Padding', 'buildr' ),
                            'description'   => __( 'Set the space (in pixels) between menu links and the logo', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_LOGO_HORIZONTAL_PADDING
                        ),
                        BUILDR_OPTIONS::NAVBAR_LOGO_HEIGHT_DSK => array (
                            'type'          => 'number',
                            'label'         => __( 'Logo - Height (Desktop)', 'buildr' ),
                            'description'   => __( 'Set the logo height for the desktop Navbar', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_LOGO_HEIGHT_DSK
                        ),
                        BUILDR_OPTIONS::NAVBAR_LOGO_HEIGHT_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Logo - Height (Mobile)', 'buildr' ),
                            'description'   => __( 'Set the logo height for the mobile Navbar', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_LOGO_HEIGHT_MBL
                        ),
                        BUILDR_OPTIONS::NAVBAR_SITE_TITLE_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Site Title - Font Family', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_SITE_TITLE_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'buildr' ),
                                'secondary' => __( 'Use Secondary Font', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::NAVBAR_SITE_TITLE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Site Title - Font Size', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_SITE_TITLE_FONT_SIZE
                        ),
                        BUILDR_OPTIONS::NAVBAR_SITE_TITLE_LETTER_GAP => array(
                            'type'          => 'select',
                            'label'         => __( 'Site Title - Letter Spacing', 'buildr' ),
                            'description'   => __( 'Set the scaling "em" value. Can be positive or negative. 0 for normal spacing.', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_SITE_TITLE_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'buildr' ),
                                '-.075'     => __( '-.075em', 'buildr' ),
                                '-.050'     => __( '-.050em', 'buildr' ),
                                '-.025'     => __( '-.025em', 'buildr' ),
                                '0.0'       => __( '0.00em (Default)', 'buildr' ),
                                '.025'      => __( '.025em', 'buildr' ),
                                '.050'      => __( '.050em', 'buildr' ),
                                '.075'      => __( '.075em', 'buildr' ),
                                '.100'      => __( '.100em', 'buildr' ),
                                '.250'      => __( '.250em', 'buildr' ),
                                '.500'      => __( '.500em (Widest)', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::NAVBAR_SITE_TITLE_ALL_CAPS => array(
                            'type'          => 'toggle',
                            'label'         => __( 'Site Title - All Uppercase?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_SITE_TITLE_ALL_CAPS
                        ),
                        BUILDR_OPTIONS::NAVBAR_HIDE_TAGLINE => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Hide Site Tagline?', 'buildr' ),
                            'description'   => __( 'Both the Title & Tagline show by default when no logo is chosen', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_HIDE_TAGLINE,
                        ),
                        BUILDR_OPTIONS::NAVBAR_TAGLINE_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Site Tagline - Font Family', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_TAGLINE_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'buildr' ),
                                'secondary' => __( 'Use Secondary Font', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::NAVBAR_TAGLINE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Site Tagline - Font Size', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_TAGLINE_FONT_SIZE
                        ),
                        
                    )

                ),
                
            ), // End of Site Identity

        ), // End of Site Identity Panel
            
            
        // Panel: Custom Header ------------------------------------------------
        'panel_custom_header' => array (

            'title'         => __( 'Header', 'buildr' ),
            'desciption'    => __( 'Customize the header banner on your site', 'buildr' ),
            'sections'      => array (

                // Section : Custom Header Settings ----------------------------
                'section_custom_header_general' => array (

                    'title' => __( 'General Settings', 'buildr' ),
                    'options' => array (
                        // Style
                        BUILDR_OPTIONS::CUSTOM_HEADER_STYLE_TOGGLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Header - Parallax Style', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_STYLE_TOGGLE,
                            'choices'   => array (
                                'parallax_vertical'     => __( 'Vertical Scroll', 'buildr' ),
                                'parallax_layers'       => __( 'Perspective Layers', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_HEIGHT_CALC => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Height Calculation', 'buildr' ),
                            'description'   => __( 'This allows you to choose between using % values or fixed pixel values for setting the header height', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_HEIGHT_CALC,
                            'choices'   => array (
                                'percent'   => __( 'Use % of browser height', 'buildr' ),
                                'fixed'     => __( 'Use a fixed pixel value', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_HEIGHT_PCT => array (
                            'type'          => 'number',
                            'label'         => __( 'Height (%)', 'buildr' ),
                            'description'   => __( 'Setting this to 100 will match the Header height to the browser window on both Desktop and Mobile devices.', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_HEIGHT_PCT,
                            'min'           => 25,
                            'max'           => 100,
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_HEIGHT_PCT_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Height for Mobile (%)', 'buildr' ),
                            'description'   => __( 'When viewed on screens less than 992px wide', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_HEIGHT_PCT_MBL,
                            'max'           => 100,
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_HEIGHT_PX => array (
                            'type'          => 'number',
                            'label'         => __( 'Height (px)', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_HEIGHT_PX,
                            'min'           => 250,
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_HEIGHT_PX_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Height for Mobile (px)', 'buildr' ),
                            'description'   => __( 'When viewed on screens less than 992px wide', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_HEIGHT_PX_MBL,
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_PLX_INTENSITY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Parallax Effect - Intensity', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_PLX_INTENSITY,
                            'choices'   => array (
                                'subtle'            => __( 'Subtle', 'buildr' ),
                                'default'           => __( 'Medium (Default)', 'buildr' ),
                                'high'              => __( 'High', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_TEXTURE_IMG => array (
                            'type'          => 'image',
                            'label'         => __( 'Perspective Layers - Transparent Pattern', 'buildr' ),
                            'description'   => __( 'https://www.transparenttextures.com', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_TEXTURE_IMG,
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_TEXTURE_OPAC => array (
                            'type'          => 'decimal',
                            'label'         => __( 'Perspective Layers - Pattern (Opacity)', 'buildr' ),
                            'description'   => __( '0.0 for transparent, up to 1.0 for solid/opaque', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_TEXTURE_OPAC,
                        ),
                        
                    )

                ),
                
                // Section : Custom Header Locations ----------------------------
                'section_custom_header' => array (

                    'title' => __( 'Display Locations', 'buildr' ),
                    'options' => array (
                        
                        BUILDR_OPTIONS::CUSTOM_HEADER_SHOW_ON_POSTS => array (  
                            'type'          => 'toggle',
                            'label'         => __( 'Include on Posts?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_SHOW_ON_POSTS,
                        ),
                        
                        BUILDR_OPTIONS::CUSTOM_HEADER_SHOW_ON_PAGES => array (  
                            'type'          => 'toggle',
                            'label'         => __( 'Include on Pages?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_SHOW_ON_PAGES,
                        ),
                        
                        BUILDR_OPTIONS::CUSTOM_HEADER_SHOW_ON_FRONT => array (  
                            'type'          => 'toggle',
                            'label'         => __( 'Include on the Front Page?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_SHOW_ON_FRONT,
                        ),
                        
                        BUILDR_OPTIONS::CUSTOM_HEADER_SHOW_ON_BLOG => array (   
                            'type'          => 'toggle',
                            'label'         => __( 'Include on the Blog?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_SHOW_ON_BLOG,
                        ),
                        
                        BUILDR_OPTIONS::CUSTOM_HEADER_SHOW_ON_ARCHIVE => array (   
                            'type'          => 'toggle',
                            'label'         => __( 'Include on Archive Pages?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_SHOW_ON_ARCHIVE,
                        ),
                        
                        BUILDR_OPTIONS::CUSTOM_HEADER_SHOW_ON_SHOP => array (   
                            'type'          => 'toggle',
                            'label'         => __( 'Include on the Shop Page?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_SHOW_ON_SHOP,
                        ),
                        
                    )

                ),

                // Section : Custom Header - Logo Settings ---------------------
                'section_custom_header_logo' => array (

                    'title' => __( 'Content', 'buildr' ),
                    'options' => array (

                        // Logo
                        BUILDR_OPTIONS::CUSTOM_HEADER_SHOW_LOGO => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Display the Site Logo?', 'buildr' ),
                            'description'   => __( 'If on, the Custom Logo for the site will be displayed', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_SHOW_LOGO,
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_LOGO_HEIGHT => array (
                            'type'          => 'number',
                            'label'         => __( 'Height of Logo (px)', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_LOGO_HEIGHT,
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_LOGO_HEIGHT_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Height of Logo for Mobile (px)', 'buildr' ),
                            'description'   => __( 'When viewed on screens less than 992px wide', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_LOGO_HEIGHT_MBL,
                        ),
                        
                        // Main Heading
                        BUILDR_OPTIONS::CUSTOM_HEADER_SHOW_TITLE => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Display the Main Heading?', 'buildr' ),
                            'description'   => __( 'If on, the primary content heading will be displayed', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_SHOW_TITLE
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_TITLE_CONTENT => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'What to Display?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_TITLE_CONTENT,
                            'choices'   => array (
                                'site_title'        => __( 'Site Title', 'buildr' ),
                                'site_description'  => __( 'Site Description', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_TITLE_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Font Family', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_TITLE_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'buildr' ),
                                'secondary' => __( 'Use Secondary Font', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_TITLE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Font Size', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_TITLE_FONT_SIZE
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_TITLE_LETTER_GAP => array (
                            'type'          => 'select',
                            'label'         => __( 'Letter Spacing', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_TITLE_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'buildr' ),
                                '-.075'     => __( '-.075em', 'buildr' ),
                                '-.050'     => __( '-.050em', 'buildr' ),
                                '-.025'     => __( '-.025em', 'buildr' ),
                                '0.0'       => __( '0.00em', 'buildr' ),
                                '.025'      => __( '.025em', 'buildr' ),
                                '.050'      => __( '.050em', 'buildr' ),
                                '.075'      => __( '.075em', 'buildr' ),
                                '.100'      => __( '.100em', 'buildr' ),
                                '.250'      => __( '.250em (Default)', 'buildr' ),
                                '.500'      => __( '.500em (Widest)', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_TITLE_ALL_CAPS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'All Uppercase?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_TITLE_ALL_CAPS
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_TITLE_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Text Color', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_TITLE_COLOR
                        ),

                    )

                ),

                // Section : Custom Header - Menu Settings ---------------------
                'section_custom_header_menu' => array (

                    'title' => __( 'Custom Menu', 'buildr' ),
                    'options' => array (

                        // Menu
                        BUILDR_OPTIONS::CUSTOM_HEADER_SHOW_MENU => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Display the Menu?', 'buildr' ),
                            'description'   => __( 'If on, the "Custom Header" menu will be displayed (if one is set)', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_SHOW_MENU
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_MENU_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Font Family', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_MENU_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'buildr' ),
                                'secondary' => __( 'Use Secondary Font', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_MENU_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Font Size', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_MENU_FONT_SIZE
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_MENU_LETTER_GAP => array (
                            'type'          => 'select',
                            'label'         => __( 'Menu - Link Letter Spacing', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_MENU_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'buildr' ),
                                '-.075'     => __( '-.075em', 'buildr' ),
                                '-.050'     => __( '-.050em', 'buildr' ),
                                '-.025'     => __( '-.025em', 'buildr' ),
                                '0.0'       => __( '0.00em', 'buildr' ),
                                '.025'      => __( '.025em', 'buildr' ),
                                '.050'      => __( '.050em', 'buildr' ),
                                '.075'      => __( '.075em', 'buildr' ),
                                '.100'      => __( '.100em', 'buildr' ),
                                '.250'      => __( '.250em', 'buildr' ),
                                '.500'      => __( '.500em (Default/Widest)', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_MENU_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Text Color', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_MENU_COLOR
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_MENU_LINKS_GAP => array (
                            'type'          => 'number',
                            'label'         => __( 'Link Spacing', 'buildr' ),
                            'description'   => __( 'Amount of space in px between each link in the menu', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_MENU_LINKS_GAP
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_MENU_BUTTONS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Style all Custom Header menu items as Buttons?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_MENU_BUTTONS
                        ),
                       
                    )

                ),

                // Section : Custom Header Style - Parallax Layers -------------
                'section_custom_header_plx_vertical' => array (

                    'title' => __( 'Color / Gradient Overlay', 'buildr' ),
                    'options' => array (

                        BUILDR_OPTIONS::CUSTOM_HEADER_COLOR_LAYER_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Include a colored overlay layer?', 'buildr' ),
                            'description'   => __( 'If "Yes", a semi-transparent colored layer will be added between the texture and content layers', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_COLOR_LAYER_STYLE,
                            'choices'   => array (
                                'no'        => __( 'No Color', 'buildr' ),
                                'single'    => __( 'Single Color', 'buildr' ),
                                'gradient'  => __( 'Gradient', 'buildr' ),
                            )
                        ),

                        // Overlay - Single Color
                        BUILDR_OPTIONS::CUSTOM_HEADER_COLOR_LAYER_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Color Overlay - Color', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_COLOR_LAYER_COLOR,
                        ),
                        BUILDR_OPTIONS::CUSTOM_HEADER_COLOR_LAYER_OPACITY => array ( 
                            'type'          => 'decimal',
                            'label'         => __( 'Color Overlay - Color (Opacity)', 'buildr' ),
                            'description'   => __( '0.0 for transparent, up to 1.0 for solid/opaque', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::CUSTOM_HEADER_COLOR_LAYER_OPACITY,
                        ),

                        // Overlay - Gradient
                        BUILDR_OPTIONS::GRADIENT_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Gradient - Style', 'buildr' ),
                            'description'   => __( 'Choose from linear or radial', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::GRADIENT_STYLE,
                            'choices'   => array (
                                'linear'    => __( 'Linear', 'buildr' ),
                                'radial'    => __( 'Radial', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::GRADIENT_OVERALL_OPACITY => array ( 
                            'type'          => 'decimal',
                            'label'         => __( 'Gradient - Layer Opacity', 'buildr' ),
                            'description'   => __( 'This option can be used to set transparency for the entire gradient. Set 0.0 for transparent, up to 1.0 for solid/opaque', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::GRADIENT_OVERALL_OPACITY,
                        ),
                        BUILDR_OPTIONS::GRADIENT_LINEAR_DIRECTION => array (
                            'type'          => 'select',
                            'label'         => __( 'Linear Gradient - Direction', 'buildr' ),
                            'description'   => __( 'Set the linear gradient direction (Start to End)', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::GRADIENT_LINEAR_DIRECTION,
                            'choices'   => array (
                                'up'        => __( 'Up', 'buildr' ),
                                'down'      => __( 'Down', 'buildr' ),
                                'right'     => __( 'Right', 'buildr' ),
                                'left'      => __( 'Left', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::GRADIENT_START_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Gradient Overlay - Start Color', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::GRADIENT_START_COLOR,
                        ),
                        BUILDR_OPTIONS::GRADIENT_START_COLOR_OPACITY => array ( 
                            'type'          => 'decimal',
                            'label'         => __( 'Gradient Overlay - Start Color (Opacity)', 'buildr' ),
                            'description'   => __( '0.0 for transparent, up to 1.0 for solid/opaque', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::GRADIENT_START_COLOR_OPACITY,
                        ),
                        BUILDR_OPTIONS::GRADIENT_END_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Gradient Overlay - End Color', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::GRADIENT_END_COLOR,
                        ),
                        BUILDR_OPTIONS::GRADIENT_END_COLOR_OPACITY => array ( 
                            'type'          => 'decimal',
                            'label'         => __( 'Gradient Overlay - End Color (Opacity)', 'buildr' ),
                            'description'   => __( '0.0 for transparent, up to 1.0 for solid/opaque', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::GRADIENT_END_COLOR_OPACITY,
                        ),
                        
                    )

                ),

            ), // End of Custom Header Sections

        ), // End of Custom Header Panel

        // Panel: Blog ---------------------------------------------------------
        'panel_blog' => array (

            'title'         => __( 'Blog', 'buildr' ),
            'desciption'    => __( 'Customize the blog and archive pages on your site', 'buildr' ),
            'sections'      => array (

                // Section : Blog General Settings ------------------------------
                'section_blog_general' => array (

                    'title' => __( 'General Settings', 'buildr' ),
                    'options' => array (

                        BUILDR_OPTIONS::BLOG_LAYOUT_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Blog Style', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::BLOG_LAYOUT_STYLE,
                            'choices'   => array (
                                'blog_standard' => __( 'Standard', 'buildr' ),
                                'blog_masonry'  => __( 'Masonry - Cards', 'buildr' ),
                                'blog_mosaic'   => __( 'Mosaic - Grid', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::BLOG_SHOW_DATE => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Date Posted?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::BLOG_SHOW_DATE,
                        ),
                        BUILDR_OPTIONS::BLOG_SHOW_AUTHOR => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Author?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::BLOG_SHOW_AUTHOR,
                        ),
                        BUILDR_OPTIONS::BLOG_SHOW_CONTENT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Content / Excerpt?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::BLOG_SHOW_CONTENT,
                        ),
                        BUILDR_OPTIONS::BLOG_SHOW_CATEGORY => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Category Footer?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::BLOG_SHOW_CATEGORY,
                        ),
                        BUILDR_OPTIONS::BLOG_SHOW_COMMENT_COUNT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show the Comment Count in the Meta Stats tab?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::BLOG_SHOW_COMMENT_COUNT,
                        ),
                        BUILDR_OPTIONS::BLOG_EXCERPT_TRIM_NUM => array (
                            'type'          => 'number',
                            'label'         => __( 'Automatic Excerpt - Trim by Number of Words', 'buildr' ),
                            'description'   => __( 'If no manual excerpt exists, a post will show this many words of preview content', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::BLOG_EXCERPT_TRIM_NUM,
                        ),
                        BUILDR_OPTIONS::BLOG_READ_MORE_TEXT => array (
                            'type'          => 'text',
                            'label'         => __( 'Automatic Excerpt - "Read more" Link Text', 'buildr' ),
                            'description'   => __( 'This link only shows on posts with no manual excerpt, as a content preview will be used instead', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::BLOG_READ_MORE_TEXT,
                        ),

                    )

                ),
                
                // Section : Blog Layout Settings ------------------------------
                'section_blog_advanced' => array (

                    'title' => __( 'Advanced Settings', 'buildr' ),
                    'options' => array (
                        
                        BUILDR_OPTIONS::BLOG_LAYOUT_NUM_COLS => array (
                            'type'          => 'select',
                            'label'         => __( 'Layout - Number of Columns', 'buildr' ),
                            'description'   => __( 'Mobile devices will automatically show fewer columns to maximize space.', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::BLOG_LAYOUT_NUM_COLS,
                            'choices'   => array (
                                '1col'      => __( 'Single Column', 'buildr' ),
                                '2col'      => __( 'Two Columns', 'buildr' ),
                                '3col'      => __( 'Three Columns', 'buildr' ),
                                '4col'      => __( 'Four Columns', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::BLOG_CARD_APPEARANCE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Blog Card Appearance', 'buildr' ),
                            'description'   => __( 'Select whether the Standard style blog cards should appear flat, or as raised cards with a shadow.', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::BLOG_CARD_APPEARANCE,
                            'choices'   => array (
                                'flat'      => __( 'Flat', 'buildr' ),
                                'raised'    => __( 'Raised', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::BLOG_CARD_BORDER_RADIUS => array (
                            'type'          => 'number',
                            'label'         => __( 'Round Corners on Posts in the Blog?', 'buildr' ),
                            'description'   => __( 'Set this to 0 for sharp corners, or set the rounding value in pixels.', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::BLOG_CARD_BORDER_RADIUS,
                        ),
                        BUILDR_OPTIONS::BLOG_CARD_MOSAIC_GAP => array (
                            'type'          => 'number',
                            'label'         => __( 'Space around each Mosaic tile?', 'buildr' ),
                            'description'   => __( 'This is the uncombined padding around each tile. For example, setting this to 5px per tile will equal a 10px wide gutter. Set to 0 for gapless tiles.', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::BLOG_CARD_MOSAIC_GAP,
                        ),
                        BUILDR_OPTIONS::BLOG_CARD_FONT_SIZE_DSK => array (
                            'type'          => 'number',
                            'label'         => __( 'Post Title - Font Size (Desktop)', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::BLOG_CARD_FONT_SIZE_DSK,
                        ),
                        BUILDR_OPTIONS::BLOG_CARD_FONT_SIZE_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Post Title - Font Size (Mobile)', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::BLOG_CARD_FONT_SIZE_MBL,
                        ),
                        BUILDR_OPTIONS::BLOG_META_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Post Date & Author - Font Size', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::BLOG_META_FONT_SIZE,
                        ),

                    )

                ),

            ), // End of Blog Sections

        ), // End of Blog Panel

        // Panel: Navbar -------------------------------------------------------
        null => array (

            'sections'       => array (

                'section_nav_social_links' => array (

                    'title' => __( 'Social Links', 'buildr' ),
                    'options' => array (
                        
                        BUILDR_OPTIONS::SOCIAL_URL_1 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #1 - URL', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::SOCIAL_URL_1
                        ),
                        BUILDR_OPTIONS::SOCIAL_ICON_1 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #1 - Icon', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::SOCIAL_ICON_1,
                            'choices'       => buildr_get_icons( 'social' )
                        ),
                        BUILDR_OPTIONS::SOCIAL_URL_2 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #2 - URL', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::SOCIAL_URL_2
                        ),
                        BUILDR_OPTIONS::SOCIAL_ICON_2 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #2 - Icon', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::SOCIAL_ICON_2,
                            'choices'       => buildr_get_icons( 'social' )
                        ),
                        BUILDR_OPTIONS::SOCIAL_URL_3 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #3 - URL', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::SOCIAL_URL_3
                        ),
                        BUILDR_OPTIONS::SOCIAL_ICON_3 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #3 - Icon', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::SOCIAL_ICON_3,
                            'choices'       => buildr_get_icons( 'social' )
                        ),
                        BUILDR_OPTIONS::SOCIAL_URL_4 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #4 - URL', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::SOCIAL_URL_4
                        ),
                        BUILDR_OPTIONS::SOCIAL_ICON_4 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #4 - Icon', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::SOCIAL_ICON_4,
                            'choices'       => buildr_get_icons( 'social' )
                        ),
                        BUILDR_OPTIONS::SOCIAL_URL_5 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #5 - URL', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::SOCIAL_URL_5
                        ),
                        BUILDR_OPTIONS::SOCIAL_ICON_5 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #5 - Icon', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::SOCIAL_ICON_5,
                            'choices'       => buildr_get_icons( 'social' )
                        ),

                    )

                ),
                
            ), // End of Social Section
            
        ), // End of Social Panel

        // Panel: Navbar -------------------------------------------------------
        'panel_navbar' => array (

            'title'         => __( 'Navbar', 'buildr' ),
            'desciption'    => __( 'Customize the primary navbar on your site, including control over appearance & behaviour', 'buildr' ),
            'sections'      => array (

                // Section : Navbar General Settings ---------------------------
                'section_nav_general' => array (

                    'title' => __( 'General Settings', 'buildr' ),
                    'options' => array (

                        BUILDR_OPTIONS::NAVBAR_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Navbar Style', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_STYLE,
                            'choices'   => array (
                                'slim_split'    => __( 'Slim - Centered & Split', 'buildr' ),
                                'slim_left'     => __( 'Slim - Left Aligned', 'buildr' ),
                                'banner'        => __( 'Banner', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::NAVBAR_LINKS_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Navbar Links - Font Family', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_LINKS_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'buildr' ),
                                'secondary' => __( 'Use Secondary Font', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::NAVBAR_LINKS_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Navbar Links - Font Size', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_LINKS_FONT_SIZE
                        ),
                        BUILDR_OPTIONS::NAVBAR_LINKS_GAP => array (
                            'type'          => 'number',
                            'label'         => __( 'Navbar Links - Gap Between Links', 'buildr' ),
                            'label'         => __( 'Set the pixel value for the amount of space between links', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_LINKS_GAP
                        ),
                        BUILDR_OPTIONS::NAVBAR_HAS_SHADOW => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Add a box shadow to the Navbar?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_HAS_SHADOW,
                        ),
                        BUILDR_OPTIONS::NAVBAR_SHOW_SOCIAL => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Social Links in Navbar?', 'buildr' ),
                            'description'   => __( 'If on, social links will display in the Navbar. Navbar styles display these in different ways', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_SHOW_SOCIAL,
                        ),
                        
                    )

                ),

                // Section : Slim Style Settings ---------------------------
                'section_nav_style_a' => array (

                    'title' => __( 'Advanced Settings', 'buildr' ),
                    'options' => array (
                        
                        BUILDR_OPTIONS::NAVBAR_INITIAL_HEIGHT => array (
                            'type'          => 'number',
                            'label'         => __( 'Navbar - Height (Initial)', 'buildr' ),
                            'description'   => __( 'When the Slim Navbar is at the very top of the page (unstuck)', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_INITIAL_HEIGHT
                        ),
                        BUILDR_OPTIONS::NAVBAR_STICKY_HEIGHT => array (
                            'type'          => 'number',
                            'label'         => __( 'Navbar - Height (Sticky)', 'buildr' ),
                            'description'   => __( 'When the Slim Navbar is sticky, after the user scrolls down the page', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_STICKY_HEIGHT
                        ),
                        BUILDR_OPTIONS::NAVBAR_RIGHT_ALIGN_MENU => array ( 
                            'type'          => 'toggle',
                            'label'         => __( 'Right Aligned Menu?', 'buildr' ),
                            'description'   => __( 'If on, the menu will be right-aligned. For the "Slim - Left Aligned" style of Navbar, the menu will replace the Social Links section', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_RIGHT_ALIGN_MENU,
                        ),
                        BUILDR_OPTIONS::NAVBAR_BOXED_CONTENT => array ( 
                            'type'          => 'toggle',
                            'label'         => __( 'Box the Content?', 'buildr' ),
                            'description'   => __( 'If on, the Navbar content will be lined up with the main content of the page instead of the left & right bounds of the window', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_BOXED_CONTENT,
                        ),
                        BUILDR_OPTIONS::NAVBAR_TRANSPARENT_MENU_BG => array ( 
                            'type'          => 'toggle',
                            'label'         => __( 'Transparent Menu?', 'buildr' ),
                            'description'   => __( 'If on, the menu will be transparent, allowing the Navbar background (color or image) to show through', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_TRANSPARENT_MENU_BG,
                        ),
                        BUILDR_OPTIONS::NAVBAR_BRANDING_ALIGNMENT => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Branding - Alignment', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_BRANDING_ALIGNMENT,
                            'choices'   => array (
                                'left'      => __( 'Left', 'buildr' ),
                                'center'    => __( 'Centered', 'buildr' ),
                                'right'     => __( 'Right', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::NAVBAR_MENU_ALIGNMENT => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Menu - Alignment', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_MENU_ALIGNMENT,
                            'choices'   => array (
                                'left'      => __( 'Left', 'buildr' ),
                                'center'    => __( 'Centered', 'buildr' ),
                                'right'     => __( 'Right', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::NAVBAR_BRANDING_SPACE_TOP_DSK => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Space Above', 'buildr' ),
                            'description'   => __( 'Set the amount of space (in pixels) above the branding (for the Banner style of Navbar)', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_BRANDING_SPACE_TOP_DSK
                        ),
                        BUILDR_OPTIONS::NAVBAR_BRANDING_SPACE_BOTTOM_DSK => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Space Below', 'buildr' ),
                            'description'   => __( 'Set the amount of space (in pixels) below the branding (for the Banner style of Navbar)', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_BRANDING_SPACE_BOTTOM_DSK
                        ),
                        BUILDR_OPTIONS::NAVBAR_BRANDING_SPACE_TOP_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Space Above (Mobile)', 'buildr' ),
                            'description'   => __( 'Set the amount of space (in pixels) above the branding on mobile devices (for the Banner style of Navbar)', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_BRANDING_SPACE_TOP_MBL
                        ),
                        BUILDR_OPTIONS::NAVBAR_BRANDING_SPACE_BOTTOM_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Space Below (Mobile)', 'buildr' ),
                            'description'   => __( 'Set the amount of space (in pixels) below the branding on mobile devices (for the Banner style of Navbar)', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_BRANDING_SPACE_BOTTOM_MBL
                        ),
                        BUILDR_OPTIONS::NAVBAR_FINAL_LINK_ACCENT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Style final Navbar link as a CTA?', 'buildr' ),
                            'description'   => __( 'When toggled on, the last (right-most) link in the Navbar will appear as a unique button callout', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_FINAL_LINK_ACCENT
                        ),
                        BUILDR_OPTIONS::NAVBAR_FINAL_LINK_ROUNDED => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Rounded button?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_FINAL_LINK_ROUNDED
                        ),
                        BUILDR_OPTIONS::NAVBAR_FINAL_LINK_FILL => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Color fill?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_FINAL_LINK_FILL
                        ),

                    )

                ),

                // Section : Navbar Colors -------------------------------------
                'section_nav_colors' => array (

                    'title' => __( 'Colors', 'buildr' ),
                    'options' => array (
                        
                        BUILDR_OPTIONS::NAVBAR_BG_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Background Style', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_BG_STYLE,
                            'choices'   => array (
                                'color'     => __( 'Color', 'buildr' ),
                                'image'     => __( 'Background Image', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::NAVBAR_BG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Background Color', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_BG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'buildr' ),
                                '#ffffff'    => __( 'Light', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::NAVBAR_FG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Foreground Color', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_FG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'buildr' ),
                                '#ffffff'    => __( 'Light', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::NAVBAR_MENU_BG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Menu - Background Color', 'buildr' ),
                            'description'   => __( 'If the menu is not set to transparent (in Advanced Settings), you can set the background color for the menu bar', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_MENU_BG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'buildr' ),
                                '#ffffff'    => __( 'Light', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::NAVBAR_MENU_FG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Menu - Foreground Color', 'buildr' ),
                            'description'   => __( 'If the menu is not set to transparent (in Advanced Settings), you can set the foreground color for the menu bar', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_MENU_FG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'buildr' ),
                                '#ffffff'    => __( 'Light', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::NAVBAR_BG_IMAGE => array (
                            'type'          => 'image',
                            'label'         => __( 'Background Image', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_BG_IMAGE,
                        ),
                        BUILDR_OPTIONS::NAVBAR_SOCIAL_BG_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Social Links - Drawer Background', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_SOCIAL_BG_COLOR,
                        ),
                        BUILDR_OPTIONS::NAVBAR_SOCIAL_FG_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Social Links - Icons', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_SOCIAL_FG_COLOR,
                        ),
                        BUILDR_OPTIONS::NAVBAR_SOCIAL_FG_COLOR_HOVER => array (
                            'type'          => 'color',
                            'label'         => __( 'Social Links - Icons (Hover)', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::NAVBAR_SOCIAL_FG_COLOR_HOVER,
                        ),

                    )

                ),

            ), // End of Navbar Sections

        ), // End of Navbar Panel

        // Panel: Appearance ---------------------------------------------------
        'panel_appearance' => array (

            'title'         => __( 'Appearance', 'buildr' ),
            'description'   => __( 'Customize your site colors, fonts, and more', 'buildr' ),
            'sections'      => array (

                // Section : Colors --------------------------------------------
                'section_colors' => array (

                    'title'         => __( 'Skin Colors', 'buildr' ),
                    'description'   => __( 'Customize the color theme in use on your site', 'buildr' ),
                    'options' => array (
                        
                        BUILDR_OPTIONS::COLOR_SKIN_PRIMARY => array(
                            'type'          => 'color-select',
                            'label'         => __( 'Skin Color - Primary', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::COLOR_SKIN_PRIMARY,
                            'choices'   => array(
                                '#f04265'       => __( 'Cherry Gloss', 'buildr' ),
                                '#13ecb6'       => __( 'Seafoam Coast', 'buildr' ),
                                '#7f66ff'       => __( 'Royal Lilac', 'buildr' ),
                                '#00d4ff'       => __( 'Sky Blue', 'buildr' ),
                            ),
                        ),
                        BUILDR_OPTIONS::COLOR_SKIN_SECONDARY => array(
                            'type'          => 'color-select',
                            'label'         => __( 'Skin Color - Secondary', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::COLOR_SKIN_SECONDARY,
                            'choices'   => array(
                                '#d60059'       => __( 'Magenta Rose', 'buildr' ),
                                '#04aeae'       => __( 'Tide Pool', 'buildr' ),
                                '#6e3399'       => __( 'Wildberry', 'buildr' ),
                                '#0b84da'       => __( 'Ocean Swell', 'buildr' ),
                            ),
                        ),

                    ),

                ),

                // Section : Fonts ---------------------------------------------
                'fonts' => array (

                    'title'         => __( 'Fonts', 'buildr' ),
                    'description'   => __( 'Customize the fonts in use on your site. Visit <a target="_BLANK" href="https://fonts.google.com/"> Google Fonts to see font options.</a> Please be advised some fonts on this link may not be present in the theme, as Google Fonts are constantly updated. We periodically update the font list here from Google Fonts.', 'buildr' ),
                    'options' => array (
                        
                        // Primary Font
                        BUILDR_OPTIONS::FONT_PRIMARY => array(
                            'type'      => 'select',
                            'label'     => __( 'Primary Font - For Headings & Titles', 'buildr' ),
                            'default'   => BUILDR_DEFAULTS::FONT_PRIMARY,
                            'choices'   => buildr_fonts(),
                        ),
                        BUILDR_OPTIONS::FONT_HEADINGS_LETTER_GAP => array(
                            'type'          => 'select',
                            'label'         => __( 'Letter Spacing for Headings & Titles', 'buildr' ),
                            'description'   => __( 'Set to 0 for normal spacing, negative for smaller gap between letters, positive for increased separation.', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::FONT_HEADINGS_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'buildr' ),
                                '-.075'     => __( '-.075em', 'buildr' ),
                                '-.050'     => __( '-.050em', 'buildr' ),
                                '-.025'     => __( '-.025em', 'buildr' ),
                                '0.0'         => __( '0.00em (Default)', 'buildr' ),
                                '.025'      => __( '.025em', 'buildr' ),
                                '.050'      => __( '.050em', 'buildr' ),
                                '.075'      => __( '.075em', 'buildr' ),
                                '.100'      => __( '.100em (Widest)', 'buildr' ),
                            )
                        ),

                        // Secondary Font
                        BUILDR_OPTIONS::FONT_SECONDARY => array(
                            'type'      => 'select',
                            'label'     => __( 'Secondary Font - For Content', 'buildr' ),
                            'default'   => BUILDR_DEFAULTS::FONT_SECONDARY,
                            'choices'   => buildr_fonts(),
                        ),
                        BUILDR_OPTIONS::FONT_BODY_SIZE => array(
                            'type'      => 'number',
                            'label'     => __( 'Secondary Font - Text Size (px)', 'buildr' ),
                            'default'   => BUILDR_DEFAULTS::FONT_BODY_SIZE,
                        ),

                    ),

                ),
                
                // Section : Smooth Scrolling ----------------------------------
                'section_scroll' => array (

                    'title'         => __( 'Smooth Scrolling', 'buildr' ),
                    'description'   => __( 'Customize whether the Smooth Scrolling feature is enabled on your site', 'buildr' ),
                    'options' => array (
                        
                        BUILDR_OPTIONS::EASE_SCROLL_TOGGLE => array(
                            'type'          => 'toggle',
                            'label'         => __( 'Enable Smooth Scrolling?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::EASE_SCROLL_TOGGLE,
                        ),

                    ),

                ),

            ), // End of Appearance Sections

        ), // End of Appearance Panel

        // Panel: Footer -------------------------------------------------------
        'panel_footer' => array (

            'title'         => __( 'Footer', 'buildr' ),
            'desciption'    => __( 'Customize the theme footer', 'buildr' ),
            'sections'      => array (

                // Section : Pre-Footer Widget Area Settings  ------------------
                'section_pre_footer' => array (

                    'title'     => __( 'Pre-Footer Sidebar', 'buildr' ),
                    'options'   => array (
                        
                        BUILDR_OPTIONS::FOOTER_NUM_WIDGET_COLS => array (
                            'type'          => 'range',
                            'label'         => __( 'Number of Widget Columns' , 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::FOOTER_NUM_WIDGET_COLS,
                            'min'           => 1,
                            'max'           => 4,
                            'step'          => 1
                        ),
                        BUILDR_OPTIONS::WIDGETS_TITLE_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Widget Titles - Font Family', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::WIDGETS_TITLE_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'buildr' ),
                                'secondary' => __( 'Use Secondary Font', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::WIDGETS_TITLE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Widget Titles - Font Size', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::WIDGETS_TITLE_FONT_SIZE,
                        ),
                        BUILDR_OPTIONS::WIDGETS_TITLE_FONT_LETTER_GAP => array (
                            'type'          => 'select',
                            'label'         => __( 'Widget Titles - Letter Spacing', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::WIDGETS_TITLE_FONT_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'buildr' ),
                                '-.075'     => __( '-.075em', 'buildr' ),
                                '-.050'     => __( '-.050em', 'buildr' ),
                                '-.025'     => __( '-.025em', 'buildr' ),
                                '0.0'       => __( '0.00em', 'buildr' ),
                                '.025'      => __( '.025em', 'buildr' ),
                                '.050'      => __( '.050em', 'buildr' ),
                                '.075'      => __( '.075em', 'buildr' ),
                                '.100'      => __( '.100em', 'buildr' ),
                                '.250'      => __( '.250em (Default)', 'buildr' ),
                                '.500'      => __( '.500em (Widest)', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::WIDGETS_TITLE_ALL_CAPS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Widget Titles - All Uppercase?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::WIDGETS_TITLE_ALL_CAPS,
                        ),
                        BUILDR_OPTIONS::FOOTER_BORDER_TOP_THICKNESS => array (
                            'type'          => 'number',
                            'label'         => __( 'Colored Top Border - Thickness', 'buildr' ),
                            'description'   => __( 'If set to a value greater than 0, the Prefooter will include a primary color top border of this many pixels', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::FOOTER_BORDER_TOP_THICKNESS,
                        ),
                        
                    )
                    
                ),
                        
                // Section : Footer General Settings  --------------------------
                'section_footer_general' => array (

                    'title'     => __( 'General Settings', 'buildr' ),
                    'options'   => array (

                        BUILDR_OPTIONS::FOOTER_BOXED_CONTENT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Boxed Content?', 'buildr' ),
                            'description'   => __( 'If on, the Footer will be lined up with the main content instead of the left & right bounds of the window', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::FOOTER_BOXED_CONTENT,
                        ),
                        BUILDR_OPTIONS::FOOTER_CENTER_BRANDING => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Centered?', 'buildr' ),
                            'description'   => __( 'If on, the Footer content will be centered', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::FOOTER_CENTER_BRANDING,
                        ),
                        BUILDR_OPTIONS::FOOTER_SHOW_SOCIAL => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Show Social?', 'buildr' ),
                            'description'   => __( 'If on, the Footer will include the social icon links you have set', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::FOOTER_SHOW_SOCIAL,
                        ),
                        BUILDR_OPTIONS::FOOTER_SHOW_BRANDING => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Show Branding?', 'buildr' ),
                            'description'   => __( 'If on,  the Footer will include either an alternate custom logo or your site title', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::FOOTER_SHOW_BRANDING,
                        ),
                        BUILDR_OPTIONS::FOOTER_SHOW_COPYRIGHT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Show Copyright?', 'buildr' ),
                            'description'   => __( 'If on, the Footer will include the copyright tagline you set', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::FOOTER_SHOW_COPYRIGHT,
                        ),
                        BUILDR_OPTIONS::FOOTER_COPYRIGHT_TAGLINE => array (
                            'type'          => 'text',
                            'label'         => __( 'Copyright - Tagline Text', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::FOOTER_COPYRIGHT_TAGLINE,
                        ),
                        BUILDR_OPTIONS::FOOTER_BRANDING_TYPE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Branding - What to Display?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::FOOTER_BRANDING_TYPE,
                            'choices'   => array (
                                'site_title'    => __( 'Show Site Title', 'buildr' ),
                                'alt_logo'      => __( 'Show Logo', 'buildr' ),
                            )
                        ),
                        BUILDR_OPTIONS::FOOTER_ALTERNATE_LOGO => array (
                            'type'          => 'image',
                            'label'         => __( 'Branding - Logo', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::FOOTER_ALTERNATE_LOGO,
                        ),
                        BUILDR_OPTIONS::FOOTER_ALTERNATE_LOGO_HEIGHT => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Logo Height', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::FOOTER_ALTERNATE_LOGO_HEIGHT,
                        ),
                        BUILDR_OPTIONS::FOOTER_SITE_TITLE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Font Size', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::FOOTER_SITE_TITLE_FONT_SIZE
                        ),
                        BUILDR_OPTIONS::FOOTER_SITE_TITLE_ALL_CAPS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Branding - All Uppercase?', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::FOOTER_SITE_TITLE_ALL_CAPS
                        ),
                        BUILDR_OPTIONS::FOOTER_COPYRIGHT_TAGLINE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Copyright - Font Size', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::FOOTER_COPYRIGHT_TAGLINE_FONT_SIZE
                        ),

                    )

                ),

                // Section : Footer Colors -------------------------------------
                'section_footer_colors' => array (

                    'title'     => __( 'Colors', 'buildr' ),
                    'options'   => array (
                        
                        // Pre-Footer Background
                        BUILDR_OPTIONS::PRE_FOOTER_BG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Prefooter: Background Color', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::PRE_FOOTER_BG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'buildr' ),
                                '#ffffff'    => __( 'Light', 'buildr' ),
                            )
                        ),

                        // Pre-Footer Foreground
                        BUILDR_OPTIONS::PRE_FOOTER_FG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Prefooter: Foreground Color', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::PRE_FOOTER_FG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'buildr' ),
                                '#ffffff'    => __( 'Light', 'buildr' ),
                            )
                        ),
                        
                        // Pre-Footer Widget Titles
                        BUILDR_OPTIONS::PRE_FOOTER_WIDGET_TITLE_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Prefooter: Widgets Title Color', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::PRE_FOOTER_WIDGET_TITLE_COLOR,
                        ),
                        
                        // Footer Background
                        BUILDR_OPTIONS::FOOTER_BG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Footer: Background Color', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::FOOTER_BG_COLOR,
                            'choices'   => array (
                                '#000000'    => __( 'Dark', 'buildr' ),
                                '#ffffff'    => __( 'Light', 'buildr' ),
                            )
                        ),

                        // Footer Foreground
                        BUILDR_OPTIONS::FOOTER_FG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Footer: Foreground Color', 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::FOOTER_FG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'buildr' ),
                                '#ffffff'    => __( 'Light', 'buildr' ),
                            )
                        ),

                    )

                ),

            ), // End of Footer Sections

        ), // End of Footer Panel

        // Panel: WooCommerce --------------------------------------------------
        'woocommerce' => array (

            'title'         => __( 'WooCommerce', 'buildr' ),
            'sections'      => array (

                // Section : WooCommerce Advanced  -----------------------------
                'section_woocommerce_featured' => array (

                    'title'     => __( 'Featured Products', 'buildr' ),
                    'options'   => array (
                        
                        BUILDR_OPTIONS::WOO_SHOW_FEATURED_PRODUCTS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Featured Products at the top of the Shop page?' , 'buildr' ),
                            'description'   => __( 'To feature a product, click the corresponding star icon on the Products page.' , 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::WOO_SHOW_FEATURED_PRODUCTS,
                        ),
                        BUILDR_OPTIONS::WOO_SHOW_FEATURED_PRODUCT_HEADING => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show "Featured" Header Banner?' , 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::WOO_SHOW_FEATURED_PRODUCT_HEADING,
                        ),
                        BUILDR_OPTIONS::WOO_FEATURED_PRODUCTS_NUM_COLS => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Featured Products Per Row' , 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::WOO_FEATURED_PRODUCTS_NUM_COLS,
                            'choices'       => array (
                                'two'   => __( 'Two', 'buildr' ),
                                'three' => __( 'Three', 'buildr' ),
                            )
                        ),
                        
                    )
                    
                ),
                
                // Section : WooCommerce Advanced  -----------------------------
                'section_woocommerce_slide_cart' => array (

                    'title'     => __( 'Slide-In Cart', 'buildr' ),
                    'options'   => array (
                        
                        BUILDR_OPTIONS::WOO_SLIDE_CART_TOGGLE => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Include the Slide-In Cart Drawer?' , 'buildr' ),
                            'description'   => __( 'If this is on, users can click a tab on the right side of the page to open a drawer displaying the items currently added to their cart.' , 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::WOO_SLIDE_CART_TOGGLE,
                        ),
                        BUILDR_OPTIONS::WOO_SLIDE_CART_TAB_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Tab: Color' , 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::WOO_SLIDE_CART_TAB_COLOR,
                        ),
                        BUILDR_OPTIONS::WOO_SLIDE_CART_TAB_ICON => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Tab: Icon' , 'buildr' ),
                            'default'       => BUILDR_DEFAULTS::WOO_SLIDE_CART_TAB_ICON,
                            'choices'       => array (
                                'fa-shopping-cart'      =>  __( 'Cart', 'buildr' ),
                                'fa-shopping-bag'       =>  __( 'Bag', 'buildr' ),
                                'fa-shopping-basket'    =>  __( 'Basket', 'buildr' ),
                            )
                        ),
                        
                    )
                    
                ),
                
            ), // End of Footer Sections

        ), // End of WooCommerce Panel
       
    ), // End of Panels

);

$acid->config( $data );
