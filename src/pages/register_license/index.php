<?php
if (!defined('ABSPATH')) exit;

function ssmt_register_license_init() {
    $return_url = '';
    if (isset($_REQUEST['return_url'])) {
        $return_url = esc_url(sanitize_text_field(wp_unslash($_REQUEST['return_url'])));
        set_transient('ssmt_register_license_return_url', $return_url, 60 * 5); // 5 minutes
    }

    add_filter('admin_footer_text', 'ssmt_add_footer_message');

    wp_enqueue_style('common-css', SSMT_PLUGIN_URL . 'assets/css/common.css', array(), SSMT_VERSION);
    wp_enqueue_style('loading-spinner-css', SSMT_PLUGIN_URL . 'assets/css/loading_spinner.css', array(), SSMT_VERSION);
    wp_enqueue_style('register-license-css', SSMT_PLUGIN_URL . 'assets/css/register_license.css', array(), SSMT_VERSION);

    ssmt_register_license_render();
}

function ssmt_register_license_render() {
    require SSMT_PLUGIN_PATH . 'pages/register_license/template/index.php';
}
