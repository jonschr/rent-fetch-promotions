<?php

add_filter( 'gettext', 'bh_modify_promotions_title_text', 20, 3 );
function bh_modify_promotions_title_text( $translated_text, $text, $domain ) {
    // Check if the text domain is 'default' and post type is 'promotions'
    if ( $text === 'Add title' && $domain === 'default' && get_current_screen()->post_type === 'promotions' ) {
        $translated_text = 'Enter promotion label (not shown on frontend)'; // Replace with your desired text
    }
    return $translated_text;
}
