// Mostly stolen from https://make.xwp.co/2016/07/21/navigating-to-a-url-in-the-customizer-preview-when-a-section-is-expanded/
(function ( api ) {
	api.panel( 'jw_login_page', function( panel ) {
		var previousUrl, clearPreviousUrl, previewUrlValue;
		previewUrlValue = api.previewer.previewUrl;
		clearPreviousUrl = function() {
			previousUrl = null;
		};

		panel.expanded.bind( function( isExpanded ) {
			var url;
			if ( isExpanded ) {
				console.log('api.settings', { api });
				url = api.settings.url.login;
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
