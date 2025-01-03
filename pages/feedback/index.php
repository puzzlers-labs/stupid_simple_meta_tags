<?php

function ssmt_feedback_init() {
    add_filter('admin_footer_text', 'add_ssmt_footer_message');

    wp_enqueue_script('settings-js', SSMT_PLUGIN_URL . 'assets/js/settings.js');

    wp_enqueue_style('settings-css', SSMT_PLUGIN_URL . 'assets/css/common.css');
    wp_enqueue_style('settings-css', SSMT_PLUGIN_URL . 'assets/css/settings.css');
    echo ssmt_feedback_render();
}

function ssmt_feedback_render() {
    //Wordpress uses echo approach instead of returning the template strings. Therefore need to parse the buffer.
    ob_start();
    require SSMT_PLUGIN_PATH . 'pages/feedback/template.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

function ssmt_feedback_get_files_list($directory) {
    $files = [];

    foreach (scandir($directory) as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        }

        $filePath = $directory . $file;
        if (is_dir($filePath)) {
            $files = array_merge($files, ssmt_feedback_get_files_list($filePath . '/'));
        } else {
            $files[] = $filePath;
        }
    }

    return $files;
}

function ssmt_feedback_compute_plugin_sha() {
    $hash = hash_init('sha256');
    $fileList = ssmt_feedback_get_files_list(SSMT_PLUGIN_PATH);

    foreach ($fileList as $file) {
        hash_update($hash, file_get_contents($file));
    }

    return hash_final($hash);
}
