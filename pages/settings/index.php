<?php

function stupid_simple_meta_tags_settings_init() {
    add_filter('admin_footer_text', 'add_stupid_simple_meta_tags_footer_message');

    wp_enqueue_style('common-css', STUPID_SIMPLE_META_TAGS_PLUGIN_URL . 'assets/css/common.css');

    wp_enqueue_script('settings-js', STUPID_SIMPLE_META_TAGS_PLUGIN_URL . 'assets/js/settings.js');
    wp_enqueue_style('settings-css', STUPID_SIMPLE_META_TAGS_PLUGIN_URL . 'assets/css/settings.css');

    echo stupid_simple_meta_tags_settings_render();
}

//Wordpress uses echo approach instead of returning the template strings. Therefore need to parse the buffer.
function stupid_simple_meta_tags_settings_render() {
    ob_start();
    require STUPID_SIMPLE_META_TAGS_PLUGIN_PATH . 'pages/settings/template/index.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

function stupid_simple_meta_tags_settings_tab_basic_configuration_render() {
    ob_start();
    require STUPID_SIMPLE_META_TAGS_PLUGIN_PATH . 'pages/settings/template/components/tab_basic_configuration.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

function stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render($stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render_config = []) {
    ob_start();
    require STUPID_SIMPLE_META_TAGS_PLUGIN_PATH . 'pages/settings/template/components/tab_basic_configuration/meta_tags_table_row.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

function stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_column_titles_render() {
    ob_start();
    require STUPID_SIMPLE_META_TAGS_PLUGIN_PATH . 'pages/settings/template/components/tab_basic_configuration/meta_tags_table_column_titles.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

function stupid_simple_meta_tags_settings_tab_advanced_configuration_render() {
    ob_start();
    require STUPID_SIMPLE_META_TAGS_PLUGIN_PATH . 'pages/settings/template/components/tab_advanced_configuration.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

function stupid_simple_meta_tags_basic_settings_meta_configuration_list_callback($input) {
    if (!is_array($input)) {
        return [];
    }

    $allow_tags = [
        'meta' => [
            'content' => [],
            'name' => [],
            'property' => [],
            'http-equiv' => [],
            'itemprop' => [],
            'charset' => [],
            'scheme' => [],
        ],
    ];

    $clean_data = array_map(function ($row) use ($allow_tags) {
        return [
            'order' => intval($row['order'] ?? 0),
            'type'  => sanitize_text_field($row['type'] ?? ''),
            'key'   => sanitize_text_field($row['key'] ?? ''),
            'value' => str_replace('"', "'", wp_kses($row['value'] ?? '', $allow_tags)),
        ];
    }, $input);

    return $clean_data;
}
