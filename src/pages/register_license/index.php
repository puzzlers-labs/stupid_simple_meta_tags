<?php

function ssmt_register_license_init() {
    $return_url = '';
    if (isset($_REQUEST['return_url'])) {
        $return_url = esc_url($_REQUEST['return_url']);
        set_transient('ssmt_register_license_return_url', $return_url, 60 * 5); // 5 minutes
    }

    $is_licensed = ssmt_is_licensed();
    if (isset($_REQUEST['ssmt_license_key']) && $_REQUEST['ssmt_license_key']) {
        $license_key = ssmt_license_key_sanatizer($_REQUEST['ssmt_license_key']);
        update_option('ssmt_admin_settings_license_key', $license_key, true);

        $return_url = get_transient('ssmt_register_license_return_url') ?: admin_url('admin.php?page=ssmt_settings_old');
        delete_transient('ssmt_register_license_return_url');
    }
    $is_licensed = ssmt_is_licensed();
    $register_license_url = "";
    if (!$is_licensed) {
        $register_return_url  = admin_url('admin.php?page=ssmt_register_license');
        $register_license_url = 'https://ssmt.app/register-license?return_url=' . urlencode($register_return_url);
    }
    $validate_license_link = 'https://puzzlers-labs.free.beeceptor.com/check_license';

    add_filter('admin_footer_text', 'add_ssmt_footer_message');

    wp_enqueue_style('common-css', SSMT_PLUGIN_URL . 'assets/css/common.css', array(), SSMT_VERSION);
    wp_enqueue_style('loading-spinner-css', SSMT_PLUGIN_URL . 'assets/css/loading_spinner.css', array(), SSMT_VERSION);
    wp_enqueue_style('register-license-css', SSMT_PLUGIN_URL . 'assets/css/register_license.css', array(), SSMT_VERSION);

    wp_enqueue_script('register-license-js', SSMT_PLUGIN_URL . 'assets/js/register_license.js', array(), SSMT_VERSION);
    wp_localize_script('register-license-js', 'ssmt_register_license_data', array(
        'isLicensed'           => ssmt_is_licensed() ? 'true' : 'false',
        'registerLicenseURL'   => $register_license_url ?? '',
        'validateLicenseURL'   => admin_url('admin-ajax.php'),
        'validateNonce'        => wp_create_nonce('ssmt_register_license_validate'),
        'returnURL'            => $return_url,
        'registerLicenseWPURL' => admin_url('admin.php?page=ssmt_register_license&return_url=' . $return_url),
    ));

    ssmt_register_license_render($register_license_url);
}

function ssmt_register_license_render($register_license_url) {
    // This variable is used in the template file.
    require SSMT_PLUGIN_PATH . 'pages/register_license/template/index.php';
}

function ssmt_license_key_sanatizer($license_key) {
    return sanitize_text_field($license_key);
}
