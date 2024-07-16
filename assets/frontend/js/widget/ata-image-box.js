(function($) {
	"use strict";
    var widgetName = ata_widget_localize.widget_name
    var AtaFaq     = function($scope, $) {
        if (jQuery(".animation").length > 0) {
            jQuery(".animation").each(function() {
                jQuery(this).onScreen({
                    container: window,
                    direction: "vertical",
                    doIn: function() {
                        jQuery(this).addClass("animationActive");
                    },
                    doOut: function() {
                        jQuery(this).removeClass("animationActive");
                        // Do something to the matched elements as they get off scren.
                    },
                });
            });
        }
	};
	 $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/'+ widgetName +'.default', AtaFaq);
    });

})(jQuery);


