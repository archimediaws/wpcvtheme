/*
Template: Sam Martin - Personal Vcard Resume HTML Template
Author: potenzaglobalsolutions.com
Version: 1.0
Design and Developed by: potenzaglobalsolutions.com

NOTE:  

*/
(function($) {
	"use strict";
	/*************************
			Owl carousel
	*************************/

	$('.owl-carousel-1').owlCarousel({
	   items:1,
	   loop:true,
	   autoplay:true,
	   autoplayTimeout:2500,
	   autoplayHoverPause:true, 
	   smartSpeed:800,
	   dots:true,
	   nav:false
	  }); 
	 
	 
	/*************************
		 isotope
	*************************/
	$(window).on("load resize",function(e){
	  var $container = $('.isotope'),
		  colWidth = function () {
			var w = $container.width(), 
			columnNum = 1,
			columnWidth = 0;
		 return columnWidth;
		  },
		 isotope = function () {
		  $container.isotope({
			resizable: true,
			itemSelector: '.grid-item',
			masonry: {
			  columnWidth: colWidth(),
			  gutterWidth: 10
			}
		  });
		};
	  isotope(); 
	  var $isotopefilters = $('.isotope-filters');
	  // bind filter button click
	  $isotopefilters.on( 'click', 'button', function() {
		var filterValue = $( this ).attr('data-filter');
		$container.isotope({ filter: filterValue });
	  });
		// change active class on buttons
	   $isotopefilters.each( function( i, buttonGroup ) {
		  var $buttonGroup = $( buttonGroup );
		  $buttonGroup.on( 'click', 'button', function() {
			$buttonGroup.find('.active').removeClass('active');
			$( this ).addClass('active');
		  });
		}); 
	  }); 
	 
	 /*************************
		  Popup gallery
	*************************/
	$('.popup-portfolio').magnificPopup({
			delegate: 'a.portfolio-img',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			mainClass: 'mfp-img-mobile',
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				titleSrc: function(item) {
					return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
				}
		   }
	});
})(jQuery);
/* Touch Effects */
!function(e){function t(e){return new RegExp("(^|\\s+)"+e+"(\\s+|$)")}function n(e,t){var n=s(e,t)?o:a;n(e,t)}if(Modernizr.touch){var s,a,o;"classList"in document.documentElement?(s=function(e,t){return e.classList.contains(t)},a=function(e,t){e.classList.add(t)},o=function(e,t){e.classList.remove(t)}):(s=function(e,n){return t(n).test(e.className)},a=function(e,t){s(e,t)||(e.className=e.className+" "+t)},o=function(e,n){e.className=e.className.replace(t(n)," ")});var c={hasClass:s,addClass:a,removeClass:o,toggleClass:n,has:s,add:a,remove:o,toggle:n};"function"==typeof define&&define.amd?define(c):e.classie=c,[].slice.call(document.querySelectorAll(".item-hover")).forEach(function(e,t){e.querySelector(".item-info > a").addEventListener("touchstart",function(e){e.stopPropagation()},!1),e.addEventListener("touchstart",function(e){c.toggle(this,"cs-hover")},!1)})}}(window);