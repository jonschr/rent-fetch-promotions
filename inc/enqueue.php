<?php

add_action( 'wp_enqueue_scripts', 'na_enqueue' );
function na_enqueue() {
	
	// Plugin styles
    wp_enqueue_style( 'bullhorn-style', BULLHORN_URL . 'assets/css/bullhorn.css', array(), BULLHORN_VERSION, 'screen' );
    
    // Script
    wp_register_script( 'bullhorn-triggers', BULLHORN_URL . 'assets/js/bullhorn-triggers.js', array( 'jquery' ), BULLHORN_VERSION, true );
    wp_register_script( 'html2canvas', 'https://html2canvas.hertzen.com/dist/html2canvas.min.js', array( 'jquery' ), BULLHORN_VERSION, true );
    wp_register_script( 'bullhorn-close-bkg-color-detection', BULLHORN_URL . 'assets/js/bullhorn-close-bkg-color-detection.js', array( 'html2canvas' ), BULLHORN_VERSION, true );
    
}

function enqueue_custom_editor_assets() {
    
    $screen = get_current_screen();
    
    // // bail if we're not on the promotions post type
    // if ( !$screen || $screen->post_type !== 'promotions' )
    //     return;
        
    // Enqueue JavaScript
    wp_enqueue_script(
        'custom-editor-script',
        BULLHORN_URL . 'assets/js/custom-editor-scripts.js',
        array( 'wp-blocks', 'wp-dom' ),
        BULLHORN_VERSION,
        true
    );

    // Enqueue CSS
    wp_enqueue_style(
        'custom-editor-style',
        BULLHORN_URL . 'assets/css/custom-editor-style.css',
        array( 'wp-edit-blocks' ),
        BULLHORN_VERSION
    );
}
add_action( 'enqueue_block_editor_assets', 'enqueue_custom_editor_assets' );

