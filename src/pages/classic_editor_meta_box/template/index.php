<?php
global $post;
// Get existing meta tags if they exist
$meta_tags = get_post_meta($post->ID, 'ssmt_post_meta_classic_editor', true);
if (!is_array($meta_tags) || empty($meta_tags)) {
    $meta_tags = [['order' => 0, 'value' => '']];
}
$is_licensed = ssmt_is_licensed();
$registration_url = admin_url('admin.php?page=ssmt_register_license');
$post_edit_url    = urlencode('post.php?post=' . $post->ID . '&action=edit');
$registration_url = $registration_url . '&return_url=' . $post_edit_url;
?>

<?php if (!$is_licensed) : ?>
    <div class="frosted-overlay" style="position: absolute; top: -6px; left: 0; background: rgba(0, 0, 0, 0.1); backdrop-filter: blur(2px); display: flex; flex-direction: column; justify-content: center; align-items: center; z-index: 100; padding: 1em; gap: 1em; height: calc(100% - 20px); width: calc(100% - 26px);">
        <div class="overlay-message" style="color: red; background-color: rgba(255, 255, 255, 0.9); padding: 4px; border-radius: 8px; max-width: 90%; width: auto;">
            <p style="color: red; text-align: center; margin: 0px;">A license is required to manage advanced configuration features.</p>
        </div><a href="<?php echo esc_url($registration_url); ?>" style="background-color: rgb(0, 124, 186); color: white; padding: 10px 20px; text-decoration: none; border-radius: 2px; font-weight: bold; display: inline-block; text-align: center; cursor: pointer;">Register for free</a>
    </div>
<?php endif; ?>
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

<script>
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

        cell1.innerHTML = '<input type="text" size="4" placeholder="Order" value="0" style="width: 100%;" name="ssmt_post_meta_classic_editor[' + newIndex + '][order]" />';
        cell2.innerHTML = '<input type="text" placeholder="Value" value="" style="width: 100%;" name="ssmt_post_meta_classic_editor[' + newIndex + '][value]" />';
        cell3.innerHTML = '<button type="button" class="ssmt-delete-row" style="background: none; border: none; cursor: pointer;"><span class="dashicons dashicons-trash"></span></button>';

        // Add event listener for the new delete button
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
</script>