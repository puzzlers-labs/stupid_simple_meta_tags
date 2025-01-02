<?php $meta_configuration_list = get_option('stupid_simple_meta_tags_basic_settings_meta_configuration_list', []); ?>
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
            <div class="alignleft actions bulkactions">
                <label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
                <select name="action2" id="bulk-action-selector-bottom">
                    <option value="-1">Bulk actions</option>
                    <option value="activate-selected">Hide</option>
                    <option value="deactivate-selected">Show</option>
                    <option value="delete-selected">Delete</option>
                </select>
                <input type="submit" name="bulk_action" id="doaction" class="button action" value="Apply">
                <button type="button" id="add-input" class="button">Add Row</button>
            </div>
            <div class="tablenav-pages one-page">
                <span class="displaying-num"><?php echo count($meta_configuration_list); ?> items</span>
            </div>
            <br class="clear">
        </div>

        <h2 class="screen-reader-text">Meta Tags List</h2>
        <table class="wp-list-table widefat plugins">
            <thead>
                <?php echo stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_column_titles_render(); ?>
            </thead>

            <tbody id="dynamic-inputs-list">
                <?php if (!empty($meta_configuration_list)): ?>
                    <?php foreach ($meta_configuration_list as $index => $single_meta_configuration) : ?>
                        <?php echo stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render(['index' => $index, 'form_data' => $single_meta_configuration]); ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <?php echo stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render(['row_class' => 'active', 'index' => count($meta_configuration_list) + 1]); ?>
                <?php endif; ?>
                <?php echo stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render(['row_class' => 'template d-none inactive']); ?>
            </tbody>

            <tfoot>
                <?php echo stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_column_titles_render(); ?>
            </tfoot>

        </table>
        <div class="tablenav bottom">

            <div class="alignleft actions bulkactions">
                <label for="bulk-action-selector-bottom" class="screen-reader-text">Select bulk action</label>
                <select name="action2" id="bulk-action-selector-bottom">
                    <option value="-1">Bulk actions</option>
                    <option value="activate-selected">Hide</option>
                    <option value="deactivate-selected">Show</option>
                    <option value="delete-selected">Delete</option>
                </select>
                <input type="submit" name="bulk_action" id="doaction2" class="button action" value="Apply">
                <button type="button" onclick="addRow();" class="button">Add Row</button>
            </div>
            <div class="tablenav-pages one-page">
                <span class="displaying-num"><?php echo count($meta_configuration_list); ?> items</span>
            </div>
            <br class="clear">
        </div>
        <?php submit_button(); ?>
    </form>
</div>