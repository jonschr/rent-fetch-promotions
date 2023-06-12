<?php

add_action( 'wp_footer', 'rfp_query_buttons' );
function rfp_query_buttons() {
    
    if ( is_singular( 'promotions' ) )
        return;
    
    $button_positions = rfp_get_meta_values( 'button_position', 'promotions' );

    // Check if any unique values are found
    if (!empty($button_positions)) {
                
        // Loop through the unique values
        foreach ($button_positions as $position) {

            // Query posts for each button position
            $args = array(
                'post_type'      => 'promotions',
                'posts_per_page' => -1,
                'meta_query'     => array(
                    array(
                        'key'     => 'button_position',
                        'value'   => $position,
                        'compare' => '='
                    )
                )
            );
            
            $button_query = new WP_Query($args);

            // Check if any posts are found for the current position
            if ($button_query->have_posts()) {
                                
                printf( '<div class="rfp-button-wrap %s">', $position );
                
                    // Loop through the posts
                    while ($button_query->have_posts()) {
                        $button_query->the_post();
                                                
                        do_action( 'rfp_do_button' );
                    
                    }
                
                echo '</div>'; // End .rfp-button-wrap
                
            }

            // End wrapping div
            // echo '</div>';

            // Restore original post data
            wp_reset_postdata();
        }
    }

}

add_action( 'rfp_do_button', 'rfp_button_template_selection' );
function rfp_button_template_selection() {
    
    $button_style = esc_html( get_post_meta( get_the_ID(), 'button_style', true ) );
                        
    if ( $button_style == 'simple' || !$button_style )
        do_action( 'rfp_do_simple_button' );
    
    if ( $button_style == 'fancy' )
        do_action( 'rfp_do_fancy_button' );
}

add_action( 'rfp_do_simple_button', 'rfp_simple_button' );
function rfp_simple_button() {
    
    $label = esc_html( get_post_meta( get_the_ID(), 'button_label', true ) );
    $button_bg_color = esc_html( get_post_meta( get_the_ID(), 'button_bg_color', true ) );
    $button_text_color = esc_html( get_post_meta( get_the_ID(), 'button_text_color', true ) );
    $override_url = esc_url( get_post_meta( get_the_ID(), 'override_url', true ) );
    
    if ( $override_url ) {
        
        // get the base url for this website
        $base_url = get_site_url();
        
        // if the base_url string is part of the override_url string
        if ( strpos( $override_url, $base_url ) !== false ) {
            
            // set $target to _self
            $target = '_self';
            
        } else {
            
            // set $target to _blank
            $target = '_blank';
            
        }
        
        printf( '<a href="#" class="rfp-button rfp-button-%s" target="_blank">%s</a>', get_the_ID(), $label );
        
    } else {
        
        // display a button using the meta value for button_label
        printf( '<a href="#" class="rfp-button rfp-button-%s" data-button="%s">%s</a>', get_the_ID(), get_the_ID(), $label );
        
    }
    
    ?>
    <style>
        .rfp-button-<?php echo get_the_ID(); ?> {
            
            <?php if ( $button_bg_color ) : ?>
            background-color: <?php echo $button_bg_color; ?> !important;
            <?php endif; ?>
            
            <?php if ( $button_text_color ) : ?>
            color: <?php echo $button_text_color; ?> !important;
            <?php endif; ?>
        }
    </style>
    <?php
    
}