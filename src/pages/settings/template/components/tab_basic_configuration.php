<?php
$meta_configuration_list        = $_POST['ssmt_basic_configuration_meta_configuration_list'] ?? get_option('ssmt_basic_configuration_meta_configuration_list', []);
$validation_error_row_indexes   = get_transient('ssmt_basic_configuration_meta_configuration_list_validation_error_row_indexes');
$validation_error_row_indexes   = is_array($validation_error_row_indexes) ? $validation_error_row_indexes : [];

delete_transient('ssmt_basic_configuration_meta_configuration_list_validation_error_row_indexes');
?>

<div>
    <div class="section-description">
        <p>
            The Basic Configuration section is for setting up the essential details of your website. Here, you can add a site title, description, and a default image that will appear when your site is shared on social media or searched online. It's a quick and simple way to make sure your site looks professional.
        </p>
    </div>
    <h1>
        Set Meta Tags
    </h1>

    <datalist id="ssmt_meta_key_options">
        <?php foreach (SSMT_META_KEY_OPTIONS as $option) : ?>
            <option value="<?php echo esc_attr($option); ?>"></option>
        <?php endforeach; ?>
    </datalist>

    <form method="post" action="">
        <?php wp_nonce_field('ssmt_basic_configuration', 'ssmt_basic_configuration_nonce'); ?>

        <div class="tablenav top">
            <?php ssmt_settings_tab_basic_configuration_meta_tags_table_bulk_actions_render(); ?>
            <?php ssmt_settings_tab_basic_configuration_meta_tags_table_count_render(count($meta_configuration_list)); ?>
            <br class="clear">
        </div>

        <h2 class="screen-reader-text">Meta Tags List</h2>
        <table class="wp-list-table widefat plugins">
            <thead>
                <?php ssmt_settings_tab_basic_configuration_meta_tags_table_column_titles_render(); ?>
            </thead>

            <tbody id="dynamic-inputs-list">
                <?php ssmt_settings_tab_basic_configuration_meta_tags_table_row_render(['row_class' => 'd-none inactive', 'is_template' => true]); ?>
                <?php if (!empty($meta_configuration_list)): ?>
                    <?php foreach ($meta_configuration_list as $index => $single_meta_configuration): ?>
                        <?php $is_active = $single_meta_configuration['order'] >= 0; ?>
                        <?php $is_error  = in_array($index, $validation_error_row_indexes); ?>
                        <?php $row_class = $is_error ? 'paused' : ($is_active ? 'active' : 'active hide'); ?>
                        <?php ssmt_settings_tab_basic_configuration_meta_tags_table_row_render(['row_class' => $row_class, 'index' => $index, 'form_data' => $single_meta_configuration]); ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php ssmt_settings_tab_basic_configuration_meta_tags_table_row_render(['row_class' => 'active', 'index' => count($meta_configuration_list) + 1]); ?>
                <?php endif; ?>
            </tbody>

            <tfoot>
                <?php ssmt_settings_tab_basic_configuration_meta_tags_table_column_titles_render(); ?>
            </tfoot>

        </table>
        <div class="tablenav bottom">
            <?php ssmt_settings_tab_basic_configuration_meta_tags_table_bulk_actions_render(); ?>
            <?php ssmt_settings_tab_basic_configuration_meta_tags_table_count_render(count($meta_configuration_list)); ?>
            <br class="clear">
        </div>
        <?php submit_button(); ?>
    </form>
</div>