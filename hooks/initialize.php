<?php

/**
 * Initialize hook for the plugin.
 * This hook is called every time the plugin is loaded.
 * 
 * @author Puzzlers Labs Pvt. Ltd. <tech@puzzlers-labs.com>
 */

require_once STUPID_SIMPLE_META_TAGS_PLUGIN_PATH . 'pages/settings/index.php';
require_once STUPID_SIMPLE_META_TAGS_PLUGIN_PATH . 'pages/feedback/index.php';

function stupid_simple_meta_tags_initialized() {
    add_action('wp_head', 'stupid_simple_meta_tags_render_meta_tags');

    add_action('admin_menu', 'stupid_simple_meta_tags_setup_menu');

    register_setting('stupid_simple_meta_tags_basic_settings',    'stupid_simple_meta_tags_basic_settings_meta_configuration_list');
    register_setting('stupid_simple_meta_tags_advanced_settings', 'stupid_simple_meta_tags_advanced_settings_stealth_mode');
    register_setting('stupid_simple_meta_tags_advanced_settings', 'stupid_simple_meta_tags_advanced_settings_enable_caching');
    register_setting('stupid_simple_meta_tags_advanced_settings', 'stupid_simple_meta_tags_advanced_settings_use_dynamic_tags');
    register_setting('stupid_simple_meta_tags_advanced_settings', 'stupid_simple_meta_tags_advanced_settings_dynamic_tags_configuration_list');
    register_setting('stupid_simple_meta_tags_admin_settings',    'stupid_simple_meta_tags_admin_settings_license_key');

    add_action('admin_init', 'stupid_simple_meta_tags_form_submission_validator');
}

function stupid_simple_meta_tags_setup_menu() {
    add_menu_page('Stupid Simple Meta Tags Settings', 'SSMT', 'manage_options', 'stupid_simple_meta_tags_settings', 'stupid_simple_meta_tags_settings_init', 'dashicons-tag');

    add_submenu_page('stupid_simple_meta_tags_settings', 'SSMT Settings', 'Settings', 'manage_options', 'stupid_simple_meta_tags_settings', 'stupid_simple_meta_tags_settings_init');
    add_submenu_page('stupid_simple_meta_tags_settings', 'SSMT Feedback', 'Feedback', 'manage_options', 'stupid_simple_meta_tags_settings_feedback', 'stupid_simple_meta_tags_feedback_init');
}

function stupid_simple_meta_tags_render_meta_tags() {
    $meta_configuration_list = get_option('stupid_simple_meta_tags_basic_settings_meta_configuration_list', []);

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
