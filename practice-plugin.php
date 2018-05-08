<?php
/**
 * @package PracticePlugin
 * Plugin Name: Practice Plugin
 * Plugin URI: http://ibinex.com/
 * Description: A brief description about your plugin.
 * Version: 1.0.0
 * Author: Ryan Gabriel Molina
 * Author URI: https://github.com/ryangmolina
 * License: GPLv2 or later
**/

/**
 * Securing your Plugin
 * don't load directly or prevents access through the url
**/

// https://codepen.io/artuurs/pen/YEJBvg
// https://codepen.io/wortmann/pen/KQPQaR?page=1&

// Method 1 will dief if ABSPATH is not defined
if(!defined('ABSPATH')) {
	exit;
}

// Method 2 will die if ABSPATH is not defined [null coalesce] 
defined('ABSPATH') or die("Hey, you can't access this file, you silly human! [defined(ABSPATH)]");

// Method 3 it means we are not in wordpress
if(!function_exists('add_action')) {
	echo "Hey, you can't access this file, silly human! [!function_exists(add_action)]";
	exit;
}

// Define the PLUGIN URL
define('PRACTICE_PLUGIN_URL', dirname(__FILE__));

if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require_once( dirname(__FILE__) . '/inc/admin.class.php' );
    add_action( 'init', array( 'PPAdmin', 'init' ) );
}

require_once dirname(__FILE__) . '/inc/practiceplugin.class.php';
if(class_exists('Practice_Plugin')) {
    $practice_plugin = new Practice_Plugin('Practice Plugin initialized');
    /**
     * Useful in triggering actions when plugin is activated .
     * (Generate a CPT, Flush rewrite rules, etc.)
     */
    register_activation_hook(__FILE__, array($practice_plugin, 'activate'));
    /**
     * Useful in triggering actions when plugin is deactivated.
     * (Flush rewrite rules etc.)
     */
    register_deactivation_hook(__FILE__, array($practice_plugin, 'activate'));
    /**
     * Useful in triggreing actions when plugin is uninstalled.
     * (Delete data etc.)
     */
    register_uninstall_hook(__FILE__, array($practice_plugin, 'uninstall'));
} else {
    echo "Practice_Plugin doesn't exists";
}

