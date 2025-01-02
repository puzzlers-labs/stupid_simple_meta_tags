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
    <form method="post" action="options.php" id="dynamic-inputs-form">
        <?php
        settings_fields('my_plugin_settings_group');
        $inputs = get_option('my_plugin_dynamic_inputs', []);
        ?>
        <datalist id="options">
            <option value="og:type"></option>
            <option value="og:title"></option>
            <option value="og:description"></option>
            <option value="og:url"></option>
            <option value="og:image"></option>
            <option value="twitter:card"></option>
            <option value="twitter:site"></option>
            <option value="twitter:title"></option>
            <option value="twitter:image"></option>
        </datalist>
    </form>


    <form method="post">
        <input type="hidden" id="_wpnonce" name="_wpnonce" value="6ee8644c54"><input type="hidden" name="_wp_http_referer" value="/puzzlers/wp-admin/plugins.php">
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
            <div class="tablenav-pages one-page"><span class="displaying-num">3 items</span>
                <span class="pagination-links"><span class="tablenav-pages-navspan button disabled" aria-hidden="true">«</span>
                    <span class="tablenav-pages-navspan button disabled" aria-hidden="true">‹</span>
                    <span class="paging-input"><label for="current-page-selector" class="screen-reader-text">Current Page</label><input class="current-page" id="current-page-selector" type="text" name="paged" value="1" size="1" aria-describedby="table-paging"><span class="tablenav-paging-text"> of <span class="total-pages">1</span></span></span>
                    <span class="tablenav-pages-navspan button disabled" aria-hidden="true">›</span>
                    <span class="tablenav-pages-navspan button disabled" aria-hidden="true">»</span></span>
            </div>
            <br class="clear">
        </div>
        <h2 class="screen-reader-text">Meta Tags List</h2>
        <table class="wp-list-table widefat plugins">
            <thead>
                <tr>
                    <td id="cb" class="manage-column column-cb check-column"><input id="cb-select-all-1" type="checkbox">
                        <label for="cb-select-all-1"><span class="screen-reader-text">Select All</span></label>
                    </td>
                    <th scope="col" id="name" class="manage-column column-name column-primary">Order</th>
                    <th scope="col" id="description" class="manage-column column-description">Type</th>
                    <th scope="col" id="name" class="manage-column column-name column-primary">Meta Tag Key</th>
                    <th scope="col" id="description" class="manage-column column-description">Meta Tag Value</th>
                    <th scope="col" id="description" class="manage-column column-description">Action</th>
                </tr>
            </thead>

            <tbody id="dynamic-inputs-list">
                <?php if (!empty($inputs)) {
                    foreach ($inputs as $key => $value) {
                        echo stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render();
                    }
                } else {
                    echo stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render(['row_class' => 'active']);
                } ?>
                <?php echo stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render(['row_class' => 'template d-none']); ?>
            </tbody>

            <tfoot>
                <tr>
                    <td id="cb" class="manage-column column-cb check-column"><input id="cb-select-all-1" type="checkbox">
                        <label for="cb-select-all-1"><span class="screen-reader-text">Select All</span></label>
                    </td>
                    <th scope="col" id="name" class="manage-column column-name column-primary">Order</th>
                    <th scope="col" id="description" class="manage-column column-description">Type</th>
                    <th scope="col" id="name" class="manage-column column-name column-primary">Meta Tag Name</th>
                    <th scope="col" id="description" class="manage-column column-description">Meta Tag Value</th>
                    <th scope="col" id="description" class="manage-column column-description">Action</th>
                </tr>
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
            <div class="tablenav-pages one-page"><span class="displaying-num">3 items</span>
                <span class="pagination-links"><span class="tablenav-pages-navspan button disabled" aria-hidden="true">«</span>
                    <span class="tablenav-pages-navspan button disabled" aria-hidden="true">‹</span>
                    <span class="screen-reader-text">Current Page</span><span id="table-paging" class="paging-input"><span class="tablenav-paging-text">1 of <span class="total-pages">1</span></span></span>
                    <span class="tablenav-pages-navspan button disabled" aria-hidden="true">›</span>
                    <span class="tablenav-pages-navspan button disabled" aria-hidden="true">»</span></span>
            </div>
            <br class="clear">
        </div>
        <?php submit_button(); ?>
    </form>
</div>