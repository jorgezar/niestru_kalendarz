var databaseAccessPath = 'http://easypack1.hekko24.pl/niestru/callendar/database/';
$(document).ready(function(){
	$.getJSON(databaseAccessPath + "services.php", function(data){
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