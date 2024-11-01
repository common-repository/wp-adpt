<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
 ?>
 <!-- Modal -->
 <div class="adpt-modal-container modal-<?php echo $i; ?>">
    <div class="adpt-modal-box">
        <div class="adpt-modal-header">
            <h3><?php _e('Contact Form','adpt'); ?></h3>
            <span class="close adpt-modal-close"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <div class="adpt-modal-body">
            <div class="alert alert-danger" role="alert"></div>
            <div class="alert alert-success" role="alert"></div>
            <form action="" class="adpt-contact-form">
                <div class="row">
                    <?php wp_nonce_field( 'adpt_ajax_action' ) ?>
                    <div class=" mb-3 col-md-6">
                        <label for="adpt-name"><?php _e('Full Name','adpt') ?></label>
                        <input type="text" class="form-control" id="adpt-name" />
                    </div>
                    <div class="form- mb-3 col-md-6">
                        <label for="adpt-email"><?php _e('Email address','adpt');?></label>
                        <input type="email" class="form-control" id="adpt-email" />
                    </div>
                </div>
                <div class="row">
                    <div class="form- mb-3 col-md-4">
                        <label for="adpt-package"><?php _e('Selected Package','adpt')?></label>
                        <input type="text" class="form-control adpt-package-title-<?php echo $i; ?>" id="adpt-package" readonly="readonly" />
                    </div>
                    <div class="form- mb-3 col-md-4">
                        <label for="adpt-services"><?php _e('Selected Services','adpt')?></label>
                        <input type="text" class="form-control adpt-selected-services<?php echo $i; ?>" id="adpt-services" readonly="readonly" />
                    </div>
                    <div class="form- mb-3 col-md-4">
                        <label for="adpt-price"><?php _e('Price','adpt');?></label>
                        <input type="text" class="form-control adpt-selected-price-<?php echo $i; ?>" id="adpt-price" readonly="readonly" />
                    </div>
                </div>
                <div class="form- mb-3">
                    <label for="adpt-project-desc"><?php _e('Project Description','adpt')?></label>
                    <textarea name="" id="adpt-project-desc" class="form-control"></textarea>
                </div>
                <button type="submit" class="adpt-contact-btn adpt-button"><?php _e('Submit','adpt')?></button>
                <button class="buttonload adpt-contact-btn">
                  <i class="fa fa-spinner fa-spin"></i><?php _e('Sending','adpt')?>
                </button>
                <button type="submit" class="adpt-contact-btn adpt-sent"><?php _e('Sent','adpt')?></button>
            </form>
        </div>
    </div>
 </div>
