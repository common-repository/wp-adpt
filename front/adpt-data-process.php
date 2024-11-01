<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// Ajax call

function adpt_ajax_data_process(){
	$name 			= sanitize_text_field($_POST['name']);
	$email 			= sanitize_email($_POST['email']);
	$services 		= sanitize_text_field($_POST['services']);
	$package 		= sanitize_text_field($_POST['package']);
	$price 			= sanitize_text_field($_POST['price']);
	$desc 			= sanitize_textarea_field($_POST['desc']);

	global $wpdb;
	   $table_name = $wpdb->prefix . "adpt_order";
	   $get_email_data  = $wpdb->get_col( $wpdb->prepare( "SELECT adpt_customer_email FROM $table_name",ARRAY_A ) ); 

	   if (in_array( $email, $get_email_data)) {
	   	echo "<span class='error' style='color:red'>".__('This email address is already exists','adpt')."</span>";
	   	wp_die(); 
	   }
	   if (empty($name)) {
	   	echo "<span class='error' style='color:red'>".__('Name field is empty. Please input your full name','adpt')."</span>";
	   	wp_die(); 
	   }
	   if (empty($email)) {
	   	echo "<span class='error' style='color:red'>".__('Email field is empty. Please put your email address','adpt')."</span>";
	   	wp_die(); 
	   }
	   if (!is_email( $email)) {
	   	echo "<span class='error' style='color:red'>".__('Invalid Email Address','adpt')."</span>";
	   	wp_die();
	   }
	   if (empty($services)) {
	   	echo "<span class='error' style='color:red'>".__('Service field is empty.','adpt')."</span>";
	   	wp_die(); 
	   }
	   if (empty($package)) {
	   	echo "<span class='error' style='color:red'>".__('Package field is empty.','adpt')."</span>";
	   	wp_die(); 
	   }
	   if (empty($price)) {
	   	echo "<span class='error' style='color:red'>".__('Price field is empty.','adpt')."</span>";
	   	wp_die(); 
	   }
	   
	   else{
	   	if (check_ajax_referer( 'adpt_ajax_action', 'nonce' )) {
	   		
	   $data = $wpdb->insert($table_name, array(
	    'adpt_customer_name'			=>	sanitize_text_field($name),
	    'adpt_customer_email'			=>	sanitize_email( $email ),
	    'adpt_selected_services'		=>	sanitize_text_field($services),
	    'adpt_selected_pack'			=>	sanitize_text_field($package),
	    'adpt_selected_service_price'	=>	sanitize_text_field($price),
	    'adpt_project_description'		=>	sanitize_textarea_field($desc),
		));  

		if (!empty($data)) {
			echo "<span class='success' style='color:green'>".__('Thank you for contacting us!','adpt')."</span>";
			wp_die(); 
				}
	   	}
	}

}
add_action('wp_ajax_adpt_ajax_action', 'adpt_ajax_data_process');
add_action('wp_ajax_nopriv_adpt_ajax_action', 'adpt_ajax_data_process');