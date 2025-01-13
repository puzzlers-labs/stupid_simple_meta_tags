<?php

function ssmt_classic_editor_meta_box_render() {
    require SSMT_PLUGIN_PATH . 'pages/classic_editor_meta_box/template/index.php';
}

function ssmt_classic_editor_save_meta_tags() {
    global $post;

    $post_id = $post->ID;

	// Check for nonce validity and user permissions
    if (!isset($_POST['ssmt_classic_editor_meta_tags_nonce']) || !wp_verify_nonce($_POST['ssmt_classic_editor_meta_tags_nonce'], 'ssmt_classic_editor_meta_tags')) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['ssmt_post_meta_classic_editor'])) {
        $meta_tags = $_POST['ssmt_post_meta_classic_editor'];
        $meta_tags = array_map(function($meta_tag) {
            return [
                'order' => sanitize_text_field($meta_tag['order'] ?? '0'),
                'value' => sanitize_text_field($meta_tag['value'] ?? '')
            ];
        }, $meta_tags);

        // Clean up empty rows
        $meta_tags = array_filter($meta_tags, function($meta_tag) {
            return !empty($meta_tag['value']);
        });

        // Parse order values to integers
        $meta_tags = array_map(function($meta_tag) {
            $meta_tag['order'] = intval($meta_tag['order']) ?? 0;
            return $meta_tag;
        }, $meta_tags);

        update_post_meta($post_id, 'ssmt_post_meta_classic_editor', $meta_tags);
    }
}