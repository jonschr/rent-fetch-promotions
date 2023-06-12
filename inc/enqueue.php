<?php

add_action( 'wp_enqueue_scripts', 'rfp_enqueue' );
function rfp_enqueue() {
	
	// Plugin styles
    wp_enqueue_style( 'rent-fetch-promotions-style', RENTFETCH_PROMOTIONS_URL . 'assets/css/rent-fetch-promotions.css', array(), RENTFETCH_PROMOTIONS_VERSION, 'screen' );
    
    // Script
    wp_register_script( 'rfp-triggers', RENTFETCH_PROMOTIONS_URL . 'assets/js/rfp-triggers.js', array( 'jquery' ), RENTFETCH_PROMOTIONS_VERSION, true );
    wp_register_script( 'html2canvas', 'https://html2canvas.hertzen.com/dist/html2canvas.min.js', array( 'jquery' ), RENTFETCH_PROMOTIONS_VERSION, true );
    wp_register_script( 'rfp-close-bkg-color-detection', RENTFETCH_PROMOTIONS_URL . 'assets/js/rfp-close-bkg-color-detection.js', array( 'html2canvas' ), RENTFETCH_PROMOTIONS_VERSION, true );
    
}

function rfp_enqueue_custom_editor_assets() {
    
    $screen = get_current_screen();
    
    // // bail if we're not on the promotions post type
    // if ( !$screen || $screen->post_type !== 'promotions' )
    //     return;
        
    // Enqueue JavaScript
    wp_enqueue_script(
        'custom-editor-script',
        RENTFETCH_PROMOTIONS_URL . 'assets/js/rfp-custom-editor-scripts.js',
        array( 'wp-blocks', 'wp-dom' ),
        RENTFETCH_PROMOTIONS_VERSION,
        true
    );

    // Enqueue CSS
    wp_enqueue_style(
        'custom-editor-style',
        RENTFETCH_PROMOTIONS_URL . 'assets/css/rfp-custom-editor-style.css',
        array( 'wp-edit-blocks' ),
        RENTFETCH_PROMOTIONS_VERSION,
    );
}
add_action( 'enqueue_block_editor_assets', 'rfp_enqueue_custom_editor_assets' );
