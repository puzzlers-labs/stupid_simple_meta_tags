<?php

/**
 * Initialize hook for the plugin.
 * This hook is called every time the plugin is loaded.
 * 
 * @author Puzzlers Labs Pvt. Ltd. <tech@puzzlers-labs.com>
 */

require_once STUPID_SIMPLE_META_TAGS_PLUGIN_PATH . 'pages/settings/index.php';

function stupid_simple_meta_tags_initialized()
{
    add_action('admin_menu', 'stupid_simple_meta_tags_setup_menu');
}

function stupid_simple_meta_tags_setup_menu()
{
    add_menu_page('Stupid Simple Meta Tags Settings', 'SSMT', 'manage_options', 'stupid_simple_meta_tags_settings', 'stupid_simple_meta_tags_settings_init');
}
