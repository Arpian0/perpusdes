(function ($) {
    "use strict";

    $('body').on('click', '.panel-file-manager', function (e) {
        e.preventDefault();
        $(this).filemanager('file', {prefix: '/laravel-filemanager'});
    });

    $('body').on('change', 'select[name="role"]', function (e) {
        e.preventDefault();

        const $instructorLabel = $('.js-instructor-label');
        const $organizationLabel = $('.js-organization-label');

        if ($(this).val() === 'teacher') {
            $organizationLabel.addClass('d-none');
            $instructorLabel.removeClass('d-none');
        } else {
            $organizationLabel.removeClass('d-none');
            $instructorLabel.addClass('d-none');
        }
    });

    $('body').on('change', 'input[name="id"]', function (e) {
        e.preventDefault();

        $('button#paymentSubmit').removeAttr('disabled');

        const packageId = $(this).val();

        checkPackageHasInstallment(packageId);
    });

    function checkPackageHasInstallment(id) {
        const path = '/become-instructor/packages/' + id + '/checkHasInstallment';
        const $btn = $('.js-installment-btn');
        $btn.addClass('d-none');

        $.get(path, function (result) {
            if (result && result.has_installment) {
                $btn.removeClass('d-none');
                $btn.attr('href', '/become-instructor/packages/' + id + '/installments');
            }
        });
    }


    $('body').on('change', '.js-user-bank-input', function (e) {
        e.preventDefault();

        const $optionSelected = $(this).find("option:selected");
        const specifications = $optionSelected.attr('data-specifications')

        const $card = $('.js-bank-specifications-card');
        let html = '';

        if (specifications) {
            Object.entries(JSON.parse(specifications)).forEach(([index, item], key) => {

                html += '<div class="form-group">\n' +
                    '         <label class="font-weight-500 text-dark-blue">' + item + '</label>\n' +
                    '         <input type="text" name="bank_specifications['+ index +']" value="" class="form-control"/>\n' +
                    ' </div>'
            })
        }

        $card.html(html);
    });

})(jQuery);
