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

$animal_ages      = get_terms([
                        'taxonomy' => 'animal_ages',
                        'hide_empty' => false,
                    ]);
$cover_types      = get_terms([
                        'taxonomy' => 'ct_categories',
                        'hide_empty' => false,
                    ]);
$animal_types     = get_terms([
                        'taxonomy' => 'animal_types',
                        'hide_empty' => false,
                    ]);
$product_features = get_terms([
                        'taxonomy' => 'product_features',
                        'hide_empty' => false,
                    ]);

$total = count($cover_types);
if ($total == 4) {
    $total = 'four';
}
 ?>

<div class="search-form container">
    <div class="inner-container">
        <h2 class="form-title">Let's help you find the best policy.</h2>
        <form class="form" id="ajax-search-form" action="#">   
            <div class="form-col">
                <select name="animal_types" id="animalTypes" placeholder="Animal Type">
                    <option value="">Animal Type</option>
                    <?php foreach($animal_types as $animal_type): ?>
                        <option value="<?php echo $animal_type->term_id; ?>"><?php  echo $animal_type->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-col">
                <select name="animal_ages" id="animalAges" placeholder="Animal Age">
                    <option value="">Animal Age</option>
                    <?php foreach($animal_ages as $animal_age): ?>
                        <option value="<?php echo $animal_age->term_id; ?>"><?php  echo $animal_age->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-col">
                <select name="cover_types" id="coverTypes" placeholder="Cover Type">
                    <option value="">Cover Type</option>
                    <?php foreach($cover_types as $cover_type): ?>
                        <option value="<?php echo $cover_type->term_id; ?>"><?php  echo $cover_type->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>   
            <div class="form-col">
                <select name="product_features" id="productFeatures" placeholder="Product Feature">
                    <option value="">Product Feature</option>
                    <?php foreach($product_features as $product_feature): ?>
                        <option value="<?php echo $product_feature->term_id; ?>"><?php  echo $product_feature->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>  
            <div class="form-col">

            </div>  
            <div class="form-col">
                <button type="submit" class="btn">Search</button>
            </div>                                  
        </form>
        <p class="form-discalimer">The following product information provided by PetSure is to help you research available insurance brands and products. Search filters allow you to group products withi similar features and may not compare all features relevant to you.</p>
    </div>
</div>
<div class="form-text-container">
    <h4 class="cover-type-title">There are <?php echo $total ?> types of cover:</h4>
    <ol class="cover-type-list">
        <?php foreach($cover_types as $cover_type): ?>
            <li>
                <?php echo $cover_type->name ?> - <span class="cover-desc"><?php echo $cover_type->description?></span>
            </li>
        <?php endforeach; ?>
    </ol>
    <div class="product-disclaimer">
        <p class="disclaimer-text">
            Costs and product information should be confirmed with relevant insurer. Consider the Product Disclosure Statement and Target Market Determination (TMD), before making a purchase decision. Contact the product issuer directly for a copy of the TMD.
        </p>
        <p class="disclaimer-text">
            These products are only available to persons over the age of 18suitable if you can afford to pay the applicable premium, upfront vet expenses before submitting a claim (unless GapOnly® is used), and veterinary expenses that are above the accepted claim amount.
        </p>
        <p class="disclaimer-text last">
            *Waiting periods, pre-existing conditions, condition exclusions and applicable excess will vary by product, so please check with your preferred insurer for more information.
        </p>
    </div>
</div>
 
