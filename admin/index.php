<?php
add_action('admin_menu',    'stupid_simple_meta_tags_setup_menu');

function stupid_simple_meta_tags_setup_menu()
{
    add_menu_page('Stupid Simple Meta Tags Settings', 'SSMT', 'manage_options', 'stupid_simple_meta_tags_settings', 'stupid_simple_meta_tags_settings_init');
}

function stupid_simple_meta_tags_settings_init()
{
    require_once plugin_dir_path(__FILE__) . 'pages/settings.php';
    add_filter('admin_footer_text', 'add_stupid_simple_meta_tags_message');

    wp_enqueue_script('settings-js',   plugin_dir_url(__FILE__) . '/js/settings.js');
    wp_enqueue_style('settings-css',   plugin_dir_url(__FILE__) . '/css/settings.css');
    echo stupid_simple_meta_tags_settings_render();
}

function add_stupid_simple_meta_tags_message()
{
    $version = stupid_simple_meta_tags_get_version();
    echo '<span id="footer-thankyou">Thank you for using SSMT. &#124; Copyright &copy; Puzzlers Labs All rights reserved &#124; SSMT version v' . esc_attr($version) . '</span>';
}
