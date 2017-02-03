/*global jQuery, document, redux*/
(function( $ ) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.tc_sample_import = redux.field_objects.tc_sample_import || {};

    redux.field_objects.tc_sample_import.init = function( selector ) {
        if ( !selector ) {
            selector = $( document ).find( ".redux-group-tab:visible" ).find( '.redux-container-tc_sample_import:visible' );
        }

        $( selector ).each(
            function() {
                var el = $( this );
                var parent = el;
                if ( !el.hasClass( 'redux-field-container' ) ) {
                    parent = el.parents( '.redux-field-container:first' );
                }
                if ( parent.is( ":hidden" ) ) { // Skip hidden fields
                    return;
                }
                if ( parent.hasClass( 'redux-field-init' ) ) {
                    parent.removeClass( 'redux-field-init' );
                } else {
                    return;
                }
				
                el.each( function() {
					
					$( '.import-this-sample' ).click( function( e ) {
						e.preventDefault();
						
						var overlay = $( document.getElementById( 'redux_ajax_overlay' ) );
						var loader = $('#redux-sticky #info_bar .spinner');
						
						// Display Loader
						$(loader).addClass('is-active');
						
						// Display Overlay
						overlay.fadeIn();
						
						if( $(this).hasClass('disabled') ){
							return false;
						}
						
						var current_element = $(e.target);
						
						// Disable all import buttons
						var $nonce = current_element.attr( "data-nonce" );
						$.ajax({
							type: 'POST',
							dataType: 'json',
							url: sample_data_import_object.ajaxurl,
							data: { 
								'action': 'theme_import_sample', //calls wp_ajax_nopriv_ajaxlogin
								'security': $('#sample_data_security').val(),
								'sample_id': current_element.data('id'),
								'nonce': $nonce,
							},
							success: function(data){
								/*
								// Hide Loader
								$(loader).removeClass('is-active');
								
								// Hide Overlay
								overlay.fadeOut( 'fast' );
								*/
								
								// Display custom message received from ajax.
								if( data.message ){									
									$('.admin-demo-data-custom-notice .admin-demo-data-custom-notice-inner').html(data.message);
									$('.admin-demo-data-custom-notice').slideDown();
								}
								
								//$('#redux_notification_bar .admin-demo-data-notice').show();
								//$('#redux_notification_bar .admin-demo-data-notice').hide('blind', {}, 500);
								
								// $('#redux_notification_bar .admin-demo-data-notice').hide().fadeIn('slow').delay(5000).hide(1);
								$('#redux_notification_bar .admin-demo-data-notice').hide().slideDown('slow').delay(5000).slideUp('slow');
								$('#redux_notification_bar .admin-demo-data-reload').hide().delay(1000).slideDown('slow').delay(15000).slideUp('slow');
								
								// Reload Page
								window.setTimeout(function(){
									document.location.href = document.location.href;
								}, 5000);
								return data;
							}
						});
						
						window.onbeforeunload = null;
						redux.args.ajax_save = false;
					} );
				});
				$( '.admin-demo-data-custom-notice .admin-demo-data-custom-notice-close' ).click(function() {
					$( ".admin-demo-data-custom-notice" ).slideUp('slow');
				});
            }
        );
    };
})( jQuery );