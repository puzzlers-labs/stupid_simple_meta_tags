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
    add_action('admin_menu', 'stupid_simple_meta_tags_setup_menu');

    register_setting('stupid_simple_meta_tags_basic_settings', 'stupid_simple_meta_tags_basic_settings_meta_configuration_list', [
        'sanitize_callback' => 'stupid_simple_meta_tags_basic_settings_meta_configuration_list_callback',
    ]);

    add_action('admin_init', 'stupid_simple_meta_tags_form_submission_validator');
}

function stupid_simple_meta_tags_setup_menu() {
    add_menu_page('Stupid Simple Meta Tags Settings', 'SSMT', 'manage_options', 'stupid_simple_meta_tags_settings', 'stupid_simple_meta_tags_settings_init', 'dashicons-tag');

    add_submenu_page('stupid_simple_meta_tags_settings', 'SSMT Settings', 'Settings', 'manage_options', 'stupid_simple_meta_tags_settings', 'stupid_simple_meta_tags_settings_init');
    add_submenu_page('stupid_simple_meta_tags_settings', 'SSMT Feedback', 'Feedback', 'manage_options', 'stupid_simple_meta_tags_settings_feedback', 'stupid_simple_meta_tags_feedback_init');
}
