(function($) {
	"use strict";
    var widgetName = ata_widget_localize.widget_name
    var WidgetJsonBasedLottiesAnimationHandler = function($scope, $) {
		var container = $scope.find('.ata-lottie__container'),            
            data_id = container.data("id"),


			data_id 					= container.data("id"),              
			data_path					= container.data("path"),
			data_trigger        		= container.data("trigger"),
			data_loop					= container.data("loop"),
			data_anim_renderer    		= container.data("anim_renderer"),
			data_hover_area       		= container.data("hover-area"),
			data_direction        		= container.data("direction"),
			data_on_hover_out     		= container.data("on-hover-out");

			var container_id = $(container).find('.ata-lottie__animation');

			var kap_lotties_animation = bodymovin.loadAnimation({
				container: container_id[0],
				renderer: data_anim_renderer,
				loop: data_loop,
				direction: data_direction,
				autoplay: (data_trigger === 'autoplay') ? true : false,
				path: data_path
			});



			if(data_trigger === 'on_hover'){				
				jQuery(container).mouseenter(function() {
					kap_lotties_animation.play();
					console.log('enter');
				})
			}
			if(data_trigger === 'on_hover'){				
				jQuery(container).mouseout(function() {
					kap_lotties_animation.stop();
					console.log('out');
				})
			}

			
		
		if(data_trigger){
			
			if(data_trigger === 'bind_to_scroll'){
				$(container).onScreen({
					container: window,
					direction: "vertical",
					doIn: function () {
						$(container).each(function () {
							kap_lotties_animation.play();
							// console.log('scroll IN');

						});
					},
					doOut: function () {
						kap_lotties_animation.stop();
						// Do something to the matched elements as they get off scren
						// console.log('scroll out');
					},
				});
			}
		}
		
	};
	 $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/'+ widgetName +'.default', WidgetJsonBasedLottiesAnimationHandler);
    });

})(jQuery);

