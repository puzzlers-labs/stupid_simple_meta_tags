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
