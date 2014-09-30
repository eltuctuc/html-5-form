// the semi-colon before function invocation is a safety net against concatenated
// scripts and/or other plugins which may not be closed properly.
;
(function ($) {
	'use strict';

	// undefined is used here as the undefined global variable in ECMAScript 3 is
	// mutable (ie. it can be changed by someone else). undefined isn't really being
	// passed in so we can ensure the value of it is truly undefined. In ES5, undefined
	// can no longer be modified.

	// window and document are passed through as local variable rather than global
	// as this (slightly) quickens the resolution process and can be more efficiently
	// minified (especially when both are regularly referenced in your plugin).

	// Create the defaults once
	var pluginName = 'phpmailerconfig';
	var defaults = {
		hiddenFields : {
			toEmail :   '',
			toName :    '',
			fromEmail : '',
			subject :  '',
			body :  ''
		},
		subjectId:        '',
		submitButtonId:   'submitBtn',
		tplSuccessId:     'submitSuccess',
		tplFailedId:      'submitFailed'
};

	// The actual plugin constructor
	function Plugin(element, options) {
		this.element = element;
		// jQuery has an extend method which merges the contents of two or
		// more objects, storing the result in the first object. The first object
		// is generally empty as we don't want to alter the default options for
		// future instances of the plugin
		this.settings = $.extend({}, defaults, options);
		this._defaults = defaults;
		this._name = pluginName;
		this.init();
	}

	// Avoid Plugin.prototype conflicts
	$.extend(Plugin.prototype, {
		init: function () {
			// Place initialization logic here
			// You already have access to the DOM element and
			// the options via the instance, e.g. this.element
			// and this.settings
			// you can add more functions like the one below and
			// call them like so: this.yourOtherFunction(this.element, this.settings).
			console.log(this._name + ' started');

			var $element = $(this.element);
			var settings = this.settings;
			console.log('settings', settings);

			$.each(settings.hiddenFields, function (key, value) {
				if($('#' + key).length == 0)
				var $input = $('<input>')
						.attr('type', 'hidden')
						.attr('name', key)
						.attr('id', key)
						.attr('value', value);
				$element.append($input)
			});

			//$('#' + this.settings.submit_button).attr("disabled", "disabled");
			$('#' + settings.tplSuccessId).hide();
			$('#' + settings.tplFailedId).hide();

			$element.on('submit', function(event) {
				event.preventDefault();
				$('#' + settings.tplSuccessId).hide();
				$('#' + settings.tplFailedId).hide();

				var postData = $(this).serializeArray();
				var formURL = $(this).attr("action");

				$.post(formURL, postData)
					.done( function (data) {
						console.log('done', data);

						var successId = '#' + settings.tplSuccessId;

						$('.panel-body', $(successId)).append(
							$('<div>').html(data)
						);

						$(successId).show();
					})
					.fail( function (xhr) {
						console.log('fail', xhr);

						var failedId = '#' + settings.tplFailedId;

						$('.panel-body', $(failedId)).append(
							$('<div>').html(xhr.responseText)
						);

						$(failedId).show();
					})
				;
			}); // contact-form.on()
		}
	});

	// A really lightweight plugin wrapper around the constructor,
	// preventing against multiple instantiations
	$.fn[pluginName] = function (options) {
		this.each(function () {
			if (!$.data(this, 'plugin_' + pluginName)) {
				$.data(this, 'plugin_' + pluginName, new Plugin(this, options));
			}
		});

		// chain jQuery functions
		return this;
	};

})(jQuery);