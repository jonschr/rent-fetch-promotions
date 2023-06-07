<?php

// Add custom columns to the admin post list
function add_promotions_admin_columns($columns) {
    $new_columns = array(
        'cb' => '<input type="checkbox">',
        'title' => __('Title'),
        'button_label' => __('Button Label'),
        'button_style' => __('Button Style'),
        'button_position' => __('Button Position'),
        'width' => __('Width (px)'),
        'button_bg_color' => __('Button Bkg Color'),
        'button_text_color' => __('Button Text Color'),
        'modified' => __('Last Modified'),
        'status' => __('Status')
    );

    return $new_columns;
}
add_filter('manage_promotions_posts_columns', 'add_promotions_admin_columns');

// Populate custom columns with data
function populate_promotions_admin_columns($column, $post_id) {
    switch ($column) {
        case 'button_label':
            $button_label = get_post_meta($post_id, 'button_label', true) ?: 'My New Promotion';
            echo esc_html($button_label);
            break;
        case 'button_style':
            $button_style = get_post_meta($post_id, 'button_style', true) ?: 'Simple Button';
            echo esc_html($button_style);
            break;
        case 'button_position':
            $button_position = get_post_meta($post_id, 'button_position', true) ?: 'bottom right';
            echo esc_html($button_position);
            break;
        case 'width':
            $width = get_post_meta($post_id, 'width', true) ?: 600;
            echo esc_html($width);
            break;
        case 'button_bg_color':
            $button_bg_color = get_post_meta($post_id, 'button_bg_color', true) ?: '#ffffff';
            echo '<div style="background-color: ' . esc_attr($button_bg_color) . '; width: 20px; height: 20px; display: inline-block;"></div> ' . esc_html($button_bg_color);
            break;
        case 'button_text_color':
            $button_text_color = get_post_meta($post_id, 'button_text_color', true) ?: '';
            echo '<div style="background-color: ' . esc_attr($button_text_color) . '; width: 30px; height: 30px; display: inline-block;"></div> ' . esc_html($button_text_color);
            break;
        case 'modified':
            $modified = get_the_modified_time(get_option('date_format'), $post_id);
            echo esc_html($modified);
            break;
        case 'status':
            $status = get_post_status($post_id);
            echo esc_html($status);
            break;
    }
}
add_action('manage_promotions_posts_custom_column', 'populate_promotions_admin_columns', 10, 2);

// Make the 'modified' column sortable
function make_modified_column_sortable($columns) {
    $columns['modified'] = 'modified';
    return $columns;
}
add_filter('manage_edit-promotions_sortable_columns', 'make_modified_column_sortable');
