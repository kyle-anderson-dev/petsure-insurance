<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.procode-x.com
 * @since      1.0.0
 *
 * @package    Petsure_Insurance
 * @subpackage Petsure_Insurance/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Petsure_Insurance
 * @subpackage Petsure_Insurance/includes
 * @author     Kyle Anderson <kyle@procode-x.com>
 */
class Petsure_Insurance_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'petsure-insurance',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
