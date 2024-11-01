;(function($){
	$(document).ready(function(){
		$('.adpt-button').click(function(){
			var name 			= $(this).closest("form").find("#adpt-name").val();
			var email 			= $(this).closest("form").find("#adpt-email").val();
			var package 		= $(this).closest("form").find("#adpt-package").val();
			var services 		= $(this).closest("form").find("#adpt-services").val();
			var price 			= $(this).closest("form").find("#adpt-price").val();
			var description 	= $(this).closest("form").find("#adpt-project-desc").val();			
			var nonce 			= $(this).closest("form").find("#_wpnonce").val();			

			$(this).closest("form").find(".buttonload").show();	
			$(this).hide();	
			$(".close").click(function(){
				$('.alert').empty();
				$('.alert').hide();
				return false;
			});

			// AJAX processing 
			$.post(adpt_ajax_data.ajax_url,
				{
				'action' 	: 'adpt_ajax_action',
				 'name'		: name,
				 'email'	: email,
				 'package' 	: package,
				 'services' : services,
				 'price'	: price,
				 'desc'		: description,
				 'nonce'	: nonce
				}).done(function(data){
					var alertClass = $(data).attr('class');
					if (alertClass == 'error') {						
				      $(".alert-danger").show();
				      $(".alert-danger").html(data);
				      $(".buttonload").hide();
				      $('.adpt-button').show();
				      $('.adpt-sent').hide();	
					}
					if (alertClass == 'success') {
						$(".alert-danger").hide();
						$(".alert-success").show();
						$(".alert-success").html(data);
						$(".buttonload").hide();
						$('.adpt-button').hide();	
						$('.adpt-sent').show();
				      setTimeout(function() {
			              $('.adpt-modal-container').fadeOut('slow');
			              $('.alert-success').delay(1000).empty();
			              $('.alert-success').hide();
			              //$('.adpt-modal-body form').delay(1000).trigger("reset");
			              $('.adpt-button').show();	
			              $('.adpt-sent').hide();
			              location.reload();
			          }, 2000);
					}				      

			    });

			return false;
		});
	});
})(jQuery);

