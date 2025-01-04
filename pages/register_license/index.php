<?php

function ssmt_register_license_init() {
    add_filter('admin_footer_text', 'add_ssmt_footer_message');

    wp_enqueue_style('common-css', SSMT_PLUGIN_URL . 'assets/css/common.css');
    wp_enqueue_style('register-license-css', SSMT_PLUGIN_URL . 'assets/css/register_license.css');

    echo ssmt_register_license_render();
}

function ssmt_register_license_render() {
    $register_license_link = admin_url('admin.php?page=ssmt_register_license');

    ob_start();
    require SSMT_PLUGIN_PATH . 'pages/register_license/template/index.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}
