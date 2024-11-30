(function($) {
	"use strict";
    var widgetName = ata_widget_localize.widget_name
    var AtaFaq = function($scope, $) {
        $('.btn-link').on('click', function() {
            var $this = $(this);
            var $target = $($this.data('target'));
    
            if ($target.hasClass('ata-show')) {
                $target.removeClass('ata-show');
                $this.parents('.card').removeClass('active'); // Remove active class if the section is hidden
            } else {
                $('.ata-collapse').removeClass('ata-show'); // Hide all other sections
                $('.card').removeClass('active'); // Remove active class from all cards
                $target.addClass('ata-show'); // Show the target section
                $this.parents('.card').addClass('active'); // Add active class to the parent card
            }
        });
    };
	 $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/'+ widgetName +'.default', AtaFaq);
    });

})(jQuery);


