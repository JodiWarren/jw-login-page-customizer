<?php

namespace JwLoginPageCustomizer\Customizer;

class Customizer {

	public function init() {
		add_action( 'customize_register', [ $this, 'customise_login_register' ] );
	}

	public function customise_login_register( \WP_Customize_Manager $wp_customize ) {

		// Add Customizer data to login page footer
		add_action( 'login_footer', array( $wp_customize, 'customize_preview_settings' ), 20 );

		$wp_customize->add_panel(
			'jw_login_page',
			[
				'capability'  => 'edit_theme_options',
				'title'       => __( 'Login Page', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
				'description' => __( 'Customize the login page style', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
			]
		);

		$this->bg_controls( $wp_customize );
		$this->logo_controls( $wp_customize );
		$this->form_controls( $wp_customize );
		$this->button_controls( $wp_customize );
		$this->link_controls( $wp_customize );
		$this->message_controls( $wp_customize );
		$this->custom_controls( $wp_customize );

	}

	/**
	 * Set up controls for the background section
	 *
	 * @param \WP_Customize_Manager $wp_customize
	 */
	private function bg_controls( \WP_Customize_Manager $wp_customize ) {
		$wp_customize->add_section(
			'jw_login_page_bg',
			[
				'priority' => 15,
				'title'    => __( 'Page Background', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
				'panel'    => 'jw_login_page',
			]
		);

		$wp_customize->add_setting(
			'jw_login_page[background-color]',
			[
				'default'           => '',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'jw_login_page[background-color]',
				[
					'label'    => __( 'Background Color', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_bg',
					'settings' => 'jw_login_page[background-color]',
				]
			)
		);

		$wp_customize->add_setting(
			'jw_login_page[background-image]',
			[
				'default'    => '',
				'type'       => 'option',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Image_Control(
				$wp_customize,
				'jw_login_page[background-image]',
				[
					'label'    => __( 'Background Image', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_bg',
					'settings' => 'jw_login_page[background-image]',
				]
			)
		);

		$wp_customize->add_setting(
			'jw_login_page[background-repeat]',
			[
				'default'    => 'on',
				'type'       => 'option',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage'
			]
		);

		$wp_customize->add_control(
			'jw_login_page[background-repeat]',
			[
				'type'     => 'checkbox',
				'label'    => __( 'Background Image Repeat', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
				'section'  => 'jw_login_page_bg',
				'settings' => 'jw_login_page[background-repeat]',
			]
		);

		$wp_customize->add_setting(
			'jw_login_page[background-cover]',
			[
				'default'    => '',
				'type'       => 'option',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage'
			]
		);

		$wp_customize->add_control(
			'jw_login_page[background-cover]',
			[
				'type'     => 'checkbox',
				'label'    => __( 'Background Image Cover', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
				'section'  => 'jw_login_page_bg',
				'settings' => 'jw_login_page[background-cover]',
			]
		);
	}

	/**
	 * Set up controls for the logo section
	 *
	 * @param \WP_Customize_Manager $wp_customize
	 */
	private function logo_controls( \WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_section(
			'jw_login_page_logo',
			[
				'priority' => 15,
				'title'    => __( 'Logo', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
				'panel'    => 'jw_login_page',
			]
		);

		/**
		 *  ===== Logo ======
		 */

		$wp_customize->add_setting(
			'jw_login_page[logo-image]',
			[
				'default'    => '',
				'type'       => 'option',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Image_Control(
				$wp_customize,
				'jw_login_page[logo-image]',
				[
					'label'    => __( 'Logo Image', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_logo',
					'settings' => 'jw_login_page[logo-image]',
				]
			)
		);

		$wp_customize->add_setting(
			'jw_login_page[logo-image-width]',
			[
				'default'    => '84',
				'type'       => 'option',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage'
			]
		);

		$wp_customize->add_control(
			'jw_login_page[logo-image-width]',
			[
				'type'     => 'number',
				'label'    => __( 'Width', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
				'section'  => 'jw_login_page_logo',
				'settings' => 'jw_login_page[logo-image-width]',
			]
		);

		$wp_customize->add_setting(
			'jw_login_page[logo-image-height]',
			[
				'default'    => '84',
				'type'       => 'option',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage'
			]
		);

		$wp_customize->add_control(
			'jw_login_page[logo-image-height]',
			[
				'type'     => 'number',
				'label'    => __( 'Height', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
				'section'  => 'jw_login_page_logo',
				'settings' => 'jw_login_page[logo-image-height]',
			]
		);

		$wp_customize->add_setting(
			'jw_login_page[logo-destination]',
			[
				'default'    => '',
				'type'       => 'option',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage'
			]
		);

		$wp_customize->add_control(
			'jw_login_page[logo-destination]',
			[
				'type'     => 'text',
				'label'    => __( 'Logo Destination', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
				'section'  => 'jw_login_page_logo',
				'settings' => 'jw_login_page[logo-destination]',
			]
		);

		$wp_customize->add_setting(
			'jw_login_page[logo-title]',
			[
				'default'    => '',
				'type'       => 'option',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage'
			]
		);

		$wp_customize->add_control(
			'jw_login_page[logo-title]',
			[
				'type'     => 'text',
				'label'    => __( 'Logo Title Text', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
				'section'  => 'jw_login_page_logo',
				'settings' => 'jw_login_page[logo-title]',
			]
		);

		$wp_customize->add_setting(
			'jw_login_page[logo-hide]',
			[
				'default'    => '',
				'type'       => 'option',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage'
			]
		);

		$wp_customize->add_control(
			'jw_login_page[logo-hide]',
			[
				'type'     => 'checkbox',
				'label'    => __( 'Hide logo', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
				'section'  => 'jw_login_page_logo',
				'settings' => 'jw_login_page[logo-hide]',
			]
		);

	}

	/**
	 * @param \WP_Customize_Manager $wp_customize
	 */
	private function form_controls( \WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_section(
			'jw_login_page_form',
			[
				'priority' => 15,
				'title'    => __( 'Form', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
				'panel'    => 'jw_login_page',
			]
		);

		$wp_customize->add_setting(
			'jw_login_page[form-background-color]',
			[
				'default'           => '',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'jw_login_page[form-background-color]',
				[
					'label'    => __( 'Background Color', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_form',
					'settings' => 'jw_login_page[form-background-color]',
				]
			)
		);

		$wp_customize->add_setting(
			'jw_login_page[form-label-color]',
			[
				'default'           => '',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'jw_login_page[form-label-color]',
				[
					'label'    => __( 'Label Color', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_form',
					'settings' => 'jw_login_page[form-label-color]',
				]
			)
		);

		$wp_customize->add_setting(
			'jw_login_page[form-field-background-color]',
			[
				'default'           => '',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'jw_login_page[form-field-background-color]',
				[
					'label'    => __( 'Field Background Color', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_form',
					'settings' => 'jw_login_page[form-field-background-color]',
				]
			)
		);

		$wp_customize->add_setting(
			'jw_login_page[form-field-border-color]',
			[
				'default'           => '',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'jw_login_page[form-field-border-color]',
				[
					'label'    => __( 'Field Border Color', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_form',
					'settings' => 'jw_login_page[form-field-border-color]',
				]
			)
		);

		$wp_customize->add_setting(
			'jw_login_page[form-field-text-color]',
			[
				'default'           => '',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'jw_login_page[form-field-text-color]',
				[
					'label'    => __( 'Field Text Color', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_form',
					'settings' => 'jw_login_page[form-field-text-color]',
				]
			)
		);

	}

	private function button_controls( \WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_section(
			'jw_login_page_button',
			[
				'priority' => 15,
				'title'    => __( 'Button', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
				'panel'    => 'jw_login_page',
			]
		);

		$wp_customize->add_setting(
			'jw_login_page[button-background-color]',
			[
				'default'           => '',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'jw_login_page[button-background-color]',
				[
					'label'    => __( 'Background Color', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_button',
					'settings' => 'jw_login_page[button-background-color]',
				]
			)
		);

		$wp_customize->add_setting(
			'jw_login_page[button-text-color]',
			[
				'default'           => '',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'jw_login_page[button-text-color]',
				[
					'label'    => __( 'Text Color', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_button',
					'settings' => 'jw_login_page[button-text-color]',
				]
			)
		);

		$wp_customize->add_setting(
			'jw_login_page[button-hover-background-color]',
			[
				'default'           => '',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'jw_login_page[button-hover-background-color]',
				[
					'label'    => __( 'Hover Background Color', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_button',
					'settings' => 'jw_login_page[button-hover-background-color]',
				]
			)
		);

		$wp_customize->add_setting(
			'jw_login_page[button-hover-text-color]',
			[
				'default'           => '',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'jw_login_page[button-hover-text-color]',
				[
					'label'    => __( 'Hover Text Color', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_button',
					'settings' => 'jw_login_page[button-hover-text-color]',
				]
			)
		);

	}

	private function link_controls( \WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_section(
			'jw_login_page_link',
			[
				'priority' => 15,
				'title'    => __( 'Links', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
				'panel'    => 'jw_login_page',
			]
		);

		$wp_customize->add_setting(
			'jw_login_page[link-text-color]',
			[
				'default'           => '',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'jw_login_page[link-text-color]',
				[
					'label'    => __( 'Link Text Color', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_link',
					'settings' => 'jw_login_page[link-text-color]',
				]
			)
		);

		$wp_customize->add_setting(
			'jw_login_page[link-hover-text-color]',
			[
				'default'           => '',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'jw_login_page[link-hover-text-color]',
				[
					'label'    => __( 'Link Hover Text Color', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_link',
					'settings' => 'jw_login_page[link-hover-text-color]',
				]
			)
		);

	}

	private function message_controls( \WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_section(
			'jw_login_page_messages',
			[
				'priority' => 15,
				'title'    => __( 'Messages', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
				'panel'    => 'jw_login_page',
			]
		);

		$wp_customize->add_setting(
			'jw_login_page[message-text-color]',
			[
				'default'           => '',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'jw_login_page[message-text-color]',
				[
					'label'    => __( 'Text Color', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_messages',
					'settings' => 'jw_login_page[message-text-color]',
				]
			)
		);

		$wp_customize->add_setting(
			'jw_login_page[message-background-color]',
			[
				'default'           => '',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'jw_login_page[message-background-color]',
				[
					'label'    => __( 'Background Color', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_messages',
					'settings' => 'jw_login_page[message-background-color]',
				]
			)
		);

		$wp_customize->add_setting(
			'jw_login_page[message-link-color]',
			[
				'default'           => '',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'jw_login_page[message-link-color]',
				[
					'label'    => __( 'Link Color', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_messages',
					'settings' => 'jw_login_page[message-link-color]',
				]
			)
		);

		$wp_customize->add_setting(
			'jw_login_page[message-link-hover-color]',
			[
				'default'           => '',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'jw_login_page[message-link-hover-color]',
				[
					'label'    => __( 'Link Hover Color', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_messages',
					'settings' => 'jw_login_page[message-link-hover-color]',
				]
			)
		);

	}

	private function custom_controls( \WP_Customize_Manager $wp_customize ) {
		$wp_customize->add_section(
			'jw_login_page_custom',
			[
				'priority' => 15,
				'title'    => __( 'Custom CSS', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
				'panel'    => 'jw_login_page',
			]
		);

		$wp_customize->add_setting(
			'jw_login_page[custom-css]',
			[
				'default'           => '',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_textarea_field',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage'
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Code_Editor_Control(
				$wp_customize,
				'jw_login_page[custom-css]',
				[
					'label'    => __( 'Custom CSS', JW_LOGIN_PAGE_CUSTOMIZER_DOMAIN ),
					'section'  => 'jw_login_page_custom',
					'settings' => 'jw_login_page[custom-css]',
					'code_type' => 'text/css',
				]
			)
		);
	}

}
