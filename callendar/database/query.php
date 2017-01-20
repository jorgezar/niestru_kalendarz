<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
/* general script for performing queries to database
here we execute deletes, updates, inserts comming from ajax
selects are executed from standalone scripts as they need to echo json to a url
*/
include_once("connection.php");
if(isset($_POST['saveServicesData']) && $_POST['task'] == 'saveServices'){
	if(save_services_order($_POST['saveServicesData']) > 0){
		echo "zapisano zmiany usług w bazie danych";
	} else {
		echo "coś poszło nie tak podczas zapisu usług w bazie danych";
	}
}
if(isset($_POST['newServiceData']) && $_POST['task'] == 'addService'){
	add_service($_POST['newServiceData']);
}
if(isset($_POST['singleServiceData']) && $_POST['task']=='saveSingleService'){
	save_single_service($_POST['singleServiceData']);
}
if(isset($_POST['serviceId']) && $_POST['task'] == 'deleteService'){
	delete_service($_POST['serviceId']);
}
if(isset($_POST['updateHoursData']) && $_POST['task'] == 'updateWorkingHours'){
	updateWorkingHours($_POST['updateHoursData']);
}
if(isset($_POST['timePoint']) && $_POST['task'] == 'updateTimeRange'){
	updateTimeRange($_POST['timePoint']);
}
if(isset($_POST['eventData']) && $_POST['task'] == 'addNewEvent'){
	addNewEvent($_POST['eventData']);
}
if(isset($_POST['id']) && $_POST['task'] == 'deleteEvent'){
	deleteEvent($_POST['id']);
}
function deleteEvent($id){
	$id = sanitize($id);
	$sql = "DELETE FROM evenement WHERE id='$id'";
	db_query($sql);
}
function addNewEvent($data){
	$title = sanitize($data['title']);
	$start = sanitize($data['start']);
	$end = sanitize($data['end']);
	$telephone = sanitize($data['telephone']);
	foreach($data['services'] as $service){
		$service = sanitize($service);
	}
	$services = implode(",", $data['services']);
	$sql = "INSERT INTO `evenement` (`title`, `start`, `end`, `telephone`, `services`) VALUES ('$title', '$start', '$end', '$telephone', '$services')";
	db_query($sql);
}
function updateTimeRange($data){
	$data = sanitize($data);
	$sql = "UPDATE time_range SET range_selected = '$data' WHERE id=1";
	db_query($sql);
}
function updateWorkingHours($data){
	foreach($data as $item){
		$open = $item["isOpen"];
		if($open == 'true'){
			$open = '1';
		} else {
			$open = '0';
		}
		$day = sanitize($item['day']);
		$start = sanitize($item['start']);
		$end = sanitize($item['end']);
		$sql = "UPDATE opening_hours SET start = '$start', end = '$end', open = '$open' WHERE id = '$day'";
		db_query($sql);
	}
}
function delete_service($id){
	$id = sanitize($id);
	$sql = "DELETE FROM services WHERE serviceId='$id'";
	$result = db_query($sql);
	return $result;
}
function save_single_service($data){
	$name = sanitize($data['serviceName']);
	$time = sanitize($data['serviceTime']);
	$color = sanitize($data['serviceColor']);
	$id = sanitize($data['serviceId']);
	$sql = "UPDATE services SET serviceName='$name', serviceTime='$time', serviceColor='$color' WHERE serviceId='$id'";
	$result = db_query($sql);
	return $result;
}
function add_service($data){
	$name = sanitize($data['name']);
	$time = sanitize($data['time']);
	$color = sanitize($data['color']);
	$sql = "INSERT INTO `services` (serviceName, serviceTime, serviceColor) VALUES ('$name','$time','$color');";
	write_to_log($sql);
	$result = db_query($sql);
	if($result){return true;} else {return false;}
}
function save_services_order($data){
//returns the number of affected rows to confirm changes in database
	$affectedRows=0;
	foreach ($data as $item){
		$serviceName  = sanitize($item['name']);
		$serviceTime  = sanitize($item['time']);
		$serviceColor = sanitize($item['color']);
		$serviceOrder = sanitize($item['index']);
		$serviceId    = sanitize($item['id']);
		$sql = "UPDATE services SET serviceName='$serviceName', serviceTime='$serviceTime', serviceColor='$serviceColor', serviceOrder='$serviceOrder' WHERE serviceId='$serviceId'";
		$result = db_query($sql);
		if($result){
			$affectedRows +=1;
			}
	}
	return $affectedRows;
}

?>
