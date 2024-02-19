<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.procode-x.com
 * @since      1.0.0
 *
 * @package    Petsure_Insurance
 * @subpackage Petsure_Insurance/public/partials
 */


$partners = new WP_Query(
    array(
        'post_type' => 'partners',
        'posts_per_page' => -1,
        'orderby' => 'rand',
        'post_status' => 'publish',
    )
);
?>
<div class="splide container">
    <div class="splide__slider">
        <div class="splide__track">
            <div class="splide__list">
            <?php if($partners->have_posts()) :
                while($partners->have_posts()) : $partners->the_post(); 
                    $post_id = get_the_ID();
                    $quote = get_post_meta( get_the_ID(), 'get_quote_metabox', true );
                    $special = get_post_meta( get_the_ID(), 'special_offer_metabox', true );
                    $title = get_the_title();
                    $vaps = get_the_terms( get_the_ID(), 'vap' );
                ?>
                <div class="splide__slide">
                    <div class="partner-container">
                        <div class="row grid-content">
                            <div class="grid-col one">
                                <?php  the_post_thumbnail(); ?>
                            </div>
                            <div class="grid-col two">
                                <?php include( plugin_dir_path( __DIR__ ) .'partials/table/cover-plans-table.php'); ?>
                            </div>
                            <div class="grid-col three">
                                <div class="buttons-grid-inner">
                                    <?php if($quote): ?>
                                        <div class="btn-container">
                                            <a href="<?php echo $quote ?>" target="_blank" class="partner-btns quote">Get a Quote</a>
                                            <p class="btn-subtext">On <?php echo $title ?>'s website</p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($special): ?>
                                        <div class="btn-container">
                                            <a href="<?php echo $special ?>" target="_blank" class="partner-btns special">Special Offer</a>
                                            <p class="btn-subtext">On <?php echo $title ?>'s website</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row grid-logos">
                            <div class="vap-col title">
                                <h2 class="vap-title">
                                    Value added products
                                </h2>
                            </div>
                            <div class="vap-col images">
                                <div class="vap-img-container">
                                    <?php 
                                    if($vaps):
                                        foreach($vaps as $vap): 
                                            $vap_image_meta = get_term_meta( $vap->term_id, 'vap_img', true);
                                            $vap_img_url = wp_get_attachment_image_url( $vap_image_meta, 'medium' );
                                            ?>
                                            <div class="vap-img-col">
                                                <img src="<?php echo $vap_img_url ?>"/>
                                            </div>
                                        <?php endforeach; 
                                    endif; ?>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>		
                <?php endwhile;
            endif; 
            wp_reset_query(); ?>
            </div>
        </div>
    </div>

    <div class="slide-actions">
        <div class="splide__progress">
            <div class="splide__progress__bar">
            </div>
        </div>
        <button class="splide__toggle" type="button">
            <span class="splide__toggle__play">Play Insurer Packages Carousel</span>
            <span class="splide__toggle__pause">Pause Insurer Packages Carousel</span>
        </button>
    </div>
</div>
