<?php

function ssmt_settings_init() {
    add_filter('admin_footer_text', 'add_ssmt_footer_message');

    wp_enqueue_style('common-css', SSMT_PLUGIN_URL . 'assets/css/common.css');

    echo ssmt_settings_render();
}

//Wordpress uses echo approach instead of returning the template strings. Therefore need to parse the buffer.
function ssmt_settings_render() {
    wp_enqueue_script('settings-js', SSMT_PLUGIN_URL . 'assets/js/basic_configuration.js');
    wp_enqueue_style('settings-css', SSMT_PLUGIN_URL . 'assets/css/basic_configuration.css');

    ob_start();
    require SSMT_PLUGIN_PATH . 'pages/settings/template/index.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

function ssmt_settings_tab_basic_configuration_render() {
    ob_start();
    require SSMT_PLUGIN_PATH . 'pages/settings/template/components/tab_basic_configuration.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

function ssmt_settings_tab_basic_configuration_meta_tags_table_row_render($ssmt_settings_tab_basic_configuration_meta_tags_table_row_render_config = []) {
    ob_start();
    require SSMT_PLUGIN_PATH . 'pages/settings/template/components/tab_basic_configuration/meta_tags_table_row.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

function ssmt_settings_tab_basic_configuration_meta_tags_table_column_titles_render() {
    ob_start();
    require SSMT_PLUGIN_PATH . 'pages/settings/template/components/tab_basic_configuration/meta_tags_table_column_titles.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

function ssmt_settings_tab_basic_configuration_meta_tags_table_count_render($ssmt_settings_tab_basic_configuration_meta_tags_table_count) {
    ob_start();
    require SSMT_PLUGIN_PATH . 'pages/settings/template/components/tab_basic_configuration/meta_tags_table_count.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

function ssmt_settings_tab_basic_configuration_meta_tags_table_bulk_actions() {
    ob_start();
    require SSMT_PLUGIN_PATH . 'pages/settings/template/components/tab_basic_configuration/meta_tags_table_bulk_actions.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

function ssmt_settings_tab_advanced_configuration_render() {
    wp_enqueue_script('settings-js', SSMT_PLUGIN_URL . 'assets/js/advanced_configuration.js');
    wp_enqueue_style('settings-css', SSMT_PLUGIN_URL . 'assets/css/advanced_configuration.css');

    ob_start();
    require SSMT_PLUGIN_PATH . 'pages/settings/template/components/tab_advanced_configuration.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

function ssmt_settings_tab_advanced_configuration_meta_tags_table_row_render($ssmt_settings_tab_advanced_configuration_meta_tags_table_row_render_config = []) {
    ob_start();
    require SSMT_PLUGIN_PATH . 'pages/settings/template/components/tab_advanced_configuration/meta_tags_table_row.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

function ssmt_settings_tab_advanced_configuration_meta_tags_table_column_titles_render() {
    ob_start();
    require SSMT_PLUGIN_PATH . 'pages/settings/template/components/tab_advanced_configuration/meta_tags_table_column_titles.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

function ssmt_settings_tab_advanced_configuration_meta_tags_table_count_render($ssmt_settings_tab_advanced_configuration_meta_tags_table_count) {
    ob_start();
    require SSMT_PLUGIN_PATH . 'pages/settings/template/components/tab_advanced_configuration/meta_tags_table_count.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

function ssmt_settings_tab_advanced_configuration_meta_tags_table_bulk_actions() {
    ob_start();
    require SSMT_PLUGIN_PATH . 'pages/settings/template/components/tab_advanced_configuration/meta_tags_table_bulk_actions.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}




/**
 * Validate the form submission data.
 * 1. The data should be an array.
 * 2. Each row should be an array.
 * 3. The row should have order property and it's value between -1 and 9999.
 * 4. Each row should have a type property and it's value as any of name, property, direct.
 * 5. If the type is name or property, the row should have a key property.
 * 6. If the type is direct, the row should have a value property.
 * 7. The length of the key and value should be less than 255 characters.
 * 8. Total item count should be less than 10000.
 */
function ssmt_basic_configuration_meta_configuration_list_validate($input) {
    $validation_error_row_indexes = [];
    $is_valid = true;
    if (!is_array($input)) {
        $is_valid = false;
    }
    if (count($input) > 10000) {
        $is_valid = false;
    }
    foreach ($input as $index => $single_row) {
        if (!is_array($single_row)) {
            $validation_error_row_indexes[] = $index;
            $is_valid = false;
        }
        if (!isset($single_row['order']) || !is_numeric($single_row['order']) || $single_row['order'] < -1 || $single_row['order'] > 9999) {
            $validation_error_row_indexes[] = $index;
            $is_valid = false;
        }
        if (!isset($single_row['type']) || !in_array($single_row['type'], ['name', 'property', 'direct'])) {
            $validation_error_row_indexes[] = $index;
            $is_valid = false;
        }

        if ($single_row['type'] === 'name' || $single_row['type'] === 'property') {
            if (!isset($single_row['key']) || empty($single_row['key'])) {
                $validation_error_row_indexes[] = $index;
                $is_valid = false;
            }
        } else if ($single_row['type'] === 'direct') {
            if (!isset($single_row['value']) || empty($single_row['value'])) {
                $validation_error_row_indexes[] = $index;
                $is_valid = false;
            }
        }

        if ((isset($single_row['key']) && strlen($single_row['key']) > 255) || (isset($single_row['value']) && strlen($single_row['value']) > 255)) {
            $validation_error_row_indexes[] = $index;
            $is_valid = false;
        }
    }

    $validation_error_row_indexes = array_unique($validation_error_row_indexes);
    if ($validation_error_row_indexes) {
        set_transient('ssmt_basic_configuration_meta_configuration_list_validation_error_row_indexes', $validation_error_row_indexes, 5);
    }

    return $is_valid;
}

function ssmt_advanced_settings_validate($input) {
    $is_valid = true;
    if (isset($input['ssmt_advanced_settings_show_ssmt_branding']) && $input['ssmt_advanced_settings_show_ssmt_branding'] !== '1') {
        $is_valid = false;
    }
    if (isset($input['ssmt_advanced_settings_enable_caching']) && $input['ssmt_advanced_settings_enable_caching'] !== '1') {
        $is_valid = false;
    }
    if (isset($input['ssmt_advanced_settings_use_dynamic_tags']) && $input['ssmt_advanced_settings_use_dynamic_tags'] !== '1') {
        $is_valid = false;
    }

    return $is_valid;
}

/**
 * Sanitize the form submission data.
 * 1. If the data is not an array, do not save it.
 * 2. Do not save empty rows.
 * 3. Sanitize the order, type, key and value.
 * 4. Sort the data based on the order in descending order.
 */
function ssmt_basic_configuration_meta_configuration_list_sanitize($input) {
    if (!is_array($input)) {
        return [];
    }

    $direct_type_allow_tags = [
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

    $input = array_filter($input, function ($row) {
        return !empty($row['type']);
    });

    $input = array_map(function ($row) use ($direct_type_allow_tags) {
        $order  = intval($row['order'] ?? 0);
        $type   = sanitize_text_field($row['type'] ?? '');
        $key    = sanitize_text_field($row['key'] ?? '');
        $value  = str_replace(["\'", "'", '\"', '\\"', '\\\"', '\\\\"', '\\\\\"'], '"', $row['value'] ?? '');
        $value  = wp_kses($value, $direct_type_allow_tags);

        return [
            'order' => $order,
            'type'  => $type,
            'key'   => $key,
            'value' => $value,
        ];
    }, $input);

    array_multisort(array_column($input, 'order'), SORT_DESC, $input);

    return $input;
}

function ssmt_advanced_settings_sanitize($input) {
    $sanitized_data = [];
    $sanitized_data['ssmt_advanced_settings_show_ssmt_branding'] = isset($input['ssmt_advanced_settings_show_ssmt_branding']) ? true : false;
    $sanitized_data['ssmt_advanced_settings_enable_caching']     = isset($input['ssmt_advanced_settings_enable_caching'])     ? true : false;
    $sanitized_data['ssmt_advanced_settings_use_dynamic_tags']   = isset($input['ssmt_advanced_settings_use_dynamic_tags'])   ? true : false;

    if (!ssmt_is_licensed()) {
        $sanitized_data['ssmt_advanced_settings_show_ssmt_branding'] = true;
        $sanitized_data['ssmt_advanced_settings_use_dynamic_tags']   = false;
    }

    return $sanitized_data;
}
