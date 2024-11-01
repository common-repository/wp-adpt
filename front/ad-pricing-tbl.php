<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
 ?>
<style type="text/css">
    #adpt-<?php echo esc_attr($i); ?> .adpt-pricing-tbl .adpt-pricing-tbl-header{
        background: <?php echo esc_html( $header_bg_color ); ?>;
    }
    #adpt-<?php echo esc_attr($i); ?> .adpt-pricing-tbl:hover .adpt-pricing-tbl-header{
        background: <?php echo esc_html( $header_bg_hov_color ); ?>;
    }
    #adpt-<?php echo esc_attr($i); ?> .adpt-pricing-tbl:hover .pricing-content ul:after,
    .adpt-pricing-tbl:hover .pricing-content ul:before {
        background: linear-gradient(to bottom, <?php echo esc_html( $header_bg_hov_color ); ?> 50%, <?php echo esc_html( $header_bg_hov_color ); ?> 50%);
    }
    #adpt-<?php echo esc_attr($i); ?> .adpt-pricing-tbl .adpt-contact-btn{
        color: <?php echo esc_html( $btn_color ); ?>;
        background: <?php echo esc_html( $btn_bg_color ); ?>;
    }
    #adpt-<?php echo esc_attr($i); ?> .adpt-pricing-tbl:hover .adpt-contact-btn{
        color: <?php echo esc_html( $btn_hov_color ); ?>;
        background: <?php echo esc_html( $btn_bg_hov_color ); ?>;
    }    

    #adpt-<?php echo esc_attr($i); ?> .form-check-input:checked {
        background-color: <?php echo esc_html( $btn_checkbox_color ); ?>;
        border-color: <?php echo esc_html( $btn_checkbox_color ); ?>;
    }
    #adpt-<?php echo esc_attr($i); ?> .adpt-pricing-tbl span.adpt-ribbon{
        color: <?php echo esc_html( $ribbon_text_color ); ?>;
        background: <?php echo esc_html( $ribbon_bg_color ); ?>;
        box-shadow: 0px 2px 3px <?php echo esc_html( $ribbon_bg_color ); ?>;
    }

</style>
<div id="adpt-<?php echo esc_attr($i); ?>" class="col-md-<?php echo !empty($cols) ? $cols : 4; ?> col-sm-6 protected">
    <form action="">
        <div class="adpt-pricing-tbl">
            <div class="adpt-pricing-tbl-header">
                <h3 class="heading pack-title-<?php echo esc_attr($i); ?>"><?php echo esc_html($title); ?></h3>
                <?php if ($ribbon):?>
                <span class="adpt-ribbon"><?php echo !empty(esc_html($ribbon_txt)) ? esc_html(strtoupper($ribbon_txt)) : __('RECOMMENDED','adpt') ;?></span>
                <?php endif; ?>
                <span class="price-value">
                    <span class="currency"><?php echo esc_html($currency); ?></span><span class="total-price-<?php echo esc_attr($i); ?>"><?php esc_html( '0.00','adpt' ); ?></span>
                    <?php if ($duration):?>
                    	<span class="month">/<?php echo esc_html($duration); ?></span>
                    <?php endif; ?>
                </span>
                <span class="adpt-subtitle"><?php echo esc_html($subtitle); ?></span>
            </div>
            <div class="pricing-content">
            	<span class="item-alert select-item-<?php echo esc_attr($i); ?>"></span>
                <ul class="pricing-items">  
                    <?php
                        $service_items = $data['services'];
                        
                        foreach ($service_items as  $item):
                            $checked = $item['adpt_services_default'];
                            $adpt_price = preg_replace('/[A-Za-z\$\@\;\<\>\'\{\}\?\^\~\`\!\#\&\%\*\(\)\-\=\,\_\+\[\]\:\|\/\" "]+/', '', $item['adpt_services_value']);
                            $price = floatval($adpt_price);
                            $item_title = $item['adpt_services'];
                            $item_price = '';
                            if ($show_item_price == 1) {
                                $item_price = esc_html($currency).esc_html($price);
                            }
                    ?>
                    <li>
                        <div class="form-check form-switch">
                            <input class="form-check-input adpt-checkbox-<?php echo esc_attr($i); ?>" data-value="<?php echo esc_attr($price); ?>" type="checkbox" data-title="<?php echo esc_attr($item_title); ?>"<?php if($checked == 1){echo "checked";} ?> />
                            <label class="form-check-label"><?php echo esc_html($item_title); ?> 
                            <span class="inline-price"><?php echo esc_html($item_price); ?></span></label>                          	
                        </div>
                    </li>  
                    <?php endforeach; ?>                        
                </ul>
                <button type="button" class="adpt-contact-btn button-<?php echo esc_attr($i); ?>" ><?php echo !empty($btn_txt) ? esc_html($btn_txt) : __('Contact Us','adpt'); ?></button>
            </div>
        </div>
    </form>
</div>
        
        