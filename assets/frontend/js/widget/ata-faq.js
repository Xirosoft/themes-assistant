(function($) {
	"use strict";
    var widgetName = ata_widget_localize.widget_name
    var AtaFaq     = function($scope, $) {
        $('.btn-link').on('click', function() {
            var $this = $(this);
            var $target = $($this.data('target'));
        
            if ($target.hasClass('ata-show')) {
                $target.removeClass('ata-show');
            } else {
                $('.ata-collapse').removeClass('ata-show'); // Hide all other sections
                $target.addClass('ata-show'); // Show the target section
            }
        });
	};
	 $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/'+ widgetName +'.default', AtaFaq);
    });

})(jQuery);


