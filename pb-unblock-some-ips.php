<?php

	/**
	 * Plugin Name: PB Unblock some IPs
	 * Plugin URI:  http://web.mps.systems/wp-plugin-pb-unblock-some-ips/
	 * Description: Block your website from being viewed - But unblock some IPs!
	 * Author:      Pat Bloom
	 * Author URI:  http://patbloom.com
	 * Version:     0.7.6
	 * Text Domain: pb-unblock-some-ips
	 * Domain Path: /languages
	 */

	if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

	// Plugin Name.
	if ( ! defined( 'PBUSI_NAME' ) ) {
		define( 'PBUSI_NAME', 'PB Unblock some IPs' );
	}

// Plugin version.
	if ( ! defined( 'PBUSI_VERSION' ) ) {
		define( 'PBUSI_VERSION', '0.7.6' );
	}

// Plugin Folder Path.
	if ( ! defined( 'PBUSI_PLUGIN_DIR' ) ) {
		define( 'PBUSI_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
	}

// Plugin Folder URL.
	if ( ! defined( 'PBUSI_PLUGIN_URL' ) ) {
		define( 'PBUSI_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	}

// Plugin Root File.
	if ( ! defined( 'PBUSI_PLUGIN_FILE' ) ) {
		define( 'PBUSI_PLUGIN_FILE', __FILE__ );
	}

//	Add Settings Link
	add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'pbusi_settings_link');
	function pbusi_settings_link( $pbusi_settings_url ) {
		$pbusi_settings_url[] = '<a href="' .
			admin_url( 'options-general.php?page=pb-unblock-some-ips' ) . '">' . __('Settings') . '</a>';
		return $pbusi_settings_url;
	}

// Define the class and the function.
	require_once dirname( __FILE__ ) . '/functions/admin_settings.php';
	require_once dirname( __FILE__ ) . '/functions/block_unblock_ips.php';