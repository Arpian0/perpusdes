(function ($) {
    "use strict";

    $('body').on('change', '#heroSection1', function (e) {
        e.preventDefault();

        if (this.checked) {
            $('#heroSection2').prop('checked', false);
        } else {
            $('#heroSection2').prop('checked', false);
        }
    });

    $('body').on('change', '#heroSection2', function (e) {
        e.preventDefault();

        if (this.checked) {
            $('#heroSection1').prop('checked', false);
        } else {
            $('#heroSection1').prop('checked', false);
        }
    });

    $('body').on('change', '#loginDeviceLimit', function (e) {
        e.preventDefault();
        const $input = $('.js-device-limit-number');

        if (this.checked) {
            $input.removeClass('d-none');
        } else {
            $input.addClass('d-none');
        }
    });
})(jQuery);
