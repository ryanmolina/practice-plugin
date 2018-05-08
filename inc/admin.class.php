<?php

class PPAdmin {
	const NONCE = 'pp-admin-settings';
	private static $initiated = false;
	
	public static function init() {
		if(!self::$initiated) {
			self::init_hooks();
		}
	}

	public static function init_hooks() {
		self::$initiated = true;
		echo plugin_basename(__FILE__);
		add_action('admin_menu', array('PPAdmin', 'register_menu_page'));
		add_filter('plugin_action_links_' . plugin_basename(__FILE__),
					array('PPAdmin', 'settings_link'));
	}

	public static function settings_link($links) {
		$settings_link = '<a href="options-general.php?page=practice-plugin-prices">Settings</a>';
		array_push($links, $settings_link);
		return $links;
	}

	public static function register_menu_page() {
		add_menu_page(
			__('Practice Plugin Page Title', 'practice-plugin'),
			__('Practice Plugin Menu', 'practice-plugin'),
			'manage_options',
			'practice-plugin',
			array('PPAdmin', 'admin'),
			'',
			81
		);

		add_submenu_page(
			'practice-plugin',
			__('Help', 'practice-plugin'),
			__('Help', 'practice-plugin'),
			'manage_options',
			'practice-plugin-prices',
			array('PPAdmin', 'admin_help')
		);
	}

	public static function admin() {
		echo 'Admin';
	}

	public static function admin_help() {
		require_once PRACTICE_PLUGIN_URL . '/partials/admin-help.php';
	}

}