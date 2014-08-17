/**
 * Created by Enrico on 17.08.2014.
 */

(function($){
	'use strict';
	$(document).ready(function() {

		$('#contact-form .form-group.required > label').append($('<span>').html('*'));

		$('#contact-form').on('submit', function(event) {
			event.preventDefault();
			var proceed = true;

			if(proceed) //everything looks good! proceed...
			{
				$.post('mail/index.php',
					{
						'user_email': 'postmaster@localhost',
						'user_name': 'Postmaster',
						'from_email': 'enrico.reinsdorf@re-design.de',
						'from_name': 'Enrico Reinsdorf',
						'subject': 'Test Subject',
						'msg': ''
					})// $.post(

					.done(function(data) {
						console.log('success', data);
						$("#contact-results").slideDown().html('');
					})// $.post().done()

					.fail(function(data) {
						console.log('fail', data.responseText);

						$('#contact-results')
							.hide()
							.html('Ein Fehler ist aufgetreten.')
							.slideDown();
					})// $.post().done()

					.always(function(data) {
						console.log('finished');

						$('#contact-results')
							.hide()
							.html('Email verschickt')
							.slideDown();
					}); // $.post.done()
			}
			$("#contact-results")
				.hide()
				.html('');
		}); // contact-form.on()
	}); // document.ready()
})(jQuery);