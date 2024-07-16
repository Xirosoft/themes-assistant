(function($) {
	"use strict";
    var widgetName = ata_widget_localize.widget_name
    var AtaTimeTable     = function($scope, $) {
        $('.nav-link').on('click', function(e) {
            e.preventDefault();
    
            // Remove active class from all tab links and tab content
            $('.nav-link').removeClass('active');
            $('.tab-pane').removeClass('active show');
    
            // Add active class to the clicked tab link
            $(this).addClass('active');
    
            // Get the target tab content's ID
            var target = $(this).attr('href');
    
            // Show the corresponding tab content
            $(target).addClass('active show');
        });
	};
	 $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/'+ widgetName +'.default', AtaTimeTable);
    });

})(jQuery);


