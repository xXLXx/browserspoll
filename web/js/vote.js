+function ($) {
	$.fn.historyinput = function () {
		console.log(document.referrer);
		$(this).val(document.referrer);
	}

	$(function () {
		$('[history-input]').historyinput();
	});
} (jQuery);