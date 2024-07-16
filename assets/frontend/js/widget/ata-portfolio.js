(function($) {
	"use strict";
    var widgetName   = ata_widget_localize.widget_name
    var AtaPortfolio = function($scope, $) {
        if ($(".portGrid").length > 0) {
			var $container = $(".portGrid");
			$container.isotope({
				filter: "*",
				animationOptions: {
					duration: 750,
					easing: "linear",
					queue: false,
				},
			});

			$(".filters button").on("click", function () {
				$(".filters .active").removeClass("active");
				$(this).addClass("active");
				var leftPosition = $(this).position();
				var btnOverlay = $('.btn-overlay')
				// console.log(leftPosition);
				$('.btn-overlay').css('left', leftPosition.left);
				var selector = $(this).attr("data-filter");
				$container.isotope({
					filter: selector,
					animationOptions: {
						duration: 750,
						easing: "linear",
						queue: false,
					},
				});
				return false;
			});
		}
	};
	 $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/'+ widgetName +'.default', AtaPortfolio   );
    });

})(jQuery);


