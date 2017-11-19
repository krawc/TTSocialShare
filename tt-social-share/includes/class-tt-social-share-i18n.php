<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       konradkrawczyk.com
 * @since      1.0.0
 *
 * @package    Tt_Social_Share
 * @subpackage Tt_Social_Share/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Tt_Social_Share
 * @subpackage Tt_Social_Share/includes
 * @author     Konrad Krawczyk <konrad.krawczyk@nyu.edu>
 */
class Tt_Social_Share_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'tt-social-share',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
