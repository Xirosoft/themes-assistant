(function($) {
    function feedbackfunc(selector, next, prev) {
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
                rtl: rtlSlide,
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
                        items: 1
                },
                1000: {
                        items: 1
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
    feedbackfunc('.hero-slide', '.home-next', '.home-prev');
})(jQuery);