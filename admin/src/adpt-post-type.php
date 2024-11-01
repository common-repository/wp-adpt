<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// Register Custom AD Pricing Table
function adpt_post_type() {

	$labels = array(
		'name'                  => _x( 'AD Pricing Table', 'AD Pricing Table General Name', 'adpt' ),
		'singular_name'         => _x( 'AD Pricing Table', 'AD Pricing Table Singular Name', 'adpt' ),
		'menu_name'             => __( 'AD Pricing Table', 'adpt' ),
		'name_admin_bar'        => __( 'AD Pricing Table', 'adpt' ),
		'archives'              => __( 'Item Archives', 'adpt' ),
		'attributes'            => __( 'Item Attributes', 'adpt' ),
		'parent_item_colon'     => __( 'Parent Item:', 'adpt' ),
		'all_items'             => __( 'All Pricing Tables', 'adpt' ),
		'add_new_item'          => __( 'Add Pricing Table', 'adpt' ),
		'add_new'               => __( 'Add Pricing Table', 'adpt' ),
		'new_item'              => __( 'New Pricing Table', 'adpt' ),
		'edit_item'             => __( 'Edit Pricing Table', 'adpt' ),
		'update_item'           => __( 'Update Pricing Table', 'adpt' ),
		'view_item'             => __( 'View Pricing Table', 'adpt' ),
		'view_items'            => __( 'View Pricing Tables', 'adpt' ),
		'search_items'          => __( 'Search Pricing Table', 'adpt' ),
		'not_found'             => __( 'Not found', 'adpt' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'adpt' ),
		'insert_into_item'      => __( 'Insert into item', 'adpt' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'adpt' ),
		'items_list'            => __( 'Items list', 'adpt' ),
		'items_list_navigation' => __( 'Items list navigation', 'adpt' ),
		'filter_items_list'     => __( 'Filter items list', 'adpt' ),
	);

	$args = array(
			'label'                 => __( 'AD Pricing Table', 'adpt' ),
			'labels'                => $labels,
			'supports'              => array('title'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => false,
			'capability_type'       => 'page',
		);

	register_post_type( 'adpt', $args);

}
add_action( 'init', 'adpt_post_type', 0 );