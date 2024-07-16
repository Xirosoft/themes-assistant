(function($) {
	"use strict";
    var widgetName  = ata_widget_localize.widget_name
    var AtaCounter  = function($scope, $) {
        $('.stat-count').onScreen({
            container: window,
            direction: 'vertical',
            doIn: function() {
                $('.stat-count').each(function() {
                    var $this = $(this),
                        countTo = $this.attr('data-count');
                    $({
                        countNum: $this.text()
                    }).animate({
                        countNum: countTo
                    }, {
                        duration: 1000,
                        easing: 'linear',
                        step: function() {
                            $this.text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $this.text(this.countNum);
                            //alert('finished');
                        }
                    });
                });

            },
            doOut: function() {
                // Do something to the matched elements as they get off scren
            }
        });
	};
	 $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/'+ widgetName +'.default', AtaCounter);
    });

})(jQuery);


