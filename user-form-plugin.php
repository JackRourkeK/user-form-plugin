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
	require_once plugin_dir_path( __FILE__ ) . 'user-form-table.php';
	// return "Hello Binod";
}
add_shortcode('example_user_display_form', 'user_form_plugin');

function head_code() {
	$output = '';
	if(is_single()){
		$output .= '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">';    
		$output .= '<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>';    
		$output .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';    
		$output .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>';    
		$output .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>'; 
		$output .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>'; 
		$output .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>';
		$output .= '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>'; 
	}
	echo $output;

}
add_action('wp_head','head_code');

function my_plugin_scripts() {
	wp_enqueue_script( 'user-form-script', plugin_dir_url( __FILE__ ) . 'admin/js/user-form-plugin-admin.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'custom-validation-script', plugin_dir_url( __FILE__ ) . 'admin/js/custom-validation.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'my_plugin_scripts' );
