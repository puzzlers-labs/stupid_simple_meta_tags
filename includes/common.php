<?php

/**
 * Common functions for the plugin.
 * @author Puzzlers Labs Pvt. Ltd. <tech@puzzlers-labs.com>
 */

function stupid_simple_meta_tags_init()
{

    add_action('enqueue_block_editor_assets', 'enqueue_custom_editor_plugin');

    add_action('wp_head', 'hook_javascript');
}

function enqueue_custom_editor_plugin()
{
    wp_enqueue_script(
        'custom-editor-plugin',
        plugins_url('custom-editor-plugin.js', __FILE__),
        array('wp-plugins', 'wp-edit-post', 'wp-components', 'wp-element', 'wp-data'),
        '1.0',
        true
    );
}

function hook_javascript()
{
    var_dump(get_post_meta(get_the_ID()));
}
