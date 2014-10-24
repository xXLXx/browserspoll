+function ($) {
	$.fn.hoverablepie = function (options) {
		$(this).bind('plothover', function (event, pos, obj) {
			 if (!obj)
		        return;

		    percent = parseFloat(obj.series.percent).toFixed(2);
		    $($(this).data('hoverable-pie')).html('<span style="font-weight: bold; color: '+obj.series.color+'">'+obj.series.label+' ('+percent+'%)</span>');
		});
	}

	$(function () {
		$('[data-hoverable-pie]').hoverablepie();
	});
} (jQuery);