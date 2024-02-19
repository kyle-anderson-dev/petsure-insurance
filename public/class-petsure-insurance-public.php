<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.procode-x.com
 * @since      1.0.0
 *
 * @package    Petsure_Insurance
 * @subpackage Petsure_Insurance/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Petsure_Insurance
 * @subpackage Petsure_Insurance/public
 * @author     Kyle Anderson <kyle@procode-x.com>
 */
class Petsure_Insurance_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), '4.1.4', 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/petsure-insurance-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array( 'jquery' ), '4.1.4', true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/petsure-insurance-public.js', array( 'jquery' ), $this->version, true );

	}

	public function set_scripts_type_attribute( $tag, $handle, $src ) {
		if ( 'module_handle' === $handle ) {
			$tag = '<script type="module" src="'. $src .'"></script>';
		}
		return $tag;
	}

	/**
	 * 
	 * @since    1.0.0
	 * 
	 * @param array  $post_templates The list of page templates
	 * 
	 * @param array $post
	 * 
	 * @param string $post_type
	 * 
	 * @return array  $templates The modified list of page templates
	 */
	public function add_search_page_template( $post_templates, $wp_theme, $post, $post_type ) {

		$post_templates['search-page.php'] = __('Insurance Search Page');

    	return $post_templates;

	}

	/**
	 * Change the page template to the selected template on the dropdown
	 * 
	 * @param $template
	 *
	 * @return mixed
	 */
	function ip_change_page_template($template) {

		$file_name = 'search-page.php';

		if(  get_page_template_slug() === $file_name ) {

			if ( $theme_file = locate_template( array( $file_name ) ) ) {
				$template = $theme_file;
			} else {
				$template = plugin_dir_path( __FILE__ ) . 'templates/'. $file_name;
			}
		}
	
		if($template == '') {
			throw new \Exception('No template found');
		}
	
		return $template;
	}

}
