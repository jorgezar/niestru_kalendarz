<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once($_SERVER['DOCUMENT_ROOT'] . "/niestru/callendar/lib/mailer/PHPMailerAutoload.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/niestru/callendar/database/connection.php");
if(isset($_POST)){
	$timestamp = date_timestamp_get(date_create());
	$usertelephone = $_POST['usertelephone'];
	$username = sanitize($_POST['username']);
	$password = md5($_POST['password']);
	$useremail = sanitize($_POST['useremail']);
	file_put_contents("log.txt", $username.$password.$useremail."\n", FILE_APPEND);
	if (insert_new_user($username, $password, $useremail, $usertelephone, $timestamp) != 0){
		echo "Proszę czekać na email z linkiem aktywacyjnym";
	} else {
		echo "Nie udało się utworzyć użytkownika";
	}
}
//
//var_dump(get_required_files());
function insert_new_user($username, $password, $useremail, $usertelephone, $timestamp){
	$query = "insert into users (`username`,`useremail`,`userpassword`,`user_level`,`user_telephone`, `register_date`) values ('$username','$useremail','$password', '0', '$usertelephone','$timestamp')";
	if(send_activation_email($username, $useremail)){
		file_put_contents("log.txt", "mama, just sent a mail: ".$username.$useremail." \n", FILE_APPEND);
	}
	file_put_contents("log.txt", $query."\n", FILE_APPEND);
	db_query($query);
	return mysqli_affected_rows(db_connect());
}
function send_activation_email($username, $useremail) {
	$activation_string = create_activation_string($username, $useremail);
	$url = "http://easypack1.hekko24.pl/niestru/account/activate.php?user=" . $useremail . "&data=" . $activation_string;
	$message = "Witaj, " . $username . "! Wejdź pod ten adres aby aktywować swoje konto: \n " . $url;
	$mail = new PHPMailer;
	$mail->Host = "mail.easypack1.hekko24.pl";
	$mail->SMTPAuth = true;
	$mail->Username = 'testuser1@easypack1.hekko24.pl';
	$mail->Password = 'qwerty';
	$mail->SMTPSecure = 'tls';
	$mail->Port = 25;
	$mail->setFrom('testuser1@easypack1.hekko24.pl', 'Author');
	$mail->addAddress($useremail);     // Add a recipient
	
	$mail->isHTML(true);
	$mail->Subject = "Aktywuj swoje konto";
	$mail->Body    = $message;
	if(!$mail->send()) {
		echo 'Nie udało się wysłać wiadomości.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Wysłano wiadomość. ';
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

