<?php

function stupid_simple_meta_tags_feedback_init() {
    add_filter('admin_footer_text', 'add_stupid_simple_meta_tags_footer_message');

    wp_enqueue_script('settings-js', STUPID_SIMPLE_META_TAGS_PLUGIN_URL . 'assets/js/settings.js');

    wp_enqueue_style('settings-css', STUPID_SIMPLE_META_TAGS_PLUGIN_URL . 'assets/css/common.css');
    wp_enqueue_style('settings-css', STUPID_SIMPLE_META_TAGS_PLUGIN_URL . 'assets/css/settings.css');
    echo stupid_simple_meta_tags_feedback_render();
}


function stupid_simple_meta_tags_feedback_render() {

    //Wordpress uses echo approach instead of returning the template strings. Therefore need to parse the buffer.
    ob_start();
    require STUPID_SIMPLE_META_TAGS_PLUGIN_PATH . 'pages/feedback/template.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

function stupid_simple_meta_tags_feedback_get_files_list($directory) {
    $files = [];

    foreach (scandir($directory) as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        }

        $filePath = $directory . $file;
        if (is_dir($filePath)) {
            $files = array_merge($files, stupid_simple_meta_tags_feedback_get_files_list($filePath . '/'));
        } else {
            $files[] = $filePath;
        }
    }

    return $files;
}

function stupid_simple_meta_tags_feedback_compute_plugin_sha() {
    $hash = hash_init('sha256');
    $fileList = stupid_simple_meta_tags_feedback_get_files_list(STUPID_SIMPLE_META_TAGS_PLUGIN_PATH);

    foreach ($fileList as $file) {
        hash_update($hash, file_get_contents($file));
    }

    return hash_final($hash);
}
