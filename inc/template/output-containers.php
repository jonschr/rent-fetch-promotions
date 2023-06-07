<?php

add_action( 'wp_footer', 'bh_output_containers' );
function bh_output_containers() {
    
    // Query posts for each button position
    $args = array(
        'post_type'      => 'promotions',
        'posts_per_page' => -1,
    );
    $container_query = new WP_Query($args);

    // Check if any posts are found for the current position
    if ($container_query->have_posts()) {
        
        wp_enqueue_script( 'html2canvas' );
        wp_enqueue_script( 'bullhorn-triggers' );
        wp_enqueue_script( 'bullhorn-close-bkg-color-detection');
        
        // the background for the containers, should be set to active if there's anything else active
        echo '<div class="bullhorn-container-bkg"></div>';
    
        // Loop through the posts again to display the content
        while ($container_query->have_posts()) {
            
            $container_query->the_post();
            
            $position = esc_html( get_post_meta( get_the_ID(), 'button_position', true ) );
            $width = esc_html( get_post_meta( get_the_ID(), 'width', true ) );
            
            printf( '<div class="bullhorn-container %s" style="max-width:%spx !important;" data-promotion="%s">', $position, $width, get_the_ID() );
                echo '<div class="bullhorn-wrap">';
            
                    echo '<a href="#" class="bullhorn-close"><span></span><span></span></a>';
                            
                    the_content();
                    
                    edit_post_link();
                    
                echo '</div>';
            echo '</div>'; // End .bullhorn-button-wrap
        }
    }
    
}