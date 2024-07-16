(function($) {
	"use strict";

    var widgetName           = ata_widget_localize.widget_name
    var AtaBackgroundAniamation = function($scope, $) {
    var els = $('.ael')
        for (let index = 1; index < els.length + 1; index++) {
            animateDiv(".el" + index);
        }
        function makeNewPosition() {
            var h  = $(window).height() - 50;
            var w  = $(window).width() - 50;
            var nh = Math.floor(Math.random() * h);
            var nw = Math.floor(Math.random() * w);
            return [nh, nw];
        }

        function animateDiv(myclass) {
            var newq = makeNewPosition();
            $(myclass).animate({
                    top: newq[0],
                    left: newq[1],
                },
                10000,
                function() {
                    animateDiv(myclass);
                }
            );
        }
        var divs      = document.getElementsByClassName('ael');
        var winWidth  = window.innerWidth;
        var winHeight = window.innerHeight;

        // i stands for "index". you could also call this banana or haircut. it's a variable
        for (var i = 0; i < divs.length; i++) {
            var thisDiv           = divs[i];
            var randomTop         = getRandomNumber(0, winHeight);
            var randomLeft        = getRandomNumber(0, winWidth);
            thisDiv.style.opacity = 1;
            thisDiv.style.top     = randomTop + "px";
            thisDiv.style.left    = randomLeft + "px";
        }
        
        function getRandomNumber(min, max) {
            return Math.random() * (max - min) + min;
        }
		
	};
	 $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/'+ widgetName +'.default', AtaBackgroundAniamation);
    });

})(jQuery);

