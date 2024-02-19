<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.procode-x.com
 * @since      1.0.0
 *
 * @package    Petsure_Insurance
 * @subpackage Petsure_Insurance/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Petsure_Insurance
 * @subpackage Petsure_Insurance/admin
 * @author     Kyle Anderson <kyle@procode-x.com>
 */
class Petsure_Insurance_Admin {

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

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the media for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function load_media_files() {

		wp_enqueue_media();

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/petsure-insurance-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/petsure-insurance-admin.js', array( 'jquery' ), $this->version, true );

	}

	/**
	 * Register the custom post types Partners & Cover Plans.
	 *
	 * @since    1.0.0
	 */
	public function create_insurance_post_types() {
		$supports = array(
			'title', 
			'editor', 
			'author', 
			'thumbnail', 
			'excerpt',
			'custom-fields',
			'comments',
			'revisions',
			'post-formats',
		);
		$labels = array(
			'name' => _x('Partners', 'plural'),
			'singular_name' => _x('Partner', 'singular'),
			'menu_name' => _x('Insurance partners', 'admin menu'),
			'name_admin_bar' => _x('Partner', 'admin bar'),
			'add_new' => _x('Add New', 'add new'),
			'add_new_item' => __('Add New Partner'),
			'new_item' => __('New Partner'),
			'edit_item' => __('Edit Partner'),
			'view_item' => __('View Partner'),
			'all_items' => __('All Partners'),
			'search_items' => __('Search Partners'),
			'not_found' => __('No Partners found.'),
		);
		$args = array(
			'supports' => $supports,
			'labels' => $labels,
			'public' => true,
			'query_var' => true,
			'menu_position' => 5,
        	'menu_icon' => 'dashicons-book',
			'rewrite' => array('slug' => 'partners'),
			'has_archive' => true,
			'hierarchical' => false,
		);
		
		$ct_labels = array(
			'name' => _x('Cover Plans', 'plural'),
			'singular_name' => _x('Cover Plan', 'singular'),
			'menu_name' => _x('Cover Plans', 'admin menu'),
			'name_admin_bar' => _x('Cover Plan', 'admin bar'),
			'add_new' => _x('Add New', 'add new'),
			'add_new_item' => __('Add New cover plan'),
			'new_item' => __('New cover plan'),
			'edit_item' => __('Edit cover plan'),
			'view_item' => __('View cover plan'),
			'all_items' => __('All cover plans'),
			'search_items' => __('Search cover plans'),
			'not_found' => __('No cover plans found.'),
		);
		$ct_args = array(
			'supports' => $supports,
			'labels' => $ct_labels,
			'public' => true,
			'query_var' => true,
			'menu_position' => 5,
        	'menu_icon' => 'dashicons-book',
			'rewrite' => array('slug' => 'cover_plans'),
			'has_archive' => true,
			'hierarchical' => false,
		);

		register_post_type('partners', $args);
		register_post_type('cover_plans', $ct_args);
	}

	/**
	 * Register the custom taxonomies for the Cover Plans post type.
	 *
	 * @since    1.0.0
	 */
	public function create_ct_category_taxonomy() {
		$labels = array(
			'name' => 'Cover Type',
			'singular_name' => 'Cover Type',
			'menu_name' => 'Cover Types',
			'all_items' => 'All Cover Types',
			'new_item_name' => 'New Cover Type Name',
			'add_new_item' => 'Add Cover Type',
			'edit_item' => 'Edit Cover Type',
			'update_item' => 'Update Cover Type',
			'view_item' => 'View Cover Type',
			'separate_items_with_commas' => 'Separate cover types with commas',
			'add_or_remove_items' => 'Add or remove cover types',
			'choose_from_most_used' => 'Choose from the most used',
			'popular_items' => 'Popular Cover Types',
			'search_items' => 'Search Cover Types',
			'not_found' => 'Not Found',
			'no_terms' => 'No Cover Types',
			'items_list' => 'Cover Types list',
			'items_list_navigation' => 'Cover Types list navigation',
		);
		$args = array(
			'labels' => $labels,
			'hierarchical' => false,
			'public' => false,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud' => true,
		);

		$at_labels = array(
			'name' => 'Animal Type',
			'singular_name' => 'Animal Type',
			'menu_name' => 'Animal Types',
			'all_items' => 'All Animal Types',
			'new_item_name' => 'New Animal Type',
			'add_new_item' => 'Add Animal Type',
			'edit_item' => 'Edit Animal Type',
			'update_item' => 'Update Animal Type',
			'view_item' => 'View Animal Type',
			'separate_items_with_commas' => 'Separate animal types with commas',
			'add_or_remove_items' => 'Add or remove animal types',
			'choose_from_most_used' => 'Choose from the most used',
			'popular_items' => 'Popular Animal Types',
			'search_items' => 'Search Animal Types',
			'not_found' => 'Not Found',
			'no_terms' => 'No Animal Types',
			'items_list' => 'Animal Types list',
			'items_list_navigation' => 'Animal Types list navigation',
		);
		$at_args = array(
			'labels' => $at_labels,
			'hierarchical' => false,
			'public' => false,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud' => true,
		);

		$aa_labels = array(
			'name' => 'Animal Ages',
			'singular_name' => 'Animal Age',
			'menu_name' => 'Animal Ages',
			'all_items' => 'All Animal Ages',
			'new_item_name' => 'New Animal Age',
			'add_new_item' => 'Add Animal Age',
			'edit_item' => 'Edit Animal Age',
			'update_item' => 'Update Animal Age',
			'view_item' => 'View Animal Age',
			'separate_items_with_commas' => 'Separate animal ages with commas',
			'add_or_remove_items' => 'Add or remove animal ages',
			'choose_from_most_used' => 'Choose from the most used',
			'popular_items' => 'Popular Animal Ages',
			'search_items' => 'Search Animal Ages',
			'not_found' => 'Not Found',
			'no_terms' => 'No Animal Ages',
			'items_list' => 'Animal Ages list',
			'items_list_navigation' => 'Animal Ages list navigation',
		);
		$aa_args = array(
			'labels' => $aa_labels,
			'hierarchical' => false,
			'public' => false,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud' => true,
		);

		$pf_labels = array(
			'name' => 'Product Features',
			'singular_name' => 'Product Feature',
			'menu_name' => 'Product Features',
			'all_items' => 'All Product Features',
			'new_item_name' => 'New Product Feature',
			'add_new_item' => 'Add Product Feature',
			'edit_item' => 'Edit Product Feature',
			'update_item' => 'Update Product Feature',
			'view_item' => 'View Product Feature',
			'separate_items_with_commas' => 'Separate product features with commas',
			'add_or_remove_items' => 'Add or remove product features',
			'choose_from_most_used' => 'Choose from the most used',
			'popular_items' => 'Popular Product Features',
			'search_items' => 'Search Product Features',
			'not_found' => 'Not Found',
			'no_terms' => 'No Product Features',
			'items_list' => 'Product Features list',
			'items_list_navigation' => 'Product Features list navigation',
		);
		$pf_args = array(
			'labels' => $pf_labels,
			'hierarchical' => false,
			'public' => false,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud' => true,
		);

		$vap_labels = array(
			'name' => 'Value Added Products',
			'singular_name' => 'Value Added Product',
			'menu_name' => 'Value Added Products',
			'all_items' => 'All Value Added Products',
			'new_item_name' => 'New Value Added Product',
			'add_new_item' => 'Add Value Added Product',
			'edit_item' => 'Edit Value Added Product',
			'update_item' => 'Update Value Added Product',
			'view_item' => 'View Value Added Product',
			'separate_items_with_commas' => 'Separate value added products with commas',
			'add_or_remove_items' => 'Add or remove value added products',
			'choose_from_most_used' => 'Choose from the most used',
			'popular_items' => 'Popular Value Added Products',
			'search_items' => 'Search Value Added Products',
			'not_found' => 'Not Found',
			'no_terms' => 'No Value Added Products',
			'items_list' => 'Value Added Products list',
			'items_list_navigation' => 'Value Added Products list navigation',
		);
		$vap_args = array(
			'labels' => $vap_labels,
			'hierarchical' => false,
			'public' => false,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud' => true,
		);

		register_taxonomy('ct_categories', array('cover_plans'), $args);
		register_taxonomy('animal_types', array('cover_plans'), $at_args);
		register_taxonomy('animal_ages', array('cover_plans'), $aa_args);
		register_taxonomy('product_features', array('cover_plans'), $pf_args);
		register_taxonomy('vap', array('partners'), $vap_args);
	}

	/**
	 * Regsiter custom metabox for Cover Plans.
	 *
	 * @since    1.0.0
	 *
	 */
	public function add_related_metabox() {
		add_meta_box( 'cover_plans_metabox', __( 'Select Insurance Partner', 'textdomain' ), array($this,'insurance_partner_box'), 'cover_plans', 'normal' );
		add_meta_box( 'vet_cost_metabox', __( '% of Vet Cost Reimbursed', 'textdomain' ), array($this,'render_vet_cost_meta'), 'cover_plans', 'normal' );
		add_meta_box( 'annual_benefit_metabox', __( 'Annual Benefit Limit', 'textdomain' ), array($this,'render_annual_benefit_meta'), 'cover_plans', 'normal' );
		add_meta_box( 'excess_options_metabox', __( 'Excess Options', 'textdomain' ), array($this,'render_excess_options_meta'), 'cover_plans', 'normal' );

		add_meta_box( 'get_quote_metabox', __( 'Get a Quote URL', 'textdomain' ), array($this,'render_get_quote_meta'), 'partners', 'normal' );
		add_meta_box( 'special_offer_metabox', __( 'Special Offer URL', 'textdomain' ), array($this,'render_special_offer_meta'), 'partners', 'normal' );
	}

	/**
	 * Display custom partners data for custom metabox.
	 *
	 * @since    1.0.0
	 * 
	 * @param array $post.
	 *
	 */
	public function insurance_partner_box($post) {

		wp_nonce_field( basename( __FILE__ ), 'insurance_partner_nonce' );
		
		$stored_meta = get_post_meta( $post->ID );
		
		$partnerArgs = array(
		'post_type' => 'partners',
		'post_status' => 'publish',
		'numberposts' => -1
		);
		
		$partners = get_posts($partnerArgs);
		
		if($partners): ?>
		<p>
		  <select name="meta-select" id="meta-select">
			<option value="NULL">Please choose an insurance partner for this cover plan</option>
		<?php foreach($partners as $partner): ?>
			<option value="<?php echo $partner->ID; ?>" <?php if ( isset ( $stored_meta['meta-select'] ) ) selected( $stored_meta['meta-select'][0], $partner->ID ); ?>><?php echo $partner->post_title; ?></option>
		<?php endforeach; ?>
		  </select>
		</p>    
		<?php
		else:
		?>
		<p>There are no insurance partners - please save this post, and create an insurance partner. You will then be able to choose an insurance partner that this cover plan is associated to.</p>
		<?php
		endif;
	}

	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_vet_cost_meta( $post ) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field( basename( __FILE__ ), 'vet_cost_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, 'vet_cost_metabox', true );

		// Display the form, using the current value.
		?>
		<label for="vet_cost_metabox">
			<?php _e( 'Add % of Vet Cost Reimbursed', 'textdomain' ); ?>
		</label>
		<br/>
		<br/>
		<input type="text" id="vetCost" name="vet_cost_metabox" value="<?php echo esc_attr( $value ); ?>" size="100"/>
		<?php
	}

	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_annual_benefit_meta( $post ) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field( basename( __FILE__ ), 'annual_benefit_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, 'annual_benefit_metabox', true );

		// Display the form, using the current value.
		?>
		<label for="annual_benefit_metabox">
			<?php _e( 'Add Annual Benefit Limit', 'textdomain' ); ?>
		</label>
		<br/>
		<br/>
		<input type="text" id="annualBenefit" name="annual_benefit_metabox" value="<?php echo esc_attr( $value ); ?>" size="100"/>
		<?php
	}

	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_excess_options_meta( $post ) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field( basename( __FILE__ ), 'excess_options_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, 'excess_options_metabox', true );

		// Display the form, using the current value.
		?>
		<label for="excess_options_metabox">
			<?php _e( 'Add Excess Options', 'textdomain' ); ?>
		</label>
		<br/>
		<br/>
		<input type="text" id="excessOptions" name="excess_options_metabox" value="<?php echo esc_attr( $value ); ?>" size="100"/>
		<?php
	}

	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_get_quote_meta( $post ) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field( basename( __FILE__ ), 'get_quote_url_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, 'get_quote_metabox', true );

		// Display the form, using the current value.
		?>
		<label for="get_quote_metabox">
			<?php _e( 'Add the URL to get a quote for this insurance partner', 'textdomain' ); ?>
		</label>
		<br/>
		<br/>
		<input type="text" id="getQuote" name="get_quote_metabox" value="<?php echo esc_attr( $value ); ?>" size="100"/>
		<?php
	}

	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_special_offer_meta( $post ) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field( basename( __FILE__ ), 'special_offer_url_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, 'special_offer_metabox', true );

		// Display the form, using the current value.
		?>
		<label for="special_offer_metabox">
			<?php _e( 'Add the special offer URL for this insurance partner', 'textdomain' ); ?>
		</label>
		<br/>
		<br/>
		<input type="text" id="specialOffer" name="special_offer_metabox" value="<?php echo esc_attr( $value ); ?>" size="100"/>
		<?php
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @since    1.0.0
	 * 
	 * @param int $post_id The ID of the post being saved.
	 *
	 */
	public function insurance_partner_save_box( $post_id ) {
		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ 'insurance_partner_nonce' ] ) && wp_verify_nonce( $_POST[ 'insurance_partner_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
		
		// Exits script depending on save status
		if ( $is_autosave || $is_revision || !$is_valid_nonce ):
			return;
		endif;
		// Checks for input and saves if needed
		if( isset( $_POST[ 'meta-select' ] ) ) :
			update_post_meta( $post_id, 'meta-select', $_POST[ 'meta-select' ] );
		endif;
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save_get_quote_metabox( $post_id ) {

		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ 'get_quote_url_nonce' ] ) && wp_verify_nonce( $_POST[ 'get_quote_url_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
		
		// Exits script depending on save status
		if ( $is_autosave || $is_revision || !$is_valid_nonce ) :
			return;
		endif;
		// Checks for input and saves if needed
		if( isset( $_POST[ 'get_quote_metabox' ] ) ) :
			update_post_meta( $post_id, 'get_quote_metabox', $_POST[ 'get_quote_metabox' ] );
		endif;
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save_special_offer_metabox( $post_id ) {

		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ 'special_offer_url_nonce' ] ) && wp_verify_nonce( $_POST[ 'special_offer_url_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
		
		// Exits script depending on save status
		if ( $is_autosave || $is_revision || !$is_valid_nonce ):
			return;
		endif;
		// Checks for input and saves if needed
		if( isset( $_POST[ 'special_offer_metabox' ] ) ) :
			update_post_meta( $post_id, 'special_offer_metabox', $_POST[ 'special_offer_metabox' ] );
		endif;
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save_excess_options_metabox( $post_id ) {

		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ 'excess_options_nonce' ] ) && wp_verify_nonce( $_POST[ 'excess_options_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
		
		// Exits script depending on save status
		if ( $is_autosave || $is_revision || !$is_valid_nonce ):
			return;
		endif;
		// Checks for input and saves if needed
		if( isset( $_POST[ 'excess_options_metabox' ] ) ) :
			update_post_meta( $post_id, 'excess_options_metabox', $_POST[ 'excess_options_metabox' ] );
		endif;
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save_annual_benefits_metabox( $post_id ) {

		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ 'annual_benefit_nonce' ] ) && wp_verify_nonce( $_POST[ 'annual_benefit_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
		
		// Exits script depending on save status
		if ( $is_autosave || $is_revision || !$is_valid_nonce ):
			return;
		endif;
		// Checks for input and saves if needed
		if( isset( $_POST[ 'annual_benefit_metabox' ] ) ) :
			update_post_meta( $post_id, 'annual_benefit_metabox', $_POST[ 'annual_benefit_metabox' ] );
		endif;
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save_vet_cost_metabox( $post_id ) {

		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ 'vet_cost_nonce' ] ) && wp_verify_nonce( $_POST[ 'vet_cost_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
		
		// Exits script depending on save status
		if ( $is_autosave || $is_revision || !$is_valid_nonce ):
			return;
		endif;
		// Checks for input and saves if needed
		if( isset( $_POST[ 'vet_cost_metabox' ] ) ) :
			update_post_meta( $post_id, 'vet_cost_metabox', $_POST[ 'vet_cost_metabox' ] );
		endif;
	}

	/**
	 * Create the custom fields for the taxonomy Value Added Products.
	 *
	 * @since    1.0.0
	 * 
	 * @param string $taxonomy The name of the taxonomy to acquire.
	 *
	 */
	public function vap_custom_fields($taxonomy) {
		?>
			<div class="form-field">
				<label>Value Added Product Logo</label>
				<a href="#" class="button vap-upload">Upload image</a>
				<a href="#" class="vap-remove" style="display:none">Remove image</a>
				<input type="hidden" name="vap_img" value="">
			</div>
		<?php
	}


	/**
	 * Adding custom logo field to the edit screen for Value Added Products
	 *
	 * @since    1.0.0
	 * 
	 * @param array $term.
	 * 
	 * @param string $taxonomy.
	 *
	 */
	function vap_edit_logo_field( $term, $taxonomy ) {

		// get meta data value
		$image_id = get_term_meta( $term->term_id, 'vap_img', true );
	
		?>

		<tr class="form-field">
			<th>
				<label for="vap_img">Value Added Product Logo</label>
			</th>
			<td>
				<?php if( $image = wp_get_attachment_image_url( $image_id, 'medium' ) ) : ?>
					<a href="#" class="vap-upload">
						<img src="<?php echo esc_url( $image ) ?>" />
					</a>
					<a href="#" class="vap-remove">Remove image</a>
					<input type="hidden" name="vap_img" value="<?php echo absint( $image_id ) ?>">
				<?php else : ?>
					<a href="#" class="button vap-upload">Upload image</a>
					<a href="#" class="vap-remove" style="display:none">Remove image</a>
					<input type="hidden" name="vap_img" value="">
				<?php endif; ?>
			</td>
		</tr>
		<?php
	}

	/**
	 * Create the custom fields for the taxonomy Cover Types.
	 *
	 * @since    1.0.0
	 * 
	 * @param int $term_id.
	 *
	 */
	public function save_vap_custom_field( $term_id ) {
	
		update_term_meta(
			$term_id,
			'vap_img',
			sanitize_text_field( $_POST[ 'vap_img' ] )
		);
		
	}

}
