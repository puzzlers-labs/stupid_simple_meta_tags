<?php
if (!defined('ABSPATH')) exit;

$validation_error_row_indexes = get_transient('ssmt_basic_configuration_meta_configuration_list_validation_error_row_indexes');
$validation_error_row_indexes = is_array($validation_error_row_indexes) ? $validation_error_row_indexes : [];
?>
<div>
    <p>The Advanced Configuration section is for users who want more precise control over their site's metadata. You'll find checkboxes to enable features like the Gutenberg editor, classic editor, or custom page tags. These options let you decide exactly which tags to show for each page or post, giving you greater flexibility and customization.</p>
    <form method="post" action="">
        <?php wp_nonce_field('ssmt_advanced_configuration', 'ssmt_advanced_configuration_nonce'); ?>

        <table class="form-table">
            <tr>
                <th scope="row" class="p-8 ps-0">
                    <label for="ssmt_advanced_settings_show_ssmt_branding">Show SSMT Branding</label>
                </th>
                <td class="p-8 ps-0">
                    <input type="checkbox" name="ssmt_advanced_settings_show_ssmt_branding" id="ssmt_advanced_settings_show_ssmt_branding" value="1" <?php checked(get_option('ssmt_advanced_settings_show_ssmt_branding')); ?> />
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