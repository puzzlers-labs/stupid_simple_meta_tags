<?php

/**
 * Common functions for the plugin.
 * @author Puzzlers Labs Pvt. Ltd. <tech@puzzlers-labs.com>
 */

function add_ssmt_footer_message() {
    echo '<span id="footer-thankyou">Thank you for using Stupid Simple Meta Tags (SSMT)</span>';
    echo '<span>&nbsp;&#124;&nbsp;</span>';
    echo '<span>Copyright &copy; <a href="https://puzzlers-labs.com" target="_blank">Puzzlers Labs Pvt. Ltd.</a> All rights reserved</span>';
    echo '<span class="alignright">';
    echo 'SSMT version v' . esc_attr(SSMT_VERSION);
    echo '&nbsp;&#124;&nbsp;';
    echo '<a href="https://github.com/puzzlers-labs/stupid_simple_meta_tags" target="_blank" class="alignright">Github</a>';
    echo '</span>';
}

function ssmt_form_submission_validator() {
    if (isset($_POST['ssmt_basic_settings_nonce'])) {
        if (!wp_verify_nonce($_POST['ssmt_basic_settings_nonce'], 'ssmt_basic_settings')) {
            add_action('admin_notices', function () {
                echo '<div class="notice notice-error is-dismissible"><p>Oops! Something went wrong with your request. Please refresh the page and try submitting the form again.</p></div>';
            });
        } elseif (ssmt_basic_settings_meta_configuration_list_validate($_POST['ssmt_basic_settings_meta_configuration_list'])) {
            $sanitized_data = ssmt_basic_settings_meta_configuration_list_sanitize($_POST['ssmt_basic_settings_meta_configuration_list']);
            update_option('ssmt_basic_settings_meta_configuration_list', $sanitized_data);
            add_action('admin_notices', function () {
                echo '<div class="notice notice-success is-dismissible"><p>Great! Your settings were saved without any issues.</p></div>';
            });
            unset($_POST['ssmt_basic_settings_meta_configuration_list']);
        } else {
            add_action('admin_notices', function () {
                echo '<div class="notice notice-error is-dismissible"><p>Error: The input provided is invalid. Please check and try again.</p></div>';
            });
        }
    }
}

function ssmt_is_licensed() {
    return true;
}

// function stupid_simple_meta_tags_init() {

//     add_action('enqueue_block_editor_assets', 'enqueue_custom_editor_plugin');

//     add_action('wp_head', 'hook_javascript');
// }

// function enqueue_custom_editor_plugin() {
//     wp_enqueue_script(
//         'custom-editor-plugin',
//         plugins_url('custom-editor-plugin.js', __FILE__),
//         array('wp-plugins', 'wp-edit-post', 'wp-components', 'wp-element', 'wp-data'),
//         '1.0',
//         true
//     );
// }

// function hook_javascript() {
//     var_dump(get_post_meta(get_the_ID()));
// }
