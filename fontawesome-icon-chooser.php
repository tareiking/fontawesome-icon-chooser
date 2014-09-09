<?php
/**
 * Plugin Name: FontAwesome Icon Chooser for WP Visual Editor
 * Plugin URI: http://www.sennza.com.au/
 * Description: Enable FontAwesome Icons from any WP Visual Editor, including widgets and the content editor.
 * Version: 0.1
 * Author: Sennza Pty Ltd, Bronson Quick, Ryan McCue, Lachlan MacPherson, Tarei King
 * Author URI: http://www.sennza.com.au/
 * GitHub Plugin URI: https://github.com/sennza/fontawesome-icon-chooser
 */

// Exit if this file is directly accessed
if ( !defined( 'ABSPATH' ) ) exit;

class Tinymce_Fontawesome {

	private static $instance;

	static function get_instance() {

		if ( ! self::$instance ) {
			self::$instance = new Tinymce_Fontawesome;
		}

		return self::$instance;
	}

	public function __construct() {

		add_filter( 'mce_external_plugins', array( $this, 'load_tinymce_fontawesome' ) );

		add_action( 'wp_enqueue_style', array( $this, 'enqueue_scripts' ), 11 );
		add_action( 'admin_enqueue_scripts', array ($this, 'enqueue_admin_scripts' ), 11 );

		add_filter( 'plugin_mce_css', array( $this, 'load_tinymce_css' ) );
		add_filter( 'mce_buttons', array( $this, 'init_buttons') );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_css' ) );
	}

	/**
	 * Enqueue the TinyMCE plugin into the editor
	 *
	 * @todo : Add checks to load on wp_admin only
	 */
	function load_tinymce_fontawesome () {
		$plugins = array( 'fontawesome', 'noneditable' );
		$plugins_array = array();

		foreach ($plugins as $plugin ) {
			$plugins_array[ $plugin ] = plugins_url('lib/fontawesome', __FILE__) . '/plugin.min.js';
		}
		return $plugins_array;
	}

	/**
	 * Add button to TinyMCE
	 */
	function init_buttons( $buttons ){
		array_push($buttons, "fontawesome");
		return $buttons;
	}

	/**
	 * Load Frontend Scripts
	 */
	function enqueue_scripts() {
		if ( ! wp_script_is( 'fontawesome', 'enqueued' ) ) {
			wp_enqueue_style( 'fontawesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );
		}
	}

	/**
	 * Load Admin Styles
	 */
	function enqueue_admin_scripts() {
		if ( ! wp_script_is( 'fontawesome', 'enqueued' ) ) {
			wp_enqueue_style( 'fontawesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );
			add_editor_style( plugins_url( '/assets/styles.css', __FILE__ ) );
		}
	}

	/**
	 * Loads FontAwesome within the editor button...
	 *
	 * @todo : there seems to be a fair amount of unDRY going on with FA
	 */
	function load_tinymce_css( $mce_css ){
		$mce_css .= plugins_url( '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );

		return $mce_css;
	}

	/**
	 * Enqueue CSS
	 *
	 * We've got some default styles which need to be loaded in order to view icons on the FrontEnd
	 */
	function enqueue_css( $args ){
		$defaults = array(
			'enqueue_css' => true,
		);

		$filtered_args = apply_filters( 'tinymce_fontawesome_css', $defaults );

		$defaults = wp_parse_args( $filtered_args, $defaults );

		if ( $defaults['enqueue_css'] == false ) {
			return;
		}

		wp_enqueue_style( 'tinymce-fa-styles', plugins_url( '/assets/styles.css', __FILE__ ) );
	}
}

add_action( 'plugins_loaded', array( 'Tinymce_Fontawesome', 'get_instance' ) );