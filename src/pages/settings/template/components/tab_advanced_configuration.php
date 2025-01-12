<?php
$meta_configuration_list        = $_POST['ssmt_basic_configuration_meta_configuration_list'] ?? get_option('ssmt_basic_configuration_meta_configuration_list', []);
$validation_error_row_indexes   = get_transient('ssmt_basic_configuration_meta_configuration_list_validation_error_row_indexes');
$validation_error_row_indexes   = is_array($validation_error_row_indexes) ? $validation_error_row_indexes : [];
$is_licesned                    = ssmt_is_licensed();
$current_page_url               = 'admin.php?page=ssmt_settings&tab=advanced_configuration';
$current_page_url               = urlencode($current_page_url);
?>
<div>
    <?php if (!$is_licesned): ?>
        <div class="notice notice-warning is-dismissible">
            <p><strong>Unlicensed:</strong> Some advanced features are disabled. <a href="<?php echo esc_url(admin_url('admin.php?page=ssmt_register_license&return_url=' . $current_page_url)); ?>">Register for free</a> to enable full functionality.</p>
        </div>
    <?php endif; ?>
    <p>The Advanced Configuration section is for users who want more precise control over their site's metadata. You’ll find checkboxes to enable features like the Gutenberg editor, classic editor, or custom page tags. These options let you decide exactly which tags to show for each page or post, giving you greater flexibility and customization.</p>
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
                    <input type="checkbox" name="ssmt_advanced_settings_enable_caching" id="ssmt_advanced_settings_enable_caching" value="1" <?php checked(get_option('ssmt_advanced_settings_enable_caching')); ?> <?php if (!$is_licesned): ?>disabled<?php endif; ?> />
                </td>
            </tr>
            <tr>
                <th scope="row" class="p-8 ps-0">
                    <label for="ssmt_advanced_settings_enable_gutenberg_plugin">Enable Gutenberg Plugin</label>
                </th>
                <td class="p-8 ps-0">
                    <input type="checkbox" name="ssmt_advanced_settings_enable_gutenberg_plugin" id="ssmt_advanced_settings_enable_gutenberg_plugin" value="1" <?php checked(get_option('ssmt_advanced_settings_enable_gutenberg_plugin')); ?> />
                </td>
            </tr>
            <tr>
                <th scope="row" class="p-8 ps-0">
                    <label for="ssmt_advanced_settings_enable_classic_editor_plugin">Enable Classic Editor Plugin</label>
                </th>
                <td class="p-8 ps-0">
                    <input type="checkbox" name="ssmt_advanced_settings_enable_classic_editor_plugin" id="ssmt_advanced_settings_enable_classic_editor_plugin" value="1" <?php checked(get_option('ssmt_advanced_settings_enable_classic_editor_plugin')); ?> />
                </td>
            </tr>
            <tr>
                <th scope="row" class="p-8 ps-0">
                    <label for="ssmt_advanced_settings_enable_custom_fields">Enable Custom Fields</label>
                </th>
                <td class="p-8 ps-0">
                    <input type="checkbox" name="ssmt_advanced_settings_enable_custom_fields" id="ssmt_advanced_settings_enable_custom_fields" value="1" <?php checked(get_option('ssmt_advanced_settings_enable_custom_fields')); ?> />
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>
    </form>
</div>