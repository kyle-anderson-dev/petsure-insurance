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

$cover_plans = new WP_Query(
    array(
        'post_type' => 'cover_plans',
        'posts_per_page' => -1,
        'orderby' => 'rand',
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'meta-select',
                'value' => get_the_ID()
            )
        )
    )
);
?>

<table class="responsive-table">
    <thead class="table-header">
        <tr>
            <th></th>
            <th></th>
            <th>% of Vet Cost Reimbursed</th>
            <th>Annual Benefit Limit</th>
            <th>Excess Options</th>
        </tr>
    </thead>
    <tbody>
    <?php if($cover_plans->have_posts()) :
            while($cover_plans->have_posts()) : $cover_plans->the_post(); ?>
            <tr class="table-row">
                <td class="col"><?php echo the_title(); ?></td>
                <td class="col"></td>
                <td class="col" data-label="% of Vet Cost Reimbursed"><?php echo get_post_meta( get_the_ID(), 'vet_cost_metabox', true );?>% </td>
                <td class="col" data-label="Annual Benefit Limit">$<?php echo get_post_meta( get_the_ID(), 'annual_benefit_metabox', true );?> </td>
                <td class="col" data-label="Excess Options"><?php echo get_post_meta( get_the_ID(), 'excess_options_metabox', true );?>% </td>
            </tr>
    <?php endwhile;
        endif; ?>
    </tbody>
</table>
