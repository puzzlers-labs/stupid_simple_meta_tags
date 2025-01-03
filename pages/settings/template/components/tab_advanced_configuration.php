<?php
$is_licesned = ssmt_is_licensed();
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

        <p class="submit">
            <input type="submit" class="button button-primary" value="Save Changes">
        </p>
    </form>
</div>