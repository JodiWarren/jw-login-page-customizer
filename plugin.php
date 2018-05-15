<?php
/**
 * Plugin Name: JW Login Page Customizer
 * Plugin URI:
 * Description:
 * Version:     0.1.0
 * Author:      Jodi Warren
 * Author URI:  https://jodiwarren.com
 * Text Domain: jw-login-page-customizer
 * Domain Path: /languages
 */

// Useful global constants
define( 'JW_LOGIN_PAGE_CUSTOMIZER_VERSION', '0.1.0' );
define( 'JW_LOGIN_PAGE_CUSTOMIZER_URL',     plugin_dir_url( __FILE__ ) );
define( 'JW_LOGIN_PAGE_CUSTOMIZER_PATH',    dirname( __FILE__ ) . '/' );
define( 'JW_LOGIN_PAGE_CUSTOMIZER_INC',     JW_LOGIN_PAGE_CUSTOMIZER_PATH . 'includes/' );
define( 'JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN',    'jw-login-customizer' );


// Include files
require_once JW_LOGIN_PAGE_CUSTOMIZER_INC . 'functions/core.php';
require_once JW_LOGIN_PAGE_CUSTOMIZER_INC . 'classes/Customizer.php';
require_once (JW_LOGIN_PAGE_CUSTOMIZER_INC . 'classes/Frontend.php');


// Activation/Deactivation
register_activation_hook( __FILE__, '\JwLoginPageCustomizer\Core\activate' );
register_deactivation_hook( __FILE__, '\JwLoginPageCustomizer\Core\deactivate' );

// Bootstrap
JwLoginPageCustomizer\Core\setup();

$login_customizer = new JwLoginPageCustomizer\Customizer\Customizer();
$login_customizer->init();

$frontend = new JwLoginCustomizer\Frontend\Frontend();
$frontend->init();
