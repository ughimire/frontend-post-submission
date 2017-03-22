<?php
/*
Plugin Name: Frontend Post Submission
Plugin URI: http://umeshghimire.com.np
Description: Frontend post submission builder without login
Author: Umesh Ghimire
Author URI: http://umeshghimire.com.np
Text Domain: frontend-post-submission
Domain Path: /languages/
Version: 1.0
*/

// Plugin Name and its version
define('FP_BUILDER', '1.0');


// Plugin label
define('FP_BUILDER_SUBMISSION_LABEL', 'FP Builder');


// Directory seperator constant
define("FP_BUILDER_DS", DIRECTORY_SEPARATOR);


// Required minimum version of wordpress to install this plugin
define('FP_BUILDER_MIN_WORDPRESS_VERSION', '4.6');


// Required minimum php version
define('FP_BUILDER_MIN_PHP_VERSION', '5.0');


// Plugin file path
define('FP_BUILDER_PLUGIN', __FILE__);


// base path for plugin
define('FP_BUILDER_BASE', plugin_basename(FP_BUILDER_PLUGIN));


// plugin name
define('FP_BUILDER_PLUGIN_NAME', trim(dirname(FP_BUILDER_BASE), '/'));


// plugin directory
define('FP_BUILDER_PLUGIN_DIR', untrailingslashit(dirname(FP_BUILDER_PLUGIN)));


// packages path
define('FP_BUILDER_PLUGIN_PACKAGES_DIR', WP_PLUGIN_DIR . FP_BUILDER_DS . FP_BUILDER_PLUGIN_NAME . FP_BUILDER_DS . 'packages' . FP_BUILDER_DS);


// packages path
define('FP_BUILDER_PLUGIN_HELPER_DIR', WP_PLUGIN_DIR . FP_BUILDER_DS . FP_BUILDER_PLUGIN_NAME . FP_BUILDER_DS . 'helper' . FP_BUILDER_DS);


// plugin directory
define('FP_BUILDER_PLUGIN_URL', plugins_url('/', FP_BUILDER_PLUGIN));


if (!class_exists('FPLoader')) {

    // Don't activate on anything less than PHP FP_BUILDER_MIN_PHP_VERSION or WordPress FP_BUILDER_MIN_WORDPRESS_VERSION
    if (version_compare(PHP_VERSION, FP_BUILDER_MIN_PHP_VERSION, '<') || version_compare(get_bloginfo('version'), FP_BUILDER_MIN_WORDPRESS_VERSION, '<') || !function_exists('spl_autoload_register')) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
        deactivate_plugins(__FILE__);
        die('BackWPup requires PHP version 5.2.7 with spl extension or greater and WordPress 3.8 or greater.');
    }

    //Start this plugin
    if (function_exists('add_filter')) {

        add_action('plugins_loaded', array('FPLoader', 'FPLoad'), 11);

        require_once FP_BUILDER_PLUGIN_DIR . FP_BUILDER_DS . 'FPLoader.php';
    }
}



