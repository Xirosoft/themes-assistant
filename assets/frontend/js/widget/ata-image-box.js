jQuery(document).ready(function ($) {
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
});