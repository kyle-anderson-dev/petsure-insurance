<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); 

?>

<div class="search-page">
    <section class="search-form-section">
        <?php include( plugin_dir_path( __DIR__ ) .'partials/search-form.php'); ?>
    </section>
    <section class="search-results">
        <?php include( plugin_dir_path( __DIR__ ) .'partials/partner-blocks.php'); ?>
    </section>
</div>

<?php 

get_footer(); 
