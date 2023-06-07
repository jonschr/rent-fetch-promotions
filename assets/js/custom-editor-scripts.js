window.onload = function () {
    var widthInput = document.querySelector('#width');
    var wpBlocks = document.querySelectorAll('.is-root-container > .wp-block');

    function setWidth() {
        var widthValue = widthInput.value + 'px';
        wpBlocks.forEach(function (block) {
            block.style.width = widthValue;
            block.style.maxWidth = widthValue;
        });
    }

    // Set initial width
    setWidth();

    // Update width when input changes
    widthInput.addEventListener('input', setWidth);

    // Promise to wait for .is-root-container
    new Promise(function (resolve) {
        var rootContainerObserver = new MutationObserver(function (
            mutations,
            observer
        ) {
            if (document.querySelector('.is-root-container')) {
                observer.disconnect();
                resolve();
            }
        });
        rootContainerObserver.observe(document.body, {
            childList: true,
            subtree: true,
        });
    }).then(function () {
        // Now that .is-root-container exists, start observing for .wp-block elements
        var wpBlockObserver = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                if (mutation.type === 'childList') {
                    wpBlocks = document.querySelectorAll(
                        '.is-root-container > .wp-block'
                    );
                    setWidth();
                }
            });
        });

        wpBlockObserver.observe(document.querySelector('.is-root-container'), {
            childList: true, // observe direct children
            subtree: true, // and lower descendants too
        });
    });
};
