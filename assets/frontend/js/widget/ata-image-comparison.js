(function($) {
	"use strict";
    var ImageComparisaion = function($scope, $) {
        /*  Before/After */
        var image_offset    = $('.comporision-slider').data('offset');
        var orientation     = $('.comporision-slider').data('orient');
        var beforelabel     = $('.comporision-slider').data('belabel');
        var afterlabel      = $('.comporision-slider').data('aflabel');
        var no_overlay      = $('.comporision-slider').data('overl');
        var clickOption     = $('.comporision-slider').data('click');
        console.log(image_offset);
        if (clickOption == 'yes') {
            clickOption = false;
        }else{
            clickOption = true;
        }
        if (no_overlay == 'yes') {
            no_overlay = true;
        }else{
            no_overlay = false;
        }
        if($('.ata-image-diff').length > 0){
            $(".ata-image-diff").twentytwenty({
                default_offset_pct: image_offset, // How much of the before image is visible when the page loads
                orientation: orientation, // Orientation of the before and after images ('horizontal' or 'vertical')
                before_label: beforelabel, // Set a custom before label
                after_label: afterlabel, // Set a custom after label
                no_overlay: no_overlay, //Do not show the overlay with before and after
                move_slider_on_hover: clickOption, // Move slider on mouse hover?
                move_with_handle_only: true, // Allow a user to swipe anywhere on the image to control slider movement. 
                click_to_move: false, // Allow a user to click (or tap) anywhere on the image to move the slider to that location.
            });
        }
	};
	 $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/'+ata_widget_localize.widget_name+'.default', ImageComparisaion);
    });

})(jQuery);


