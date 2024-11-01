<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Column Management
 */

function adpt_manage_column($columns){
	unset($columns['date']);
	$columns['shortcode']	= __('Shortcode','adpt');
	return $columns;

}

add_filter('manage_adpt_posts_columns','adpt_manage_column');

function adpt_display_data($column, $post_id){
	$shortcode = "[pricing_table_shortcode id='".$post_id."']";
	echo '<input type="text"  value="'.esc_attr($shortcode).'" readonly class="adpt-shortcode">';

}
add_action('manage_adpt_posts_custom_column','adpt_display_data',10,2);