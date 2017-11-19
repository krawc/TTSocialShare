<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              konradkrawczyk.com
 * @since             1.0.0
 * @package           Tt_Social_Share
 *
 * @wordpress-plugin
 * Plugin Name:       TopTal Social Share
 * Plugin URI:        http://git.toptal.com/Konrad-Krawczyk/konrad-krawczyk.git
 * Description:       This plugin displays share buttons of selected social media accounts. Available to posts, pages and other custom post types.
 * Version:           1.0.0
 * Author:            Konrad Krawczyk
 * Author URI:        konradkrawczyk.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tt-social-share
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tt-social-share-activator.php
 */
function activate_tt_social_share() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tt-social-share-activator.php';
	Tt_Social_Share_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tt-social-share-deactivator.php
 */
function deactivate_tt_social_share() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tt-social-share-deactivator.php';
	Tt_Social_Share_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tt_social_share' );
register_deactivation_hook( __FILE__, 'deactivate_tt_social_share' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tt-social-share.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tt_social_share() {

	$plugin = new Tt_Social_Share();
	$plugin->run();

}
run_tt_social_share();
