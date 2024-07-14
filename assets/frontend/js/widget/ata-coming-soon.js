(function($) {
	"use strict";
    var CountDownTimer = function($scope, $) {
        var clock = $('#clock');
        if ($(clock).length > 0) {
            var date = $(clock).data('date');
            $(clock).countdown(date).on('update.countdown', function(event) {
                var $this = $(this).html(event.strftime('' +
                    '<p><span class="label">week%!w</span> <span class="time-value">%-w</span> </p>' +
                    '<p><span class="label">day%!d</span> <span class="time-value">%-d</span> </p>' +
                    '<p><span class="label">hr</span> <span class="time-value">%H</span> </p>' +
                    '<p><span class="label">min</span> <span class="time-value">%M</span> </p>' +
                    '<p><span class="label">sec</span> <span class="time-value">%S</span> </p>'));
            });
        }
	};
	 $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/'+ata_widget_localize.widget_name+'.default', CountDownTimer);
    });

})(jQuery);


