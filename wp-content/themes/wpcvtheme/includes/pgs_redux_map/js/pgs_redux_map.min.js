jQuery(document).ready(function($) {
	if( $(".redux-container-pgs_redux_map").length != 0 ) {
		var pgs_redux_maps = $('.redux-container-pgs_redux_map');
		jQuery(pgs_redux_maps).each( function( i, ele ) {
			var map_wrap_id = $(ele).attr('id');
			
			var map_field_id = $("#"+map_wrap_id).data('id');
			
			var lat = $("#"+map_wrap_id).find('.maps_data').data('lat');
			var long = $("#"+map_wrap_id).find('.maps_data').data('long');
			
			var latitude_input = $('#'+map_field_id+'_lat');
			var longitude_input = $('#'+map_field_id+'_lon');
			var locationname_input = $('#'+map_field_id+'_address');
			
			$("#"+map_field_id+"_map").locationpicker({
				location: {
					latitude: lat,
					longitude: long
				},
				inputBinding: {
					latitudeInput: $('#'+map_field_id+'_lat'),
					longitudeInput: $('#'+map_field_id+'_lon'),					
					locationNameInput: $('#'+map_field_id+'_address')
				},
				radius: false,
				enableAutocomplete: true,
				onchanged: function (currentLocation, radius, isMarkerDropped) {
					// Uncomment line below to show alert on each Location Changed event					
				}
			});
		});
	}
});