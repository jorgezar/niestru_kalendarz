$(document).ready(function() {
		var weeklyHours = [];
		$.getJSON('http://easypack1.hekko24.pl/fullc/database/getWorkingHours.php', function(data){
		for (i in data){
			var start = data[i].start;
			var end = data[i].end;
			var startMinutes = parseInt(start % 60, 10);
			var startHours = parseInt(start / 60 %24, 10);
			if(startHours.toString().length == 1) {
				startHours = '0' + startHours.toString();
			}
			var start = startHours +":"+startMinutes;
			var endMinutes = parseInt(end % 60, 10);
			var endHours = parseInt(end / 60 % 24, 10);
			if(endHours.toString().length == 1) {
				endHours = '0' + endHours.toString();
			}
			var end = endHours +":"+endMinutes;
			var dayNumber = '[ ' + parseInt(i)+1 + ' ]';
			var singleDayData= {'dow':dayNumber, 'start':start,'end':end};
			weeklyHours.push(singleDayData);
		}
	});

	$('#calendar').fullCalendar({
	allDayDefault:false,
	events: "http://easypack1.hekko24.pl/fullc/database/events.php",
	header: {
		left: 'prev,next today',
		center: 'title',
		right: 'month,agendaWeek,agendaDay'
	},
	editable: true,
	eventLimit: true, // allow "more" link when too many events
	locale:"pl",
	navLinks: true, // can click day/week names to navigate views
	selectable: true,
	selectHelper: true,

	//create new event			
	select: function(start, end, jsEvent, view) {
		if(view.name == 'month'){
		$('#calendar').fullCalendar('changeView', 'agendaDay');
		$('#calendar').fullCalendar('gotoDate', start);
		} else {
		var start = $.fullCalendar.moment(start).format();
		var end = $.fullCalendar.moment(end).format();
		var title = prompt('Nazwa wydarzenia');
		var eventData;
		if (title) {
			eventData = {
				title: title,
				start: start,
				end: end
			};
			$.ajax({
				url:'http://easypack1.hekko24.pl/fullc/database/add_events.php',
				data: {'title':title, 'start':start, 'end':end},
				type:'POST',
				success: function(json) {
				}
			});
			$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
			}
			$('#calendar').fullCalendar('unselect');
		}	
	},

	eventRender: function(event, element, view) {
	element.attr('href', 'javascript:void(0);');
	element.click(function(){
		$("#startTime").html(moment(event.start).format('MMM Do H:mm A'));
		$("#endTime").html(moment(event.end).format('MMM Do H:mm A'));
		$("#eventInfo").html(event.description);
		$("#eventContent").dialog({ 
			modal:true, 
			title: event.title,
			buttons:{
				"EDYTUJ": function() {
					alert("funkcja zostanie napisana później");
				},
				"ZAMKNIJ": function() {
					$("#eventContent").dialog("close");
					},
				"USUŃ": function(){
					$.ajax({
						url:'http://easypack1.hekko24.pl/fullc/database/delete.php',
						data:{'id': event.id},
						type:'POST',
						success: function(json) {
							alert('Usunięto wydarzenie');
							$('#calendar').fullCalendar( 'refetchEvents' );
							$("#eventContent").dialog("close");	
							}
						});
					}
				}
			});
	});
	//console.log(event.start + event.title + event.end);
    if (event.allDay === 'true') {
     event.allDay = true;
    } else {
     event.allDay = false;
    }
},
dayRender: function(date, cell) {
//console.log(date + cell);
	if ($(this).hasClass('fc-nonbusiness')){
	console.log('not a business day');
		alert('is non business');
	}
},
/*
	dayClick: function(date, jsEvent, view){
		alert(view.name);
		if (view.name != 'month')
			return;
		$('#calendar').fullCalendar('changeView', 'agendaDay');
		$('#calendar').fullCalendar('gotoDate', date);
	},
	*/
			//moving event in browser database update
	eventDrop: function(event, delta){
		var start = $.fullCalendar.moment(event.start).format();
		var end = $.fullCalendar.moment(event.end).format();
		$.ajax({
			url:'http://easypack1.hekko24.pl/fullc/database/update_events.php',
			data: {'title':event.title, 'start':start, 'end':end, 'id':event.id},
			type:'POST',
			success: function(json) {
				alert('Wydarzenie zapisane');
				}
			});
	},
	businessHours: weeklyHours,

	

			
	});
});
	