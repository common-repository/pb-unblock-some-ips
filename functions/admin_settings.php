<?php

	if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

	// Include CSS for some styling
	add_action( 'admin_enqueue_scripts', function() {
		wp_enqueue_style( 'pbusi-styles-admin', PBUSI_PLUGIN_URL . 'assets/css/pbusi-styles-admin.css', array(),PBUSI_VERSION, 'all');
	});

	add_action( 'admin_menu', 'pbusi_admin_menu' );
	function pbusi_admin_menu() {
		add_options_page( 'PB Unblock some IPs', 'PB Unblock some IPs', 'manage_options', 'pb-unblock-some-ips', 'pbusi_options_page' );
	}

	add_action( 'admin_init', 'pbusi_admin_init' );
	function pbusi_admin_init() {
		register_setting( 'pbusi-settings-group', 'pbusi-setting-ips' );
		register_setting( 'pbusi-settings-group', 'pbusi-setting-active' );
		register_setting( 'pbusi-settings-group', 'pbusi-setting-slug' );
		register_setting( 'pbusi-settings-group', 'pbusi-setting-email' );
		add_settings_section( 'pbusi-section-one', '', 'pbusi_section_one_datareturn', 'pb-unblock-some-ips' );
		add_settings_field( 'pbusi-field-one', __( 'Enable blocking (all IPs)' , 'pb-unblock-some-ips' ), 'pbusi_field_one_datareturn', 'pb-unblock-some-ips', 'pbusi-section-one' );
		add_settings_field( 'pbusi-field-two', __('Unblock these IPs' , 'pb-unblock-some-ips') . '<br>(' . __('yours is' , 'pb-unblock-some-ips') . ' <code>' . $_SERVER["REMOTE_ADDR"] . '</code>)', 'pbusi_field_two_datareturn', 'pb-unblock-some-ips', 'pbusi-section-one' );
		add_settings_field( 'pbusi-field-three', __('Custom Admin URL' , 'pb-unblock-some-ips') . '<br>(' . __('fill slug if using' , 'pb-unblock-some-ips') . ')', 'pbusi_field_three_datareturn', 'pb-unblock-some-ips', 'pbusi-section-one' );
		add_settings_field( 'pbusi-field-four', __('Unblock E-mail Address' , 'pb-unblock-some-ips') . '<br>(' . __('fill if you want to enable Unblock Requests by e-mail' , 'pb-unblock-some-ips') . ')', 'pbusi_field_four_datareturn', 'pb-unblock-some-ips', 'pbusi-section-one' );
	}
	function pbusi_section_one_datareturn() {
		echo '<p><strong>' . __('"PB Unblock some IPs" lets you block the access to your website when developing (like on a staging environment) - but unblock some IPs for viewing' , 'pb-unblock-some-ips') . '.</strong></p>
             <p>' . __('Check "Enable blocking" to enable the block, then add the IP addresses which should be able to view the website (one per line, no commas or spaces)' , 'pb-unblock-some-ips') . '.</p>';
	}

	function pbusi_field_one_datareturn() { ?>
        <input class="regular-text" type="checkbox" name="pbusi-setting-active" value="1" <?php checked(1, get_option('pbusi-setting-active'), true); ?> />
	<?php }

	function pbusi_field_two_datareturn() {
		$pbusi_settings_ips_convert = esc_attr( get_option( 'pbusi-setting-ips' ) ); // Get Settings Field Values
		$pbusi_settings_ips_convert = str_replace(',', "\n", $pbusi_settings_ips_convert ); // Convert 'old' commas to linebreaks ?>
		<textarea rows="10" cols="90" class="regular-text" placeholder="<?php echo __('IP addresses, One per line, No commas' , 'pb-unblock-some-ips'); ?>" name="pbusi-setting-ips"><?php echo $pbusi_settings_ips_convert; ?></textarea>
	<?php }

	function pbusi_field_three_datareturn() {
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') $pbusi_protocol = 'https://';
		else $pbusi_protocol = 'http://';
		echo $pbusi_protocol . $_SERVER['HTTP_HOST'] . '/'; ?><input class="regular-text admin-slug" type="text" placeholder="<?php echo __('e.g.: secret-admin-login' , 'pb-unblock-some-ips'); ?>" name="pbusi-setting-slug" value="<?php echo esc_attr( get_option( 'pbusi-setting-slug' ) ); ?>" />/
	<?php }

	function pbusi_field_four_datareturn() { ?>
		<input class="regular-text admin-slug" type="text" placeholder="<?php echo __('e.g.: admin@website.com' , 'pb-unblock-some-ips'); ?>" name="pbusi-setting-email" value="<?php echo esc_attr( get_option( 'pbusi-setting-email' ) ); ?>" />
	<?php }

	function pbusi_options_page() { ?>
        <div class="wrap">
            <h1><img width="355px" valign="top" id="pbusi_title_logo" alt="<?php echo PBUSI_NAME; ?>" src="<?php echo PBUSI_PLUGIN_URL . '/assets/images/pbusi-logo.png'; ?>" style="max-width:100%" />
              <span class="description "><?php echo __('Version' , 'pb-unblock-some-ips') . ' ' . PBUSI_VERSION; ?></span></h1>
            <form action="options.php" method="POST">
                <div id="poststuff">
                    <div class="meta-box-sortables ui-sortable">
                        <div class="postbox">
                            <div class="inside">
                                <?php settings_fields( 'pbusi-settings-group' ); ?>
                                <?php do_settings_sections( 'pb-unblock-some-ips' ); ?>
                                <?php submit_button(); ?>
                            </div>
                        </div>
                    </div>
                    <?php include_once PBUSI_PLUGIN_DIR . 'functions/footer.php'; ?>
                </div>
            </form>
        </div>
		<?php
	}

	function pbusi_toolbar_status_link( $wp_admin_bar ) {
		$pbusi_status = get_option('pbusi-setting-active');
		if ( $pbusi_status === '1') {
			$pbusi_status_active = '<span class="ab-icon dashicons dashicons-yes-alt"></span>';
		} else {
			$pbusi_status_active = '<span class="ab-icon dashicons dashicons-no"></span>';
		}
		$args = array(
			'id'    => 'pbusi_toolbar_status_link',
			'title' => $pbusi_status_active . __( ' Unblock Some IPs', 'pb-unblock-some-ips' ),
			'href'  => 'options-general.php?page=pb-unblock-some-ips',
			'meta'  => array(
				'class' => 'pbusi-toolbar-status-link'
			)
		);
		$wp_admin_bar->add_node( $args );
	}
	add_action( 'admin_bar_menu', 'pbusi_toolbar_status_link', 999 );