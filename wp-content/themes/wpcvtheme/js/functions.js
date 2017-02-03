(function($){

	"use strict"; 

	jQuery(window).load(function() {

		// MASSONRY Without jquery

		var container = document.querySelector('#massonry-container');		

		if(container != null){

			var msnry = new Masonry( container, {

				itemSelector: 'article.massonry-item',

				columnWidth: 'article.massonry-item',

				isOriginLeft: (jQuery( "body" ).hasClass( "rtl" )) ? false :true,

			});  

		}



	});

	/*Facebook share */

	jQuery('.facebook-share').on('click', function() {

		var $url = jQuery(this).attr('data-url');

		window.open('https://www.facebook.com/sharer/sharer.php?u=' + $url, "facebookWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0");

		return false;

    });

	/*twitter share */

	jQuery('.twitter-share').on('click', function() {

        var $this = jQuery(this),

            $url = $this.attr('data-url'),

            $title = $this.attr('data-title');



            window.open('http://twitter.com/intent/tweet?text=' + $title + ' ' + $url, "twitterWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0");

        return false;

    });

	

	/*pinterest share */

    jQuery('.pinterest-share').on('click', function() {

		var $this = jQuery(this),

			$url = $this.attr('data-url'),

			$title = $this.attr('data-title'),

			$image = $this.attr('data-image');

		window.open('http://pinterest.com/pin/create/button/?url=' + $url + '&media=' + $image + '&description=' + $title, "twitterWindow", "height=320,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0");

		return false;

    });



    /*googleplus share */

    jQuery('.googleplus-share').on('click', function() {

		var $url = jQuery(this).attr('data-url');

		window.open('https://plus.google.com/share?url=' + $url, "googlePlusWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0");

		return false;

    });



	/*linkedin share */

    jQuery('.linkedin-share').on('click', function() {

		var $this = jQuery(this),

			$url = $this.attr('data-url'),

			$title = $this.attr('data-title'),

			$desc = $this.attr('data-desc');

		window.open('http://www.linkedin.com/shareArticle?mini=true&url=' + $url + '&title=' + $title + '&summary=' + $desc, "linkedInWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0");

		return false;

    });

	

	

	/*************************

         chart

	*************************/

	jQuery('.language-skills').appear(function() {

			var data_barcolor=jQuery('.chart').attr('data-barcolor');

			data_barcolor=(data_barcolor!='')? data_barcolor: '#07cb79';

			jQuery('.chart').easyPieChart({

				easing: 'easeOutBounce',

				lineWidth: 8,

				size: 150,

				scaleColor: false,

				barColor: data_barcolor,

				trackColor: '#f7f7f7',

				animate: 7000,

				onStep: function(from, to, percent) {

					$(this.el).find('.percent').text(Math.round(percent));

				}

			});

		  

		   },

	  {

	 offset: 400 

	});

	

	/*************************

        Menu scroll

	*************************/

	jQuery('body.home #main-menu-container #navbar,.scroll-down').on( "click", function(e) {

		if ( jQuery(e.target).is('a') && jQuery(e.target).attr('href').search("#")!=-1) {			

			if (location.pathname.replace(/^\//,'') == e.target.pathname.replace(/^\//,'') && location.hostname == e.target.hostname) {

				var target = jQuery(e.target.hash);

				target = target.length ? target : jQuery('[name=' + e.target.hash.slice(1) +']');

				if (target.length) {

					var gap = 0; 

					if($("#site-header").length != 0) gap = 75; 

                    else if($("#center-header").length != 0) gap = 40; 

					jQuery('html,body').animate({

					  scrollTop: target.offset().top - gap

					}, 900);

						 

				 }

			}

			return false;

		}

	});

	jQuery( "#navbar li.page-scroll a" ).click(function() {

		 jQuery( ".main-navigation.navbar-collapse" ).removeClass( "toggled" );

	});

	 jQuery(window).scroll(function () {

       if (!jQuery('.header').hasClass('no-sticky')) {

            if (jQuery(this).scrollTop() > 10) {      

                jQuery('.header').addClass('sticky');

               }

             else {

                jQuery('.header').removeClass('sticky');

            }

          }

     });

	jQuery('body').scrollspy({ 

		target: '.main-navigation',

		offset: 80

	})

	

	jQuery(".dropdown-menu").hide();

	jQuery(".dropdown-toggle").show();



	jQuery('.dropdown-toggle').click(function(){

		/*console.log(jQuery(".dropdown-menu").is(":visible"));*/

		var menu_id=jQuery(this).parent('li').attr('id');		

		jQuery( ".dropdown-menu" ).each(function( index ) {

			/*console.log(menu_id+"=="+jQuery(this).parent('li').attr('id') +"=="+ jQuery(this).is(":visible"));*/

			if(menu_id!=jQuery(this).parent('li').attr('id') && jQuery(this).is(":visible")){

				jQuery(this).parent('li').children('.dropdown-menu').hide();

				/*console.log(jQuery(this).is(":visible"));*/

			}

		});			

		

		jQuery(this).parent('li').children('.dropdown-menu').slideToggle();

		/*jQuery(".dropdown-menu").slideToggle();*/

	});


jQuery('.site-content,.page-header,#primary').on('click', function (e) {
if (jQuery('.dropdown-menu').is(':visible')) {
    
	jQuery( ".dropdown-menu" ).slideUp( "3000", function() {
    
  });
} 

else {

}

});



	

	/*************************

		matchHeight

	*************************/

	/*$('body.blog .content-area article.post').matchHeight();*/

	$('.vc_wp_posts .recent-post').matchHeight();

	

	/*************************

	typer

	*************************/

	if( $(".typer-content").length != 0 ) {

		var win = $(window);

		var typers = $('.typer-content');

		

		jQuery(typers).each( function( i, ele ) {

			var typer = $(ele);

			var typer_raw = $(typer).find('.typer_data').children('*');

			var typer_data =jQuery.map( typer_raw, function( a ) {

				return a.outerHTML;

			});

			

			typer.typer(typer_data);

		

			win.resize(function(){

				var fontSize = Math.max(Math.min(win.width() / (1 * 10), parseFloat(Number.POSITIVE_INFINITY)), parseFloat(Number.NEGATIVE_INFINITY));

					typer.css({

					fontSize: fontSize * .3 + 'px'

				});

			}).resize();

		});

	}

	

	/*************************

		Add calendar Events

	*************************/

	

	if( $(".sm_availability_calendar").length != 0 ) {

		var availability_calendars = $('.sm_availability_calendar');

		jQuery(availability_calendars).each( function( i, ele ) {

			var availability_calendar = $(ele);

			

			var calendar_id = $(availability_calendar).find('.sm_availability_calendar_datepicker').attr('id');

			

			var calendar_data = $(availability_calendar).find('.calendar_data').html();

			var events = eval(calendar_data);

			

			$("#"+calendar_id).datepicker({

				dateFormat: 'DD, d MM, yy',

				beforeShowDay: function(date) {

					var result = [true, '', null];

					var matching = $.grep(events, function(event) {

						return event.Date.valueOf() === date.valueOf();

					});

					

					if (matching.length) {

						result = [true, 'highlight', null];

					}

				   var date = $(this).datepicker('getDate');

				   $('#'+calendar_id+'_day').html($.datepicker.formatDate('DD', date));

				   $('#'+calendar_id+'_month').html($.datepicker.formatDate('MM', date));

				   $('#'+calendar_id+'_date').html($.datepicker.formatDate('d', date));

					return result;

				},

				onSelect: function(dateText) {

					var date,

						selectedDate = new Date(dateText),

						i = 0,

						event = null;

					

					while (i < events.length && !event) {

						date = events[i].Date;

						

						if (selectedDate.valueOf() === date.valueOf()) {

							event = events[i];

						}

						i++;

					}

					if (event) {

						alert(event.Title);

					}

				}

			});

		});

	}

})(jQuery);