<?php

// Add the "Promotion details" metabox
function rfp_add_promotion_metabox() {
    add_meta_box(
        'promotion_details_metabox',
        'Promotion Details',
        'render_promotion_details_metabox',
        'promotions',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'rfp_add_promotion_metabox');

// Enqueue color picker script
function rfp_enqueue_color_picker() {
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_style('wp-color-picker');
}
add_action( 'admin_enqueue_scripts', 'rfp_enqueue_color_picker');

// Render the "Promotion details" metabox
function render_promotion_details_metabox($post) {
    // Retrieve existing values or set defaults
    $button_label = get_post_meta($post->ID, 'button_label', true) ?: 'My New Promotion';
    $button_style = get_post_meta($post->ID, 'button_style', true) ?: 'Simple Button';
    $button_position = get_post_meta($post->ID, 'button_position', true) ?: 'bottom-right';
    $width = get_post_meta($post->ID, 'width', true) ?: 600;
    $button_bg_color = get_post_meta($post->ID, 'button_bg_color', true) ?: '#000000';
    $button_text_color = get_post_meta($post->ID, 'button_text_color', true) ?: '#ffffff';
    $override_url = get_post_meta($post->ID, 'override_url', true) ?: '';
    
    ?>

    <div class="bullhorn-fields">
        <label for="button_label">Button Label:</label><br>
        <input type="text" name="button_label" id="button_label" value="<?php echo esc_attr($button_label); ?>"><br><br>
    </div>

    <!-- <div class="bullhorn-fields">
        <label>Button Style:</label><br>
        <input type="radio" name="button_style" value="simple" <?php // echo checked($button_style, 'Simple Button', false); ?>> Simple Button<br>
        <input type="radio" name="button_style" value="fancy" <?php // echo checked($button_style, 'Fancy Button with Featured Image', false); ?>> Fancy Button with Featured Image<br><br>
    </div> -->

    <div class="bullhorn-fields">
        <label>Button Screen Position:</label><br>
        <label>
            <input type="radio" name="button_position" value="left" <?php echo checked($button_position, 'left', false); ?>>
            Left
        </label><br>

        <label>
            <input type="radio" name="button_position" value="right" <?php echo checked($button_position, 'right', false); ?>>
            Right
        </label><br>

        <label>
            <input type="radio" name="button_position" value="bottom" <?php echo checked($button_position, 'bottom', false); ?>>
            Bottom
        </label><br>

        <label>
            <input type="radio" name="button_position" value="bottom-left" <?php echo checked($button_position, 'bottom-left', false); ?>>
            Bottom Left
        </label><br>

        <label>
            <input type="radio" name="button_position" value="bottom-right" <?php echo checked($button_position, 'bottom-right', false); ?>>
            Bottom Right
        </label><br>
        <br>
    </div>

    <div class="bullhorn-fields">
        <label for="width">Width (in pixels):</label><br>
        <input type="number" name="width" id="width" value="<?php echo esc_attr($width); ?>"><br><br>
    </div>

    <div class="bullhorn-fields">
        <label for="button_bg_color">Button Background Color:</label><br>
        <input type="text" name="button_bg_color" id="button_bg_color" class="color-picker" value="<?php echo esc_attr($button_bg_color); ?>"><br><br>
    </div>

    <div class="bullhorn-fields">
        <label for="button_text_color">Button Text Color:</label><br>
        <input type="text" name="button_text_color" id="button_text_color" class="color-picker" value="<?php echo esc_attr($button_text_color); ?>">
    </div>
    
    <div class="bullhorn-fields">
        <label for="override_url">Override URL (if you'd rather this button go to a URL instead of opening a slider):</label><br>
        <input type="url" name="override_url" id="override_url" value="<?php echo esc_url($override_url); ?>"><br><br>
    </div>

    
    <?php
}

// Save metabox data
function save_promotion_metabox($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save metabox fields
    if (isset($_POST['button_label'])) {
        update_post_meta($post_id, 'button_label', sanitize_text_field($_POST['button_label']));
    }

    if (isset($_POST['button_style'])) {
        update_post_meta($post_id, 'button_style', sanitize_text_field($_POST['button_style']));
    }

    if (isset($_POST['button_position'])) {
        update_post_meta($post_id, 'button_position', sanitize_text_field($_POST['button_position']));
    }

    if (isset($_POST['width'])) {
        update_post_meta($post_id, 'width', absint($_POST['width']));
    }

    if (isset($_POST['button_bg_color'])) {
        update_post_meta($post_id, 'button_bg_color', sanitize_hex_color($_POST['button_bg_color']));
    }

    if (isset($_POST['button_text_color'])) {
        update_post_meta($post_id, 'button_text_color', sanitize_hex_color($_POST['button_text_color']));
    }
    
    if (isset($_POST['override_url'])) {
        update_post_meta($post_id, 'override_url', esc_url($_POST['override_url']));
    }
}
add_action('save_post_promotions', 'save_promotion_metabox');

// Output the color picker script initialization
function rfp_output_color_picker_script() {
    ?>
    <script>
        jQuery(document).ready(function($) {
            $('.color-picker').wpColorPicker();
        });
    </script>
    <?php
}
add_action('admin_footer', 'rfp_output_color_picker_script');