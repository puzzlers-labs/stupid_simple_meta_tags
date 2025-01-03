<?php

/**
 * Initialize hook for the plugin.
 * This hook is called every time the plugin is loaded.
 * 
 * @author Puzzlers Labs Pvt. Ltd. <tech@puzzlers-labs.com>
 */

require_once SSMT_PLUGIN_PATH . 'pages/settings/index.php';
require_once SSMT_PLUGIN_PATH . 'pages/feedback/index.php';

function ssmt_initialized() {
    add_action('wp_head', 'ssmt_render_meta_tags');

    add_action('admin_head', 'ssmt_admin_style');
    add_action('admin_menu', 'ssmt_setup_menu');

    register_setting('ssmt_basic_settings',    'ssmt_basic_settings_meta_configuration_list');
    register_setting('ssmt_advanced_settings', 'ssmt_advanced_settings_stealth_mode');
    register_setting('ssmt_advanced_settings', 'ssmt_advanced_settings_enable_caching');
    register_setting('ssmt_advanced_settings', 'ssmt_advanced_settings_use_dynamic_tags');
    register_setting('ssmt_advanced_settings', 'ssmt_advanced_settings_dynamic_tags_configuration_list');
    register_setting('ssmt_admin_settings',    'ssmt_admin_settings_license_key');

    add_action('admin_init', 'ssmt_form_submission_validator');
}

function ssmt_setup_menu() {
    add_menu_page('Stupid Simple Meta Tags Settings', 'SSMT', 'manage_options', 'ssmt_settings', 'ssmt_settings_init', ssmt_get_icon());

    add_submenu_page('ssmt_settings', 'SSMT Settings', 'Settings', 'manage_options', 'ssmt_settings', 'ssmt_settings_init');
    add_submenu_page('ssmt_settings', 'SSMT Feedback', 'Feedback', 'manage_options', 'ssmt_settings_feedback', 'ssmt_feedback_init');
}

function ssmt_render_meta_tags() {
    $meta_configuration_list = get_option('ssmt_basic_settings_meta_configuration_list', []);

    echo "<!-- Stupid Simple Meta Tags Start -->";
    foreach ($meta_configuration_list as $meta_configuration) {
        $meta_configuration['key']   = trim($meta_configuration['key']);
        $meta_configuration['value'] = trim($meta_configuration['value']);

        if ($meta_configuration['order'] < 0) {
            continue;
        }

        if ($meta_configuration['type'] === 'direct') {
            if (!empty($meta_configuration['value'])) {
                echo $meta_configuration['value'];
            }
        } else {
            if (!empty($meta_configuration['key'])) {
                echo "<meta {$meta_configuration['type']}='{$meta_configuration['key']}' content='{$meta_configuration['value']}' />";
            }
        }
    }
    echo "<!-- Stupid Simple Meta Tags End -->";
}

function ssmt_get_icon() {
    $admin_color = get_user_option('admin_color');
    if (ssmt_is_licensed()) {
        return SSMT_PLUGIN_URL . "assets/images/ssmt_licensed.png";
    }
    if (in_array($admin_color, ['light'])) {
        return SSMT_PLUGIN_URL . "assets/images/ssmt_dark.png";
    }
    return SSMT_PLUGIN_URL . "assets/images/ssmt_light.png";
}

function ssmt_admin_style() {
    echo '<style>';
    echo '    #adminmenu .toplevel_page_ssmt_settings img {';
    echo '        width: 20px;';
    echo '        height: 20px;';
    echo '        object-fit: contain;';
    echo '    }';
    echo '</style>';
}
