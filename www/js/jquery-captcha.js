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
	var pluginName = 'redCaptcha',
		defaults = {
			propertyName: 'value',
			imgPath: './captcha.php',
			imgId: 'red_captcha_img_id'
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


			if ($(this.element).data('captcha-script') != '') {
				this.settings.imgPath = $(this.element).data('captcha-script');
			}

			var $img = $('<img>')
					.attr('src', this.settings.imgPath)
					.attr('id', this.settings.imgId)
				;
			var $button = $('<button>')
					.addClass('btn btn-default')
					.attr('title', 'Bild neuladen')
					.attr('type', 'button')
					.data('imgSrc', this.settings.imgPath)
					.data('imgId', this.settings.imgId)
					.append($('<i>').addClass('glyphicon glyphicon-refresh'))
					.on('click', this.refreshAction)
				;

			$(this.element).before(
				$('<div>')
					.append($img)
					.append($button)
			);
		},
		refreshAction: function () {
			var $this = $(this);
			$('#' + $this.data('imgId')).attr('src', $this.data('imgSrc'));
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