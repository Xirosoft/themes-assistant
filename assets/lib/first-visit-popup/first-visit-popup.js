/**
* First Visit Popup
*/
jQuery(function ($) {

    var popup_set_time = popup_data.popup_set_time;
    var popup_interval = popup_data.popup_interval;
    // Now you can use these values in your jQuery code

    $.fn.firstVisitPopup = function (settings) {
        var $body = $('body');
        var $dialog = $(this);
        var $blackout;
        var setCookie = function (name, value) {
            var date = new Date(),
                expires = 'expires=';
            date.setTime(date.getTime() + (10*60*popup_set_time)); //86400000 => 10min
            expires += date.toGMTString();
            document.cookie = name + '=' + value + '; ' + expires + '; path=/';
        }
        var getCookie = function (name) {
            var allCookies = document.cookie.split(';'),
                cookieCounter = 0,
                currentCookie = '';
            for (cookieCounter = 0; cookieCounter < allCookies.length; cookieCounter++) {
                currentCookie = allCookies[cookieCounter];
                while (currentCookie.charAt(0) === ' ') {
                    currentCookie = currentCookie.substring(1, currentCookie.length);
                }
                if (currentCookie.indexOf(name + '=') === 0) {
                    return currentCookie.substring(name.length + 1, currentCookie.length);
                }
            }
            return false;
        }
        var showMessage = function () {
            $blackout.show();
            $dialog.show();
        }
        var hideMessage = function () {
            $blackout.hide();
            $dialog.hide();
            setCookie('fvpp' + settings.cookieName, 'true');
        }

        $body.append('<div id="fvpp-blackout"></div>');
        $dialog.append('<a id="fvpp-close">&times;</a>');
        $blackout = $('#fvpp-blackout');

        if (getCookie('fvpp' + settings.cookieName)) {
            hideMessage();
        } else {
            showMessage();
        }

        $(settings.showAgainSelector).on('click', showMessage);
        $body.on('click', '#fvpp-blackout, #fvpp-close', hideMessage);

    };


    setTimeout(() => {
        $('#borax-welcome-message').firstVisitPopup({
            cookieName : 'borax-promo',
            // showAgainSelector: '#show-message'
        });
    }, popup_set_time)
});
