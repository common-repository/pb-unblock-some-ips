<?php if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

	$pbusi_admin_email          = get_option('pbusi-setting-email');
	$pbusi_blockpage_ip         = $_SERVER['REMOTE_ADDR'];  // Get visitor IP
	$pbusi_blockpage_link       = "";   // Declare empty variable
	$pbusi_blockpage_subject    = __('Please Unblock my IP Address', 'pb-unblock-some-ips');    // Subject for e-mail
	$pbusi_blockpage_body       = __('This message was send from', 'pb-unblock-some-ips') . " " . get_home_url() . " " . __('with the', 'pb-unblock-some-ips') . "<strong> " . PBUSI_NAME . "</strong> Wordpress plugin.";  // Body for e-mail

	if (empty( $pbusi_admin_email )) {
		$pbusi_blockpage_email = ""; // Declare empty variable
	} else {
		$pbusi_blockpage_email = urlencode( $pbusi_admin_email ); // Encode @ sign for double security
	}

	if(!empty( $pbusi_blockpage_email )) { // Show E-mail link when an e-mail is filled in on options page
		$pbusi_blockpage_link = '<a href="#" data-c="' . base64_encode( $pbusi_blockpage_email )
			. '" data-s="' . base64_encode( $pbusi_blockpage_subject ) . '" data-m="' . base64_encode("<h2>" . $pbusi_blockpage_ip . "</h2><br><br>"
			. "<i>" . $pbusi_blockpage_body. "</i>")
			. '" onfocus="this.href = \'mailto:\' + atob(this.dataset.c) + \'?subject=\' + atob(this.dataset.s) + \'&body=\' + atob(this.dataset.m || \'\')">'
			. __('Send request to Unblock', 'pb-unblock-some-ips') . '</a> ';
	}

	header("HTTP/1.0 404 Not Found"); // 404 Block page content
	die('<html><head><title>' . __('Error 404: Page not found', 'pb-unblock-some-ips') . '</title>'
		. '<meta name="robots" content="noindex, nofollow"><meta name="googlebot" content="noindex" /></head><body>'
		. '<h1>' . __('Page not found', 'pb-unblock-some-ips') . '</h1><p>'
		. __('The page you requested was not found.', 'pb-unblock-some-ips')
		. '<br><br>' . $pbusi_blockpage_link
		. 'IP ' . $pbusi_blockpage_ip
		. '</p></body></html>');
	exit();