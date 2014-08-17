/**
 * Created by Enrico on 17.08.2014.
 */

(function($){
	'use strict';
	$(document).ready(function(){

		$('#contact-form').on('submit', function(event) {
			event.preventDefault();

			$.post('mail.php',
				{

				})
				.done(function(data) {
					console.log('success', data);
				})
				.fail(function(data) {
					console.log('fail');
				})
				.always(function(data) {
					console.log('finished');
				});
		});
	});
})(jQuery);