<?php

function stupid_simple_meta_tags_settings_init()
{
    add_filter('admin_footer_text', 'add_stupid_simple_meta_tags_message');

    wp_enqueue_script('settings-js', STUPID_SIMPLE_META_TAGS_PLUGIN_URL . 'assets/js/settings.js');
    wp_enqueue_style('settings-css', STUPID_SIMPLE_META_TAGS_PLUGIN_URL . 'assets/css/settings.css');
    echo stupid_simple_meta_tags_settings_render();
}

function add_stupid_simple_meta_tags_message()
{
    echo '<span id="footer-thankyou">Thank you for using SSMT. &#124; Copyright &copy; Puzzlers Labs All rights reserved &#124; SSMT version v' . esc_attr(STUPID_SIMPLE_META_TAGS_VERSION) . '</span>';
}


function stupid_simple_meta_tags_settings_render()
{

    //Wordpress uses echo approach instead of returning the template strings. Therefore need to parse the buffer.
    ob_start();
    require_once STUPID_SIMPLE_META_TAGS_PLUGIN_PATH . 'pages/settings/template.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}
