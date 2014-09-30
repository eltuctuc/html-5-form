/**
 * Created by Enrico on 17.08.2014.
 */

(function($){
	'use strict';
	$(document).ready(function() {

		$('#contact-form .form-group.required > label').append($('<span>').html('*'));

		$('#contact-form')
			.attr('method', 'post')
			.phpmailerconfig({
				hiddenFields : {
					toName: 'Enrico Reinsdorf',
					toEmail: 'enrico@re-design.de'
				},
				subjectId: 'inputSubject',
				submitButtonId: 'contact-submit',
				tplSuccessId: 'contact-success',
				tplFailedId: 'contact-failed'
			})
		;


		$('#inputCaptcha').redCaptcha();
	}); // document.ready()
})(jQuery);