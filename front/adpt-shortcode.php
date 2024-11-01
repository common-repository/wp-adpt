<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Register all shortcodes
 *
 * @return null
 */
function adpt_register_shortcodes() {
    add_shortcode( 'pricing_table_shortcode', 'adpt_shortcode_cback' );
}
add_action( 'init', 'adpt_register_shortcodes' );


function adpt_shortcode_cback($atts){
    global $wp_query,
        $post;

    $atts = shortcode_atts( array(
        'id' => ''
    ), $atts );

    $args =  array(
        'post_type'     => 'adpt',
        'post__in'      =>  array( sanitize_title( $atts['id'] ) )

    ) ;      
   
    ob_start();
?>

    <div class="row row-flex">
<?php
    $query = new WP_Query($args);
     
    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
        $adpt_data      =   carbon_get_the_post_meta('pricing_package');
        $i  =   rand(123,789); 
        foreach($adpt_data as $data):
            $i++; 
            $currency  =   carbon_get_the_post_meta('adpt_currency');            
            $duration  =   carbon_get_the_post_meta('adpt_duration');
            $title     =   $data['adpt_package_title']; 
            $subtitle  =   $data['adpt_package_subtitle']; 
            $ribbon    =   $data['adpt_package_recommended']; 

            // Settings
            $cols                   =     carbon_get_the_post_meta('adpt_columns');            
            $header_bg_color        =     carbon_get_the_post_meta('adpt_header_bg_color');
            $header_bg_hov_color    =     carbon_get_the_post_meta('adpt_header_bg_hover_color');
            $btn_bg_color           =     carbon_get_the_post_meta('adpt_btn_bg_color');
            $btn_bg_hov_color       =     carbon_get_the_post_meta('adpt_btn_bg_hover_color');
            $btn_txt                =     carbon_get_the_post_meta('adpt_button_text');
            $ribbon_txt             =     carbon_get_the_post_meta('adpt_ribbon_text');
            $btn_color              =     carbon_get_the_post_meta('adpt_btn_color');            
            $btn_hov_color          =     carbon_get_the_post_meta('adpt_btn_hover_color');
            $btn_checkbox_color     =     carbon_get_the_post_meta('adpt_checkbox_color');
            $ribbon_text_color      =     carbon_get_the_post_meta('adpt_ribbon_text_color');
            $ribbon_bg_color        =     carbon_get_the_post_meta('adpt_ribbon_bg_color');

            $error_text             =     carbon_get_the_post_meta('adpt_uncheck_error');
            $show_item_price        =     carbon_get_the_post_meta('adpt_show_price_item');

            include plugin_dir_path(__file__).'ad-pricing-tbl.php';
            include plugin_dir_path(__file__).'adpt-contact-form.php';
        ?>
<script>
    ;(function($){
        $(document).ready(function(){
            
            var totalPrice  =   0.00,
                values      =   [];

                // get pack title by class
                var packTitle = $('.pack-title-<?php echo esc_attr($i); ?>').text();

                // get price from selected value
            $('.adpt-checkbox-<?php echo esc_attr($i); ?>').each(function(){
                if($(this).is(':checked')){
                    values.push($(this).data('value'));
                    totalPrice += parseInt($(this).data('value'));
                }
            });
            
            $('.adpt-selected-price-<?php echo $i; ?>').val(totalPrice); 
            $('.total-price-<?php echo esc_attr($i); ?>').text(totalPrice); 
            $('.adpt-package-title-<?php echo esc_attr($i); ?>').val(packTitle); 

            var total_price = $('.total-price-<?php echo esc_attr($i); ?>').text(totalPrice);
            if(total_price == 0){
                $(".adpt-contact-btn").prop("disabled",true);
            }
            // get default checked value from pricing table. 

            var totalPrice      =   0.00,
                selectedService =   [],
                values          =   [];
            $('.adpt-checkbox-<?php echo esc_attr($i); ?>').each(function(){
                if($(this).is(':checked')){
                    values.push($(this).data('value'));
                    totalPrice += parseInt($(this).data('value'));
                    selectedService.push($(this).data('title'));
                }
                if(totalPrice ==  0){
                    $(".button-<?php echo esc_attr($i); ?>").prop("disabled",true);
                    $(".select-item-<?php echo esc_attr($i); ?>").text("<?php echo !empty(esc_html($error_text)) ? esc_html($error_text) : __('Please select an item to proceed','adpt') ;?>");
                }else{
                    $(".button-<?php echo esc_attr($i); ?>").prop("disabled",false);
                    $(".select-item-<?php echo esc_attr($i); ?>").text("");
                }
            });

            $('.total-price-<?php echo esc_attr($i); ?>').text(totalPrice); 
            $('.adpt-selected-price-<?php echo esc_attr($i); ?>').val('<?php echo esc_html($currency); ?> '+totalPrice+' - <?php echo esc_html($duration); ?>'); 
            $('.adpt-selected-services<?php echo esc_attr($i); ?>').val(selectedService.join(', ')); 
           

            // get selected checked value from pricing table.  

            $('.adpt-checkbox-<?php echo esc_attr($i); ?>').change(function(){                
                var totalPrice      =   0.00,
                    selectedService =   [],
                    values          =   [];
                $('.adpt-checkbox-<?php echo esc_attr($i); ?>').each(function(){
                    if($(this).is(':checked')){
                        values.push($(this).data('value'));
                        totalPrice += parseInt($(this).data('value'));
                        selectedService.push($(this).data('title'));
                    }
                    if(totalPrice ==  0){
                        $(".button-<?php echo esc_attr($i); ?>").prop("disabled",true);
                        $(".select-item-<?php echo esc_attr($i); ?>").text("<?php echo !empty(esc_html($error_text)) ? esc_html($error_text) : __('Please select an item to proceed','adpt') ;?>");
                    }else{
                        $(".button-<?php echo esc_attr($i); ?>").prop("disabled",false);
                        $(".select-item-<?php echo esc_attr($i); ?>").text("");
                    }
                    
                });

                $('.total-price-<?php echo esc_attr($i); ?>').text(totalPrice); 
                $('.adpt-selected-price-<?php echo esc_attr($i); ?>').val('<?php echo esc_html($currency); ?> '+totalPrice+' - <?php echo esc_html($duration); ?>'); 
                $('.adpt-selected-services<?php echo esc_attr($i); ?>').val(selectedService.join(', '));                    

            });

            //Content protection
            // $("html").on("contextmenu",function(e){
            //    return false;
            // });
            

            // Modal Form
            $(".button-<?php echo esc_attr($i); ?>").click(function(){
                $('.modal-<?php echo esc_attr($i); ?>').fadeIn();

                return false;
            });
            $(".close").click(function(){
                $('.modal-<?php echo esc_attr($i); ?>').fadeOut();
                return false;
            });
            

        });

    })(jQuery);
</script>

    <?php endforeach; endwhile;  
    wp_reset_query();
    return ob_get_clean();
    else : ?>
    <p><?php esc_html_e( 'Sorry, Pricing Table Not Found!','adpt' ); ?></p>
    <?php endif; ?>

    </div>
<?php } ?>