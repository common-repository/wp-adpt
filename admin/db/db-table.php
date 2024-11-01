<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $wpdb;
$table_name = $wpdb->prefix . "adpt_order"; 
$sql = "CREATE TABLE {$table_name} (
  id INT(9) NOT NULL AUTO_INCREMENT,
  adpt_customer_name VARCHAR(255),
  adpt_customer_email VARCHAR(255),
  adpt_selected_pack VARCHAR(255),
  adpt_selected_services TEXT,
  adpt_selected_service_price VARCHAR(255),
  adpt_project_description TEXT,
  adpt_order_date TIMESTAMP,
  adpt_notification INT(9) NOT NULL,
  PRIMARY KEY  (id)
)";
require_once ABSPATH .'wp-admin/includes/upgrade.php';
dbDelta( $sql ); 