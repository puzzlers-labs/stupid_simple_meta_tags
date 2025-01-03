<div class="wrap">
    <p>This section allows you to manage and customize the settings for dynamic inputs. You can add, remove, or edit entries as needed, ensuring flexibility and ease of use. Each tab stores its own unique list of inputs, giving you complete control over your configuration.
    <form method="post" action="">
        <?php wp_nonce_field('save_advanced_settings', 'advanced_settings_nonce'); ?>

        <table class="form-table">
            <tr>
                <th scope="row" class="p-8 ps-0">
                    <label for="ssmt_tags_advanced_settings_stealth_mode">Show SSMT Branding</label>
                </th>
                <td class="p-8 ps-0">
                    <input type="checkbox" name="ssmt_advanced_settings_stealth_mode" id="ssmt_advanced_settings_stealth_mode" value="1" <?php checked(get_option('ssmt_advanced_settings_stealth_mode'), '1'); ?> />
                </td>
            </tr>
            <tr>
                <th scope="row" class="p-8 ps-0">
                    <label for="option2">Enable Caching</label>
                </th>
                <td class="p-8 ps-0">
                    <input type="checkbox" name="option2" id="option2" value="1" <?php checked(get_option('option2'), '1'); ?> />
                </td>
            </tr>
            <tr>
                <th scope="row" class="p-8 ps-0">
                    <label for="option4">Use Dynamic Tags</label>
                </th>
                <td class="p-8 ps-0">
                    <input type="checkbox" name="option4" id="option4" value="1" <?php checked(get_option('option4'), '1'); ?> />
                </td>
            </tr>
        </table>

        <p class="submit">
            <input type="submit" class="button button-primary" value="Save Changes">
        </p>
    </form>
</div>