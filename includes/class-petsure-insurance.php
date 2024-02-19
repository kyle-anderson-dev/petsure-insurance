<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.procode-x.com
 * @since      1.0.0
 *
 * @package    Petsure_Insurance
 * @subpackage Petsure_Insurance/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Petsure_Insurance
 * @subpackage Petsure_Insurance/includes
 * @author     Kyle Anderson <kyle@procode-x.com>
 */
class Petsure_Insurance {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Petsure_Insurance_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PETSURE_INSURANCE_VERSION' ) ) {
			$this->version = PETSURE_INSURANCE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'petsure-insurance';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Petsure_Insurance_Loader. Orchestrates the hooks of the plugin.
	 * - Petsure_Insurance_i18n. Defines internationalization functionality.
	 * - Petsure_Insurance_Admin. Defines all hooks for the admin area.
	 * - Petsure_Insurance_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-petsure-insurance-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-petsure-insurance-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-petsure-insurance-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-petsure-insurance-public.php';

		$this->loader = new Petsure_Insurance_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Petsure_Insurance_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Petsure_Insurance_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Petsure_Insurance_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'load_media_files' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_admin, 'create_insurance_post_types' );
		$this->loader->add_action( 'init', $plugin_admin, 'create_ct_category_taxonomy' );
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'add_related_metabox' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'insurance_partner_save_box' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'save_get_quote_metabox' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'save_special_offer_metabox' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'save_excess_options_metabox' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'save_annual_benefits_metabox' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'save_vet_cost_metabox' );
		$this->loader->add_action( 'vap_add_form_fields', $plugin_admin, 'vap_custom_fields' );
		$this->loader->add_action( 'vap_edit_form_fields', $plugin_admin, 'vap_edit_logo_field', 10, 2 );
		$this->loader->add_action( 'created_vap', $plugin_admin, 'save_vap_custom_field' );
		$this->loader->add_action( 'edited_vap',  $plugin_admin, 'save_vap_custom_field' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Petsure_Insurance_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_filter( 'theme_page_templates', $plugin_public, 'add_search_page_template', 10, 4 );
		$this->loader->add_filter( 'template_include', $plugin_public, 'ip_change_page_template' );
		$this->loader->add_filter( 'script_loader_tag', $plugin_public, 'set_scripts_type_attribute', 10, 3 );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Petsure_Insurance_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
