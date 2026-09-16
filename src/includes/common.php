<?php
if (!defined('ABSPATH')) exit;

/**
 * Common functions for the plugin.
 * @author Puzzlers Labs Pvt. Ltd. <tech@puzzlers-labs.com>
 */

function ssmt_add_footer_message() {
    echo '<span id="footer-thankyou">Thank you for using Straightforward Simple Meta Tags (SSMT)</span>';
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
        $nonce = sanitize_text_field(wp_unslash($_POST['ssmt_basic_configuration_nonce']));
        if (!wp_verify_nonce($nonce, 'ssmt_basic_configuration')) {
            add_action('admin_notices', function () {
                echo '<div class="notice notice-error is-dismissible"><p>Oops! Something went wrong with your request. Please refresh the page and try submitting the form again.</p></div>';
            });
        } else {
            $raw_list = isset($_POST['ssmt_basic_configuration_meta_configuration_list']) ? wp_unslash($_POST['ssmt_basic_configuration_meta_configuration_list']) : [];
            if (ssmt_basic_configuration_meta_configuration_list_validate($raw_list)) {
                $sanitized_data = ssmt_basic_configuration_meta_configuration_list_sanitize($raw_list);
                $is_enable_caching = ssmt_is_enable_caching();
                update_option('ssmt_basic_configuration_meta_configuration_list', $sanitized_data, $is_enable_caching);
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
    }

    if (isset($_POST['ssmt_advanced_configuration_nonce'])) {
        $nonce = sanitize_text_field(wp_unslash($_POST['ssmt_advanced_configuration_nonce']));
        if (!wp_verify_nonce($nonce, 'ssmt_advanced_configuration')) {
            add_action('admin_notices', function () {
                echo '<div class="notice notice-error is-dismissible"><p>Oops! Something went wrong with your request. Please refresh the page and try submitting the form again.</p></div>';
            });
        } else {
            $post_data = [
                'ssmt_advanced_settings_show_ssmt_branding'           => isset($_POST['ssmt_advanced_settings_show_ssmt_branding'])           ? sanitize_text_field(wp_unslash($_POST['ssmt_advanced_settings_show_ssmt_branding'])) : null,
                'ssmt_advanced_settings_enable_caching'               => isset($_POST['ssmt_advanced_settings_enable_caching'])               ? sanitize_text_field(wp_unslash($_POST['ssmt_advanced_settings_enable_caching'])) : null,
                'ssmt_advanced_settings_enable_gutenberg_plugin'      => isset($_POST['ssmt_advanced_settings_enable_gutenberg_plugin'])      ? sanitize_text_field(wp_unslash($_POST['ssmt_advanced_settings_enable_gutenberg_plugin'])) : null,
                'ssmt_advanced_settings_enable_classic_editor_plugin' => isset($_POST['ssmt_advanced_settings_enable_classic_editor_plugin']) ? sanitize_text_field(wp_unslash($_POST['ssmt_advanced_settings_enable_classic_editor_plugin'])) : null,
                'ssmt_advanced_settings_enable_custom_fields'         => isset($_POST['ssmt_advanced_settings_enable_custom_fields'])         ? sanitize_text_field(wp_unslash($_POST['ssmt_advanced_settings_enable_custom_fields'])) : null,
            ];
            if (ssmt_advanced_settings_validate($post_data)) {
                $sanitized_data = ssmt_advanced_settings_sanitize($post_data);
                update_option('ssmt_advanced_settings_show_ssmt_branding', $sanitized_data['ssmt_advanced_settings_show_ssmt_branding'], true);
                update_option('ssmt_advanced_settings_enable_caching', $sanitized_data['ssmt_advanced_settings_enable_caching'], true);
                update_option('ssmt_advanced_settings_enable_gutenberg_plugin', $sanitized_data['ssmt_advanced_settings_enable_gutenberg_plugin']);
                update_option('ssmt_advanced_settings_enable_classic_editor_plugin', $sanitized_data['ssmt_advanced_settings_enable_classic_editor_plugin']);
                update_option('ssmt_advanced_settings_enable_custom_fields', $sanitized_data['ssmt_advanced_settings_enable_custom_fields']);
                add_action('admin_notices', function () {
                    echo '<div class="notice notice-success is-dismissible"><p>Great! Your settings were saved without any issues.</p></div>';
                });
                unset($_POST['ssmt_advanced_settings_show_ssmt_branding']);
                unset($_POST['ssmt_advanced_settings_enable_caching']);
                unset($_POST['ssmt_advanced_settings_enable_gutenberg_plugin']);
                unset($_POST['ssmt_advanced_settings_enable_classic_editor_plugin']);
                unset($_POST['ssmt_advanced_settings_enable_custom_fields']);
            } else {
                add_action('admin_notices', function () {
                    echo '<div class="notice notice-error is-dismissible"><p>Error: The input provided is invalid. Please check and try again.</p></div>';
                });
            }
        }
    }
}

function ssmt_is_licensed() {
    return true;
}

function ssmt_is_gutenberg_enabled() {
    return get_option('ssmt_advanced_settings_enable_gutenberg_plugin', false);
}

function ssmt_is_classic_editor_enabled() {
    return get_option('ssmt_advanced_settings_enable_classic_editor_plugin', false);
}

function ssmt_is_custom_fields_enabled() {
    return get_option('ssmt_advanced_settings_enable_custom_fields', false);
}

function ssmt_is_enable_caching() {
    return get_option('ssmt_advanced_settings_enable_caching', false);
}
