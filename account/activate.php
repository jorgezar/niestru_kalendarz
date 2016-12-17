<?php
include_once("../callendar/database/connection.php");
if($_GET){
	 //echo sanitize($_GET['hello']);
	 $user = sanitize($_GET['user']);
	 $secret = sanitize($_GET['data']);
	 $user_level = get_user_level($user);
	 if($user_level != 0 || empty($secret)){
		 redirect_user_politely();
	 } else {
		 activate_user($user, $secret);
	 }
}

function get_user_level($useremail){
	$query = "select `user_level` from `users` where `useremail` = '$useremail'";
	$result = db_query($query);
	$data = mysqli_fetch_assoc($result);
	return $data['user_level'];
}
function activate_user($user, $data){
	$query1 = "select * from `users` where `useremail` = '$user'";
	$result = db_query($query1);
	$user_data = mysqli_fetch_assoc($result);
	if (create_activation_string($user_data['username'],$user_data['useremail']) == $data) {
		$query2 = "update `users` set `user_level` = '1' where `useremail` = '$user'";
		//echo $query2;
		$connection = db_connect();
		$result = db_query($query2);
		if(mysqli_affected_rows(db_connect()) != 0){
			echo "konto dla $user zostało aktywowane, możesz się zlogować";
			redirect_user_politely();
		} else {
			echo "nie udało się aktywować $user";
			redirect_user_politely();
		}
	} else {
		//invalid data, retrn error
		echo "Nie udało się aktywować uźytkownika, błędne dane";
		redirect_user_politely();
	}
	
}

file_put_contents("log.txt", $username."\n", FILE_APPEND);
?>
