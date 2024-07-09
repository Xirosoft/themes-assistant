jQuery(document).ready(function($) {

    console.log(ata_ajax_localize.ajax_url);
    /**
     * Window loading method call
     */
    $(window).on("load", function () {
        var popup = $('<div class="ata__popup"></div>  <div id="toast-container"></div>');
        $("body").append(popup);
    });


    var $inputSelector = $('.form-container .switch input[type="checkbox"]'),
        $enableAll = $('#enable-all'),
        $disableAll = $('#disable-all'),
        $switchAllInput = $('#switch-all-input');

    $enableAll.on('click', function() {
        $inputSelector.prop('checked', true);
    });

    $disableAll.on('click', function() {
        $inputSelector.prop('checked', false);
    });

    $switchAllInput.on('change', function() {
        var isChecked = $(this).prop('checked');
        $inputSelector.prop('checked', isChecked);
    });

    // fancybox
    // $('.switch-btn a').fancybox({
    //     type: "iframe",
    // })

    /**
     * ATA Elements submit action
     */
    $("#ata_save_element").on("click", function (e) {
        e.preventDefault();
        // Serialize the form data
        var ataElementsData = $("#ata_elements_form").serialize();
        console.log(ataElementsData);
        $.ajax({
            url: ata_ajax_localize.ajax_url, // WordPress AJAX URL
            type: 'POST',
            data: {
                action: 'elements_settings',
                ataElementsData: ataElementsData,
                nonce: ata_ajax_localize.nonce
            },
            success: function(response) {
                console.log(response);
                showToast(response.success, "toast-success");
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                showToast('Something wrong! Please check the setting options', "toast-error");
                console.error('AJAX Error: ' + textStatus, errorThrown);
            }
        });


        return false;
        
    });

    /**
     * Show Toast
     * @param {*} message 
     * @param {*} styleClass  showToast("Warning!", "toast-warning"); showToast("Success!", "toast-success"); showToast("Error!", "toast-error");
     */
    function showToast(message, styleClass) {
        const toast = $("<div>", {
            class: "toast " + styleClass,
            text: message,
        });

        const closeButton = $("<span>", {
            class: "close-button",
            text: "×",
        });

        closeButton.click(function() {
            toast.remove();
        });

        toast.append(closeButton);

        $("#toast-container").append(toast);

        setTimeout(function() {
            toast.css("opacity", 1);
        }, 100);

        setTimeout(function() {
            toast.css("opacity", 0);
        }, 3000);

        setTimeout(function() {
            toast.remove();
        }, 3300);
    }



});

