<?php

//* Remove Yoast
add_action( 'add_meta_boxes', 'rfp_remove_yoast_box', 100);
function rfp_remove_yoast_box() {
	remove_meta_box( 'wpseo_meta', 'promotions', 'normal');
}
