<?php

namespace JwLoginCustomizer\Frontend;

require_once( JW_LOGIN_PAGE_CUSTOMIZER_INC . 'classes/Style.php' );

use JwLoginCustomizer\Style\Style;

class Frontend {

	private $settings = [];

	public function init() {
		$this->settings = get_option( 'jw_login_page', [] );

		add_action( 'login_head', [ $this, 'customCss' ] );
//		add_action( 'login_footer', [ $this, 'add_wp_footer' ] );
//		add_action( 'login_head', [ $this, 'customIcon' ] );
		add_filter( 'login_headerurl', [ $this, 'headerUrl' ] );
		add_filter( 'login_headertitle', [ $this, 'headerTitle' ] );
	}

	/**
	 * Build custom CSS for login page
	 */
	public function customCss() {
		if ( count( $this->settings ) <= 0 ) {
			return;
		}

		$settings = $this->settings;

		// === BG Settings ===
		$body = new Style( 'body' );
		$this->addStyle( $body, 'background-color', "background-color: {{setting}}" );
		$this->addStyle( $body, 'background-image', "background-image: url('{{setting}}')" );
		if ( isset( $settings['background-repeat'] ) && $settings['background-repeat'] !== true ) {
			$body->addStyle( "background-repeat: no-repeat" );
		}
		if ( isset( $settings['background-cover'] ) && $settings['background-cover'] === true ) {
			$body->addStyle( "background-size: cover" );
		}

		// === Logo Settings ===
		$logo = new Style( '.login h1 a' );
		$this->addStyle( $logo, 'logo-image', "background-image: none, url('{{setting}}')" );
		$this->addStyle( $logo, 'logo-image', "background-size: contain" );
		$this->addStyle( $logo, 'logo-image-width', "width: {{setting}}px" );
		$this->addStyle( $logo, 'logo-image-height', "height: {{setting}}px" );
		if ( isset( $settings['logo-hide'] ) && $settings['logo-hide'] === true ) {
			$logo->addStyle( "display: none" );
		}

		// === Form Settings ===
		$form = new Style( '.login form' );
		$this->addStyle( $form, 'form-background-color', "background-color: {{setting}}" );

		// === Form Label Settings ===
		$labels = new Style( '.login label' );
		$this->addStyle( $labels, 'form-label-color', "color: {{setting}}" );

		// === Form Field Settings ===
		$field = new Style( '.login form .input, .login form input[type="checkbox"]' );
		$this->addStyle( $field, 'form-field-background-color', "background-color: {{setting}}" );
		$this->addStyle( $field, 'form-field-text-color', "color: {{setting}}" );
		$this->addStyle( $field, 'form-field-border-color', "border-color: {{setting}}" );

		// === Form Button Settings ===
		$button = new Style( '.login .button-primary' );
		$this->addStyle( $button, 'button-background-color', "background-color: {{setting}}" );
		$this->addStyle( $button, 'button-background-color', "border-color: {{setting}}" );
		$this->addStyle( $button, 'button-background-color', "box-shadow: 0 1px 0 {{setting}}" );
		$this->addStyle( $button, 'button-text-color', "color: {{setting}}; text-shadow: none;" );

		// === Form Button Hover Settings ===
		$buttonHover = new Style( '.login .button-primary:hover, .login .button-primary:active' );
		$this->addStyle( $buttonHover, 'button-hover-background-color', "background-color: {{setting}}" );
		$this->addStyle( $buttonHover, 'button-hover-background-color', "border-color: {{setting}}" );
		$this->addStyle( $buttonHover, 'button-hover-background-color', "box-shadow: 0 1px 0 {{setting}}" );
		$this->addStyle( $buttonHover, 'button-hover-text-color', "color: {{setting}}; text-shadow: none;" );

		// === Link Settings ===
		$links = new Style( '.login #nav a, .login #backtoblog a' );
		$this->addStyle( $links, 'link-text-color', "color: {{setting}}" );

		$linksHover = new Style( '.login #nav a:hover, .login #backtoblog a:hover' );
		$this->addStyle( $linksHover, 'link-hover-text-color', "color: {{setting}}" );

		// === Message Settings ===
		$messages = new Style( '.login .message, .login #login_error' );
		$this->addStyle( $messages, 'message-background-color', "background-color: {{setting}}" );
		$this->addStyle( $messages, 'message-text-color', "color: {{setting}}" );

		// === Message Settings ===
		$messageLink = new Style( '.login .message a, .login #login_error a' );
		$this->addStyle( $messageLink, 'message-link-color', "color: {{setting}}" );

		// === Message Settings ===
		$messageLinkHover = new Style( '.login .message a:hover, .login #login_error a:hover' );
		$this->addStyle( $messageLinkHover, 'message-link-hover-color', "color: {{setting}}" );


		$output = join( "\n",
			[
				$body->output(),
				$logo->output(),
				$form->output(),
				$labels->output(),
				$field->output(),
				$button->output(),
				$buttonHover->output(),
				$links->output(),
				$linksHover->output(),
				$messages->output(),
				$messageLink->output(),
				$messageLinkHover->output(),
				$settings['custom-css']
			]
		);

		echo sprintf( '<style class="jw-login-styles">%s</style>', $output );
	}

	/**
	 * Helper to abstract some of the repetition involved in setting many CSS values
	 *
	 * @param Style $class
	 * @param $setting
	 * @param $template
	 */
	private function addStyle( Style $class, $setting, $template ) {
		if ( isset( $this->settings[ $setting ] ) && strlen($this->settings[ $setting ]) ) {
			$value = str_replace( "{{setting}}", $this->settings[ $setting ], $template );
			$class->addStyle( $value );
		}
	}

	public function customIcon() {
		$customIcon = get_option( JW_LOGIN_CUSTOMIZER_DOMAIN . '-icon-url' );
		if ( strlen( $customIcon ) <= 0 ) {
			return;
		}

		$customIconWidth  = get_option( JW_LOGIN_CUSTOMIZER_DOMAIN . '-icon-width' );
		$customIconHeight = get_option( JW_LOGIN_CUSTOMIZER_DOMAIN . '-icon-height' );

		$iconSize = '';

		if ( strlen( $customIconWidth ) && strlen( $customIconHeight ) ) {
			$iconSize = 'background-size: ' . $customIconWidth . 'px ' . $customIconHeight . 'px;';
			$iconSize .= 'height: ' . $customIconHeight . 'px;';
			$iconSize .= 'width:' . $customIconWidth . 'px;';
		}

		echo sprintf( '<style>.login h1 a{ background-image: url("%s"); %s }</style>', esc_url( $customIcon ),
			esc_attr( $iconSize ) );

	}

	public function customMarkup() {
		$customMarkup = get_option( JW_LOGIN_CUSTOMIZER_DOMAIN . '-markup' );
		echo $customMarkup;
	}

	public function headerUrl( $url ) {
		$destination = $this->settings['logo-destination'];
		if ( isset($destination) && strlen($destination) ) {
			return $destination;
		}

		return $url;
	}

	/**
	 * @param $url string
	 *
	 * @return string
	 */
	public function headerTitle( $url ) {
		$title = $this->settings['logo-title'];
		if ( isset($title) && strlen($title) ) {
			return $title;
		}

		return $url;
	}
}
