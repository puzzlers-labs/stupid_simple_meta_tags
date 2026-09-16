<?php
if (!defined('ABSPATH')) exit;

function ssmt_classic_editor_meta_box_render() {
    $inline_js = "
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('ssmt_add_row').addEventListener('click', function() {
                var table = document.getElementById('ssmt_meta_tags_table').getElementsByTagName('tbody')[0];
                var rowCount = table.rows.length;
                var row = table.insertRow(rowCount);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                let newIndex = 1;
                if (rowCount > 0) {
                    const lastRow = table.rows[rowCount - 1];
                    const lastIndex = parseInt(lastRow.dataset.rowId, 10);
                    newIndex = lastIndex + 1;
                }
                row.dataset.rowId = newIndex;
                cell1.innerHTML = '<input type=\"text\" size=\"4\" placeholder=\"Order\" value=\"0\" style=\"width: 100%;\" name=\"ssmt_post_meta_classic_editor[' + newIndex + '][order]\" />';
                cell2.innerHTML = '<input type=\"text\" placeholder=\"Value\" value=\"\" style=\"width: 100%;\" name=\"ssmt_post_meta_classic_editor[' + newIndex + '][value]\" />';
                cell3.innerHTML = '<button type=\"button\" class=\"ssmt-delete-row\" style=\"background: none; border: none; cursor: pointer;\"><span class=\"dashicons dashicons-trash\"></span></button>';
                cell3.getElementsByTagName('button')[0].addEventListener('click', function() {
                    table.deleteRow(row.rowIndex - 1);
                });
            });
            document.querySelectorAll('.ssmt-delete-row').forEach(function(button) {
                button.addEventListener('click', function() {
                    var row = this.parentNode.parentNode;
                    row.parentNode.removeChild(row);
                });
            });
        });
    ";
    wp_register_script('ssmt-classic-editor-meta-box', false, [], SSMT_VERSION, true);
    wp_enqueue_script('ssmt-classic-editor-meta-box');
    wp_add_inline_script('ssmt-classic-editor-meta-box', $inline_js);

    require SSMT_PLUGIN_PATH . 'pages/classic_editor_meta_box/template/index.php';
}

function ssmt_classic_editor_save_meta_tags() {
    global $post;

    $post_id = $post->ID;

	// Check for nonce validity and user permissions
    if (!isset($_POST['ssmt_classic_editor_meta_tags_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['ssmt_classic_editor_meta_tags_nonce'])), 'ssmt_classic_editor_meta_tags')) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['ssmt_post_meta_classic_editor'])) {
        $meta_tags = wp_unslash($_POST['ssmt_post_meta_classic_editor']);
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
