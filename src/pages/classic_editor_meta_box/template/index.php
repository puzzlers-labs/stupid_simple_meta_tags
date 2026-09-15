<?php
if (!defined('ABSPATH')) exit;

global $post;
// Get existing meta tags if they exist
$meta_tags = get_post_meta($post->ID, 'ssmt_post_meta_classic_editor', true);
if (!is_array($meta_tags) || empty($meta_tags)) {
    $meta_tags = [['order' => 0, 'value' => '']];
}
?>

<table class="ssmt-meta-tags-list-container" style="width: 100%;" id="ssmt_meta_tags_table">
    <?php wp_nonce_field('ssmt_classic_editor_meta_tags', 'ssmt_classic_editor_meta_tags_nonce'); ?>
    <thead>
        <tr>
            <td>
                <p style="margin-bottom: 0px;">Order</p>
            </td>
            <td>
                <p style="margin-bottom: 0px;">Meta Tag</p>
            </td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($meta_tags as $idx => $single_meta_tag) : ?>
            <tr data-row-id="<?php echo esc_attr($idx); ?>">
                <td>
                    <input type="text" size="4" placeholder="Order" value="<?php echo esc_attr($single_meta_tag['order']); ?>" name="ssmt_post_meta_classic_editor[<?php echo esc_attr($idx); ?>][order]" style="width: 100%;" />
                </td>
                <td>
                    <input type="text" placeholder="Value" value="<?php echo esc_attr($single_meta_tag['value']); ?>" style="width: 100%;" name="ssmt_post_meta_classic_editor[<?php echo esc_attr($idx); ?>][value]" />
                </td>
                <td>
                    <button type="button" class="ssmt-delete-row" style="background: none; border: none; cursor: pointer;"><span class="dashicons dashicons-trash"></span></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<p>
    <button class="button" type="button" id="ssmt_add_row">Add New</button>
</p>
