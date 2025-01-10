<?php

function ssmt_feedback_init() {
    add_filter('admin_footer_text', 'add_ssmt_footer_message');

    wp_enqueue_style('common-css', SSMT_PLUGIN_URL . 'assets/css/common.css');
    wp_enqueue_style('feedback-css', SSMT_PLUGIN_URL . 'assets/css/feedback.css');

    wp_enqueue_script('feedback-js', SSMT_PLUGIN_URL . 'assets/js/feedback.js');
    wp_localize_script('feedback-js', 'feedback_data', array(
        'adminAjaxURL'  => admin_url('admin-ajax.php'),
    ));

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

function get_sha_for_version($version_to_check) {
    $fileContent = file_get_contents('https://raw.githubusercontent.com/puzzlers-labs/stupid_simple_meta_tags/refs/heads/main/checksums.txt');

    if ($fileContent === false) {
        return '';
    }

    $lines = explode("\n", $fileContent);
    foreach ($lines as $single_line) {
        // Skip empty lines, row breaker lines and lines that have the header information
        if (trim($single_line) === '' || strpos($single_line, 'VERSION') !== false || strpos($single_line, '=') !== false) {
            continue;
        }

        $single_line_parts = array_map('trim', explode('|', $single_line));

        // Ensure the line has the expected structure
        if (count($single_line_parts) < 3) {
            continue;
        }

        // Extract the version and SHA
        $release_version = $single_line_parts[0];
        $release_sha     = $single_line_parts[1];

        // Check if the version matches
        if ($release_version == $version_to_check) {
            return $release_sha;
        }
    }
    return '';
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
