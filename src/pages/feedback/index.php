<?php
if (!defined('ABSPATH')) exit;

function ssmt_feedback_init() {
    add_filter('admin_footer_text', 'ssmt_add_footer_message');

    wp_enqueue_style('common-css', SSMT_PLUGIN_URL . 'assets/css/common.css', array(), SSMT_VERSION);
    wp_enqueue_style('feedback-css', SSMT_PLUGIN_URL . 'assets/css/feedback.css', array(), SSMT_VERSION);

    ssmt_feedback_render();
}

function ssmt_feedback_render() {
    require SSMT_PLUGIN_PATH . 'pages/feedback/template.php';
}

function ssmt_linux_compatible_file_sort($a, $b) {
    if ($a[0] == '.' && $b[0] != '.') return -1;
    if ($a[0] != '.' && $b[0] == '.') return 1;

    if (strpos($a, $b) !== false || strpos($b, $a) !== false) {
        if (pathinfo($a, PATHINFO_EXTENSION) && !pathinfo($b, PATHINFO_EXTENSION)) return -1;
        if (!pathinfo($a, PATHINFO_EXTENSION) && pathinfo($b, PATHINFO_EXTENSION)) return 1;
    }

    return strcmp($a, $b);
}

function ssmt_feedback_get_files_list($directory) {
    $files = [];
    $directory_contents = scandir($directory);
    usort($directory_contents, 'ssmt_linux_compatible_file_sort');

    foreach ($directory_contents as $file) {
        if ($file == '.' || $file == '..') continue;
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
    $fileList   = ssmt_feedback_get_files_list(SSMT_PLUGIN_PATH);
    $fileHashes = [];
    foreach ($fileList as $idx => $file) {
        $fileHashes[$idx] = hash_file('sha256', $file);
    }
    return hash('sha256', implode('', $fileHashes));
}

/**
 * Fetch per-file checksums from the WordPress.org plugin checksums API.
 * This is the same endpoint WordPress core uses for integrity verification.
 * Results are cached in a transient to avoid repeated API calls.
 *
 * @return array|null Associative array of relative-path => sha256, or null if unavailable.
 */
function ssmt_feedback_get_remote_checksums() {
    $transient_key = 'ssmt_checksums_' . SSMT_VERSION;
    $cached        = get_transient($transient_key);

    if ($cached !== false) {
        return $cached === 'unavailable' ? null : $cached;
    }

    $plugin_slug = dirname(plugin_basename(SSMT_PLUGIN_FILE));
    $response    = wp_remote_get(
        'https://downloads.wordpress.org/plugin-checksums/' . $plugin_slug . '/' . SSMT_VERSION . '.json'
    );

    if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {
        set_transient($transient_key, 'unavailable', HOUR_IN_SECONDS);
        return null;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);

    if (!isset($data['files']) || !is_array($data['files'])) {
        set_transient($transient_key, 'unavailable', HOUR_IN_SECONDS);
        return null;
    }

    set_transient($transient_key, $data['files'], DAY_IN_SECONDS);
    return $data['files'];
}

/**
 * Verify local plugin files against WordPress.org published checksums.
 *
 * @return string|array 'verified', 'unavailable', or array of modified file paths.
 */
function ssmt_feedback_verify_plugin_integrity() {
    $remote_checksums = ssmt_feedback_get_remote_checksums();

    if ($remote_checksums === null) {
        return 'unavailable';
    }

    $modified_files = [];
    foreach ($remote_checksums as $relative_path => $expected_hash) {
        $local_file = SSMT_PLUGIN_PATH . $relative_path;
        if (!file_exists($local_file)) {
            $modified_files[] = $relative_path;
            continue;
        }
        if (hash_file('sha256', $local_file) !== $expected_hash) {
            $modified_files[] = $relative_path;
        }
    }

    return empty($modified_files) ? 'verified' : $modified_files;
}
