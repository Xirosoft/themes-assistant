
(function($) {
	"use strict";
    var widgetName = ata_widget_localize.widget_name
    var AtaLogoSlider = function($scope, $) {

        function AtaSlider(selector, next, prev) {
            var snav = $(selector).data('nav');
            var scontrol = $(selector).data('control');
            var sautoplay = $(selector).data('autoplay');
            var sloop = $(selector).data('loop');
            var rtlSlide = $(selector).data('rtl');
            var feedCaro = $(selector);
            if (rtlSlide == 'yes') {
                rtlSlide = true;
            } else {
                rtlSlide = false;
            }
            $(feedCaro).owlCarousel({
                loop: sloop,
                center: true,
                margin: 30,
                nav: snav,
                dots: scontrol,
                autoplay: sautoplay,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    992: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            });
            var owl = $(feedCaro);
            owl.owlCarousel();
            $(next).on('click', function() {
                owl.trigger('next.owl.carousel');
            });
            $(prev).on('click', function() {
                owl.trigger('prev.owl.carousel', [300]);
            });
        }
        AtaSlider('.partners-logo', '.home-next', '.home-prev');
	};
	 $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/'+ widgetName +'.default', AtaLogoSlider);
    });

})(jQuery);