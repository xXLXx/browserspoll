+function ($) {
	var lastHoveredRow = -1;

	$.fn.hoverablepie = function (options) {
		$(this).bind('plothover', function (event, pos, obj) {
			 if (!obj)
		        return;

		    percent = parseFloat(obj.series.percent).toFixed(2);
		    $($(this).data('hoverable-pie')).html('<span style="font-weight: bold; color: '+obj.series.color+'">'+obj.series.label+' ('+percent+'%)</span>');

		    $gridTr = $($(this).data('hoverable-grid') + ' tbody > tr');
		    
		    $gridTr.eq(lastHoveredRow).removeClass('success');
		    $gridTr.eq(lastHoveredRow = obj.seriesIndex).addClass('success');
		});
	}

	$(function () {
		$('[data-hoverable-pie]').hoverablepie();
	});
} (jQuery);