<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       konradkrawczyk.com
 * @since      1.0.0
 *
 * @package    Tt_Social_Share
 * @subpackage Tt_Social_Share/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tt_Social_Share
 * @subpackage Tt_Social_Share/admin
 * @author     Konrad Krawczyk <konrad.krawczyk@nyu.edu>
 */
class Tt_Social_Share_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {


		$options = get_option($this->plugin_name);

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		// Tracks new sections for whitelist_custom_options_page()
		$this->page_sections = array();
		// Must run after wp's `option_update_filter()`, so priority > 10
		// add_action( 'whitelist_options', array( $this, 'whitelist_custom_options_page' ),11 );

		$this->ttsocialshare_options = get_option($this->plugin_name);

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tt_Social_Share_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tt_Social_Share_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// CSS stylesheet for Color Picker
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tt-social-share-admin.css', array( 'wp-color-picker' ), $this->version, 'all' );
		wp_enqueue_style( 'ionicons', 'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tt_Social_Share_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tt_Social_Share_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_media();
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tt-social-share-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, false );

	}

	public function add_plugin_admin_menu() {

	    /*
	     * Add a settings page for this plugin to the Settings menu.
	     *
	     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
	     *
	     *        Administration Menus: http://codex.wordpress.org/Administration_Menus
	     *
	     */
	    add_options_page( 'TT Social Share', 'TT Social Share', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
	    );
	}

	 /**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */

	public function add_action_links( $links ) {
	    /*
	    *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
	    */
	   $settings_link = array(
	    '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
	   );
	   return array_merge(  $settings_link, $links );

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */

	public function display_plugin_setup_page() {
	    include_once( 'partials/tt-social-share-admin-display.php' );
	}

	public function validate($input) {
    // All checkboxes inputs
    $valid = array();
		//Post types
		$post_types = get_post_types();
			foreach ($post_types as $type){
				$valid['displayOn'][$type] = (isset($input['displayOn'][$type]) && !empty($input['displayOn'][$type])) ? 1 : 0;
		}
		//Display or don't - speific buttons
    $valid['displayFb'] = (isset($input['displayFb']) && !empty($input['displayFb'])) ? 1 : 0;
		$valid['displayTw'] = (isset($input['displayTw']) && !empty($input['displayTw'])) ? 1 : 0;
		$valid['displayGp'] = (isset($input['displayGp']) && !empty($input['displayGp'])) ? 1 : 0;
		$valid['displayPi'] = (isset($input['displayPi']) && !empty($input['displayPi'])) ? 1 : 0;
		$valid['displayLi'] = (isset($input['displayLi']) && !empty($input['displayLi'])) ? 1 : 0;
		$valid['displayWa'] = (isset($input['displayWa']) && !empty($input['displayWa'])) ? 1 : 0;
		//Set color and size of buttons - size defaults to medium, color defaults to brand colors
		$valid['btnSize'] = (isset($input['btnSize']) && !empty($input['btnSize'])) ? $input['btnSize'] : 'btnMd';
		$valid['colorCode'] = (isset($input['colorCode']) && !empty($input['colorCode'])) ? $input['colorCode'] : "";
		//Display or not - specific locations on the page
		$valid['displayUnderPost'] = (isset($input['displayUnderPost']) && !empty($input['displayUnderPost'])) ? 1 : 0;
		$valid['displayUnderThumb'] = (isset($input['displayUnderThumb']) && !empty($input['displayUnderThumb'])) ? 1 : 0;
		$valid['displayLeft'] = (isset($input['displayLeft']) && !empty($input['displayLeft'])) ? 1 : 0;
		$valid['displayEnd'] = (isset($input['displayEnd']) && !empty($input['displayEnd'])) ? 1 : 0;
		//Set the order of buttons
		$valid['btnOrder'] = (isset($input['btnOrder']) && !empty($input['btnOrder'])) ? $input['btnOrder'] : "tt-btn_1,tt-btn_2,tt-btn_3,tt-btn_4,tt-btn_5,tt-btn_6";
		//Display or hide on loop posts
		$valid['loop'] = (isset($input['loop']) && !empty($input['loop'])) ? 1 : 0;
		$valid['hideTitle'] = (isset($input['hideTitle']) && !empty($input['hideTitle'])) ? 1 : 0;

    return $valid;
 }

 	public function options_update() {
	 	register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	}

	public function add_button_styling_admin(){

		$colorCode = $this->ttsocialshare_options['colorCode'];

		$css = '<style>';
		//set the button color optionally
		if ( !empty($colorCode) ){
			$css .= '.tt-btn{
					background: '.$colorCode.'!important;
				}';
		}

		$css .= '</style>';

		echo $css;

	}


}
