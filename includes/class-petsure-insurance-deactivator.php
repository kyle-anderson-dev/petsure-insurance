<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.procode-x.com
 * @since      1.0.0
 *
 * @package    Petsure_Insurance
 * @subpackage Petsure_Insurance/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Petsure_Insurance
 * @subpackage Petsure_Insurance/includes
 * @author     Kyle Anderson <kyle@procode-x.com>
 */

class Petsure_Insurance_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}

}