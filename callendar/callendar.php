<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />

<link rel='stylesheet' href='callendar/css/fullcalendar.css' />
<link rel='stylesheet' href='callendar/css/panel.css' />
<link href="css/font-awesome.css" rel="stylesheet">
<link href='callendar/lib/cupertino/jquery-ui.min.css' rel='stylesheet' />
<script src='callendar/lib/moment.min.js'></script>
<script src='callendar/lib/jquery.min.js'></script>
<script src='callendar/fullcalendar/fullcalendar.min.js'></script>
<script src='callendar/locale/pl.js'></script>
<script src='callendar/lib/jquery-ui.js'></script>
<script src='callendar/locale/pl.js'></script>
<script src='callendar/js/touch.min.js'></script>
<meta name=viewport content="width=device-width, initial-scale=1">
<script src = "callendar/fullcalendar/calendarMainFunction.js"></script>

</head>

<div id='panelcalendar'>

<!-- Home Panel  -->
<div class="panel" id="home">
    <div id="particles"></div>
</div>

<div class="panel" id="slice">
    <div class="panel-content">
       <?php include('administrator.php'); ?>						
    </div>
</div>

<!-- Navigation -->
<div class="menu">
  <a class="menu__link" href="#slice" data-hover="Slice">Administrator</a>
	
</div>

	<div id="eventContent" title="Event Details" style="display:none;">
	Początek: <span id="startTime"></span><br>
    Koniec: <span id="endTime"></span><br><br>
    <p id="eventInfo"></p>
 </div>
	<div id="eventDialog" title="eventDialogForm" style="display:none;">
		<form action='' method='post'>
			<label>Imię klienta:</label>
			<input type='text' id='clientName' name='clientName'><br>
			<label>Telefon:</label>
			<input type='text' id='clientTelephone' name='clientTelephone'><br>
			<div id='eventStart'></div>
			<div id='eventEnd'></div>
			<span id='serviceTimeCounter'></span>
			<div id='services'></div>
		</form>
	</div>
	<div id='calendar'></div>
</body>
</html>