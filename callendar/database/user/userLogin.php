<?php
$username = $_POST['username'];
$password = $_POST['password'];

function create_new_user($username, $password, $useremail){
	$connection = db_connect();
	$username = sanitize($username);
	$useremail = sanitize($useremail);
	$password = md5($password);
	$query = "insert into `users` ('username', 'password', 'useremail') values ('$username','$password','$useremail')";
	return $query;
}
function delete_user($username, $password){
	
}
function change_user_password($username, $oldpassword, $newpassword){
	
}

if($_POST){
	$string = "$username , $password";
	file_put_contents("log.txt", $string)
}
?>