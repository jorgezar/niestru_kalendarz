var databaseAccessPath = "http://easypack1.hekko24.pl/niestru/callendar/database/"
$(document).ready(function(){
	$.getJSON(databaseAccessPath+"getTimeRange.php", function(data){
		var activeElement = data[0].range_selected;
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


