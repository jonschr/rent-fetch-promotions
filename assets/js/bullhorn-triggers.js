jQuery(document).ready(function ($) {
    $('.bullhorn-button').click(function (event) {
        event.preventDefault(); // Disable default event

        var buttonValue = $(this).data('button');
        var promotionValue = $(
            '.bullhorn-container[data-promotion="' + buttonValue + '"]'
        ).data('promotion');

        if (promotionValue) {
            $(
                '.bullhorn-container[data-promotion="' + buttonValue + '"]'
            ).addClass('active');
            $('.bullhorn-container-bkg').addClass('active');
            $(this).addClass('active');
        }
    });

    $('.bullhorn-container-bkg, .bullhorn-close').click(function (event) {
        event.preventDefault(); // Disable default event

        $('.bullhorn-container').removeClass('active');
        $('.bullhorn-container-bkg').removeClass('active');
        $('.bullhorn-button').removeClass('active');
    });
});
