<?php
/*
Plugin Name: Manage TinyMCE Editor
Description: Add buttons to TinyMCE, WordPress' default visual editor.
Version: 1.0.0
Author: Daniele De Santis
Author URI: http://www.danieledesantis.net
Text Domain: manage-tinymce-editor
Domain Path: /languages/
License: GPL2

/*
Copyright 2017  Daniele De Santis  (email : hello@danieledesantis.net)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

// set plugin instance
$wpmte = new Wpmte();

/**
 * Manage Tinymce Editor class.
 *
 * @class Wpmte
 * @version	1.0.0
 */
class Wpmte {

	/**
	 * @var $defaults
	 */
	private $defaults = array(
		'toolbar' => array(
			'cut'				=> 0,
			'copy'				=> 0,
			'paste'				=> 0,
			'code'				=> 0,
			'fontselect'		=> 0,
			'fontsizeselect'	=> 0,
			'styleselect'		=> 0,
			'styleselect'		=> 0,
			'backcolor'			=> 0,
			'newdocument'		=> 0,
			'superscript'		=> 0,
			'subscript'			=> 0
		)
	);

	/**
	 * Constructor.
	 */
	public function __construct() {
		register_activation_hook( __FILE__, array( $this, 'activate' ) );

		// settings
		$this->settings = array(
			'toolbar' => array(
				'cut',
				'copy',
				'paste',
				'code',
				'fontselect',
				'fontsizeselect',
				'styleselect',
				'backcolor',
				'newdocument',
				'superscript',
				'subscript'
			),
			'labels' => array(
				'cut'                => __( 'Cut', 'manage-tinymce-editor' ),
				'copy'               => __( 'Copy', 'manage-tinymce-editor' ),
				'paste'              => __( 'Paste', 'manage-tinymce-editor' ),
				'code'               => __( 'Source code', 'manage-tinymce-editor' ),
				'fontselect'         => __( 'Font family selector', 'manage-tinymce-editor' ),
				'fontsizeselect'     => __( 'Font size selector', 'manage-tinymce-editor' ),
				'styleselect'        => __( 'Style selector', 'manage-tinymce-editor' ),
				'backcolor'          => __( 'Background color', 'manage-tinymce-editor' ),
				'newdocument'        => __( 'Empty document', 'manage-tinymce-editor' ),
				'superscript'        => __( 'Superscript', 'manage-tinymce-editor' ),
				'subscript'          => __( 'Subscript', 'manage-tinymce-editor' )
			),
			'dashicons' => array(
				'cut'                => 'dashicons-editor-te dashicons-editor-cut',
				'copy'               => 'dashicons-editor-te dashicons-editor-copy',
				'paste'              => 'dashicons-editor-te dashicons-editor-paste',
				'code'               => 'dashicons-editor-code',
				'fontselect'         => '',
				'fontsizeselect'     => '',
				'styleselect'        => '',
				'backcolor'          => 'dashicons-editor-textcolor dashicons-editor-backcolor',
				'newdocument'        => 'dashicons-editor-te dashicons-editor-empty',
				'superscript'        => 'dashicons-editor-te dashicons-editor-sup',
				'subscript'          => 'dashicons-editor-te dashicons-editor-sub',
			)
		);

		// actions
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu_options' ) );
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_load_styles' ) );

		// filters
		add_filter( 'mce_buttons', array( $this, 'wpmte_customize_TinyMCE' ) );
		add_filter( 'plugin_action_links', array( $this, 'plugin_settings_link' ), 10, 2 );
	}

	/**
	 * Load textdomain.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'manage-tinymce-editor', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Add submenu.
	 */
	public function admin_menu_options() {
		add_options_page(
			__( 'Manage TinyMCE Editor', 'manage-tinymce-editor' ), __( 'Manage TinyMCE Editor', 'manage-tinymce-editor' ), 'manage_options', 'manage-tinymce-editor', array( $this, 'options_page' )
		);
	}

	/**
	 * Customize editor
	 */
	public function wpmte_customize_TinyMCE( $buttons ) {

		$option_values = get_option('wpmte_options');

		if ( $option_values ) {

			foreach ( $option_values as $option => $value ) {
				if ( $value ) {
					$buttons[] = $option;
				}
			}

		}

		return $buttons;
	}

	/**
	 * Options page output.
	 */
	public function options_page() {
		echo '
		<div class="wrap">
			<h2>' . __( 'Manage TinyMCE Editor', 'manage-tinymce-editor' ) . '</h2>
			<h3>' . __( 'Add buttons to TinyMCE editor.', 'manage-tinymce-editor' ) . ' </h3>
			<p>' . __( 'Select the buttons you want to add to WordPress TinyMCE editor.', 'manage-tinymce-editor' ) . ' </p>
			<form action="options.php" method="post">';

			settings_fields( 'wpmte_options' );
			do_settings_sections( 'wpmte_options' );
			submit_button( 'Update options', 'primary', 'wpmte_save_options', true );

		echo '
			</form>
			<div class="clear"></div>
			<div class="wpmte_extra_info">
				<h4>Manage TinyMCE editor is a plugin by Daniele De Santis</h4>
				<p><a href="http://www.danieledesantis.net" target="_blank">www.danieledesantis.net</a></p>
			</div>
		</div>';
	}

	/**
	 * Register plugin settings.
	 */
	public function register_settings() {
		register_setting( 'wpmte_options', 'wpmte_options' );

		$option_values = get_option('wpmte_options');

		$section_name = 'wpmte_toolbar';
		add_settings_section( $section_name, __( 'Available buttons', 'manage-tinymce-editor' ), '', 'wpmte_options' );

		foreach ( $this->settings['toolbar'] as $value ) {
			if ( is_array($option_values) && array_key_exists($value, $option_values) ) {
				$curr_value = $option_values[$value];
			} else {
				$curr_value = 0;
			}
			$title = ($this->settings['dashicons'][$value] == '') ? '' : '<span class="wpmte_btn_icon"><i class="dashicons-before ' . $this->settings['dashicons'][$value] . '"></i></span>';
			$label = $this->settings['labels'][$value];
			add_settings_field( $value, $title . '<span class="wpmte_btn_label">' . $label . '</span>', array( $this, 'wpmte_create_checkbox' ), 'wpmte_options', $section_name, array( 'value' => $value, 'curr_value' => $curr_value ) );
		}

	}

	public function wpmte_create_checkbox( $args ) {
		echo '
		<input type="checkbox" name="wpmte_options['. $args['value'] . ']" value="1" ' . checked( true, $args['curr_value'], false) . '/>';
	}

	/**
	 * Add links to settings page.
	 */
	public function plugin_settings_link( $links, $file ) {
		if ( current_user_can( 'manage_options' ) ) {

			$plugin = plugin_basename( __FILE__ );

			if ( $file == $plugin )
				array_unshift( $links, sprintf( '<a href="%s">%s</a>', admin_url( 'options-general.php?page=manage-tinymce-editor' ), __( 'Settings', 'manage-tinymce-editor' ) ) );
		}

		return $links;
	}

	/**
	 * Activate the plugin.
	 */
	public function activate() {
		add_option( 'wpmte_options', $this->defaults );
	}

	/**
	 * Load scripts and styles - admin.
	 */
	public function admin_load_styles( $page ) {
		if ( $page === 'settings_page_manage-tinymce-editor' ) {
			wp_enqueue_style( 'manage-tinymce-editor-admin', plugins_url( 'css/admin.css', __FILE__ ) );
		}
	}

}
