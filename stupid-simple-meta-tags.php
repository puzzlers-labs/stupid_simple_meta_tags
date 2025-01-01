<?php

/**
 * Plugin Name:        Stupid Simple Meta Tags (SSMT)
 * Plugin URI:         https://puzzlers-labs.com/
 * Description:        A simple plugin to add meta tags to the head of your site.
 * Plugin Logo:        https://puzzlers-labs.com/assets/images/logo/Logo%20cropped.png
 * Requires at least:  5.2
 * Requires PHP:       7.2
 * Version:            1.0.0
 * Author:             Puzzlers Labs Pvt. Ltd.
 * Text Domain:        stupid_simple_meta_tags
 * Author URI:         https://puzzlers-labs.com/
 * License:            Expat License
 * License URI:        https://directory.fsf.org/wiki/License:Expat	
 */


// Only load the plugin if it is running in a Wordpress environment.
if (!defined('WPINC')) {
    die('Uh oh, this is not a Wordpress environment.');
}

// Define the plugin version.
define('STUPID_SIMPLE_META_TAGS_VERSION', '1.0.0');

/**
 * Handlers for the activation and deactivation of the plugin.
 */
function activate_stupid_simple_meta_tags()
{
    require_once plugin_dir_path(__FILE__) . 'includes/activator.php';
    stupid_simple_meta_tags_activate();
}

function deactivate_stupid_simple_meta_tags()
{
    require_once plugin_dir_path(__FILE__) . 'includes/deactivator.php';
    stupid_simple_meta_tags_deactivate();
}

register_activation_hook(__FILE__, 'activate_stupid_simple_meta_tags');
register_deactivation_hook(__FILE__, 'deactivate_stupid_simple_meta_tags');


require plugin_dir_path(__FILE__) . 'includes/common.php';
require plugin_dir_path(__FILE__) . 'admin/index.php';

stupid_simple_meta_tags_init();
