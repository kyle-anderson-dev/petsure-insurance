<?php

/**
 *
 * @link              https://www.procode-x.com
 * @since             1.0.0
 * @package           Petsure_Insurance
 *
 * @wordpress-plugin
 * Plugin Name:       PetSure Insurance
 * Plugin URI:        https://www.procode-x.com
 * Description:       Plugin to create and manage different insurance packages for PetSure
 * Version:           1.0.0
 * Author:            Kyle Anderson
 * Author URI:        https://www.procode-x.com/
 * Text Domain:       petsure-insurance
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'PETSURE_INSURANCE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-petsure-insurance-activator.php
 */
function activate_petsure_insurance() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-petsure-insurance-activator.php';
	Petsure_Insurance_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-petsure-insurance-deactivator.php
 */
function deactivate_petsure_insurance() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-petsure-insurance-deactivator.php';
	Petsure_Insurance_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_petsure_insurance' );
register_deactivation_hook( __FILE__, 'deactivate_petsure_insurance' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-petsure-insurance.php';

/**
 * Begins execution of the plugin.
 *
 *
 * @since    1.0.0
 */
function run_petsure_insurance() {

	$plugin = new Petsure_Insurance();
	$plugin->run();

}
run_petsure_insurance();
