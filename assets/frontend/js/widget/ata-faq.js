$('.btn-link').on('click', function() {
    var $this = $(this);
    var $target = $($this.data('target'));

    if ($target.hasClass('show')) {
        $target.removeClass('show');
    } else {
        $('.collapse').removeClass('show'); // Hide all other sections
        $target.addClass('show'); // Show the target section
    }
});