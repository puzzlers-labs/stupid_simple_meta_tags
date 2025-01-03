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

define('SSMT_PLUGIN_FILE', __FILE__);
define('SSMT_PLUGIN_PATH', plugin_dir_path(SSMT_PLUGIN_FILE));
define('SSMT_PLUGIN_URL',  plugin_dir_url(SSMT_PLUGIN_FILE));

require SSMT_PLUGIN_PATH . 'config.php';

require SSMT_PLUGIN_PATH . 'hooks/activate.php';
require SSMT_PLUGIN_PATH . 'hooks/deactivate.php';
require SSMT_PLUGIN_PATH . 'hooks/initialize.php';
require SSMT_PLUGIN_PATH . 'hooks/install.php';
require SSMT_PLUGIN_PATH . 'hooks/uninstall.php';

// Give fallback defines.
if (!defined('SSMT_VERSION')) {
    define('SSMT_VERSION', '0.0.0-alpha');
}
if (!defined('SSMT_META_KEY_OPTIONS')) {
    define('SSMT_META_KEY_OPTIONS', []);
}

// import common functions.
require SSMT_PLUGIN_PATH . 'includes/common.php';

register_activation_hook(SSMT_PLUGIN_FILE,   'ssmt_activated');
register_deactivation_hook(SSMT_PLUGIN_FILE, 'ssmt_deactivated');
register_uninstall_hook(SSMT_PLUGIN_FILE,    'ssmt_uninstalled');

ssmt_initialized();
