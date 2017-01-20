var databaseQueryPath = '195.62.13.113/niestru_kalendarz/callendar/database/query.php'

$(document).ready(function() {
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
	$.getJSON('/niestru_kalendarz/callendar/database/services.php', function(data){
		for (i in data){
			var serviceId = data[i].serviceId;
			var serviceName = data[i].serviceName;
			var serviceTime = data[i].serviceTime;
			var serviceColor = data[i].serviceColor;
			var serviceOrder = data[i].serviceOrder;
			var myHTML = "<li class='inputHolder'><input type='text' class='serviceName' id = 'serviceName"+i+"' name='serviceName" + i + "' value='" + serviceName+ "'/> <input type = 'text' name='serviceTime" + i+ "'class='serviceTime' id='serviceTime"+i+"'value ='"+serviceTime+"' /> <input type='color' class='serviceColor' id='serviceColor"+i+"' name='serviceColor"+i+"' value = '"+serviceColor+"'/><button class='deleteService' id='"+serviceId+"'></button><button class='saveService' id='"+serviceId+"'></button></li>";
			$('<div/>', {
				'class' : 'serviceHolder',
				'id': serviceId,
				'name' : serviceName,
				'html' : myHTML
				}).appendTo(wrapper);
		}
	});

    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
		var valid = true;
        var serviceName = $("#serviceName").val();
		var serviceTime = $("#serviceTime").val();
		var serviceColor = $("#serviceColor").val();
		if (serviceName == ''){
			valid = false;
			alert('proszę wprowadzić nazwę usługi');
		}
		if(serviceTime == '' || isNaN(serviceTime)){
			valid=false;
			alert("proszę wprowadzić czas w minutach (można wprowadzić zero minut)");
		}
		if(valid){
			var newService = {
				'name' : serviceName,
				'time' : serviceTime,
				'color' : serviceColor
			}
		$.ajax({
			url: databaseQueryPath,
			data: {
				'task' : 'addService',
				'newServiceData' : newService
				},
			type:"POST",
			success:function(){
				alert('zapisałem');
				location.reload();
			}
		});
		}
    });
    //called when save service to database icon is clicked on the front
	$("body").on('click', '.saveService',function(){
		var singleServiceData = {
			'serviceName' : $(this).siblings(".serviceName").val(),
			'serviceTime' : $(this).siblings(".serviceTime").val(),
			'serviceColor' : $(this).siblings(".serviceColor").val(),
			'serviceId' : $(this).attr("id")
		};
		$.ajax({
			url : databaseQueryPath,
			type : "POST",
			data : {
				'task' : 'saveSingleService',
				'singleServiceData' : singleServiceData
			},
			success : alert("zapisano zmiany")
		});
	});

	$("body").on('click', '.deleteService', function(){
		var serviceId = $(this).attr('id');
		var serviceName = $(this).siblings(".serviceName").val();
    $('<div></div>').appendTo('body')
        .html('<div><h6>'+serviceName+'</h6></div>')
        .dialog({
		dialogClass : 'deleteServiceDialog',
        modal: true,
        opacity: 5.5,
        title: 'Czy usunąć usługę?',
        autoOpen: true,
        width: 'auto',
        resizable: false,
        buttons: {
            Tak: function () {
                $.ajax({
					url :databaseQueryPath,
					data : {
						'serviceId' : serviceId,
						'task' : 'deleteService'
					},
					type : "POST",
					success : function(){
						alert("job well done!");
						location.reload();
					}
				});
                $(this).dialog("close");
            },
            Nie: function () {
                $(this).dialog("close");
            }
        },
        close: function (event, ui) {
            $(this).remove();
        }
    });
    

		});
});
$(function () {
    $("#sortable").sortable({
        update: function (event, ui) {
			var sortables = [];
            var order = $(this).sortable('toArray');
			$(".serviceHolder").each(function(){
				var data = {
					"id" : $(this).attr("id"),
					"name" : $(this).find("input.serviceName").val(),
					"time" : $(this).find("input.serviceTime").val(),
					"color" : $(this).find("input.serviceColor").val(),
					"index" : order.indexOf($(this).attr("id"))				
				};
				sortables.push(data);
				
			});
			console.log(sortables);
			$.ajax({
				data: { 'saveServicesData' : sortables,
						'task' : 'saveServices'
					},
				type: 'POST',
                url: databaseQueryPath
           }); 
        }
    }).disableSelection();
});
