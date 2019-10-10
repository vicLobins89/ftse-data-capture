<?php
/**
 * Plugin Name: FTSE Data Capture
 * Description: This plugin adds the data capture functionality on FTSE Women Leaders.
 * Version: 1.0.0
 * Author: Vic Lobins
 * Author URI: http://thisisrare.co.uk
 * License: GPL2
 * Text Domain: ftse-data-capture
 */

// Personalised User Flow
class PersonalisedUserFlow {
	
	public function __construct() {
		add_shortcode( 'custom-login-form', array( $this, 'render_login_form' ) );
		add_shortcode( 'custom-register-form', array( $this, 'render_register_form' ) );
		add_shortcode( 'custom-password-lost-form', array( $this, 'render_password_lost_form' ) );
		add_shortcode( 'custom-password-reset-form', array( $this, 'render_password_reset_form' ) );
		add_shortcode( 'account-info', array( $this, 'render_account_info_page' ) );
		add_shortcode( 'survey-page', array( $this, 'render_survey_page' ) );
		add_shortcode( 'confirmation-page', array( $this, 'render_confirmation_page' ) );
		add_shortcode( 'thanks-page', array( $this, 'render_thanks_page' ) );
		add_shortcode( 'welcome-page', array( $this, 'render_welcome_page' ) );
		add_shortcode( 'request-change-page', array( $this, 'render_request_change_page' ) );
		
		add_action( 'login_form_login', array( $this, 'redirect_to_custom_login' ) );
		add_action( 'wp_logout', array( $this, 'redirect_after_logout' ) );
		add_action( 'login_form_register', array( $this, 'redirect_to_custom_register' ) );
		add_action( 'login_form_register', array( $this, 'do_register_user' ) );
		//add_action( 'wp_print_footer_scripts', array( $this, 'add_captcha_js_to_footer' ) );
		add_action( 'login_form_lostpassword', array( $this, 'redirect_to_custom_lostpassword' ) );
		add_action( 'login_form_lostpassword', array( $this, 'do_password_lost' ) );
		add_action( 'login_form_rp', array( $this, 'redirect_to_custom_password_reset' ) );
		add_action( 'login_form_resetpass', array( $this, 'redirect_to_custom_password_reset' ) );
		add_action( 'login_form_rp', array( $this, 'do_password_reset' ) );
		add_action( 'login_form_resetpass', array( $this, 'do_password_reset' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'ftse_enqueue_script' ) );
		add_action( 'wp_head', array( $this, 'ftse_enqueue_styles' ) );
		add_action( 'after_setup_theme', array( $this, 'remove_admin_bar' ) );
		
		//add_action('wp_login', array( $this, 'set_user_role'));
		
		add_filter( 'authenticate', array( $this, 'maybe_redirect_at_authenticate' ), 101, 3 );
		add_filter( 'login_redirect', array( $this, 'redirect_after_login' ), 10, 3 );
		add_filter( 'admin_init', array( $this, 'register_settings_fields' ) );
		add_filter( 'retrieve_password_message', array( $this, 'replace_retrieve_password_message'), 10, 4 );
		add_filter( 'wp_mail_from', array( $this, 'replace_from_email_address') );
		add_filter( 'wp_mail_from_name', array( $this, 'replace_from_name') );
		add_filter( 'wp_mail_content_type', array( $this, 'replace_email_content_type') );
	}
	
	public function set_user_role() {
		
		$users = get_users( array(
			'role__not_in' => array('administrator')
		) );

		// Define a user role based on its index in the array.
		$roles = array( 
			'administrator', 
			'editor', 
			'author', 
			'contributor', 
			'subscriber',
			''
		);
		$role = $roles[5];
		
		foreach($users as $user) {
			$user->set_role( $role );
		}
	}
	
	public function register_settings_fields() {
		//reCaptcha keys
		register_setting( 'general', 'personalise-login-recaptcha-site-key' );
		register_setting( 'general', 'personalise-login-recaptcha-secret-key' );
		
		add_settings_field(
			'personalise-login-recaptcha-site-key',
			'<label for="personalise-login-recaptcha-site-key">' . __( 'reCAPTCHA site key', 'ftse-data-capture' ) . '</label>',
			array( $this, 'render_recaptcha_site_key_field' ),
			'general'
		);
		
		add_settings_field(
			'personalise-login-recaptcha-secret-key',
			'<label for="personalise-login-recaptcha-secret-key">' . __( 'reCAPTCHA secret key', 'ftse-data-capture' ) . '</label>',
			array( $this, 'render_recaptcha_secret_key_field' ),
			'general'
		);
	}
	
	public function render_recaptcha_site_key_field() {
		$value = get_option( 'personalise-login-recaptcha-site-key', '' );
		echo '<input type="text" id="personalise-login-recaptcha-site-key" class="regular-text" name="personalise-login-recaptcha-site-key" value="' . esc_attr( $value ) . '" />';
	}

	public function render_recaptcha_secret_key_field() {
		$value = get_option( 'personalise-login-recaptcha-secret-key', '' );
		echo '<input type="text" id="personalise-login-recaptcha-secret-key" class="regular-text" name="personalise-login-recaptcha-secret-key" value="' . esc_attr( $value ) . '" />';
	}
	
	// Activation hook
	public static function plugin_activated() {
		// Info for plugin pages
		$page_definitions = array(
			'member-login' => array(
				'title' => __( 'Sign In', 'ftse-data-capture' ),
				'content' => '[custom-login-form]'
			),
			'member-account' => array(
				'title' => __( 'Your Account', 'ftse-data-capture' ),
				'content' => '[account-info]'
			),
			'member-register' => array(
				'title' => __( 'Register', 'ftse-data-capture' ),
				'content' => '[custom-register-form]'
			),
			'member-password-lost' => array(
				'title' => __( 'Forgot Your Password?', 'ftse-data-capture' ),
				'content' => '[custom-password-lost-form]'
			),
			'member-password-reset' => array(
				'title' => __( 'Password Reset', 'ftse-data-capture' ),
				'content' => '[custom-password-reset-form]'
			)
		);
		
		foreach ( $page_definitions as $slug => $page ) {
			// Check if page exists
			$query = new WP_Query( 'pagename=' . $slug );
			if ( !$query->have_posts() ) {
				// Add page
				wp_insert_post(
					array(
						'post_content' 		=> $page['content'],
						'post_name' 		=> $slug,
						'post_title' 		=> $page['title'],
						'post_status' 		=> 'publish',
						'post_type' 		=> 'page',
						'ping_status'		=> 'closed',
						'comment_status'	=> 'closed',
					)
				);
			}
		}
	}
	
	// Shortcodes
	public function render_login_form( $attributes, $content = null ) {
		// Parse shortcode atts
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
		$show_title = $attributes['show_title'];
		
		if( is_user_logged_in() ) {
//			return __( 'You are already signed in.', 'ftse-data-capture' );
			wp_redirect( 'gender-equality-data-collection' );
			exit;
		}
		
		$attributes['redirect'] = '';
		if( isset( $_REQUEST['redirect_to'] ) ) {
			$attributes['redirect'] = wp_validate_redirect( $_REQUEST['redirect_to'], $attributes['redirect'] );
		}
		
		// Errors
		$attributes['errors'] = array();
		if( isset( $_REQUEST['login'] ) ) {
			$error_codes = explode( ',', $_REQUEST['login'] );
			
			foreach( $error_codes as $code ) {
				$attributes['errors'] []= $this->get_error_message( $code );
			}
		}
		
		// Check if logged out
		$attributes['logged_out'] = isset( $_REQUEST['logged_out'] ) && $_REQUEST['logged_out'] == true;
		
		// Check if user just registered
		$attributes['registered'] = isset( $_REQUEST['registered'] );
		
		// Check if user requested new password
		$attributes['lost_password_sent'] = isset( $_REQUEST['checkemail'] ) && $_REQUEST['checkemail'] == 'confirm';
		
		// Check if user updated password
		$attributes['password_updated'] = isset( $_REQUEST['password'] ) && $_REQUEST['password'] == 'changed';
		
		return $this->get_template_html( 'login_form', $attributes );
	}
	
	public function render_register_form( $attributes, $content = null ) {
		// Parse shortcode atts
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
		
		// Errors
		$attributes['errors'] = array();
		if( isset( $_REQUEST['register-errors'] ) ) {
			$error_codes = explode( ',', $_REQUEST['register-errors'] );
			
			foreach( $error_codes as $code ) {
				$attributes['errors'] []= $this->get_error_message( $code );
			}
		}
		
		// reCaptcha
		//$attributes['recaptcha_site_key'] = get_option( 'personalise-login-recaptcha-site-key', null );
		
		if( is_user_logged_in() ) {
//			return __( 'You are already signed in.', 'ftse-data-capture' );
			wp_redirect( 'gender-equality-data-collection' );
			exit;
		} elseif( !get_option( 'users_can_register' ) ) {
			return __( 'Registering is not allowed.', 'ftse-data-capture' );
		} else {
			return $this->get_template_html( 'register_form', $attributes );
		}
	}
	
	public function render_password_lost_form( $attributes, $content = null ) {
		// Parse shortcode atts
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
		
		// Errors
		$attributes['errors'] = array();
		if( isset( $_REQUEST['errors'] ) ) {
			$error_codes = explode( ',', $_REQUEST['errors'] );
			
			foreach( $error_codes as $code ) {
				$attributes['errors'] []= $this->get_error_message( $code );
			}
		}
		
		if( is_user_logged_in() ) {
//			return __( 'You are already signed in.', 'ftse-data-capture' );
			wp_redirect( 'gender-equality-data-collection' );
			exit;
		} else {
			return $this->get_template_html( 'password_lost_form', $attributes );
		}
	}
	
	public function render_password_reset_form( $attributes, $content = null ) {
		// Parse shortcode atts
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
		
		if( is_user_logged_in() ) {
//			return __( 'You are already signed in.', 'ftse-data-capture' );
			wp_redirect( 'gender-equality-data-collection' );
			exit;
		} else {
			if( isset( $_REQUEST['login'] ) && isset( $_REQUEST['key'] ) ) {
				$attributes['login'] = $_REQUEST['login'];
				$attributes['key'] = $_REQUEST['key'];
				
				// Errors
				$attributes['errors'] = array();
				if( isset( $_REQUEST['errors'] ) ) {
					$error_codes = explode( ',', $_REQUEST['errors'] );;
					
					foreach( $error_codes as $code ) {
						$attributes['errors'] []= $this->get_error_message( $code );
					}
				}
				
				return $this->get_template_html( 'password_reset_form', $attributes );
			} else {
				return __( 'Invalid password reset link.', 'ftse-data-capture' );
			}
		}
	}
	
	public function render_account_info_page( $attributes, $content = null ) {
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
		
		if( is_user_logged_in() ) {
			return $this->get_template_html( 'account_info_page', $attributes );
		} else {
//			return __( 'Please log in.', 'ftse-data-capture' );
			wp_redirect( 'member-login' );
			exit;
		}
	}
	
	public function render_survey_page( $attributes, $content = null ) {
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
		
		if( is_user_logged_in() ) {
			return $this->get_template_html( 'survey_page', $attributes );
		} else {
//			return __( 'Please log in.', 'ftse-data-capture' );
			wp_redirect( 'member-login' );
			exit;
		}
	}
	
	public function render_confirmation_page( $attributes, $content = null ) {
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
		
		if( is_user_logged_in() ) {
			return $this->get_template_html( 'confirmation_page', $attributes );
		} else {
//			return __( 'Please log in.', 'ftse-data-capture' );
			wp_redirect( 'member-login' );
			exit;
		}
	}
	
	public function render_thanks_page( $attributes, $content = null ) {
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
		
		if( is_user_logged_in() ) {
			wp_redirect( 'member-login' );
			exit;
		} else {
			return $this->get_template_html( 'thanks_page', $attributes );
		}
	}
	
	public function render_welcome_page( $attributes, $content = null ) {
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
		
		if( is_user_logged_in() ) {
			wp_redirect( 'member-login' );
			exit;
		} else {
			return $this->get_template_html( 'welcome_page', $attributes );
		}
	}
	
	public function render_request_change_page( $attributes, $content = null ) {
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
		
		if( is_user_logged_in() ) {
			wp_redirect( 'member-login' );
			exit;
		} else {
			return $this->get_template_html( 'request_change_page', $attributes );
		}
	}
	
	// Get template part
	private function get_template_html( $template_name, $attributes = null ) {
		if( !$attributes ) {
			$attributes = array();
		}
		
		ob_start();
		
		do_action( 'personalise_login_before_' . $template_name );
		
		require( 'templates/' . $template_name . '.php' );
		
		do_action( 'personalise_login_after_' . $template_name );
		
		$html = ob_get_contents();
		ob_end_clean();
		
		return $html;
	}
	
	// Redirect user to custom login page instead of wp-login.php
	function redirect_to_custom_login() {
		if( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
			$redirect_to = isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : null;
			
			if( is_user_logged_in() ) {
				$this->redirect_logged_in_user( $redirect_to );
				exit;
			}
			
			$login_url = home_url( 'member-login' );
			if( !empty( $redirect_to ) ) {
				$login_url = add_query_arg( 'redirect_to', $redirect_to, $login_url );
			}
			
			wp_redirect( $login_url );
			exit;
		}
	}
	
	// Redirect user to custom register page instead of wp default
	public function redirect_to_custom_register() {
		if( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
			if( is_user_logged_in() ) {
				$this->redirect_logged_in_user();
			} else {
				wp_redirect( home_url( 'member-register' ) );
			}
			exit;
		}
	}
	
	// Redirect user to custom lost password page instead of wp default
	public function redirect_to_custom_lostpassword() {
		if( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
			if( is_user_logged_in() ) {
				$this->redirect_logged_in_user();
				exit;
			}
			
			wp_redirect( home_url( 'member-password-lost' ) );
			exit;
		}
	}
	
	// Redirect user to custom reset page or login page on error
	public function redirect_to_custom_password_reset() {
		if( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
			// Verify key / login combo
			$user = check_password_reset_key( $_REQUEST['key'], $_REQUEST['login'] );
			if( !$user || is_wp_error( $user ) ) {
				if( $user && $user->get_error_code() === 'expired_key' ) {
					wp_redirect( home_url( 'member-login?login=expiredkey' ) );
				} else {
					wp_redirect( home_url( 'member-login?login=invalidkey' ) );
				}
				exit;
			}
			
			$redirect_url = home_url( 'member-password-reset' );
			$redirect_url = add_query_arg( 'login', esc_attr( $_REQUEST['login'] ), $redirect_url );
			$redirect_url = add_query_arg( 'key', esc_attr( $_REQUEST['key'] ), $redirect_url );
			
			wp_redirect( $redirect_url );
			exit;
		}
	}
	
	// Redirects logged user to correct page
	private function redirect_logged_in_user( $redirect_to = null ) {
		$user = wp_get_current_user();
		if ( user_can( $user, 'manage_options' ) ) {
			if ( $redirect_to ) {
				wp_safe_redirect( $redirect_to );
			} else {
				wp_redirect( admin_url() );
			}
		} else {
			//wp_redirect( home_url( 'member-account' ) );
		}
	}
	
	// Redirect if errors are found
	function maybe_redirect_at_authenticate( $user, $username, $password ) {
		if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
			if( is_wp_error( $user ) ) {
				$error_codes = join( ',', $user->get_error_codes() );
				
				$login_url = home_url( 'member-login' );
				$login_url = add_query_arg( 'login', $error_codes, $login_url );
				
				wp_redirect( $login_url );
				exit;
			}
		}
		
		return $user;
	}
	
	private function get_error_message( $error_code ) {
		switch( $error_code ) {
			case 'empty_username':
				return __( 'The email field is empty', 'ftse-data-capture' );
			
			case 'empty_password':
				return __( 'The password field is empty', 'ftse-data-capture' );
			
			case 'invalid_username':
				return __( 'Incorrect login details, please try again.<br><a href="%s">Forgot your password?</a>', 'ftse-data-capture' );
			
			case 'incorrect_password':
				$err = __('Incorrect login details, please try again.<br><a href="%s">Forgot your password?</a>', 'ftse-data-capture');
				return sprintf( $err, wp_lostpassword_Url() );
				
			case 'email':
				return __( 'Email you entered is not valid', 'ftse-data-capture' );
				
			case 'user_exists':
				return __( 'Company already registered', 'ftse-data-capture');
				
			case 'email_exists':
				return __( 'Email already registered', 'ftse-data-capture');
				
			case 'closed':
				return __( 'Registration is closed', 'ftse-data-capture');
				
			case 'captcha':
				return __( 'reCaptcha failed', 'ftse-data-capture' );
				
			case 'password_mismatch':
				return __( "Passwords don't match", 'ftse-data-capture' );
				
			case 'password_tooshort':
				return __( "Password needs to be at least 7 characters long", 'ftse-data-capture' );
				
			case 'empty_username':
				return __( 'Enter email to continue', 'ftse-data-capture' );
				
			case 'invalid_email':
			case 'invalidcombo':
				return __( 'No users with that email', 'ftse-data-capture' );
				
			case 'expiredkey':
			case 'invalidkey':
				return __( 'The password reset link is not valid anymore', 'ftse-data-capture' );
				
			case 'password_reset_mismatch':
				return __( 'The passwords do not match', 'ftse-data-capture' );
			
			case 'password_reset_empty':
				return __( 'Cannot accept empty passwords', 'ftse-data-capture' );
				
			default:
				break;
		}
		
		return __( 'Unknown error', 'ftse-data-capture' );
	}
	
	public function redirect_after_logout() {
		$redirect_url = home_url( 'member-login?logged_out=true' );
		wp_safe_redirect( $redirect_url );
		exit;
	}
	
	// Redirect after login
	public function redirect_after_login( $redirect_to, $requested_redirect_to, $user ) {
		$redirect_url = home_url();
		
		if( !isset( $user->ID ) ) {
			return $redirect_url;
		}
		
		if( user_can( $user, 'manage_options' ) ) {
			if( $requested_redirect_to == '' ) {
				$redirect_url = admin_url();
			} else {
				$redirect_url = $redirected_redirect_to;
			}
		} else {
			$redirect_url = home_url( 'gender-equality-data-collection' );
		}
		
		return wp_validate_redirect( $redirect_url, home_url() );
	}
	
	// Remove admin bar for non-admins
	function remove_admin_bar() {
		if (!current_user_can('manage_options') && !is_admin()) {
		  show_admin_bar(false);
		}
	}
	
	// Validates and completes new user sign up process
	private function register_user( $email, $company_name, $first_name, $last_name, $contact_phone, $mobile_phone, $job_title, $sector, $ftseIndex, $invTrust, $sec_name, $sec_email ) {
		$errors = new WP_Error();
		
		// Email as both email and user, only one needing validation
		if( !is_email( $email ) ) {
			$errors->add( 'email', $this->get_error_message( 'email' ) );
			return $errors;
		}
		
		if( username_exists( $company_name ) ) {
			$errors->add( 'user_exists', $this->get_error_message( 'user_exists' ) );
			return $errors;
		}
		
		if( email_exists( $email ) ) {
			$errors->add( 'email_exists', $this->get_error_message( 'email_exists' ) );
			return $errors;
		}
		
		// Generate pass
		$password = wp_generate_password( 12, false );
		
		$user_data = array(
			'user_login'	=> $company_name,
			'user_email'	=> $email,
			'user_pass'		=> $password,
			'nickname'		=> $first_name . ' ' . $last_name,
			'first_name'	=> $first_name,
			'last_name'		=> $last_name
		);
		
		$user_id = wp_insert_user( $user_data );
		$this->wp_new_user_notification( $user_id, $password );
		update_user_meta( $user_id, 'company_name', $company_name );
		update_user_meta( $user_id, 'contact_phone', $contact_phone );
		update_user_meta( $user_id, 'mobile_phone', $mobile_phone );
		update_user_meta( $user_id, 'job_title', $job_title );
		update_user_meta( $user_id, 'sector', $sector );
		update_user_meta( $user_id, 'ftseIndex', $ftseIndex );
		update_user_meta( $user_id, 'invTrust', $invTrust );
		update_user_meta( $user_id, 'sec_name', $sec_name );
		update_user_meta( $user_id, 'sec_email', $sec_email );
		
		return $user_id;
	}
	
	public function wp_new_user_notification( $user_id, $plaintext_pass = '' ) {
        $user = new WP_User($user_id);

        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);
		$first_name = stripslashes($user->first_name);
		$key = get_password_reset_key($user);

        $message  = sprintf(__('New user registration on %s:'), get_option('blogname')) . "<br><br>";
        $message .= sprintf(__('Username: %s'), $user_login) . "<br><br>";
        $message .= sprintf(__('E-mail: %s'), $user_email) . "<br>";

        @wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), get_option('blogname')), $message);

        if ( empty($plaintext_pass) )
            return;

        $message  = sprintf(__('Dear %s,'), $first_name) . "<br><br>";
		
        $message .= __('Thank you for registering your company and providing your contact details on the FTSE 350 Gender Data Submission portal.') . "<br><br>";
		
        $message .= __('Next step - To set your password and access the online portal please ');
		$message .= '<a href="'.site_url( "wp-login.php?action=rp&key=$key&login=" . rawurldecode( $user_login ), 'login' ).'">click here</a>' . ".<br><br>";
		
        $message .= __('<b style="font-size: 16px;">Submitting your Data</b>') . "<br><br>";
		
        $message .= __('<b style="font-size: 16px; color: red;">The Hampton-Alexander portal will be open for companies to submit their data from Monday 01 July until Wednesday 31 July 2018.</b>') . "<br><br>";
		
        $message .= __('You can submit your company’s data by clicking on the link sent to you when you registered or by logging in to the data submission portal via the Hampton-Alexander Review website at ');
        $message .= '<a href="http://ftsewomenleaders.com/">www.ftsewomenleaders.com</a>' . ".<br><br>";
		
		$message .= __('<b>The Hampton-Alexander portal will be open for companies to submit their data from Friday 29 June until Tuesday 31 July 2018.</b>') . "<br><br>";
		
        $message .= "<i>" . __('Please note: In line with the recommendations of the Hampton-Alexander Review and to encourage greater transparency and public reporting of gender data, companies are also requested to publish details of the number of women on the Executive Committee and the Direct Reports to the Executive Committee in their Annual Report and Accounts and\or on their websites.') . "</i><br><br>";
		
        $message .= __('If you have any questions please refer to the ');
        $message .= '<a href="http://ftsewomenleaders.com/faqs">' . __('FAQ’s') . '</a>' . __(' or contact the team at ') . '<a href="mailto:info@ftsewomenleaders.com">info@ftsewomenleaders.com</a>' . ".<br><br>";
		
        $message .= __('Thank you for your continued support. We look forward to sharing best practice and reporting on progress in our annual report which will be published on the 13th November 2019.') . "<br><br>";
		
        $message .= '<b>' . __('The Hampton-Alexander Review team') . "</b>";

        wp_mail($user_email, 'FTSE 350 Gender Data Submission portal – Registration confirmation', $message);

    }
	
	// Handles the new user reg
	public function do_register_user() {
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
			$redirect_url = home_url( 'member-register' );
			
			if( !get_option( 'users_can_register' ) ) {
				// Reg closed
				$redirect_url = add_query_arg( 'register-errors', 'closed', $redirect_url );
			} else {
				$email = sanitize_email($_POST['email']);
				$company_name = sanitize_text_field( $_POST['company_name'] );
				$first_name = sanitize_text_field( $_POST['first_name'] );
				$last_name = sanitize_text_field( $_POST['last_name'] );
				$contact_phone = sanitize_text_field( $_POST['contact_phone'] );
				$mobile_phone = sanitize_text_field( $_POST['mobile_phone'] );
				$job_title = sanitize_text_field( $_POST['job_title'] );
				$sector = sanitize_text_field( $_POST['sector'] );
				$ftseIndex = sanitize_text_field( $_POST['ftseIndex'] );
				$invTrust = sanitize_text_field( $_POST['invTrust'] );
				$sec_name = sanitize_text_field( $_POST['sec_name'] );
				$sec_email = sanitize_text_field( $_POST['sec_email'] );
				
				$result = $this->register_user( $email, $company_name, $first_name, $last_name, $contact_phone, $mobile_phone, $job_title, $sector, $ftseIndex, $invTrust, $sec_name, $sec_email );
				
				if( is_wp_error( $result ) ) {
					// Parse errors into string and append as parameter to redirect
					$errors = join( ',', $result->get_error_codes() );
					$redirect_url = add_query_arg( 'register-errors', $errors, $redirect_url );
				} else {
					// Success
					$redirect_url = home_url( 'thank-you-for-registering' );
//					$redirect_url = add_query_arg( 'registered', $email, $redirect_url );
				}
			}
			
			wp_redirect( $redirect_url );
			exit;
		}
	}
	
	// Initiates password reset
	public function do_password_lost() {
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
			$errors = retrieve_password();
			/*if( is_wp_error( $errors ) ) {
				// Errors found
				$redirect_url = home_url( 'member-password-lost' );
				$redirect_url = add_query_arg( 'errors', join( ',', $errors->get_error_codes() ), $redirect_url );
			} else {
				// Email sent
				$redirect_url = home_url( 'member-login' );
				$redirect_url = add_query_arg( 'checkemail', 'confirm', $redirect_url );
			}*/
			
			$redirect_url = home_url( 'member-login' );
			$redirect_url = add_query_arg( 'checkemail', 'confirm', $redirect_url );
			
			wp_redirect( $redirect_url );
			exit;
		}
	}
	
	// Resets user pass
	public function do_password_reset() {
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
			$rp_key = $_REQUEST['rp_key'];
			$rp_login = $_REQUEST['rp_login'];
			
			$user = check_password_reset_key( $rp_key, $rp_login );
			
			if( !$user || is_wp_error( $user ) ) {
				if( $user && $user->get_error_code() === 'expired_key' ) {
					wp_redirect( home_url( 'member-login?login=expiredkey' ) );
				} else {
					wp_redirect( home_url( 'member-login?login=invalidkey' ) );
				}
				exit;
			}
			
			if( isset( $_POST['pass1'] ) ) {
				if( $_POST['pass1'] != $_POST['pass2'] ) {
					// Passwords don't match
					$redirect_url = home_url( 'member-password-reset' );
					
					$redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
					$redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
					$redirect_url = add_query_arg( 'errors', 'password_reset_mismatch', $redirect_url );
					
					wp_redirect( $redirect_url );
					exit;
				}
				
				if( strlen($_POST['pass1']) < 7 ) {
					// Password too short
					$redirect_url = home_url( 'member-password-reset' );
					
					$redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
					$redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
					$redirect_url = add_query_arg( 'errors', 'password_tooshort', $redirect_url );
					
					wp_redirect( $redirect_url );
					exit;
				}
				
				if( empty( $_POST['pass1'] ) ) {
					// Password is empty
					$redirect_url = home_url( 'member-password-reset' );
					
					$redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
					$redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
					$redirect_url = add_query_arg( 'errors', 'password_reset_empty', $redirect_url );
					
					wp_redirect( $redirect_url );
					exit;
				}
				
				// Checks OK
				reset_password( $user, $_POST['pass1'] );
				wp_redirect( home_url( 'member-login?password=changed' ) );
			} else {
				_e( 'Invalid request', 'ftse-data-capture' );
			}
			
			exit;
		}
	}
	
	public function admin_scripts_styles() {
		wp_enqueue_style( 'ftse-admin-styles', plugins_url( '/css/admin-styles.css', __FILE__ ) );
		wp_enqueue_script( 'html2csv', plugins_url( '/js/html2csv.js', __FILE__ ) );
		wp_enqueue_script( 'ftse-admin-scripts', plugins_url( '/js/admin-scripts.js', __FILE__ ) );
	}
	
	public function ftse_enqueue_script() {
		wp_enqueue_script( 'select2-jquery-plug', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js', array( 'jquery', 'masonry' ) );
        
        if( is_page( array( 'member-register', 'user-change-request' ) ) ) {
            wp_enqueue_script( 'ftse-scripts', plugin_dir_url( __FILE__ ) . 'js/registration-page-scripts.js', array( 'jquery', 'masonry' ), null, true );
        }
        
        if( is_page( array( 'member-password-reset', 'change-password' ) ) ) {
            wp_enqueue_script( 'ftse-pass-scripts', plugin_dir_url( __FILE__ ) . 'js/reset-pass-scripts.js', array( 'jquery', 'masonry' ), null, true );
        }
        
        if( is_page( 'gender-equality-data-collection' ) ) {
            wp_enqueue_script( 'ftse-data-scripts', plugin_dir_url( __FILE__ ) . 'js/survey-page-scripts.js', array( 'jquery', 'masonry' ), null, true );
        }
	}
	
	public function ftse_enqueue_styles() {
		wp_enqueue_style( 'select2-css-plug', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css' );
		wp_enqueue_style( 'ftse-styles', plugins_url( '/css/styles.css', __FILE__ ) );
	}
	
	// reCaptcha JS file
	public function add_captcha_js_to_footer() {
		echo "<script src='https://www.google.com/recaptcha/api.js'></script>";
	}
	
	// Verify reCaptcha
	private function verify_recaptcha() {
		// This field is set by recaptcha if successful
		if( isset( $_POST['g-recaptcha-response'] ) ) {
			$captcha_response = $_POST['g-recaptcha-response'];
		} else {
			return false;
		}
		
		// Verify response from Google
		$response = wp_remote_post(
			'https://www.google.com/recaptcha/api/siteverify',
			array(
				'body' => array(
					'secret' => get_option( 'personalise-login-recaptcha-secret-key' ),
					'response' => $captcha_response
				)
			)
		);
		
		$success = false;
		if( $response && is_array( $response ) ) {
			$decoded_response = json_decode( $response['body'] );
			$success = $decoded_response->success;
		}
		
		return $success;
	}
	
	//Message body of password reset email
	public function replace_retrieve_password_message( $message, $key, $user_login, $user_data ) {
		$msg = __( 'Hello!', 'ftse-data-capture' ) . "<br><br>";
		$msg .= sprintf( __( 'You asked to reset your password for the account: %s', 'ftse-data-capture' ), $user_login ) . "<br><br>";
		$msg .= __( "If this is a mistake, ignore this email.", 'ftse-data-capture' ) . "<br><br>";
		$msg .= __( 'To reset your password, follow this link:', 'ftse-data-capture' ) . "<br><br>";
		$msg .= esc_url( site_url( "wp-login.php?action=rp&key=$key&login=" . $user_login, 'login' ) ) . "<br><br>";
		$msg .= __( 'Thanks!', 'ftse-data-capture' );
		
		return $msg;
	}
	
	public function replace_from_email_address( $original_email_address ) {
		return 'info@ftsewomenleaders.com';
	}
	
	function replace_from_name( $original_email_from ) {
		return 'Hampton-Alexander Review';
	}
	
	public function replace_email_content_type(){
		return "text/html";
	}
}

// Initialise plugin
$personalised_user_flow = new PersonalisedUserFlow();

// Register pages on plugin activation
register_activation_hook( __FILE__, array( 'PersonalisedUserFlow', 'plugin_activated' ) );

// Admin page functions to display data
require('inc/admin.php');

?>