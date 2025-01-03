<?php
$meta_configuration_list        = $_POST['stupid_simple_meta_tags_basic_settings_meta_configuration_list'] ?? get_option('stupid_simple_meta_tags_basic_settings_meta_configuration_list', []);
$validation_error_row_indexes   = get_transient('stupid_simple_meta_tags_basic_settings_meta_configuration_list_validation_error_row_indexes');
$validation_error_row_indexes   = is_array($validation_error_row_indexes) ? $validation_error_row_indexes : [];

delete_transient('stupid_simple_meta_tags_basic_settings_meta_configuration_list_validation_error_row_indexes');
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

    <datalist id="stupid_simple_meta_tags_meta_key_options">
        <?php foreach (STUPID_SIMPLE_META_TAGS_META_KEY_OPTIONS as $option) : ?>
            <option value="<?php echo $option; ?>"></option>
        <?php endforeach; ?>
    </datalist>

    <form method="post" action="">
        <?php wp_nonce_field('stupid_simple_meta_tags_basic_settings_action', 'stupid_simple_meta_tags_basic_settings_nonce'); ?>

        <div class="tablenav top">
            <?php echo stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_bulk_actions(); ?>
            <?php echo stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_count_render(count($meta_configuration_list)); ?>
            <br class="clear">
        </div>

        <h2 class="screen-reader-text">Meta Tags List</h2>
        <table class="wp-list-table widefat plugins">
            <thead>
                <?php echo stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_column_titles_render(); ?>
            </thead>

            <tbody id="dynamic-inputs-list">
                <?php echo stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render(['row_class' => 'd-none inactive', 'is_template' => true]); ?>
                <?php if (!empty($meta_configuration_list)): ?>
                    <?php foreach ($meta_configuration_list as $index => $single_meta_configuration): ?>
                        <?php $is_active = $single_meta_configuration['order'] >= 0; ?>
                        <?php $is_error  = in_array($index, $validation_error_row_indexes); ?>
                        <?php $row_class = $is_error ? 'paused' : ($is_active ? 'active' : 'active hide'); ?>
                        <?php echo stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render(['row_class' => $row_class, 'index' => $index, 'form_data' => $single_meta_configuration]); ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php echo stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render(['row_class' => 'active', 'index' => count($meta_configuration_list) + 1]); ?>
                <?php endif; ?>
            </tbody>

            <tfoot>
                <?php echo stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_column_titles_render(); ?>
            </tfoot>

        </table>
        <div class="tablenav bottom">
            <?php echo stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_bulk_actions(); ?>
            <?php echo stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_count_render(count($meta_configuration_list)); ?>
            <br class="clear">
        </div>
        <?php submit_button(); ?>
    </form>
</div>