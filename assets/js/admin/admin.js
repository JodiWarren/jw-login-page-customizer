/*global wp*/


// Mostly stolen from https://make.xwp.co/2016/07/21/navigating-to-a-url-in-the-customizer-preview-when-a-section-is-expanded/
( function ( api ) {
	api.panel( 'jw_login_page', function( panel ) {
		let previousUrl, clearPreviousUrl, previewUrlValue;
		previewUrlValue = api.previewer.previewUrl;
		clearPreviousUrl = function() {
			previousUrl = null;
		};

		panel.expanded.bind( function( isExpanded ) {
			let url;
			if ( isExpanded ) {
				console.log( 'api.settings', { api } );
				// We don't want to use api.settings.url.home because that gives
				// us the interim login screen, which is not accurate
				url = api.settings.url.home + '/wp-login.php';
				previousUrl = previewUrlValue.get();

				previewUrlValue.set( url );
				previewUrlValue.bind( clearPreviousUrl );
			} else {
				previewUrlValue.unbind( clearPreviousUrl );
				if ( previousUrl ) {
					previewUrlValue.set( previousUrl );
				}
			}
		} );
	} );
} ( wp.customize ) );
