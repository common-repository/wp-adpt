<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if (!class_exists("WP_List_Table")) {
	$path = ABSPATH."wp-admin/includes/class-wp-list-table.php";
	require_once($path);
}

/**
 * 
 */
class Adptdata_Table extends WP_List_Table{
	private $_items;
	function __construct($data){
		parent::__construct();
		$this->_items =$data;
	}

	function get_columns(){
		return [
			'cb'					=>	'<input type="checkbox"/>',
			'adpt_customer_name'	=>	__('Customer Name','adpt'),
			'adpt_customer_email'	=>	__('Customer Email','adpt'),
			'adpt_order_date'		=>	__('Date','adpt'),
		];
	}

	function column_cb($item){
		$addClass = "";
		if ($item['adpt_notification'] == '0') {
			$addClass = 'class="new"';
		}
		return "<input type='checkbox' {$addClass} name='id[]' value='".$item['id']."'>";

	}

	function column_adpt_customer_name($item){
		$nonce = wp_create_nonce("adpt_action");
		$actions = [
			'view'		=>	sprintf('<a href="?page=adpt-order&pid=%s&n=%s&action_view=%s">%s</a>', $item['id'], $nonce, 'view',__('View','adpt')),
			'delete'	=>	sprintf('<a onclick="return confirm(\'Are you sure you want to delete this item?\');" href="?page=adpt-order&pid=%s&n=%s&action_del=%s">%s</a>', $item['id'], $nonce, 'delete',__('Delete','adpt')),
		];
		return sprintf('%s %s', $item['adpt_customer_name'],$this->row_actions($actions));
	}

	function column_default($item, $column_name){
		return $item[$column_name];
	}


	function get_bulk_actions() {
	        $actions = array(
	            'delete'    => __('Delete','adpt')
	        );
	        return $actions;
	    }

	    function process_bulk_action() { 
	      global $wpdb;
	      $table_name = $wpdb->prefix . "adpt_order";
           if ('delete' === $this->current_action()) {
               $get_id = isset($_GET['id']) ? array_map( 'absint', $_GET['id'] ) :[];
               foreach($get_id as $id){               	
                $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %d", $id));
               }            
               
              $url = "admin.php?page=adpt-order";
              echo("<script>location.href = '".esc_attr($url)."'</script>");
           }        
	    }
	

	function prepare_items(){
		$this->process_bulk_action();
		$per_page = 10;
		$total_pages = count($this->_items);
		$current_page = $this->get_pagenum();
		$this->set_pagination_args([
			'total_items'	=>	$total_pages,
			'per_page'		=>	$per_page,
		]);		
		$data = array_slice($this->_items, ($current_page-1) * $per_page, $per_page);
		$this->items = $data;
		$this->_column_headers = array($this->get_columns());

	}
	
}