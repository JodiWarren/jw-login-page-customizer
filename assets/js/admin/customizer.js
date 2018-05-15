/*global jQuery wp*/

import { fromJS } from 'immutable';

( function () {

	const existingStyles = document.querySelector( '.jw-login-styles' );
	if ( !existingStyles ) {
		return;
	}
	const jsStyles = document.createElement( 'style' );
	existingStyles.insertAdjacentElement( 'afterend', jsStyles );

	// Make an Immutable Map of all the styles;
	let styles = fromJS( {
		'body': {},
		'.login h1 a': {},
		'.login form': {},
		'.login label': {},
		'.login form .input, .login form input[type="checkbox"]': {},
		'.login .button-primary': {},
		'.login .button-primary:hover, .login .button-primary:active': {},
		'.login #nav a, .login #backtoblog a': {},
		'.login #nav a:hover, .login #backtoblog a:hover': {},
		'.login .message, .login #login_error': {},
		'.login .message a, .login #login_error a': {},
		'.login .message a:hover, .login #login_error a:hover': {},
	} );

	let customCSS = '';

	/**
	 * turn ['color', 'red'] into 'color: red;'
	 * @param accumulator
	 * @param currVal
	 * @param currKey
	 * @returns {string}
	 */
	const innerStyleReducer = ( accumulator, currVal, currKey ) => {
		return accumulator + `${currKey}: ${currVal};\n`;
	};

	const outerStyleReducer = ( accumulator, currVal, currKey ) => {
		const styles = currVal.reduce( innerStyleReducer, '' );
		return accumulator + `${currKey} {\n    ${styles}\n}\n`;
	};

	/**
	 * @param styles
	 * @returns {*}
	 */
	function stylesToString( styles ) {
		return styles.reduce( outerStyleReducer, '' );
	}

	function updateStyles() {
		jsStyles.textContent = stylesToString( styles ) + customCSS;
	}

	const setValue = x => x;
	const setUrl = x => `url('${x}')`;
	const setPx = x => `${x}px`;

	/**
	 * Callback for watchStyle
	 * @callback watchCallback
	 * @param {string | boolean}
	 */

	/**
	 * Helper to watch for settings change
	 * @param { string} setting        		Setting name to watch
	 * @param {array} path            		Array path to pass to Map.setIn
	 * @param {watchCallback} transform     Callback function which accepts x
	 */
	function watchStyle( setting, path, transform ) {
		wp.customize( `jw_login_page[${setting}]`, function ( value ) {
			value.bind( function ( to ) {
				styles = styles.setIn( path, transform( to ) );
				updateStyles();
			} );
		} );
	}

	watchStyle( 'background-color', ['body', 'background-color'], setValue );
	watchStyle( 'background-image', ['body', 'background-image'], setUrl );
	watchStyle( 'background-repeat', ['body', 'background-repeat'], x => x ? 'repeat' : 'no-repeat' );
	watchStyle( 'background-cover', ['body', 'background-cover'], x => x ? 'cover' : 'initial' );

	watchStyle( 'logo-image', ['.login h1 a', 'background-image'], x => `none, url(${x})` );
	watchStyle( 'logo-image', ['.login h1 a', 'background-size'], () => 'contain' );
	watchStyle( 'logo-image-height', ['.login h1 a', 'height'], setPx );
	watchStyle( 'logo-image-width', ['.login h1 a', 'width'], setPx );
	watchStyle( 'logo-hide', ['.login h1 a', 'display'], x => x ? 'none' : 'block' );

	watchStyle( 'form-background-color', ['.login form', 'background-color'], setValue );

	watchStyle( 'form-label-color', ['.login label', 'color'], setValue );

	// === Form Field Settings ===
	const formFields = '.login form .input, .login form input[type="checkbox"]';
	watchStyle( 'form-field-background-color', [formFields, 'background-color'], setValue );
	watchStyle( 'form-field-text-color', [formFields, 'color'], setValue );
	watchStyle( 'form-field-border-color', [formFields, 'border-color'], setValue );

	// === Form Button Settings ===
	const button = '.login .button-primary';
	watchStyle( 'button-background-color', [button, 'background-color'], setValue );
	watchStyle( 'button-background-color', [button, 'border-color'], setValue );
	watchStyle( 'button-background-color', [button, 'box-shadow'], x => `0 1px 0 ${x}` );
	watchStyle( 'button-text-color', [button, 'color'], setValue );
	watchStyle( 'button-text-color', [button, 'text-shadow'], x => x ? 'none' : 'inherit' );

	// === Form Button Hover Settings ===
	const buttonHovers = '.login .button-primary:hover, .login .button-primary:active';
	watchStyle( 'button-hover-background-color', [buttonHovers, 'background-color'], setValue );
	watchStyle( 'button-hover-background-color', [buttonHovers, 'border-color'], setValue );
	watchStyle( 'button-hover-background-color', [buttonHovers, 'box-shadow'], x => `0 1px 0 ${x}` );
	watchStyle( 'button-hover-text-color', [buttonHovers, 'color'], setValue );
	watchStyle( 'button-hover-text-color', [buttonHovers, 'text-shadow'], x => x ? 'none' : 'inherit' );

	watchStyle( 'link-text-color', ['.login #nav a, .login #backtoblog a', 'color'], setValue );
	watchStyle( 'link-hover-text-color', ['.login #nav a:hover, .login #backtoblog a:hover', 'color'], setValue );

	const message = '.login .message, .login #login_error';
	watchStyle( 'message-background-color', [message, 'background-color'], setValue );
	watchStyle( 'message-text-color', [message, 'color'], setValue );

	watchStyle( 'message-link-color', ['.login .message a, .login #login_error a', 'color'], setValue );
	watchStyle( 'message-link-hover-color', ['.login .message a:hover, .login #login_error a:hover', 'color'], setValue );

	wp.customize( 'jw_login_page[custom-css]', function ( value ) {
		value.bind( function ( to ) {
			customCSS = to;
			updateStyles();
		} );
	} );

} )( jQuery );
