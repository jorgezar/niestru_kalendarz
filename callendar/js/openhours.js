var rangeTimes = [];
$(document).ready(function() {
	$.getJSON('http://easypack1.hekko24.pl/fullc/database/getWorkingHours.php', function(data){
	for (i in data) {
		var isOpen = data[i].open;
		if (isOpen == 1){
			isOpen = true;
		} else {
			isOpen = false;
		}
		var dayId = data[i].id;
		var myDay = data[i].day;
		var myStart = data[i].start;
		var myEnd = data[i].end;
		//zwraca '#range-slider-i'
		var sliderIdentifier = "#range-slider-" + myDay;
		//zwraca 'input#day1.range-checkbox'
		var checkboxIdentifier = "input#" + dayId + ".range-checkbox";
		$(sliderIdentifier).slider({
			range: true,
			animate:true,
			min: 0,
			max: 1440,
			values: [myStart, myEnd],
			step:30,
			slide: slideTime,
			//change: updateOpeningHours,
			//stop: saveHoursToDatabase
	});
		$(checkboxIdentifier).prop('checked', isOpen);

		var chkbx = ".range-day #" + dayId;
		var mySlider = '#range-slider-' + myDay;
		//console.log(mySlider);
		if($(chkbx).is(":checked")) {
			$(mySlider).slider('enable');
		} else {
			$(mySlider).slider('disable');
		}
		var startHours = getTime(parseInt(myStart / 60 % 24, 10), parseInt(myStart % 60, 10));
		var endHours = getTime(parseInt(myEnd / 60 % 24, 10), parseInt(myEnd % 60, 10));
		if ($(chkbx).is(':checked')) {
		$("#range-time-" + myDay).text(startHours + " - " + endHours);
		} else {
		$("#range-time-" + myDay).text("Zamknięte");	
		}
		}
	});
$('input.range-checkbox').change(function() {
	var isChecked = 0;
	if ($(this).is(":checked")){
			isChecked = 1;
	}
	var thisId = this.id;
	console.log(isChecked + 'XXX' + thisId);
	$.ajax({
		url:'http://easypack1.hekko24.pl/fullc/database/updateWorkingDay.php',
		data:{'isOpen':isChecked, 'dayId':thisId},
		type:'POST'
	});
});
  $('.range-checkbox').on('change', function(){
    var $rangecheck = $(this);
    var $rangeslider = $rangecheck.closest('.range-day').find('.range-slider');
    slideTime({target:$rangeslider});
    //updateOpeningHours();
  });
  	$("#saveDataButton").on("click", function(){
		var sliderData = [];
		$(".range-day").each(function(index){
			var data = {
				"day"  : $(this).attr("data-day"),
				"isOpen" : $(".range-checkbox", this).is(":checked"),
				"start"  : $(".range-slider", this).slider("values", 0),
				"end"    : $(".range-slider", this).slider("values", 1)
				};
			sliderData.push(data);
				});
			console.log(sliderData);
		$.ajax({
			url : "http://easypack1.hekko24.pl/fullc/database/updateWorkingDay.php",
			data : {'sliderData' : sliderData},
			type:"POST"
		});
  });
	//called when save service to database icon is clicked on the front
	$(".saveService").each(function(){
		$(this).on('click', (function(){
			console.log("change is received");
		}));
	});

});

function slideTime(event, ui){
    if (event && event.target) {
      var $rangeslider = $(event.target);
      var $rangeday = $rangeslider.closest(".range-day");
      var rangeday_d = parseInt($rangeday.data('day'));
      var $rangecheck = $rangeday.find(":checkbox");
      var $rangetime = $rangeslider.next(".range-time");
    }
    
    if ($rangecheck.is(':checked')) {
      $rangeday.removeClass('range-day-disabled');
      $rangeslider.slider('enable');
      
      if (ui!==undefined) {
        var val0 = ui.values[0],
			      val1 = ui.values[1];
      } else {
        var val0 = $rangeslider.slider('values', 0),
			      val1 = $rangeslider.slider('values', 1);
      }
      
      var minutes0 = parseInt(val0 % 60, 10),
			    hours0 = parseInt(val0 / 60 % 24, 10),
			    minutes1 = parseInt(val1 % 60, 10),
			    hours1 = parseInt(val1 / 60 % 24, 10);
      if (hours1==0) hours1=24;
      
		  rangeTimes[rangeday_d] = [getTime(hours0, minutes0),getTime(hours1, minutes1)];
        
      $rangetime.text(rangeTimes[rangeday_d][0] + ' - ' + rangeTimes[rangeday_d][1]);
      
    } else {
      $rangeday.addClass('range-day-disabled');
      $rangeslider.slider('disable');
      
      rangeTimes[rangeday_d] = [];
      
      $rangetime.text('Zamknięte');
    }
	}
	function getTime(hours, minutes) {
		var time = null; 
		minutes = minutes + "";
		if (minutes.length == 1) {
      minutes = "0" + minutes;
		}
		return hours + ":" + minutes;
	}
function saveHoursToDatabase(event, ui){
		var day = this.id;
		var start = ui.values[0];
		var end = ui.values[1];
		$.ajax({
			url:'http://easypack1.hekko24.pl/fullc/database/updateCalendarRange.php',
			data:{'day': day, 'start': start, 'end':end},
			type:'POST'
		});
	}	