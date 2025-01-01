<?php

function stupid_simple_meta_tags_settings_render()
{
    //Wordpress uses echo approach instead of returning the template strings. Therefore need to parse the buffer.
    ob_start();
    require_once plugin_dir_path(__FILE__) . '../templates/settings.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}
