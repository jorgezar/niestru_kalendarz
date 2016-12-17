$(document).ready(function(){
	$.getJSON("/fullc/database/services.php", function(data){
		for(i in data){
			var serviceId = data[i].serviceId;
			var serviceName = data[i].serviceName;
			var serviceTime = data[i].serviceTime;
			var serviceColor = data[i].serviceColor;
			var myHTML = "<li class = 'serviceListItem' style='background-color:"+serviceColor+";'>"+serviceTime+" minut<input type='checkbox' class='serviceLabel' name='popupDialogServices' value='"+serviceId+"' serviceTime='"+serviceTime+"'>"+serviceName+"</li>";
			$("#services").append(myHTML);
		}
	});
	var totalServiceTime = 0;
	$("input:checkbox.serviceListItem").each(function(){
		var thisTime = (this.checked ? $(this).attr("serviceTime") : 0);
		totalServiceTime = totalServiceTime + thisTime;
	});
	$("#services").on('change', ':checkbox', function(){
		if($(this).is(":checked")){
			totalServiceTime = totalServiceTime + parseInt($(this).attr("serviceTime"));
			$("span#serviceTimeCounter").text(totalServiceTime + " min");
		} else if (!$(this).is(":checked")) {
			totalServiceTime = totalServiceTime - parseInt($(this).attr("serviceTime"));
			$("span#serviceTimeCounter").text(totalServiceTime + " min");
		}
	});
});