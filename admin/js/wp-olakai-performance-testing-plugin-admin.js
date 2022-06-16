(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})( jQuery );

let currentVal = 0

function progressBar(iValue, bIncremental = true) {
	if (iValue > 100) {
		iValue = 100
	} else if (iValue < 0) {
		iValue = 0
	}

	oProgressBar = jQuery('#olakai-performance-progress-bar')

	total = iValue
	if (bIncremental) {
		total += currentVal
	}
	console.log(`Setting progress bar from ${currentVal} by ${iValue} to ${total}%`)
	
	oProgressBar.css('width', `${total}%`)
	currentVal = total

	if (total > 0) {
		jQuery('#olakai-performance-progress-bar-container').removeClass('hidden')
	} else {
		jQuery('#olakai-performance-progress-bar-container').addClass('hidden')
	}
}

/**
 * Check whether the URL exists
 * 
 * @param {String} url 
 */
function _head() {
	progressBar(8)
	jQuery.ajax({ 
		data: { 
			'action': _olakai.action_report,
			'html': _olakai.query_args.html,
			'json': _olakai.query_args.json,
		},
		type: 'head',
		url: _olakai.admin,
		success: function(data) {
			window.history.pushState({}, null, `${_olakai.tools}?page=${encodeURIComponent(_olakai.action_lighthouse_run)}&url=${encodeURIComponent(_olakai.query_args.url)}&html=${encodeURIComponent(_olakai.query_args.html)}&json=${encodeURIComponent(_olakai.query_args.json)}&preset=${encodeURIComponent(_olakai.query_args.preset)}&local=${encodeURIComponent(_olakai.query_args.local)}`);
			window.location.reload();
		},
		error: function(xhr, ajaxOptions, thrownError) {
			if (thrownError == "Not Found") {
				setTimeout(function() {
					_head();
				}, 1000);
			} else {
				alert('there was an error');
				console.log('error', thrownError)
				reset(true, false);
			}
		}
	});
}

function prepareReport(response) {
	_head();
	let src = `${_olakai.admin}?action=${_olakai.action_report}&html=${response.html}&json=${response.json}`;
	_olakai.query_args.local = src;
	console.log(`Changing iframe src to ${src}`);

	jQuery('#_olakai_report_content').attr('src', src);
}

function reset(hideReport, disableGoButton) {
	if (hideReport) {
		report = { }
	}
	progressBar(disableGoButton ? 1 : 0, false)
	jQuery('#olakai-performance-form input[type=submit]').prop('disabled', disableGoButton);
	jQuery('#_olakai_report').toggleClass('hidden', hideReport);
	
	jQuery('#olakai-consulting-card-body').toggleClass('hidden', !hideReport);
}

function _olakai_form() {
	reset(true, false);

	// Check whether the form has already been submitted and this is a reload
	if (_olakai.query_args.html) {
		reset(false, false);
	}
	
	var form = jQuery('#olakai-performance-form');
	if (!form) {
		return ;
	}
	
	form.submit(function(e) {
		reset(true, true);
		e.preventDefault();
		var inputs = form.serializeArray();
		_olakai.query_args.url = inputs[1].value
		_olakai.query_args.preset = inputs[2].value
		console.log(inputs);
		jQuery.ajax({ 
			data: form.serialize(),
			type: 'post',
			url: form.attr("action"),
			success: function(data) {
				var content = JSON.parse(data);
				console.log(content);
				_olakai.query_args.html = content.html
				_olakai.query_args.json = content.json
				jQuery('#_open_report').attr("href", content.html);
				progressBar(10);
				prepareReport(content);
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert('There was an error');
				console.log('error', thrownError)
				// Toggle states
				reset(true, false);
			}
		});

		return false;
	});

	return false;
}

jQuery(document).ready(_olakai_form);
