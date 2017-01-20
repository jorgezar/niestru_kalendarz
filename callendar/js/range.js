$(document).ready(function(){
	$.getJSON("callendar/database/getTimeRange.php", function(data){
		var activeElement = data.range_selected;
		$(".rangeRadio#" + activeElement + "").prop('checked', true);
	});

	$(".rangeRadio").click(function() {    
		$.ajax({
			url : databaseAccessPath+'query.php',
			data : {
				'timePoint' : $(this).attr("id"),
				'task' : 'updateTimeRange'
				},
			type : 'POST'
		});
	});

});


