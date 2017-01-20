//var databaseAccessPath = '195.62.13.113/niestru_kalendarz/callendar/database/';
$(document).ready(function(){
	$.getJSON("callendar/database/services.php", function(data){
		for(i in data){
			var serviceId = data[i].serviceId;
			var serviceName = data[i].serviceName;
			var serviceTime = data[i].serviceTime;
			var serviceColor = data[i].serviceColor;
			var myHTML = "<li class = 'serviceListItem' style='background-color:"+serviceColor+";'>"+serviceTime+" min.<input type='checkbox' class='serviceLabel' name='popupDialogServices' value='"+serviceId+"' serviceTime='"+serviceTime+"'>"+serviceName+"</li>";
			$("#services").append(myHTML);
		}
	});
});