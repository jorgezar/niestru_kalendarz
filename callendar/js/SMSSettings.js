var databaseAccessPath = '195.62.13.113/niestru_kalendarz/callendar/js/';

function showSMSOptions(showHide){
	var html = document.getElementById('SMSOptions');
	var SMSForm = document.createElement('form');
	SMSForm.id = 'SMSForm';
	var formHeader = document.createElement('h3');
	formHeader.innerHTML = 'Kiedy wysłać przypomnienie';
	html.insertBefore(formHeader, html.childNodes[0]);
	var checkboxContainer = document.createElement('div');
	
	$.getJSON(databaseAccessPath+'SMSOptions.json', function(data){
		for (i in data){
			var $checkbox = $(document.createElement('input')).attr({
			id : 'checkbox'+(parseInt(i)+1),
			value : data[i].value,
			type : 'checkbox',
			name : data[i].value,
			text : data[i].value
		})
		$(checkboxContainer).append($checkbox).append('<label for="'+ data[i].value+'">'+data[i].value+'</label></br>');
	}});
	SMSForm.append(checkboxContainer);
	$('<h3/>', {
		'id' : 'SMSInfo',
		'class' : 'SMSInfo',
		'text' : 'Podaj tekst przypomnienia'
	}).appendTo(SMSForm);
	$('<input/>', {
		'class' : 'SMSTextbox',
		'type' : 'textarea',
		'id' : 'SMSTextbox',
		'placeholder' : 'tutaj pisać...'
	}).appendTo(SMSForm);
	if(showHide.value == 1) html.innerHTML = '';
	if(showHide.value == 2) {
		html.append(SMSForm);
		console.log(SMSForm);
	}	
}
