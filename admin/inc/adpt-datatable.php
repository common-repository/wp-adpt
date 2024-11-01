<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Register a custom menu page.
 */

function ad_pricing_tbl_order(){
	global $wpdb;
	$table_name = $wpdb->prefix . "adpt_order";

	if (isset($_GET['pid'])) {
		if(!isset($_GET['n']) || ! wp_verify_nonce($_GET['n'],'adpt_action')){
			wp_die("Sorry you're not authorised to delete this","adpt");
		}

		/**
		 * Delete Data/row from table
		 */

		if (isset($_GET['action_del']) && $_GET['action_del'] == 'delete') {
			$wpdb->delete("{$table_name}", ['id' => sanitize_key($_GET['pid'])]);
			$_GET['pid'] = null;
		}
	}
	$id = 0;
	$data  = $wpdb->get_col( $wpdb->prepare( "SELECT adpt_notification FROM $table_name WHERE adpt_notification = %d ", $id ) );
	$notification_count = count($data);

		$notification_bubble = "";
	if ($notification_count !== 0 ) {
		$notification_bubble = sprintf('<span class="adpt-notification-bubble awaiting-mod">%s</span>', $notification_count);
	}

	
	add_menu_page( __('ADPT Orders','adpt'), __('ADPT Orders'.$notification_bubble,'adpt'), 'manage_options', 'adpt-order', 'adpt_order_cb', 'dashicons-chart-area', 6 );
}
add_action('admin_menu','ad_pricing_tbl_order');

// Search function

function adpt_search_by_name($item){
	$name 	= strtolower($item['adpt_customer_name']);
	$search_name 	= sanitize_text_field($_REQUEST['s']);
	if (strpos($name, $search_name) !== false) {
			return true;
	}
	return false;
}

function adpt_order_cb(){
	global $wpdb;
	$table_name = $wpdb->prefix . "adpt_order";
	$data  = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC",ARRAY_A  ); 
		// Search item
	 if (isset($_REQUEST['s'])) {
	 		$search = sanitize_text_field($_REQUEST['s']);
	 		$data = array_filter($data,'adpt_search_by_name');
	 }

	$table = new Adptdata_Table($data);	
	$table->prepare_items();
	?>
	<?php 
		if ( !isset($_GET['action_view'])) {
	 ?>
	 <div class="wrap">
	 <h2><?php _e("All Orders","adpt") ?></h2>	 	
		<form  method="GET">
			<?php
				$table->search_box('Search','search_id');
			 	$table->display();
			 ?>
			 <input type="hidden" name="page" value="<?php echo esc_attr($_REQUEST['page']); ?>">
		</form>
	 </div>
<?php } ?>
	<?php 

	if ( isset($_GET['action_view']) && $_GET['action_view']=='view') {
		?>

		<div class="wrap adpt">
			<h2 style="padding-bottom: 20px"><?php _e("Order Details","adpt"); ?></h2>
			<table>
			  <tr>
			    <th><?php _e("Customer Name","adpt"); ?></th>
			    <th><?php _e("Customer Email","adpt"); ?></th>
			    <th><?php _e("Selected Package","adpt"); ?></th>
			    <th><?php _e("Selected Services","adpt"); ?></th>
			    <th><?php _e("Project Description","adpt"); ?></th>
			    <th><?php _e("Total Price","adpt"); ?></th>
			  </tr>
			  <?php 
			   $pid = sanitize_key($_GET['pid']);
			  	$data  = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $pid));				  		 
			  	foreach($data as $value):
			  		$name 			= $value->adpt_customer_name;
			  		$email 			= $value->adpt_customer_email;
			  		$package 		= $value->adpt_selected_pack;
			  		$price 			= $value->adpt_selected_service_price;
			  		$description 	= $value->adpt_project_description;
			  	 ?>
			  <tr>
			    <td><?php echo esc_html($name); ?></td>
			    <td><?php echo esc_html($email); ?></td>
			    <td><?php echo esc_html($package); ?></td>	
			    <td>
			   	 	<?php 
			   	 			$services = explode(',', $value->adpt_selected_services); 
			   	 			foreach($services as $service):?>
			   	 				<?php echo"<span class='adpt-services'>- ".esc_html($service)."</span>";?>
			  				<?php endforeach ?>
			   	 </td>
			    <td><?php echo esc_html($description); ?></td>
			    <td><?php echo esc_html($price); ?></td>
			  </tr>
			<?php endforeach ?>
			  
			</table>
			<?php 
				 $table_name = $wpdb->prefix . "adpt_order";
				$wpdb->update($table_name, array('adpt_notification'=>'1'), array('id'=>$pid)); 
			?>
		</div>

		<?php 
	}
	
}