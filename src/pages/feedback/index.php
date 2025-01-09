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

function ssmt_linux_compatible_file_sort($a, $b) {
    // Prioritize items starting with a dot
    if ($a[0] == '.' && $b[0] != '.') {
        return -1;
    }
    if ($a[0] != '.' && $b[0] == '.') {
        return 1;
    }

    // Check if either filename is a substring of the other
    if (strpos($a, $b) !== false || strpos($b, $a) !== false) {
        // If file a has an extension and b does not, a should come first
        if (pathinfo($a, PATHINFO_EXTENSION) && !pathinfo($b, PATHINFO_EXTENSION)) {
            return -1;
        }
        if (!pathinfo($a, PATHINFO_EXTENSION) && pathinfo($b, PATHINFO_EXTENSION)) {
            return 1;
        }
    }

    // Alphabetical sorting otherwise
    return strcmp($a, $b);
}

function ssmt_feedback_get_files_list($directory) {
    $files = [];

    $directory_contents = scandir($directory);
    usort($directory_contents, 'ssmt_linux_compatible_file_sort');

    foreach ($directory_contents as $file) {
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
    $fileList = ssmt_feedback_get_files_list(SSMT_PLUGIN_PATH);
    $fileHashes = [];

    foreach ($fileList as $idx => $file) {
        $fileHashes[$idx] = hash_file('sha256', $file);
    }
    $concatedHashes = implode('', $fileHashes);
    $pluginHash     = hash('sha256', $concatedHashes);

    return $pluginHash;
}
