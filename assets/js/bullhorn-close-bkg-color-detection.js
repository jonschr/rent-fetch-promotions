jQuery(document).ready(function ($) {
    $('.bullhorn-close').each(function () {
        var $element = $(this);

        // Get the position and dimensions of the .bullhorn-close element
        var elementOffset = $element.offset();
        var elementWidth = $element.outerWidth();
        var elementHeight = $element.outerHeight();

        // Capture a screenshot of the area behind the .bullhorn-close element
        html2canvas(document.body, {
            x: elementOffset.left,
            y: elementOffset.top,
            width: elementWidth,
            height: elementHeight,
            logging: false, // Disable logging
        }).then(function (canvas) {
            // Get the average color from the captured screenshot
            var ctx = canvas.getContext('2d');
            var pixelData = ctx.getImageData(
                0,
                0,
                elementWidth,
                elementHeight
            ).data;
            var totalPixels = pixelData.length / 4;
            var totalRed = 0;
            var totalGreen = 0;
            var totalBlue = 0;

            // Calculate the total sum of RGB values
            for (var i = 0; i < pixelData.length; i += 4) {
                totalRed += pixelData[i];
                totalGreen += pixelData[i + 1];
                totalBlue += pixelData[i + 2];
            }

            // Calculate the average RGB values
            var averageRed = Math.round(totalRed / totalPixels);
            var averageGreen = Math.round(totalGreen / totalPixels);
            var averageBlue = Math.round(totalBlue / totalPixels);

            // Convert the average RGB values to a CSS color string
            var averageColor =
                'rgb(' +
                averageRed +
                ', ' +
                averageGreen +
                ', ' +
                averageBlue +
                ')';

            console.log(averageColor);

            // Check if the average color is defined and not transparent
            if (averageColor && averageColor !== 'transparent') {
                // Calculate the luminance using the average RGB values
                var luminance =
                    0.299 * averageRed +
                    0.587 * averageGreen +
                    0.114 * averageBlue;

                // Add the appropriate class based on luminance to the nearest .post-edit-link element
                var $container = $element.closest('.bullhorn-container');
                if (luminance < 128) {
                    $container.addClass('dark-bkg');
                } else {
                    $container.addClass('light-bkg');
                }
            }
        });
    });
});
