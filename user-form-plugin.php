<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://bru.com.np/
 * @since             1.0.0
 * @package           User_Form_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       User Form Plugin
 * Plugin URI:        https://github.com/JackRourkeK/user-form-plugin
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Balram Upadhyay
 * Author URI:        http://bru.com.np/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       user-form-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'USER_FORM_PLUGIN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-user-form-plugin-activator.php
 */
function activate_user_form_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-user-form-plugin-activator.php';
	User_Form_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-user-form-plugin-deactivator.php
 */
function deactivate_user_form_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-user-form-plugin-deactivator.php';
	User_Form_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_user_form_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_user_form_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-user-form-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_user_form_plugin() {

	$plugin = new User_Form_Plugin();
	$plugin->run();

}
run_user_form_plugin();

// Initialization of User Form Plugin to show User Form
function user_form_plugin()
{
	// Loading the user form for the consistency.
	if(!is_admin()){
		require_once plugin_dir_path( __FILE__ ) . 'user-form-table.php';
	}
}
add_shortcode('example_user_display_form', 'user_form_plugin');

function my_plugin_scripts() {
	
	wp_enqueue_script( 'bootstrap-script', plugin_dir_url( __FILE__ ) . 'public/js/bootstrap.min.js', array( 'jquery' ), '1.0.0', false );

	wp_enqueue_script( 'jquery-slim-script', plugin_dir_url( __FILE__ ) . 'public/js/jquery-3.2.1.slim.min.js', array( 'jquery' ), '1.0.0', false );

	wp_enqueue_script( 'jquery-script', plugin_dir_url( __FILE__ ) . 'public/js/jquery.min.js', array( 'jquery' ), '1.0.0', false );

	wp_enqueue_script( 'jquery-popper-script', plugin_dir_url( __FILE__ ) . 'public/js/popper.min.js', array( 'jquery' ), '1.0.0', false );

	wp_enqueue_script( 'jquery-validate-script', plugin_dir_url( __FILE__ ) . 'public/js/jquery-validate.min.js', array( 'jquery' ), '1.0.0', false );

	wp_enqueue_script( 'jquery-validate-additional-script', plugin_dir_url( __FILE__ ) . 'public/js/additional-methods.min.js', array( 'jquery' ), '1.0.0', false );

	wp_enqueue_script( 'custom-validation-script', plugin_dir_url( __FILE__ ) . 'public/js/custom-validation.js', array( 'jquery' ), '1.0.0', false );
}
add_action( 'wp_enqueue_scripts', 'my_plugin_scripts' );

function my_plugin_styles()
{
	wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . '/public/css/bootstrap.min.css',false,'1.1','all' );
}
add_action('wp_enqueue_scripts', 'my_plugin_styles');