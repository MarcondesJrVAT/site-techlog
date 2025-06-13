(function () {
	"use strict";

		/* ------------------------------------------------------------------------
		   SMALL HEADER
		   ------------------------------------------------------------------------ */
		   jQuery(window).scroll(function() {
		   	var scroll = jQuery(window).scrollTop();
		   	if (scroll >= 250) {
		   		jQuery("body.fixed-header").addClass("smallHeader");
		   		if (scroll >= 350) {
		   			jQuery("body.fixed-header").addClass("active");
		   		}
		   	}
		   	else {
		   		jQuery("body.fixed-header").removeClass("smallHeader active");
		   	}
		   });

		/* ------------------------------------------------------------------------
		Smooth Scroll
		------------------------------------------------------------------------ */
		var $window = $(window, '.cd-testimonials-all .cd-testimonials-all-wrapper');		//Window object

		var scrollTime = 0.6;			//Scroll time
		var scrollDistance = 355;		//Distance. Use smaller value for shorter scroll and greater value for longer scroll

		$window.on("mousewheel DOMMouseScroll", function(event){

			event.preventDefault();

			var delta = event.originalEvent.wheelDelta/125 || -event.originalEvent.detail/3;
			var scrollTop = $window.scrollTop();
			var finalScroll = scrollTop - parseInt(delta*scrollDistance);

			TweenMax.to($window, scrollTime, {
				scrollTo : { y: finalScroll, autoKill:true },
				ease: Power1.easeOut,
				autoKill: true,
				overwrite: 5
			});

		});

	/* ------------------------------------------------------------------------
		   Show Customers
		   ------------------------------------------------------------------------ */

		$('.show-all-customers').on('click', function(e) {
			e.preventDefault();
			var $select = $('.highlighted-sec.clearfix.select');
			var $botao = $(this);

			if(!$select.hasClass('hidden')) {
				$select.addClass('hidden');
				$botao.empty().html('Ver mais usuários');
			} else {
				$select.removeClass('hidden');
				$botao.empty().html('Ver menos usuários');
			}
		})

	/* ------------------------------------------------------------------------
		   ITEM COUNTER
		   ------------------------------------------------------------------------ */
		   var itemcount= 0;

		   $('.pluss-item').on("click", function() {
		   	itemcount++;
		   	$(this).parent().find('.total-items').val(itemcount);
		   });

		   $('.less-item').on("click", function() {
		   	itemcount--;
		   	$(this).parent().find('.total-items').val(itemcount);
		   });




		/* ------------------------------------------------------------------------
		   ADD REVIEW CUSTOM SCRIPT [open/close]
		   ------------------------------------------------------------------------ */
		   jQuery("#add-review-btn").on("click", function() {
		   	jQuery("#add-review-form").slideDown();
		   });
		   jQuery("#review-form-close").on("click", function() {
		   	jQuery("#add-review-form").slideUp();
		   });

		/* ------------------------------------------------------------------------
		   MOBILE MENU
		   ------------------------------------------------------------------------ */
		   jQuery(".main-nav li a").on("click", function() {
		   	jQuery(this).parent("li").find(".dropdown-menu").slideToggle();
		   	jQuery(this).find("i").toggleClass("fa-caret-down fa-caret-up");
		   });
		   jQuery("#review-form-close").on("click", function() {
		   	jQuery("#add-review-form").slideUp();
		   });

		/* ------------------------------------------------------------------------
		   SMOOTH SCROLLING
		   ------------------------------------------------------------------------ */
		   jQuery('.scroll').each( function() {
		   	var $this = jQuery(this),
		   	target = this.hash;
		   	jQuery(this).on("click", function(e) {
		   		e.preventDefault();
		   		if( $this.length > 0 ) {
		   			if($this.attr('href') == '#' ) {
		   			} else {
		   				jQuery('html, body').animate({
		   					scrollTop: (jQuery(target).offset().top) - -1
		   				}, 1000);
		   			}
		   		}
		   	});
		   });




		/* ------------------------------------------------------------------------
		   TESTIMONIAL MODEL
		   ------------------------------------------------------------------------ */
		   $('.cd-see-all').on('click', function(){
		   	$('.cd-testimonials-all').addClass('is-visible');
		   	$('body').css('overflow','hidden');
		   });
		   $('.cd-testimonials-all .close-btn').on('click', function(){
		   	$('.cd-testimonials-all').removeClass('is-visible');
		   	$('body').css('overflow-y','scroll');
		   });
		   $(document).keyup(function(event){
			//check if user has pressed 'Esc'
			if(event.which=='27'){
				$('.cd-testimonials-all').removeClass('is-visible');
			}
		});
		   $('.cd-testimonials-all-wrapper').children('ul').masonry({
		   	itemSelector: '.cd-testimonials-item'
		   });


		   /* SMOOTH SCROLL FOR TESTIMOVIALS WRAPPER */
		var $window2 = $('.cd-testimonials-all .cd-testimonials-all-wrapper');		//Window object

		var scrollTime = 0.6;			//Scroll time
		var scrollDistance = 355;		//Distance. Use smaller value for shorter scroll and greater value for longer scroll

		$window2.on("mousewheel DOMMouseScroll", function(event){

			event.preventDefault();

			var delta = event.originalEvent.wheelDelta/125 || -event.originalEvent.detail/3;
			var scrollTop = $window2.scrollTop();
			var finalScroll = scrollTop - parseInt(delta*scrollDistance);

			TweenMax.to($window2, scrollTime, {
				scrollTo : { y: finalScroll, autoKill:true },
				ease: Power1.easeOut,
				autoKill: true,
				overwrite: 5
			});

		});




		/* ------------------------------------------------------------------------
		   SINGLE ITEM CAROUSEL
		   ------------------------------------------------------------------------ */
		   jQuery('.single-item-carousel').owlCarousel({
		   	items:1,
		   	animateOut: 'fadeOut',
		   	navText:[ '', '' ]
		   })




		/* ------------------------------------------------------------------------
		   TWO ITEMS CAROUSEL
		   ------------------------------------------------------------------------ */
		   jQuery('.two-items-carousel').owlCarousel({
		   	nav:true,
		   	navText:[ '', '' ],
		   	responsive:{
		   		0:{
		   			items:1
		   		},
		   		768:{
		   			items:1
		   		},
		   		979:{
		   			items:2
		   		},
		   		1199:{
		   			items:2
		   		}

		   	}
		   })




		/* ------------------------------------------------------------------------
		   THREE ITEMS CAROUSEL
		   ------------------------------------------------------------------------ */
		   jQuery('.three-items-carousel').owlCarousel({
		   	nav:true,
		   	navText:[ '', '' ],
		   	responsive:{
		   		0:{
		   			items:1
		   		},
		   		768:{
		   			items:2
		   		},
		   		979:{
		   			items:2
		   		},
		   		1199:{
		   			items:3
		   		}

		   	}

		   })

		/* ------------------------------------------------------------------------
		   FANCYBOX
		   ------------------------------------------------------------------------ */
		   jQuery('.fancybox').fancybox({
		   	maxWidth	: 600,
		   	maxHeight	: 800,
		   	fitToView	: false,
		   	width		: '100%',
		   	height		: '70%',
		   	autoSize	: false,
		   	autoHeight : true,
		   	closeClick	: false,
		   	openEffect	: 'none',
		   	closeEffect	: 'none'
		   });

		/* ------------------------------------------------------------------------
		   FANCYBOX MEDIA
		   ------------------------------------------------------------------------ */
		   jQuery('.fancybox-media').fancybox({
		   	openEffect  : 'none',
		   	closeEffect : 'none',
		   	helpers : {
		   		media : {}
		   	}
		   });

		/* ------------------------------------------------------------------------
		   PRODUCT DETAIL
		   ------------------------------------------------------------------------ */
		   jQuery("#product-detail-slider").responsiveSlides({
		   	maxwidth: 1000,
		   	timeout: 3E3,
		   	pager: true,
		   	speed: 700
		   });

		/* ------------------------------------------------------------------------
		   VERTICAL TABS
		   ------------------------------------------------------------------------ */
		   jQuery('.verticalTab').easyResponsiveTabs({
		   	type: 'vertical',
		   	width: 'auto',
		   	fit: true
		   });

		/* ------------------------------------------------------------------------
		   TOGGLES ICON
		   ------------------------------------------------------------------------ */
		   jQuery('.toggle-heading').on('click', function(){
		   	jQuery(this).find('i').toggleClass('fa-minus fa-plus');
		   });

		/* ------------------------------------------------------------------------
		   SEARCH
		   ------------------------------------------------------------------------ */
		   jQuery('.search-trigger').on('click', function(){
		   	jQuery('.search-container').fadeIn();
		   });
		   jQuery('.header-search-close').on('click', function(){
		   	jQuery('.search-container').fadeOut();
		   });

		/* ------------------------------------------------------------------------
			ANIMATIONS
			------------------------------------------------------------------------ */
			jQuery('.animate-it').appear();
			jQuery(document.body).on('appear', '.animate-it', function(e, $affected) {
				var fadeDelayAttr;
				var fadeDelay;
				jQuery(this).each(function(){
					if (jQuery(this).data("delay")) {
						fadeDelayAttr = jQuery(this).data("delay")
						fadeDelay = fadeDelayAttr;
					} else {
						fadeDelay = 0;
					}
					jQuery(this).delay(fadeDelay).queue(function(){
						jQuery(this).addClass('animated').clearQueue();
					});
				})
			});


		/* ------------------------------------------------------------------------
		   ISOTOPE
		   ------------------------------------------------------------------------ */
		   $(window).load(function() {
		   	var $container = $('#cases-container');
		   	$container.isotope({
		   		filter: '*',
		   		animationOptions: {
		   			duration: 750,
		   			easing: 'linear',
		   			queue: false,
		   		}
		   	});

		   	$('.cases-filter-nav li a').on("click", function() {
		   		var selector = $(this).attr('data-filter');
		   		$container.isotope({
		   			filter: selector,
		   			animationOptions: {
		   				duration: 750,
		   				easing: 'linear',
		   				queue: false,
		   			}
		   		});
		   		return false;
		   	});

		   	var $optionSets = $('.cases-filter-nav'),
		   	$optionLinks = $optionSets.find('a');

		   	$optionLinks.on("click", function() {
		   		var $this = $(this);
				  // don't proceed if already selected
				  if ( $this.hasClass('selected') ) {
				  	return false;
				  }
				  var $optionSet = $this.parents('.cases-filter-nav');
				  $optionSet.find('.selected').removeClass('selected');
				  $this.addClass('selected');
				});
		   });

		/* ------------------------------------------------------------------------
		   RANGE SLIDER [price filter]
		   ------------------------------------------------------------------------ */
		   jQuery( "#slider-range" ).slider({
		   	range: true,
		   	min: 24781,
		   	max: 50000,
		   	values: [ 28781,45000],

		   	slide: function( event, ui ) {

		   		jQuery( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		   	},

		   	stop: function(event, ui) {
		   		jQuery( "#sort_price_max" ).val(ui.values[ 1 ] );
		   		jQuery( "#sort_price_min" ).val(ui.values[ 0 ] );
		   	}
		   });
		   jQuery( "#amount" ).val( "$" + jQuery( "#slider-range" ).slider( "values", 0 ) +
		   	" - $" + jQuery( "#slider-range" ).slider( "values", 1 ) );

		})(jQuery);

		/* ------------------------------------------------------------------------
		   FORMS
		   ------------------------------------------------------------------------ */

		   function checkcontact(input)
		   {
		   	var pattern1=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		   	if(pattern1.test(input))
		   	{
		   		return true;
		   	}
		   	else{
		   		return false;
		   	}
		   }


		   function removeChecks(){
		   	var footer_name = document.getElementById("subscribe_name");
		   	var footer_email_address = document.getElementById("subscribe_email");

		   	if(footer_name.value != ""){
		   		footer_name.className = "input";
		   	}
		   	if(footer_email_address.value != "" && checkcontact(footer_email_address.value) == true){
		   		footer_email_address.className = "input";
		   	}

		   }

   			$(".select2").select2();
