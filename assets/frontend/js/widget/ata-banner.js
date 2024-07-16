(function($) {
	"use strict";
    var widgetName = ata_widget_localize.widget_name
    var AtaBanner     = function($scope, $) {
        
	};
	 $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/'+ widgetName +'.default', AtaBanner);
    });

})(jQuery);


