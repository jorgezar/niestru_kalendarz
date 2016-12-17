$(document).ready(function(){
	$.getJSON("http://easypack1.hekko24.pl/fullc/database/getTimeRange.php", function(data){
		var activeElement = data[0].range_selected;
		console.log(activeElement);
		$(".rangeRadio#" + activeElement + "").prop('checked', true);
});
	$("#timeRange input").on('change', function(){
		$.ajax({
			url : 'http://easypack1.hekko24.pl/fullc/database/updateTimeRange.php',
			data : {'timePoint' : $("input[name=timeRange]:checked", '#timeRange').val()},
			type : 'POST'
		});
	});

});


