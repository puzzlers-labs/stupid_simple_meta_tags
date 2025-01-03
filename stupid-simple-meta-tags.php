<?php

define('WP_DEBUG', true);

error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Plugin Name:        Stupid Simple Meta Tags (SSMT)
 * Plugin URI:         https://puzzlers-labs.com/
 * Description:        A simple plugin to add meta tags to the head of your site.
 * Plugin Logo:        https://puzzlers-labs.com/assets/images/logo/Logo%20cropped.png
 * Requires at least:  5.2
 * Requires PHP:       7.2
 * Version:            0.1.0
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

define('STUPID_SIMPLE_META_TAGS_PLUGIN_FILE', __FILE__);
define('STUPID_SIMPLE_META_TAGS_PLUGIN_PATH', plugin_dir_path(STUPID_SIMPLE_META_TAGS_PLUGIN_FILE));
define('STUPID_SIMPLE_META_TAGS_PLUGIN_URL',  plugin_dir_url(STUPID_SIMPLE_META_TAGS_PLUGIN_FILE));

require STUPID_SIMPLE_META_TAGS_PLUGIN_PATH . 'config.php';

require STUPID_SIMPLE_META_TAGS_PLUGIN_PATH . 'hooks/activate.php';
require STUPID_SIMPLE_META_TAGS_PLUGIN_PATH . 'hooks/deactivate.php';
require STUPID_SIMPLE_META_TAGS_PLUGIN_PATH . 'hooks/initialize.php';
require STUPID_SIMPLE_META_TAGS_PLUGIN_PATH . 'hooks/install.php';
require STUPID_SIMPLE_META_TAGS_PLUGIN_PATH . 'hooks/uninstall.php';

// Give fallback defines.
if (!defined('STUPID_SIMPLE_META_TAGS_VERSION')) {
    define('STUPID_SIMPLE_META_TAGS_VERSION', '0.0.0-alpha');
}
if (!defined('STUPID_SIMPLE_META_TAGS_META_KEY_OPTIONS')) {
    define('STUPID_SIMPLE_META_TAGS_META_KEY_OPTIONS', []);
}

// import common functions.
require STUPID_SIMPLE_META_TAGS_PLUGIN_PATH . 'includes/common.php';

register_activation_hook(STUPID_SIMPLE_META_TAGS_PLUGIN_FILE,   'stupid_simple_meta_tags_activated');
register_deactivation_hook(STUPID_SIMPLE_META_TAGS_PLUGIN_FILE, 'stupid_simple_meta_tags_deactivated');
register_uninstall_hook(STUPID_SIMPLE_META_TAGS_PLUGIN_FILE,    'stupid_simple_meta_tags_uninstalled');

stupid_simple_meta_tags_initialized();
