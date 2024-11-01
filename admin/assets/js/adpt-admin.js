;(function($){
	$(document).ready(function(){
		var addClass = $('.new').closest("tr").addClass("unapprove");

		$( function() {
		  $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
		  $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
		} );
	});
})(jQuery);