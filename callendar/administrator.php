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

<meta name=viewport content="width=device-width, initial-scale=1">

</head>

<body>

<div class="admincallendar">

<!-- WYBÓR JĘZYKA -->

<h3>Wybierz język:</h3>

<select id="locale-selector">
<option value="en">en</option>
<option value="pl">pl</option>

</select>

<hr />

<!-- GODZINY  OTWARCIA-->

<h3>Wybierz godziny otwarcia:</h3>

<div class= "selectRangeDay">
 <div class="range-day" id="range-day-1" data-day="1">
    <input type="checkbox" name="day1" id="day1" class="range-checkbox">
    <label for="day1" class="range-label">Poniedziałek:</label>
    <div id="range-slider-1" class="range-slider"></div>
    <span id="range-time-1" class="range-time"></span>
  </div>
  
  <div class="range-day" id="range-day-2" data-day="2">
    <input type="checkbox" name="day2" id="day2" class="range-checkbox" >
    <label for="day2" class="range-label">Wtorek:</label>
    <div id="range-slider-2" class="range-slider"></div>
    <span id="range-time-2" class="range-time"></span>
  </div>
  
  
  <div class="range-day" id="range-day-3" data-day="3">
    <input type="checkbox" name="day3" id="day3" class="range-checkbox" >
    <label for="day3" class="range-label">Środa:</label>  
    <div id="range-slider-3" class="range-slider"></div>
    <span id="range-time-3" class="range-time"></span>
  </div>
  
  <div class="range-day" id="range-day-4" data-day="4">
    <input type="checkbox" name="day4" id="day4" class="range-checkbox" >
    <label for="day4" class="range-label">Czwartek:</label>  
    <div id="range-slider-4" class="range-slider"></div>
    <span id="range-time-4" class="range-time"></span>
  </div>
  
  <div class="range-day" id="range-day-5" data-day="5">
    <input type="checkbox" name="day5" id="day5" class="range-checkbox" >
    <label for="day5" class="range-label">Piątek:</label>  
    <div id="range-slider-5" class="range-slider"></div>
    <span id="range-time-5" class="range-time"></span>
  </div>
  
  <div class="range-day" id="range-day-6" data-day="6">
    <input type="checkbox" name="day6" id="day6" class="range-checkbox" >
    <label for="day6" class="range-label">Sobota:</label>  
    <div id="range-slider-6" class="range-slider"></div>
    <span id="range-time-6" class="range-time"></span>
  </div>
  
  <div class="range-day" id="range-day-7" data-day="7">
    <input type="checkbox" name="day7" id="day7" class="range-checkbox">
    <label for="day7" class="range-label">Niedziela:</label>  
    <div id="range-slider-7" class="range-slider"></div>
    <span id="range-time-7" class="range-time"></span>
  </div>
</div>	
  
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