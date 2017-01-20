//name for subdomain
var databaseAccessPath = '/niestru_kalendarz';
function getServices(){
	return $.ajax({
		url : "callendar/database/services.php",
		dataType : 'json',
		type: "POST"
	});
}
$(document).ready(function() {
	var servicesInDB = [];
	var servicesPromise = getServices();	
	servicesPromise.done(function(mydata){
		for (var i in mydata){
			var singleService = {
					'id' : mydata[i].serviceId,
					'name' : mydata[i].serviceName,
					'time' : mydata[i].serviceTime,
					'color' : mydata[i].serviceColor
				};
				servicesInDB.push(singleService);
		}
	});

	var weeklyHours = [];
		//fetch opening hours for each day
	$.getJSON('callendar/database/getWorkingHours.php', function(data){
		for (i in data){
			var start = data[i].start;
			var end = data[i].end;
			var startMinutes = parseInt(start % 60, 10);
			var startHours = parseInt(start / 60 %24, 10);
			if(startHours.toString().length == 1) {
				startHours = '0' + startHours.toString();
			}
			if(startMinutes.toString().length == 1) {
				startMinutes = '0' + startMinutes.toString();
			}
			var start = startHours +":"+startMinutes;
			var endMinutes = parseInt(end % 60, 10);
			var endHours = parseInt(end / 60 % 24, 10);
			if(endHours.toString().length == 1) {
				endHours = '0' + endHours.toString();
			}
			if(endMinutes.toString().length == 1) {
				endMinutes = '0' + endMinutes.toString();
			}
			var end = endHours +":"+endMinutes;
			var dayNumber = +i + +1;
			var dayOfWeek = '[ ' + dayNumber + ' ]';
			var singleDayData= {'dow':dayOfWeek, 'start':start,'end':end};
			weeklyHours.push(singleDayData);
		}
	});
	
	$('#calendar').fullCalendar({
	allDayDefault:false,
	//fetch events from JSON file at server
	events: "callendar/database/events.php",
	header: {
		left: 'prev,next today',
		center: 'title',
		right: 'month,agendaWeek,agendaDay'
	},
	editable: true,
	eventLimit: true, // allow "more" link when too many events
	locale:'pl',
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
		$("#eventStart").text("Początek: " + start);
		var totalServiceTime = 0;
		$("input:checkbox.serviceListItem").each(function(){
			var thisTime = (this.checked ? $(this).attr("serviceTime") : 0);
			totalServiceTime = totalServiceTime + thisTime;
		});
		$("#services").on('change', ':checkbox', function(){
			if($(this).is(":checked")){
				totalServiceTime = totalServiceTime + parseInt($(this).attr("serviceTime"));
				$("#eventTimeCounter").val(totalServiceTime);
			} else if (!$(this).is(":checked")) {
				totalServiceTime = totalServiceTime - parseInt($(this).attr("serviceTime"));
				$("#eventTimeCounter").val(totalServiceTime);
			}
		});
		
		$("#eventDialog").dialog({
			modal:true,
			title:'dodaj rezerwację',
			buttons:{
				"DODAJ":function(){
					var serviceIds = [];
					$(".serviceListItem").each(function(){
						var serviceCheckbox = $(this).find(".serviceLabel");
						if(serviceCheckbox.is(":checked")){
							var serviceId = $(this).find(".serviceLabel");
							serviceIds.push(serviceId.attr("value"));
						}
					});
					var end = moment(start).format();
					end = moment(end).add(totalServiceTime, 'minute');
					var newEventData = {
						'title' : $("#clientName").val(),
						'start' : start.toString(),
						'end' : end.format(),
						'telephone' : $("#clientTelephone").val(),
						'services' : serviceIds
					};
					$.ajax({
						url: 'callendar/database/query.php',
						data: {
							'eventData' : newEventData,
							'task' : 'addNewEvent'
							},
						type:'POST',
						success: function(json) {
				},
			});
					
					$('#calendar').fullCalendar( 'refetchEvents' );
					$("#eventDialog").dialog("close");					
			}
			}
		});
		//$('#calendar').fullCalendar('renderEvent'); // stick? = true
			}
		$('#calendar').fullCalendar('unselect');
			
	},

	eventRender: function(event, element, view) {
	element.attr('href', 'javascript:void(0);');
	element.click(function(){
	
		var start = moment(event.start).format('MMM Do H:mm A');
		var end = moment(event.end).format('MMM Do H:mm A');
		var duration = moment(event.end).diff(moment(event.start), 'minutes');
		var eventDuration = $("<input />", {
			'type' : 'number',
			'min' : 1,
			'value' : duration,
			'id' : 'eventDurationInput'
		});
		$("#eventDuration").html(eventDuration);
		$("#startTime").html(start);
		$("#endTime").html(end);
		$("#clientName").html(event.title);
		$("#clientTelephone").html(event.telephone);
		var eventServicesArray = event.services.split(',');
		var serviceList = [];
		for(var service in eventServicesArray){
			var serviceDesc = '';
			for(var i in servicesInDB){
				if(eventServicesArray[service] == servicesInDB[i].id){
					var serviceDesc = $("<li />", {
					'text' : servicesInDB[i].name,
					'class' : 'dialogShowService',
					'id' : 'service_'+servicesInDB[i].id
					});
					serviceList.push(serviceDesc);
					break;
				} else {
					serviceDesc = 'Nie udało sie dopasować usługi do opisu. Być może została usunęta z bazy danych.';
				}
			}
			
		}
		$("#eventInfo").html(serviceList);
		$("#servicesList").html(event.services);
		$("#eventInfo").html(event.description);
		$("#eventContent").dialog({ 
			modal:true, 
			title: event.title,
			buttons:{
				"ZAPISZ": function() {
					alert("tutaj funkcja zapisująca zmiany do bazy");
				},
				"USUŃ": function(){
					var askUser = confirm("Naprawdę usunąć tą rezerwację?");
					if(askUser){
						$.ajax({
						url:'callendar/database/query.php',
						data:{'id': event.id, 'task': 'deleteEvent'},
						type:'POST',
						success: function(json) {
							alert('Usunięto wydarzenie');
							$('#calendar').fullCalendar( 'refetchEvents' );
							$("#eventContent").dialog("close");	
							}
						});
					}
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
			url:'/fullc/database/update_events.php',
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
	