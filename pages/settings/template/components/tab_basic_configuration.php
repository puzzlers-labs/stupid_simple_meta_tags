<?php
$meta_configuration_list        = $_POST['ssmt_basic_configuration_meta_configuration_list'] ?? get_option('ssmt_basic_configuration_meta_configuration_list', []);
$validation_error_row_indexes   = get_transient('ssmt_basic_configuration_meta_configuration_list_validation_error_row_indexes');
$validation_error_row_indexes   = is_array($validation_error_row_indexes) ? $validation_error_row_indexes : [];

delete_transient('ssmt_basic_configuration_meta_configuration_list_validation_error_row_indexes');
?>

<div>
    <div class="section-description">
        <p>
            This section allows you to manage and customize the settings for dynamic inputs. You can add, remove, or edit entries as needed, ensuring flexibility and ease of use. Each tab stores its own unique list of inputs, giving you complete control over your configuration.
        </p>
    </div>
    <h1>
        Set Meta Tags
        <div class="help-icon">
            <span class="tooltip-text">This is the help text explaining the feature or section.</span>
            ?
        </div>
    </h1>

    <datalist id="ssmt_meta_key_options">
        <?php foreach (SSMT_META_KEY_OPTIONS as $option) : ?>
            <option value="<?php echo $option; ?>"></option>
        <?php endforeach; ?>
    </datalist>

    <form method="post" action="">
        <?php wp_nonce_field('ssmt_basic_configuration', 'ssmt_basic_configuration_nonce'); ?>
        <input type="hidden" id="bulk_actions_nonce" value="<?php echo wp_create_nonce('ssmt_basic_configuration_bulk_action'); ?>" />

        <div class="tablenav top">
            <?php echo ssmt_settings_tab_basic_configuration_meta_tags_table_bulk_actions(); ?>
            <?php echo ssmt_settings_tab_basic_configuration_meta_tags_table_count_render(count($meta_configuration_list)); ?>
            <br class="clear">
        </div>

        <h2 class="screen-reader-text">Meta Tags List</h2>
        <table class="wp-list-table widefat plugins">
            <thead>
                <?php echo ssmt_settings_tab_basic_configuration_meta_tags_table_column_titles_render(); ?>
            </thead>

            <tbody id="dynamic-inputs-list">
                <?php echo ssmt_settings_tab_basic_configuration_meta_tags_table_row_render(['row_class' => 'd-none inactive', 'is_template' => true]); ?>
                <?php if (!empty($meta_configuration_list)): ?>
                    <?php foreach ($meta_configuration_list as $index => $single_meta_configuration): ?>
                        <?php $is_active = $single_meta_configuration['order'] >= 0; ?>
                        <?php $is_error  = in_array($index, $validation_error_row_indexes); ?>
                        <?php $row_class = $is_error ? 'paused' : ($is_active ? 'active' : 'active hide'); ?>
                        <?php echo ssmt_settings_tab_basic_configuration_meta_tags_table_row_render(['row_class' => $row_class, 'index' => $index, 'form_data' => $single_meta_configuration]); ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php echo ssmt_settings_tab_basic_configuration_meta_tags_table_row_render(['row_class' => 'active', 'index' => count($meta_configuration_list) + 1]); ?>
                <?php endif; ?>
            </tbody>

            <tfoot>
                <?php echo ssmt_settings_tab_basic_configuration_meta_tags_table_column_titles_render(); ?>
            </tfoot>

        </table>
        <div class="tablenav bottom">
            <?php echo ssmt_settings_tab_basic_configuration_meta_tags_table_bulk_actions(); ?>
            <?php echo ssmt_settings_tab_basic_configuration_meta_tags_table_count_render(count($meta_configuration_list)); ?>
            <br class="clear">
        </div>
        <?php submit_button(); ?>
    </form>
</div>