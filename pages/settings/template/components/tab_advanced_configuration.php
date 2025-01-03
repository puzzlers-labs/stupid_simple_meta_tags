<?php
$meta_configuration_list        = $_POST['ssmt_basic_configuration_meta_configuration_list'] ?? get_option('ssmt_basic_configuration_meta_configuration_list', []);
$validation_error_row_indexes   = get_transient('ssmt_basic_configuration_meta_configuration_list_validation_error_row_indexes');
$validation_error_row_indexes   = is_array($validation_error_row_indexes) ? $validation_error_row_indexes : [];
$is_licesned                    = ssmt_is_licensed();
?>
<div>
    <?php if (!$is_licesned): ?>
        <div class="notice notice-warning is-dismissible">
            <p><strong>Unlicensed:</strong> Some advanced features are disabled. <a href="#">Register for free</a> to enable full functionality.</p>
        </div>
    <?php endif; ?>
    <p>This section allows you to manage and customize the settings for dynamic inputs. You can add, remove, or edit entries as needed, ensuring flexibility and ease of use. Each tab stores its own unique list of inputs, giving you complete control over your configuration.
    <form method="post" action="">
        <?php wp_nonce_field('ssmt_advanced_configuration', 'ssmt_advanced_configuration_nonce'); ?>

        <table class="form-table">
            <tr>
                <th scope="row" class="p-8 ps-0">
                    <label for="ssmt_advanced_settings_show_ssmt_branding">Show SSMT Branding</label>
                </th>
                <td class="p-8 ps-0">
                    <input type="checkbox" name="ssmt_advanced_settings_show_ssmt_branding" id="ssmt_advanced_settings_show_ssmt_branding" value="1" <?php checked(get_option('ssmt_advanced_settings_show_ssmt_branding')); ?> <?php if (!$is_licesned): ?>disabled<?php endif; ?> />
                </td>
            </tr>
            <tr>
                <th scope="row" class="p-8 ps-0">
                    <label for="ssmt_advanced_settings_enable_caching">Enable Caching</label>
                </th>
                <td class="p-8 ps-0">
                    <input type="checkbox" name="ssmt_advanced_settings_enable_caching" id="ssmt_advanced_settings_enable_caching" value="1" <?php checked(get_option('ssmt_advanced_settings_enable_caching')); ?> />
                </td>
            </tr>
            <tr>
                <th scope="row" class="p-8 ps-0">
                    <label for="ssmt_advanced_settings_use_dynamic_tags">Use Dynamic Tags</label>
                </th>
                <td class="p-8 ps-0">
                    <input type="checkbox" name="ssmt_advanced_settings_use_dynamic_tags" id="ssmt_advanced_settings_use_dynamic_tags" value="1" <?php checked(get_option('ssmt_advanced_settings_use_dynamic_tags')); ?> <?php if (!$is_licesned): ?>disabled<?php endif; ?> />
                </td>
            </tr>
        </table>

        <input type="hidden" id="bulk_actions_nonce" value="<?php echo wp_create_nonce('ssmt_advanced_configuration_bulk_action'); ?>" />

        <div class="tablenav top">
            <?php echo ssmt_settings_tab_advanced_configuration_meta_tags_table_bulk_actions(); ?>
            <?php echo ssmt_settings_tab_advanced_configuration_meta_tags_table_count_render(count($meta_configuration_list)); ?>
            <br class="clear">
        </div>

        <h2 class="screen-reader-text">Meta Tags List</h2>
        <table class="wp-list-table widefat plugins">
            <thead>
                <?php echo ssmt_settings_tab_advanced_configuration_meta_tags_table_column_titles_render(); ?>
            </thead>

            <tbody id="dynamic-inputs-list">
                <?php echo ssmt_settings_tab_advanced_configuration_meta_tags_table_row_render(['row_class' => 'd-none inactive', 'is_template' => true]); ?>
                <?php if (!empty($meta_configuration_list)): ?>
                    <?php foreach ($meta_configuration_list as $index => $single_meta_configuration): ?>
                        <?php $is_active = $single_meta_configuration['order'] >= 0; ?>
                        <?php $is_error  = in_array($index, $validation_error_row_indexes); ?>
                        <?php $row_class = $is_error ? 'paused' : ($is_active ? 'active' : 'active hide'); ?>
                        <?php echo ssmt_settings_tab_advanced_configuration_meta_tags_table_row_render(['row_class' => $row_class, 'index' => $index, 'form_data' => $single_meta_configuration]); ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php echo ssmt_settings_tab_advanced_configuration_meta_tags_table_row_render(['row_class' => 'active', 'index' => count($meta_configuration_list) + 1]); ?>
                <?php endif; ?>
            </tbody>

            <tfoot>
                <?php echo ssmt_settings_tab_advanced_configuration_meta_tags_table_column_titles_render(); ?>
            </tfoot>

        </table>
        <div class="tablenav bottom">
            <?php echo ssmt_settings_tab_advanced_configuration_meta_tags_table_bulk_actions(); ?>
            <?php echo ssmt_settings_tab_advanced_configuration_meta_tags_table_count_render(count($meta_configuration_list)); ?>
            <br class="clear">
        </div>

        <?php submit_button(); ?>
    </form>
</div>