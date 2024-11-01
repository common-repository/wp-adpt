<?php
/**
 * Plugin Name: Advanced Dynamic Pricing Table
 * Description: An advanced dynamic pricing table which will give dynamic pricing system. You can easily handle your pricing system for your website, especially for agencies. Hope you will enjoy it!
 * Author: Tareq Tori
 * Author URI: mailto:tarequlislamtori@gmail.com
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: adpt
 * Domain Path: languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once plugin_dir_path(__file__).'admin/src/adpt-post-type.php';
require_once plugin_dir_path(__file__).'admin/src/adpt-metabox.php';
require_once plugin_dir_path(__file__).'admin/src/adpt-pt-col-managment.php';
require_once plugin_dir_path(__file__).'admin/inc/class-adptdata-table.php';
require_once plugin_dir_path(__file__).'admin/inc/adpt-datatable.php';
require_once plugin_dir_path(__file__).'front/adpt-shortcode.php';
require_once plugin_dir_path(__file__).'front/adpt-data-process.php';
require_once "carbon-fields/vendor/autoload.php";

/**
  * Load Text Domain for the plugin
  * @since 1.0.0
  */ 
function adpt_load_textdomain(){
	load_plugin_textdomain( 'adpt', false, plugin_dir_path( __file__ ).'languages/' );

	// Booting Carbon Field
	\Carbon_Fields\Carbon_Fields::boot();
}
add_action( 'plugins_loaded','adpt_load_textdomain');

/**
 * Activation hook
 * @since 1.0.0
 */

function adpt_activation_hook(){
    require_once plugin_dir_path(__file__).'admin/db/db-table.php';
}
register_activation_hook(__FILE__,"adpt_activation_hook");

/**
 * Enqueue a script in the WordPress Back-end.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function adpt_admin_style() {
    
    wp_enqueue_style( 'adpt-admin-style', plugin_dir_url(__FILE__).'admin/assets/css/style.css' );

    wp_enqueue_script( 'jquery-ui-tabs', array( 'jquery' ), false, true );

    wp_enqueue_script( 'adpt_admin', plugin_dir_url(__FILE__).'admin/assets/js/adpt-admin.js', array( 'jquery' ), false, true );

}
add_action( 'admin_enqueue_scripts', 'adpt_admin_style' );

/**
 * Enqueue a script in the WordPress Front-end.
 *
 * @param int $hook Hook suffix for the current front page.
 */

function adpt_enqueue_scripts() {
    wp_enqueue_style( 'adpt-bootstrap', plugin_dir_url(__FILE__).'admin/assets/css/bs-min.css');
    wp_enqueue_style( 'adpt-font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css');
    wp_enqueue_style( 'adpt-style', plugin_dir_url(__FILE__).'front/assets/css/style.css');

    wp_enqueue_script( 'adpt-bs-js', plugin_dir_url(__FILE__).'admin/assets/js/bs-min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'adpt_ajax', plugin_dir_url(__FILE__).'front/assets/js/adpt-ajax.js', array( 'jquery' ), false, true );
    // Ajax Call
    wp_localize_script( 'adpt_ajax', 'adpt_ajax_data', array('ajax_url'	=> admin_url('admin-ajax.php') ));
}
add_action( 'wp_enqueue_scripts', 'adpt_enqueue_scripts' );