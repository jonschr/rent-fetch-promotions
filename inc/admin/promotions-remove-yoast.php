<?php

//* Remove Yoast
add_action( 'add_meta_boxes', 'bh_remove_yoast_box', 100);
function bh_remove_yoast_box() {
	remove_meta_box( 'wpseo_meta', 'promotions', 'normal');
}
