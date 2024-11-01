<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
use Carbon_Fields\Container;
use Carbon_Fields\Field;
// Register Carbon Metabox

function adpt_metaboxs(){
	Container::make('post_meta',__('Pricing Table','adpt'))
	->where('post_type','=','adpt')
	// ->where('post_template','=','page-jobs.php')
	->add_fields([		
		Field::make( 'complex', 'pricing_package' )
		    ->add_fields( array(
		        Field::make('text','adpt_package_title',__('Package Title','adpt'))->set_width(30),
		        Field::make('text','adpt_package_subtitle',__('Package Sub Title','adpt'))->set_width(30),
		        // Field::make('text','adpt_package_price',__('Package Price','adpt')),		        
		        Field::make( 'checkbox', 'adpt_package_recommended', __( 'Recommended Package','adpt' ) )
		        	    ->set_option_value( 'yes' )->set_width(25),       
		        	Field::make( 'complex', 'services' )
		            ->add_fields( array(
		                Field::make('text','adpt_services',__('Service','adpt'))->set_width(30),
		                Field::make('text','adpt_services_value',__('Price','adpt'))->set_width(30),
		                Field::make( 'checkbox', 'adpt_services_default', __( 'Make It Default','adpt' ) )
		        	    ->set_option_value( 'yes' )->set_width(30),
		        	    
		            ) )
		    ) )

	]);


// Tab
    Container::make( 'post_meta', __( 'Pricing Table Settings' ) )
        ->where( 'post_type', '=', 'adpt' )
        ->add_tab( __( 'Pricing Table Style' ), array(
                Field::make( 'select', 'adpt_columns', __( 'ADPT Columns','adpt' ) )->set_options( array(
				''	  => __('Select a column','adpt'),
				'12'  => __('1 column','adpt'),
				'6'	  => __('2 column','adpt'),
				'4'	  => __('3 column','adpt'),
				'3'	  => __('4 column','adpt'),
		    )),
                Field::make( 'color', 'adpt_header_bg_color', __( 'ADPT Header Background Color','adpt' ) ),
                Field::make( 'color', 'adpt_header_bg_hover_color', __( 'ADPT Header Background Hover Color','adpt' ) ),
                Field::make( 'color', 'adpt_btn_color', __( 'ADPT Button Text Color','adpt' ) ),
                Field::make( 'color', 'adpt_btn_hover_color', __( 'ADPT Button Text Hover Color','adpt' ) ),
                Field::make( 'color', 'adpt_btn_bg_color', __( 'ADPT Button Background Color','adpt' ) ),
                Field::make( 'color', 'adpt_btn_bg_hover_color', __( 'ADPT Button Background Hover Color','adpt' ) ),
                Field::make( 'color', 'adpt_checkbox_color', __( 'ADPT Checkbox Color','adpt' ) ),
                Field::make( 'color', 'adpt_ribbon_text_color', __( 'ADPT Ribbon Text Color','adpt' ) ),
                Field::make( 'color', 'adpt_ribbon_bg_color', __( 'ADPT Ribbon BG Color','adpt' ) ),
            ) )
            ->add_tab( __( 'Pricing Table Handle' ), array(                       
                Field::make( 'text', 'adpt_uncheck_error', __( 'ADPT Uncheck Error Text','adpt' ) ),
                Field::make( 'text', 'adpt_ribbon_text', __( 'ADPT Ribbon Text','adpt' ) ),
                Field::make( 'text', 'adpt_button_text', __( 'ADPT Button Text','adpt' ) ),
                Field::make( 'checkbox', 'adpt_show_price_item', __( 'Show Price Beside Item','adpt' ) )
                    ->set_option_value( 'yes' ),                                   
                ) )            
            

        ->add_tab( __( 'Package' ), array(
                    Field::make( 'select', 'adpt_currency', __( 'Choose Currency' ) )
                    	->set_options( array(
				''	  => __('Select a currency','adpt'),				
				'ALL' => __('Albania Lek','adpt'),
		        'AFN' => __('Afghanistan Afghani','adpt'),
		        'ARS' => __('Argentina Peso','adpt'),
		        'AWG' => __('Aruba Guilder','adpt'),
		        'AUD' => __('Australia Dollar','adpt'),
		        'AZN' => __('Azerbaijan New Manat','adpt'),
		        'BSD' => __('Bahamas Dollar','adpt'),
		        'BBD' => __('Barbados Dollar','adpt'),
		        'BDT' => __('Bangladeshi Taka','adpt'),
		        'BYR' => __('Belarus Ruble','adpt'),
		        'BZD' => __('Belize Dollar','adpt'),
		        'BMD' => __('Bermuda Dollar','adpt'),
		        'BOB' => __('Bolivia Boliviano','adpt'),
		        'BAM' => __('Bosnia and Herzegovina Convertible Marka','adpt'),
		        'BWP' => __('Botswana Pula','adpt'),
		        'BGN' => __('Bulgaria Lev','adpt'),
		        'BRL' => __('Brazil Real','adpt'),
		        'BND' => __('Brunei Darussalam Dollar','adpt'),
		        'KHR' => __('Cambodia Riel','adpt'),
		        'CAD' => __('Canada Dollar','adpt'),
		        'KYD' => __('Cayman Islands Dollar','adpt'),
		        'CLP' => __('Chile Peso','adpt'),
		        'CNY' => __('China Yuan Renminbi','adpt'),
		        'COP' => __('Colombia Peso','adpt'),
		        'CRC' => __('Costa Rica Colon','adpt'),
		        'HRK' => __('Croatia Kuna','adpt'),
		        'CUP' => __('Cuba Peso','adpt'),
		        'CZK' => __('Czech Republic Koruna','adpt'),
		        'DKK' => __('Denmark Krone','adpt'),
		        'DOP' => __('Dominican Republic Peso','adpt'),
		        'XCD' => __('East Caribbean Dollar','adpt'),
		        'EGP' => __('Egypt Pound','adpt'),
		        'SVC' => __('El Salvador Colon','adpt'),
		        'EEK' => __('Estonia Kroon','adpt'),
		        'EUR' => __('Euro Member Countries','adpt'),
		        'FKP' => __('Falkland Islands (Malvinas) Pound','adpt'),
		        'FJD' => __('Fiji Dollar','adpt'),
		        'GHC' => __('Ghana Cedis','adpt'),
		        'GIP' => __('Gibraltar Pound','adpt'),
		        'GTQ' => __('Guatemala Quetzal','adpt'),
		        'GGP' => __('Guernsey Pound','adpt'),
		        'GYD' => __('Guyana Dollar','adpt'),
		        'HNL' => __('Honduras Lempira','adpt'),
		        'HKD' => __('Hong Kong Dollar','adpt'),
		        'HUF' => __('Hungary Forint','adpt'),
		        'ISK' => __('Iceland Krona','adpt'),
		        'INR' => __('India Rupee','adpt'),
		        'IDR' => __('Indonesia Rupiah','adpt'),
		        'IRR' => __('Iran Rial','adpt'),
		        'IMP' => __('Isle of Man Pound','adpt'),
		        'ILS' => __('Israel Shekel','adpt'),
		        'JMD' => __('Jamaica Dollar','adpt'),
		        'JPY' => __('Japan Yen','adpt'),
		        'JEP' => __('Jersey Pound','adpt'),
		        'KZT' => __('Kazakhstan Tenge','adpt'),
		        'KPW' => __('Korea (North) Won','adpt'),
		        'KRW' => __('Korea (South) Won','adpt'),
		        'KGS' => __('Kyrgyzstan Som','adpt'),
		        'LAK' => __('Laos Kip','adpt'),
		        'LVL' => __('Latvia Lat','adpt'),
		        'LBP' => __('Lebanon Pound','adpt'),
		        'LRD' => __('Liberia Dollar','adpt'),
		        'LTL' => __('Lithuania Litas','adpt'),
		        'MKD' => __('Macedonia Denar','adpt'),
		        'MYR' => __('Malaysia Ringgit','adpt'),
		        'MUR' => __('Mauritius Rupee','adpt'),
		        'MXN' => __('Mexico Peso','adpt'),
		        'MNT' => __('Mongolia Tughrik','adpt'),
		        'MZN' => __('Mozambique Metical','adpt'),
		        'NAD' => __('Namibia Dollar','adpt'),
		        'NPR' => __('Nepal Rupee','adpt'),
		        'ANG' => __('Netherlands Antilles Guilder','adpt'),
		        'NZD' => __('New Zealand Dollar','adpt'),
		        'NIO' => __('Nicaragua Cordoba','adpt'),
		        'NGN' => __('Nigeria Naira','adpt'),
		        'NOK' => __('Norway Krone','adpt'),
		        'OMR' => __('Oman Rial','adpt'),
		        'PKR' => __('Pakistan Rupee','adpt'),
		        'PAB' => __('Panama Balboa','adpt'),
		        'PYG' => __('Paraguay Guarani','adpt'),
		        'PEN' => __('Peru Nuevo Sol','adpt'),
		        'PHP' => __('Philippines Peso','adpt'),
		        'PLN' => __('Poland Zloty','adpt'),
		        'QAR' => __('Qatar Riyal','adpt'),
		        'RON' => __('Romania New Leu','adpt'),
		        'RUB' => __('Russia Ruble','adpt'),
		        'SHP' => __('Saint Helena Pound','adpt'),
		        'SAR' => __('Saudi Arabia Riyal','adpt'),
		        'RSD' => __('Serbia Dinar','adpt'),
		        'SCR' => __('Seychelles Rupee','adpt'),
		        'SGD' => __('Singapore Dollar','adpt'),
		        'SBD' => __('Solomon Islands Dollar','adpt'),
		        'SOS' => __('Somalia Shilling','adpt'),
		        'ZAR' => __('South Africa Rand','adpt'),
		        'LKR' => __('Sri Lanka Rupee','adpt'),
		        'SEK' => __('Sweden Krona','adpt'),
		        'CHF' => __('Switzerland Franc','adpt'),
		        'SRD' => __('Suriname Dollar','adpt'),
		        'SYP' => __('Syria Pound','adpt'),
		        'TWD' => __('Taiwan New Dollar','adpt'),
		        'THB' => __('Thailand Baht','adpt'),
		        'TTD' => __('Trinidad and Tobago Dollar','adpt'),
		        'TRY' => __('Turkey Lira','adpt'),
		        'TRL' => __('Turkey Lira','adpt'),
		        'TVD' => __('Tuvalu Dollar','adpt'),
		        'UAH' => __('Ukraine Hryvna','adpt'),
		        'GBP' => __('United Kingdom Pound','adpt'),
		        'USD' => __('United States Dollar','adpt'),
		        'UYU' => __('Uruguay Peso','adpt'),
		        'UZS' => __('Uzbekistan Som','adpt'),
		        'VEF' => __('Venezuela Bolivar','adpt'),
		        'VND' => __('Viet Nam Dong','adpt'),
		        'YER' => __('Yemen Rial','adpt'),
		        'ZWD' => __('Zimbabwe Dollar','adpt'),
			)),
			Field::make( 'select', 'adpt_duration', __( 'Choose Pakage Duration' ) )
			->set_options( array(
				'' 		=> __('Select Package Duration','adpt'),
				'mo' 	=> __('Month','adpt'),
				'6 mo' 	=> __('6 Months','adpt'),
				'yr' 	=> __('Year','adpt'),
			) ),
			
        ) );



   


}
add_action('carbon_fields_register_fields','adpt_metaboxs');


/**
 * Custom Metabox for adpt post type shortcode
 * @since 1.0.0
 */ 

 /**
 * Custom Metabox for shortcode by custom code
 */ 

function adpt_custom_metabox(){
	add_meta_box( 'adpt_shotcode', __('ADPT Shortcode','adpt'), 'adpt_shortcode_cb', 'adpt','side');
}

$adpt_shotcode = "";
function adpt_shortcode_cb($post){

	$label = __('Shortcode','adpt');
		$get_data = get_post_meta($post->ID,'_adpt_shortcode',true);
	?>
	<p>
		<label for="adpt_shortcode"><?php echo esc_html($label); ?></label>
		<br/>
		<input type="text" name="adpt_shortcode" value="<?php if ($post->post_status == 'publish') {echo $get_data;} ?>" id="adpt_shortcode" class="widefat" readonly>	
	</p>

	<?php 
}
add_action('admin_menu','adpt_custom_metabox');



// Save custom meta data

function adpt_save_meta_data($post_id){

	$data = "[pricing_table_shortcode id='".$post_id."']";
	update_post_meta($post_id,'_adpt_shortcode',$data);
}
add_action('save_post','adpt_save_meta_data');


