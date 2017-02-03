!function($) {
	var pickerOpts = {
					dateFormat: 'yy-mm-dd',							
					buttonText: '<i class="fa fa-calendar"></i>',					
				};
	$(document).click(function(e) {
		if (!$(e.target).is('.datepicker_block .vc_datepicker')) {			
			$( ".datepicker_block .vc_datepicker" ).datepicker(pickerOpts);
		}
	});
    
}(window.jQuery);