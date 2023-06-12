jQuery(document).ready(function ($) {
    $('.rfp-button').click(function (event) {
        event.preventDefault(); // Disable default event

        var buttonValue = $(this).data('button');
        var promotionValue = $(
            '.rfp-container[data-promotion="' + buttonValue + '"]'
        ).data('promotion');

        if (promotionValue) {
            $('.rfp-container[data-promotion="' + buttonValue + '"]').addClass(
                'active'
            );
            $('.rfp-container-bkg').addClass('active');
            $(this).addClass('active');
        }
    });

    $('.rfp-container-bkg, .rfp-close').click(function (event) {
        event.preventDefault(); // Disable default event

        $('.rfp-container').removeClass('active');
        $('.rfp-container-bkg').removeClass('active');
        $('.rfp-button').removeClass('active');
    });
});
