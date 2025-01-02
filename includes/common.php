<?php

/**
 * Common functions for the plugin.
 * @author Puzzlers Labs Pvt. Ltd. <tech@puzzlers-labs.com>
 */



function add_stupid_simple_meta_tags_footer_message() {
    echo '<span id="footer-thankyou">Thank you for using Stupid Simple Meta Tags (SSMT)</span>';
    echo '<span>&nbsp;&#124;&nbsp;</span>';
    echo '<span>Copyright &copy; <a href="https://puzzlers-labs.com" target="_blank">Puzzlers Labs Pvt. Ltd.</a> All rights reserved</span>';
    echo '<span class="alignright">';
    echo 'SSMT version v' . esc_attr(STUPID_SIMPLE_META_TAGS_VERSION);
    echo '&nbsp;&#124;&nbsp;';
    echo '<a href="https://github.com/puzzlers-labs/stupid_simple_meta_tags" target="_blank" class="alignright">Github</a>';
    echo '</span>';
}

function stupid_simple_meta_tags_init() {

    add_action('enqueue_block_editor_assets', 'enqueue_custom_editor_plugin');

    add_action('wp_head', 'hook_javascript');
}

function enqueue_custom_editor_plugin() {
    wp_enqueue_script(
        'custom-editor-plugin',
        plugins_url('custom-editor-plugin.js', __FILE__),
        array('wp-plugins', 'wp-edit-post', 'wp-components', 'wp-element', 'wp-data'),
        '1.0',
        true
    );
}

function hook_javascript() {
    var_dump(get_post_meta(get_the_ID()));
}
