(function($) {
	"use strict";
    var widgetName = ata_widget_localize.widget_name
    var AtaTimeTable     = function($scope, $) {
        // $('.nav-link').on('click', function(e) {
        //     e.preventDefault();
    
        //     // Remove active class from all tab links and tab content
        //     $('.nav-link').removeClass('active');
        //     $('.tab-pane').removeClass('active show');
    
        //     // Add active class to the clicked tab link
        //     $(this).addClass('active');
    
        //     // Get the target tab content's ID
        //     var target = $(this).attr('href');
    
        //     // Show the corresponding tab content
        //     $(target).addClass('active show');
        // });
        
            const tabs = document.querySelectorAll('.ata-nav-link');
            const panes = document.querySelectorAll('.ata-tab-pane');
        
            tabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    const target = this.getAttribute('data-tab');
        
                    // Remove active classes
                    tabs.forEach(t => t.classList.remove('active'));
                    panes.forEach(p => p.classList.remove('active'));
        
                    // Add active class to clicked tab and corresponding pane
                    this.classList.add('active');
                    document.getElementById(target).classList.add('active');
                });
            });
        
	};
	 $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/'+ widgetName +'.default', AtaTimeTable);
    });

})(jQuery);


