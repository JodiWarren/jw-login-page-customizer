/*global jQuery wp*/

function receiveMessage(event) {
	console.log(event);
}

window.addEventListener("message", receiveMessage, false);

( function( $ ) {

	$body = $('body');

	wp.customize( 'jw_login_page[background-color]', function( value ) {
		value.bind( function( to ) {
			$body.css({
				'background-color': to
			});
		} );
	} );


} )( jQuery );
