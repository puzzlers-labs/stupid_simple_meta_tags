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
    if (isset($_POST['ssmt_basic_configuration_nonce'])) {
        if (!wp_verify_nonce($_POST['ssmt_basic_configuration_nonce'], 'ssmt_basic_configuration')) {
            add_action('admin_notices', function () {
                echo '<div class="notice notice-error is-dismissible"><p>Oops! Something went wrong with your request. Please refresh the page and try submitting the form again.</p></div>';
            });
        } elseif (ssmt_basic_configuration_meta_configuration_list_validate($_POST['ssmt_basic_configuration_meta_configuration_list'])) {
            $sanitized_data = ssmt_basic_configuration_meta_configuration_list_sanitize($_POST['ssmt_basic_configuration_meta_configuration_list']);
            update_option('ssmt_basic_configuration_meta_configuration_list', $sanitized_data, true);
            add_action('admin_notices', function () {
                echo '<div class="notice notice-success is-dismissible"><p>Great! Your settings were saved without any issues.</p></div>';
            });
            unset($_POST['ssmt_basic_configuration_meta_configuration_list']);
        } else {
            add_action('admin_notices', function () {
                echo '<div class="notice notice-error is-dismissible"><p>Error: The input provided is invalid. Please check and try again.</p></div>';
            });
        }
    }

    if (isset($_POST['ssmt_advanced_configuration_nonce'])) {
        if (!wp_verify_nonce($_POST['ssmt_advanced_configuration_nonce'], 'ssmt_advanced_configuration')) {
            add_action('admin_notices', function () {
                echo '<div class="notice notice-error is-dismissible"><p>Oops! Something went wrong with your request. Please refresh the page and try submitting the form again.</p></div>';
            });
        } elseif (ssmt_advanced_settings_validate($_POST)) {
            $sanitized_data = ssmt_advanced_settings_sanitize($_POST);
            update_option('ssmt_advanced_settings_show_ssmt_branding', $sanitized_data['ssmt_advanced_settings_show_ssmt_branding'], true);
            update_option('ssmt_advanced_settings_enable_caching', $sanitized_data['ssmt_advanced_settings_enable_caching']);
            update_option('ssmt_advanced_settings_use_dynamic_tags', $sanitized_data['ssmt_advanced_settings_use_dynamic_tags']);
            // update_option('ssmt_advanced_settings_dynamic_tags_configuration_list', $sanitized_data['ssmt_advanced_settings_dynamic_tags_configuration_list']);
            add_action('admin_notices', function () {
                echo '<div class="notice notice-success is-dismissible"><p>Great! Your settings were saved without any issues.</p></div>';
            });
            unset($_POST['ssmt_advanced_settings_show_ssmt_branding']);
            unset($_POST['ssmt_advanced_settings_enable_caching']);
            unset($_POST['ssmt_advanced_settings_use_dynamic_tags']);
            // unset($_POST['ssmt_advanced_settings_dynamic_tags_configuration_list']);
        } else {
            add_action('admin_notices', function () {
                echo '<div class="notice notice-error is-dismissible"><p>Error: The input provided is invalid. Please check and try again.</p></div>';
            });
        }
    }
}

function ssmt_is_licensed() {
    $license_key = get_option('ssmt_admin_settings_license_key');
    if ($license_key) {
        return true;
    }
    return false;
}

function ssmt_validate_license($update_db = true) {
    // update_option('ssmt_admin_settings_license_key', '');
    // return false;

    $license_key = get_option('ssmt_admin_settings_license_key');
    $response    = wp_remote_get('https://puzzlers-labs.free.beeceptor.com/check_license'); // Also append the website and key as query params
    // Do not update the db because it might be a network issue or the server is down.
    // That does not mean the license is invalid.
    if (is_wp_error($response)) {
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);
    if ($data['license_status'] === 'valid') {
        if ($update_db) {
            update_option('ssmt_admin_settings_license_key', $license_key);
        }
        return true;
    }
    if ($update_db) {
        update_option('ssmt_admin_settings_license_key', '');
    }
    return false;
}
