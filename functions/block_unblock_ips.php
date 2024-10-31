<?php if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if (get_option('pbusi-setting-active') === '1') { // Enable plugin if "Enabled" is checked

	$pbusi_ip_block_ips = get_option('pbusi-setting-ips'); // Get IPs from Admin field
	$pbusi_ip_block_ips = str_replace(',', "\n", $pbusi_ip_block_ips ); // Convert 'old' commas to linebreaks
	$pbusi_ip_block_ips = str_replace("\n", ',', $pbusi_ip_block_ips ); // Convert linebreaks to Array Commas
	$pbusi_ip_block_ips = preg_replace('/\s+/', '', $pbusi_ip_block_ips ); // Strip Spaces

	$pbusi_ip_block_list = explode(",", $pbusi_ip_block_ips); // Make Array with IP Addresses
	$pbusi_ip_block_list = array_unique($pbusi_ip_block_list); // Filter out doubles

	if ( get_option( 'pbusi-setting-slug') !== '' ) {
		$pbusi_custom_admin_slug = get_option('pbusi-setting-slug');
	} else {
		$pbusi_custom_admin_slug = 'wp-admin';
	}

	if (!is_admin() // Keep "admin" accessible
		&& strpos($_SERVER['REQUEST_URI'], $pbusi_custom_admin_slug) === false
		&& strpos($_SERVER['REQUEST_URI'], 'wp-login.php') === false
		&& strpos($_SERVER['REQUEST_URI'], 'wp-signup.php') === false) {

		if (!in_array($_SERVER['REMOTE_ADDR'], $pbusi_ip_block_list)) {
			// Display plain HTML 404 block page with visitors IP Address & E-Mail Link if filled
			include_once "block_page.php";
		} else {
			// Unblock Page / Website visible for all visitors
		}
	}
}