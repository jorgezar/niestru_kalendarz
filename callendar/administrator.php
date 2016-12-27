<!DOCTYPE HTML>
<html lang="pl-PL">
<meta Content-Type= 'text/html' charset='utf-8'>
<?php 
error_reporting(E_ALL);
?>
<head>
<link rel='stylesheet' href='callendar/css/administrator.css' />
<script src='callendar/js/openhours.js'></script>
<script src='callendar/js/addService.js'></script>
<script src='callendar/js/touch-admin.min.js'></script>
<script src='callendar/js/jquery.validate.js'></script>
<script src='callendar/js/range.js'></script>

<meta name=viewport content="width=device-width, initial-scale=1">

</head>

<body>

<div class="admincallendar">

<!-- WYBÓR JĘZYKA -->
<!--
<h3>Wybierz język:</h3>

<select id="locale-selector">
<option value="en">en</option>
<option value="pl">pl</option>

</select>
-->
<hr /><!-- GODZINY  OTWARCIA-->
<h3>Wybierz godziny otwarcia:</h3>
<div id='selectRangeDay'></div>
<div id='saveDataButton'><button>zapisz zmiany</button></div>
  <br style="clear:both">


<hr />

<!-- DODAJ NAZWĘ USŁUGI I JEJ CZAS -->



<h3>Usługi:</h3>

  <div class="EditService">
				<div class="input_fields_wrap" id="sortable"></div>
  </div>

  <div class="AddNewService">
	<p>Dodaj usługę, ustaw jej czas oraz wybierz kolor:</p>
		<form id="addServiceForm" >
			<input type="text" id="serviceName" name="serviceName" placeholder="Nazwa usługi"> 
			<input type="text" id="serviceTime" name="serviceTime" placeholder="Czas w min."> 
			<input type="color" id="serviceColor" name="serviceColor"> 
		</form>

		<button class="add_field_button">Dodaj usługę</button>
	</div>	

<hr />

<!-- Podstawowe pole tekstowe -->

<h3>Wybierz podział minutowy kalendarza</h3>

<script type="text/javascript">
//<![CDATA[
$(document).ready(function () {
    $(':radio').change(function () {
        $(':radio[name=' + this.name + ']').parent().removeClass('inputchecked');
        $(this).parent().addClass('inputchecked');
    });
	$(".rangeRadio").click(function() {        
		console.log('ID : ' + $(this).prop('id'));
		console.log('Value : ' + $(this).prop('value'));
});
});  
//]]>
</script>


<div class="radiominutes">
 <form id='timeRange' class='timeRange'>
		<div><input type="radio" class = 'rangeRadio' name='timeRange' id='5' value='5'><label for="5"><br> 5 minut</label></div>
		<div><input type='radio' class = 'rangeRadio' name='timeRange' id='10' value='10'><label for="5"><br> 10 minut</label></div>
		<div><input type='radio' class = 'rangeRadio' name='timeRange' id='15' value='15'><label for="5"><br> 15 minut</label></div>
		<div><input type='radio' class = 'rangeRadio' name='timeRange' id='20' value='20'><label for="5"><br> 20 minut</label></div>
		<div><input type='radio' class = 'rangeRadio' name='timeRange' id='30' value='30'><label for="5"><br> 30 minut</label></div>
		<div><input type='radio' class = 'rangeRadio' name='timeRange' id='45' value='45'><label for="5"><br> 45 minut</label></div>
		<div><input type='radio' class = 'rangeRadio' name='timeRange' id='60' value='60'><label for="5"><br> 60 minut</label></div>
		<div><input type='radio' class = 'rangeRadio' name='timeRange' id='90' value='90'><label for="5"><br> 90 minut</label></div>
 </form> 
<rm /> 

</div>

<hr />


<!-- SMS -->
<h3>Wyślij SMS z przypomnieniem</h3>

<form action='ttt.php'>
<select name="nazwa" onchange="showSMSOptions(this)">
<option value="1">NIE</option>
<option value="2">TAK</option>
</select></form>
<div id="SMSOptions"></div>
</div>



<hr />

<a id = "closeAdmin" class="closepanelcontent" href="#home"> Zamknij.</a>
<script>
$(document).ready(function(){
	$(".saveService").each(function(){
		$(this).on('click', (function(){
			console.log("change is received");
		}));
	});
});
</script>
</body>