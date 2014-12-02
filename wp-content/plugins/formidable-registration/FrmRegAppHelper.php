<?php
 
class FrmRegAppHelper{
    
    public static function get_default_options(){
        $sitename = strtolower( $_SERVER['SERVER_NAME'] );
		if ( substr( $sitename, 0, 4 ) == 'www.' ) {
			$sitename = substr( $sitename, 4 );
		}
        
        return array(
            'registration'      => 0,
            'login'             => 0,
            'reg_avatar'        => '',
            'reg_username'      => '',
            'reg_email'         => '',
            'reg_password'      => '',
            'reg_last_name'     => '',
            'reg_first_name'    => '',
            'reg_display_name'  => '',
            'reg_role'          => 'subscriber',
            'reg_usermeta'      => array(),
            'reg_moderate'      => array(),
            'reg_redirect'      => '',
            'reg_email_subject' => '[sitename] '. __('Your username and password', 'frmreg'),
            'reg_email_msg'     => (sprintf(__('Username: %s', 'frmreg'), '[username]') . "\r\n" .
                sprintf(__('Password: %s', 'frmreg'), '[password]') . "\r\n" . wp_login_url()),
            'reg_email_sender'  => 'wordpress@'. $sitename,
            'reg_email_from'    => 'WordPress',
            'event'             => array('create', 'update'),
        );
    }

    /*
    * Check if the version number of Formidable is below 2.0
    */
    public static function is_below_2() {
        $frm_version = is_callable('FrmAppHelper::plugin_version') ? FrmAppHelper::plugin_version() : 0;
        return version_compare( $frm_version, '1.07.19' ) == '-1';
    }

    public static function username_exists($username){
        $username = sanitize_user($username, true);
        
        if(!function_exists('username_exists'))
            require_once(ABSPATH . WPINC . '/registration.php');
        
        return username_exists( $username );
    }
    
    public static function generate_unique_username($username, $count=0){
        $count = (int)$count;
        $new_username = ($count > 0) ? $username . $count : $username;

        if (FrmRegAppHelper::username_exists($new_username))
            $new_username = FrmRegAppHelper::generate_unique_username($username, $count+1);
        
        return sanitize_user($new_username, true);
    }
    
    public static function get_registration_settings($form) {
        if ( is_object($form) && isset($form->options['registration']) && $form->options['registration'] ) {
            return $form->options;
        }
        
        if ( is_numeric($form) ) {
            $form_id = $form;
        } else if ( is_object($form) ) {
            $form_id = $form->id;
        }
        
        // check for registration action
        if ( is_callable('FrmFormActionsHelper::get_action_for_form') ) {
            $action = FrmFormActionsHelper::get_action_for_form($form_id, 'register', 1);
            if ( $action ) {
                return $action->post_content;
            }
        }
        
        if ( is_object($form) ) {
            return false;
        }
        
        $frm_form = new FrmForm();
        $form = $frm_form->getOne($form);
        unset($frm_form);
        
        if ( $form && isset($form->options['registration']) && $form->options['registration'] ) {
            return $form->options;
        }
        
        return false;
    }

    /*----------------User Moderation Functions--------------------*/

    /*
    * Checks if user needs to be moderated, and routes to different moderation functions if so
    *
    * Since 1.11
    *
    * @return false if not being moderated, true otherwise
    */
	public static function moderate_user( $user_id, $user_pass, $moderate = '', $atts ) {
        //If user doesn't need to be moderated, return false - does user need to be moderated when created by a logged-in user?
        if ( !$moderate ) {
            return false;
        }

		//Get user object
		$user = new WP_User( $user_id );

        //Check if Pending role exists, add it if it doesn't
        global $wp_roles;
        $roles = $wp_roles->roles;
        if ( !array_key_exists( 'pending', $roles ) ) {
            add_role( 'pending', 'Pending', array() );
        }

		//Set user to "Pending" role
		$user->set_role( 'pending' );

        //Add user meta to specify the types of moderation that user needs
        add_user_meta( $user_id, 'frmreg_moderate', $moderate );

        //Add user meta to specify which role the user will have
        $future_role = ( isset( $atts['future_role'] ) && $atts['future_role'] ? $atts['future_role'] : 'subscriber' );
        add_user_meta( $user_id, 'frmreg_future_role', $future_role );

        //Add user meta to store the entry ID
        add_user_meta( $user_id, 'frmreg_entry_id', $atts['entry_id'] );

		//Temporarily save plaintext pass so I can email it to user further down the road
		if ( isset( $user_pass ) ) {
			update_user_meta( $user_id, 'frmreg_user_pass', $user_pass );
        }

        // Stop Formidable emails
        add_filter('frm_to_email', 'FrmRegAppController::stop_the_email', 20, 4 );

        // TODO: Stop all actions for Formidable 2.0+

		//Send appropriate e-mail depending on moderation type
		if ( in_array( 'email', $moderate ) ) {
			//Generate an activation key
			$key = wp_generate_password( 20, false );

			//Set the activation key for the user
            global $wpdb;
			$wpdb->update( $wpdb->users, array( 'user_activation_key' => $key ), array( 'user_login' => $user->user_login ) );

            //Get URL for activation link
            $redirect_id = isset( $atts['redirect'] ) && $atts['redirect'] ? $atts['redirect'] : wp_login_url();
            if ( ! is_numeric( $redirect_id ) ) {
                $redirect_id = url_to_postid( $redirect_id );
            }

			//Send activation e-mail
			self::new_user_activation_notification( $user_id, $key, $redirect_id );
		}

        if ( in_array( 'admin', $moderate ) ) {
			//Send admin e-mail
            //TODO: Set up this function
			//self::new_user_approval_admin_notification( $user_id );
		}

        if ( in_array( 'paypal', $moderate ) ) {
            //Check if Payment is complete now. If complete, remove paypal from moderation types and send email ( if this is only moderation type )
		}

        return true;
	}

    /*
    * Create ajax URL
    *
    * Since 1.11
    *
    * @param array of URL parameters
    * @return string
    */
    public static function create_ajax_url( $params ) {
        if ( is_array( $params ) && isset( $params['action'] ) && $params['action'] ) {
            $site_url = admin_url( 'admin-ajax.php' );
            $ajax_url = add_query_arg( $params, $site_url );
        } else {
            $ajax_url = false;
        }
        return $ajax_url;
    }

	/*
    * Redirect user with message parameters when activation link is entered
    */
	public static function activation_link_action( $key, $login, $redirect ) {
		global $wpdb;

		$key = preg_replace( '/[^a-z0-9]/i', '', $key );

		// Validate activation key
		$user = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpdb->users WHERE user_activation_key = %s AND user_login = %s", $key, $login ) );
		if ( empty( $user ) ) {
            $redirect = add_query_arg( array( 'frm_message' => 'invalid_key' ), $redirect );
            wp_redirect ( $redirect );
            exit();
        }

        //Maybe activate user now
        $moderate = self::maybe_activate_user( 'email', $user->ID );

        // If all moderation is complete
        if ( false === $moderate || 'logged_in' == $moderate ) {
            $params = array( 'frm_message' => 'complete', 'user' => $user->ID );
            if ( 'logged_in' == $moderate ) {
                $params['logged_in'] = 'true';
            }
            $redirect = add_query_arg( $params, $redirect );
        } else if ( in_array( 'paypal', $moderate ) ) {
            // Payment is not complete yet
            $params = array( 'frm_message' => 'pending_pmt', 'user' => $user->ID );
        } else if ( in_array( 'admin', $moderate ) ) {
            // Admin still needs to approve entry
            $params = array( 'frm_message' => 'pending_approval', 'user' => $user->ID );
        }
        $redirect = add_query_arg( $params, $redirect );

        //Redirect user to selected page
        wp_redirect( $redirect );
        exit();
	}

    /*
    * Update moderation user meta, maybe activate user, and return which moderation types are still needed (if any)
    */
    public static function maybe_activate_user( $current_mod, $user_id ) {
        // Get user object
        $user = new WP_User( $user_id );

        // Check which moderation user needs
        $moderate = (array) get_user_meta( $user_id, 'frmreg_moderate', 1 );

        if ( in_array( $current_mod, $moderate ) && count( $moderate ) > 1 ) {//If current moderation is NOT the only moderation type needed
            // Remove this mod type from the array
            $mod_key = array_search( $current_mod, $moderate );
            unset( $moderate[$mod_key] );

            // Update moderation user meta
            update_user_meta( $user_id, 'frmreg_moderate', $moderate );

            //TODO: Check if Paypal is active and if not, remove paypal mod type

        } else if ( in_array( $current_mod, $moderate ) ) {// If current moderation is the only moderation type left

            // Get future user role
            $user_role = get_user_meta( $user_id, 'frmreg_future_role', 1 );
            if ( !$user_role ) { $user_role = 'subscriber'; }

            // Officially activate user
    		$user->set_role( $user_role );

            //Send all emails
            self::send_all_notifications( $user );

            // Delete moderation user meta and plaintext pass
            delete_user_meta( $user_id, 'frmreg_future_role' );
            delete_user_meta( $user_id, 'frmreg_moderate' );

            $settings = self::get_form_settings( $user->ID );

            // If auto login is selected
            if ( isset( $settings['login'] ) && $settings['login'] ) {
                $creds = array();
            	$creds['user_login'] = $user->user_login;
            	$creds['user_password'] = get_user_meta( $user->ID, 'frmreg_user_pass', 1 );

                // Log user in now
            	wp_signon( $creds, false );
                $moderate = 'logged_in';
            } else {
                $moderate = false;
            }

            // Delete plaintext pass
            delete_user_meta( $user->ID, 'frmreg_user_pass' );
        }

        if ( $current_mod == 'email' ) {
    		// Clear the activation key
            global $wpdb;
    		$wpdb->update( $wpdb->users, array( 'user_activation_key' => '' ), array( 'user_login' => $user->user_login ) );
        }

        return $moderate;
    }


    /*----------------Email Notification Functions--------------------*/

    /*
    * Sends activation link to pending user
    *
    * Since 1.11
    *
    * @param integer $user_id
    * @param string $key
    * @return email
    */
	public static function new_user_activation_notification( $user_id, $key = '' ) {
		global $wpdb, $current_site;

        //Get user object
		$user = new WP_User( $user_id );

		$user_login = stripslashes( $user->user_login );
		$user_email = stripslashes( $user->user_email );

		if ( empty( $key ) ) {
			$key = $wpdb->get_var( $wpdb->prepare( "SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login ) );
			if ( empty( $key ) ) {
				$key = wp_generate_password( 20, false );
				$wpdb->update( $wpdb->users, array( 'user_activation_key' => $key ), array( 'user_login' => $user_login ) );
			}
		}

		if ( is_multisite() ) {
			$blogname = $current_site->site_name;
		} else {
			// The blogname option is escaped with esc_html on the way into the database in sanitize_option
			// we want to reverse this for the plain text arena of emails.
			$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
		}

        // Create activation URL
        $params = array('action' => 'frm_activate_user', 'key' => $key, 'login' => rawurlencode( $user_login ) );
        $activation_url = self::create_ajax_url( $params );

		$title    = sprintf( __( '[%s] Activate Your Account', 'frmreg' ), $blogname );
		$message  = sprintf( __( 'Thanks for registering at %s! To complete the activation of your account please click the following link: ', 'frmreg' ), $blogname ) . "\r\n\r\n";
		$message .=  $activation_url . "\r\n";

        // Hooks to customize subject and message
        $title   = apply_filters( 'user_activation_notification_title',   $title,   $user_id );
        $message = apply_filters( 'user_activation_notification_message', $message, $activation_url, $user_id );

		return wp_mail( $user_email, $title, $message );
	}

	/*
    * Send Formidable and Registration emails for users who have just confirmed their email address
    *
    * Since 1.11
    */
	public static function send_all_notifications( $user ) {
        if ( !is_object( $user ) ) {
            $user = new WP_User( $user );
        }
        //Get entry ID from user meta
        $entry = get_user_meta ( $user->ID, 'frmreg_entry_id', 1 );
        $frm_entry = new FrmEntry();
        $entry = $frm_entry->getOne($entry);
        unset($frm_entry);

        //Get form and form's settings
	    $frm_form = new FrmForm();
        $form = $frm_form->getOne($entry->form_id);
        unset($frm_form);
        $settings = FrmRegAppHelper::get_registration_settings( $form );
        if ( empty( $settings ) ) {
            return;
        }

        // Send Formidable emails now
        if ( self::is_below_2() ) {
            FrmProNotification::entry_created($entry->id, $form->id);
        } else {
            FrmFormActionsController::trigger_actions('create', $form->id, $entry->id, 'email');
        }

        // Send admin email
        wp_new_user_notification($user->ID, ''); // sending a blank password only sends notification to admin

		// Check for plaintext pass
        $user_pass = get_user_meta( $user->ID, 'frmreg_user_pass', 1 );
		if ( ! $user_pass ) {
			$user_pass = wp_generate_password();
			wp_set_password( $user_pass, $user->ID );
		}

        // Trigger registration email
        FrmRegAppController::new_user_notification($user->ID, $user_pass, $form, $entry->id, $settings);
	}

    /*----------------Global Settings Functions--------------------*/

    /*
    * Get login URL
    *
    * Since 1.11
    *
    * @param array URL parameters
    * @return Login URL
    */
    public static function get_login_url( $params ) {
        $frm_reg_settings = new FrmRegSettings();
        $settings = $frm_reg_settings->get_options();
        if ( isset( $settings->login ) && $settings->login ) {
            $login_url = get_permalink( $settings->login );
        } else {
            $login_url = wp_login_url();
        }
        $login_url = add_query_arg( $params, $login_url );

        return $login_url;
    }

    /*
    * Get form settings for a specific user
    *
    * Since 1.11
    *
    * @param string $user_id - User's ID number
    * @return object $settings - Form's Registration Settings
    */
    public static function get_form_settings( $user_id ) {
        if ( is_object( $user_id ) ) {
            $user_id = $user_id->ID;
        }

        if ( !$user_id ) {
            return false;
        }

        //Get entry ID from user meta
        $entry = get_user_meta ( $user_id, 'frmreg_entry_id', 1 );
        if ( !$entry ) {
            return false;
        }
        $frm_entry = new FrmEntry();
        $entry = $frm_entry->getOne($entry);
        unset($frm_entry);

        //Get form and form's settings
	    $frm_form = new FrmForm();
        $form = $frm_form->getOne( $entry->form_id );
        unset($frm_form);
        $settings = self::get_registration_settings( $form );

        return $settings;
    }

    public static function maybe_add_tooltip($name, $class = 'closed', $form_name = '') {
        $tooltips = array(
            'mod_email'     => __('Require new users to confirm their e-mail address before they may log in.', 'frmreg'),
            'mod_admin'     => __('Require new users to be approved by an administrator before they may log in.', 'frmreg'),
            'mod_paypal'    => __('Prevent users from logging in until Paypal payment is complete.', 'frmreg'),
            'mod_redirect'  => __('Select the page where users will be redirected after clicking the activation link.', 'frmreg'),
            'login_logout'  => __('Select the general login/logout page for your site.', 'frmreg'),
        );

        if ( !isset($tooltips[$name]) ) {
            return;
        }

        if ( 'open' == $class ) {
            echo ' frm_help"';
        } else {
            echo ' class="frm_help"';
        }

        echo ' title="'. esc_attr($tooltips[$name]);

        if ( 'open' != $class ) {
            echo '"';
        }
    }
}
