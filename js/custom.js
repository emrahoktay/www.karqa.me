jQuery(function($){
	// Owl Carousel
	if ( typeof $.fn.owlCarousel === "function" ) {

		// Logo Slider
		var logoSliderLayout = 5;
		var logoSliderOptions = {
			rtl:wenTravelOptions.rtl ? true : false,
			autoHeight:true,
			margin: 40,
			items: 5,
			nav: false,
			dots: false,
			autoplay: true,
			autoplayTimeout: 4000,
			loop: true,
			responsive:{
				0:{
					items:1
				},
				640:{
					items: 2
				},
				1024:{
					items: 4
				},
				1120:{
					items:5
				}
			},
			navText: [wenTravelOptions.iconNavPrev,wenTravelOptions.iconNavNext]
		};

		$(".wen-travel-logo-slider-content-wrapper").owlCarousel(logoSliderOptions);
	}
});