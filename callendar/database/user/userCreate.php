<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once($_SERVER['DOCUMENT_ROOT'] . "/niestru/callendar/database/connection.php");
if(isset($_POST)){
	$username = sanitize($_POST['username']);
	$password = md5($_POST['password']);
	$useremail = sanitize($_POST['useremail']);
	echo $username . $useremail;
	file_put_contents("log.txt", $username.$password.$useremail."\n", FILE_APPEND);
	if (insert_new_user($username, $password, $useremail) != 0){
		echo "Proszę czekać na email z linkiem aktywacyjnym";
	} else {
		echo "Nie udało się utworzyć użytkownika";
	}
}
//
//var_dump(get_required_files());
function insert_new_user($username, $password, $useremail){
	$query = "insert into users (`username`,`useremail`,`userpassword`,`user_level`) values ('$username','$useremail','$password', '0')";
	if(send_activation_email($username, $useremail)){
		file_put_contents("log.txt", "mama, just sent a mail: ".$username.$useremail." \n", FILE_APPEND);
	}
	file_put_contents("log.txt", $query."\n", FILE_APPEND);
	db_query($query);
	return mysqli_affected_rows(db_connect());
}
function send_activation_email($username, $useremail) {
	$activation_string = create_activation_string($username, $useremail);
	$to = $useremail;
	$subject = "Aktywuj swoje konto";
	$url = "http://easypack1.hekko24.pl/niestru/account/activate.php?user=" . $useremail . "&data=" . $activation_string;
	$message = "Wejdź pod ten adres aby aktywować swoje konto: \n " . $url;
	$header = "from: rezerwacje.pl";
	if(mail($to, $subject, $message, $header)){
		return true;
	} else {
		return false;
	}
}
/*
if($_POST){
	insert_new_user($username,$password,$useremail);
}
if($_POST){
	$string = $username ."acasacasc". $password;	
}
*/
//file_put_contents("log.txt", $username."\n", FILE_APPEND);

//mail($to, $subject, $message, $header);
?>

