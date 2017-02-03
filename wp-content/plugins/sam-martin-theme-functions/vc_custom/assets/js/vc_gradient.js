/*----------------------------------------------------------------------------*\
	vc_GRADIENT Param
\*----------------------------------------------------------------------------*/
( function( $ ) {
	"use strict";	
	
	var $popup = $( '#vc_ui-panel-edit-element' );		
		var $gradient_wraps  = $( '#vc_ui-panel-edit-element .vc_wrapper-param-type-vc_gradient' );
		$gradient_wraps.each( function() {		
			var $gradient_wrap  = $( this ),
				$gradient_value = $gradient_wrap.find( '.vc-value' ),
				$color_pickers  = $gradient_wrap.find( '.vc-color-picker' ),
				$range_slider   = $gradient_wrap.find( '.vc-range-slider' ),
				$angle_slider   = $gradient_wrap.find( '.vc-angle-slider' ),
				$gradient_type  = $gradient_wrap.find( '.vc-gradient-type' ),
				_color_picker   = {
					defaultColor: $( this ).val(),
					change: function() {
						setTimeout( function() {
							gradient_picker_change( $gradient_wrap, $angle_slider, $range_slider, $gradient_type );
						}, 50 );
					},
					clear: function() {
						setTimeout( function() {
							gradient_picker_change( $gradient_wrap, $angle_slider, $range_slider, $gradient_type );
						}, 50 );
					},
					hide: true,
					palettes: true
				};			
			$color_pickers.wpColorPicker( _color_picker );

			$gradient_wrap.on( 'vc.update', function() {
				gradient_picker_change( $gradient_wrap, $angle_slider, $range_slider, $gradient_type );
			} );

			$range_slider.slider( {
				animate:  'fast',
				range:    true,
				min:      parseInt( $range_slider.attr( 'data-min' ) ),
				max:      parseInt( $range_slider.attr( 'data-max' ) ),
				step:     parseInt( $range_slider.attr( 'data-step' ) ),
				values:   [ parseInt( $range_slider.attr( 'data-start-value' ) ), parseInt( $range_slider.attr( 'data-end-value' ) ) ],
				disabled: $gradient_type.is( ':checked' )
			} ).on( 'slide', function( event, ui ) {
				var $this = $( this );

				$this.attr( 'data-start-value', ui.values[ 0 ] ).attr( 'data-end-value', ui.values[ 1 ] );
				$this.parent().siblings( 'label' ).find( 'em' ).text( ui.values[ 0 ] + ' - ' + ui.values[ 1 ] );

				gradient_picker_change( $gradient_wrap, $angle_slider, $range_slider, $gradient_type );
			} );

			$angle_slider.slider( {
				animate:  'fast',
				min:      parseInt( $angle_slider.attr( 'data-min' ) ),
				max:      parseInt( $angle_slider.attr( 'data-max' ) ),
				step:     parseInt( $angle_slider.attr( 'data-step' ) ),
				value:    parseInt( $angle_slider.attr( 'data-value' ) ),
				disabled: $gradient_type.is( ':checked' )
			} ).on( 'slide', function( event, ui ) {
				var $this = $( this );

				$this.attr( 'data-value', ui.value );
				$this.parent().siblings( 'label' ).find( 'em' ).text( ui.value );

				gradient_picker_change( $gradient_wrap, $angle_slider, $range_slider, $gradient_type );
			} );

			$gradient_type.on( 'change', function() {
				var $this = $( this );

				if ( $this.is( ':checked' ) )
					$angle_slider.slider( 'disable' ).closest( '.vc-gradient-slider' ).addClass( 'vc-hidden' );
				else
					$angle_slider.slider( 'enable' ).closest( '.vc-gradient-slider' ).removeClass( 'vc-hidden' );

				gradient_picker_change( $gradient_wrap, $angle_slider, $range_slider, $gradient_type );
			} );

			$gradient_value.on( 'vc.change', function() {
				gradient_value_change( $gradient_wrap, $angle_slider, $range_slider, $gradient_type );
			} );
		} );

	/*} );*/
	function gradient_value_change( $gradient, $angle_slider, $range_slider, $gradient_type ) {
		var $gradient_value    = $gradient.find( '.vc-value' ),
			_gradient_value    = $( '#vc_ui-panel-edit-element .vc_param_value.vc-gradient-value' ).val(),
			_gradient_values   = _gradient_value.split( '||' );

		if ( _gradient_values.length == 5 ) {
			$gradient.find( '.vc-gradient-start' ).val( _gradient_values[ 0 ] ).trigger( 'change' );
			$gradient.find( '.vc-gradient-end' ).val( _gradient_values[ 1 ] ).trigger( 'change' );
			$range_slider.slider( 'values', _gradient_values[ 2 ].split( ';' ) );
			$angle_slider.slider( 'value', _gradient_values[ 3 ] );

			if ( ( _gradient_values[ 4 ] == 'linear' && $gradient_type.is( ':checked' ) ) ||
				( _gradient_values[ 4 ] == 'radial' && ! $gradient_type.is( ':checked' ) ) ) {
				$gradient_type.click();
			}

			setTimeout( function() {				
				$( '#vc_ui-panel-edit-element .vc_param_value.vc-gradient-value' ).val(_gradient_value);
			}, 50 );
		}
	}

	function gradient_picker_change( $gradient_wrap, $angle_slider, $range_slider, $gradient_type ) {		
		
		var $gradient_preview  = $( '#vc_ui-panel-edit-element .vc-gradient-preview' ),
		    $gradient_value    = $( '#vc_ui-panel-edit-element .vc_param_value.vc-gradient-value' ),
		    _start_color       = $('.vc-color-picker.vc-gradient-color-start' ).val(),
		    _end_color         = $( '.vc-color-picker.vc-gradient-color-end' ).val(),
		    _gradient_angle    = $('#vc_ui-panel-edit-element .vc-slider.vc-angle-slider').attr( 'data-value' ) || '0',
		    _start_color_range = $('#vc_ui-panel-edit-element .vc-slider.vc-range-slider').attr( 'data-start-value' ) || 0,
		    _end_color_range   = $('#vc_ui-panel-edit-element .vc-slider.vc-range-slider').attr( 'data-end-value' ) || 100,
		    _type              = $gradient_type.is( ':checked' ) ? 'radial' : 'linear',
		    _angle             = ( _type == 'linear' ) ? _gradient_angle + 'deg' : 'circle',
		    _tmp_color         = '';
		
		
		if( _start_color.length === 0 ) _start_color = 'rgba(0,0,0,0)';
		if( _end_color.length === 0 ) _end_color = 'rgba(0,0,0,0)';
			
		
		$( '#vc_ui-panel-edit-element .vc_param_value.vc-gradient-value' ).val( _start_color + '||' + _end_color + '||' + _start_color_range + ';' + _end_color_range + '||' + _angle.replace( 'deg', '' ) + '||' + _type );

		var _linear_gradient = 'background: ' + _type + '-gradient(' + _angle + ', ' + _start_color + ' ' + _start_color_range + '%, ' + _end_color + ' ' + _end_color_range + '%);';

		_angle = _angle.replace( 'circle', '0' ).replace( 'deg', '' );

		if( 135 <= _angle && _angle < 225 ) {
			_type = 0;

			_tmp_color = _start_color;
			_start_color = _end_color;
			_end_color = _tmp_color;
		} else if( ( 0 <= _angle && _angle < 45 ) || ( 315 <= _angle && _angle < 360 ) ) {
			_type = 0;
		} else if( 45 <= _angle && _angle < 135 ) {
			_type = 1;
		} else if( 225 <= _angle && _angle < 315 ) {
			_type = 1;

			_tmp_color = _start_color;
			_start_color = _end_color;
			_end_color = _tmp_color;
		}

		var _ie_gradient = 'background: filter: progid:DXImageTransform.Microsoft.gradient(GradientType=' + _type + ',startColorstr=' + _start_color + ', endColorstr=' + _end_color + ');';

		$gradient_preview.attr( 'style', _linear_gradient + _ie_gradient );
	}

} )( jQuery );
