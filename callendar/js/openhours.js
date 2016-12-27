var weekDays = {
	0 : 'poniedziałek',
	1 : 'wtorek',
	2 : 'środa',
	3 : 'czwartek',
	4 : 'piątek',
	5 : 'sobota',
	6 : 'niedziela'
}
var databaseAccessPath = "http://easypack1.hekko24.pl/niestru/callendar/database/";
$(document).ready(function(){
	$.getJSON(databaseAccessPath+'getWorkingHours.php', function(data){
	for (i in data) {
		var isOpen = data[i].open;
		if (isOpen == 1){
			isOpen = true;
		} else {
			isOpen = false;
		}
		var container = $(document.createElement("div"))
		.addClass("range-day")
		.attr("id", "day"+data[i].day)
		$("<input />",{
			'class' : 'range-checkbox',
			type : "checkbox",
			id : "checkbox" + data[i].day,
			checked : isOpen,
		}).appendTo(container);
		$("<label />", {
			'class' : 'range-label',
			'for' : "checkbox" + data[i].day,
			text : weekDays[i]
		}).appendTo(container);
		var $slider = $("<div />", {
			'class' : 'range-slider ',
			id : "range-slider" + data[i].day,	
		});
		$slider.slider({
			min : 0,
			max : 1440,
			values : [data[i].start, data[i].end],
			range : true,
			animate : true,
			step : 30,
			slide : slideTime
		});
		$slider.appendTo(container);
		if(!isOpen){
			$slider.slider("disable");
		}
		$("<label />", {
			id : "showHours" + data[i].day,
			'class' : 'range-time',
			text : showHoursLabel(data[i].start, data[i].end, isOpen)
		}).appendTo(container);
		container.appendTo("#selectRangeDay");
		}
		
  });
	$("body").on('change', '.range-checkbox', function(){
		var $slider = $(this).siblings(".range-slider");
		var $label = $(this).siblings(".range-time");
		if($slider.hasClass("ui-slider-disabled")){
			$slider.slider("enable");
			$label.text(showHoursLabel($slider.slider('values')[0], $slider.slider('values')[1], true));
		} else {
			$slider.slider("disable");
			$label.text(showHoursLabel($slider.slider('values')[0], $slider.slider('values')[1], false));
			}
	});
  	$("#saveDataButton").on("click", function(){
		var sliderData = [];
		$(".range-day").each(function(index){
			var data = {
				"day"  : $(this).attr("id"),
				"isOpen" : $(".range-checkbox", this).is(":checked"),
				"start"  : $(".range-slider", this).slider("values", 0),
				"end"    : $(".range-slider", this).slider("values", 1)
				};
			sliderData.push(data);
				});
		$.ajax({
			url : databaseAccessPath+"query.php",
			data : {
				'updateHoursData' : sliderData,
				'task' : 'updateWorkingHours'
				},
			type:"POST",
			success : alert("wprowadzono zmiany")
		});
  });
});
function slideTime(event, ui){
	var $label = $(this).siblings('.range-time');
	$($label).text(showHoursLabel(ui.values[0], ui.values[1], true));
}
function showHoursLabel(start, end, isOpen){
	var labelText = '';
	if (isOpen){
		var startHours = hoursFromMinutes(start);
		var endHours = hoursFromMinutes(end);
		labelText = startHours + ' - ' + endHours;
	} else {
		labelText = "Zamknięte";
	}	
	return labelText;
}
function hoursFromMinutes(minutes){
	return getTime(parseInt(minutes / 60 % 24, 10), parseInt(minutes % 60, 10));
}
function getTime(hours, minutes) {
	var time = null; 
	minutes = minutes + "";
	if (minutes.length == 1) {
		minutes = "0" + minutes;
	}
	return hours + ":" + minutes;
}
