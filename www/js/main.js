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

			$('form-control.has-error').each(function () {
				$(this).removeClass('has-error');
			});

			if(proceed) //everything looks good! proceed...
			{
				$
					.post('mail/recaptcha.php', {
						'captcha': $('#inputCaptcha').val()
					})

					.done(function(data) {
						console.log('success', data);
						$("#contact-results").slideDown().html('');

						if(data.success) {
							$('#contact-form').submit();
						} else {
							$("#contact-result-captcha")
								.hide()
								.html('Der eingegebene Code ist falsch.')
								.slideDown()
								.parent().addClass('has-error');
						}
					})// $.post().done()

					.fail(function(data) {
						console.log('fail', data.responseText);

						$('#contact-results')
							.hide()
							.html('Ein Fehler ist aufgetreten.')
							.slideDown();
					})// $.post().fail()
				;
			}
			$("#contact-results")
				.hide()
				.html('');
		}); // contact-form.on()


		$('#inputCaptcha').redCaptcha();
	}); // document.ready()
})(jQuery);