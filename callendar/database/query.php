<?php
//here we execute deletes, updates, inserts comming from ajax
//selects are executed from standalone scripts as they need to echo json to a url
include_once("connection.php");
$query = '';
if($_POST) {
$task = $_POST['task'];
$dbtable = $_POST['dbtable'];
$sliderData = $_POST['sliderData'];
$timePoint = $_POST['timePoint'];
$serviceName = $_POST['serviceName'];
$serviceTime = $_POST['serviceTime'];
$serviceColor = $_POST['serviceColor'];
$serviceId = $_POST['serviceId'];
$serviceIndex = $_POST['serviceIndex'];
$openStart = $_POST['openStart'];
$openEnd = $_POST['openEnd'];
$openDay = $_POST['openDay'];
$eventId = $_POST['eventId'];
$eventTitle = $_POST['eventTitle'];
$eventStart = $_POST['eventStart'];
$eventEnd = $_POST['eventEnd'];
}




?>
