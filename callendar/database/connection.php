<?php
error_reporting(E_ALL);
function db_connect() {
	static $connection;
	$includepath = '/var/www/include/config.ini';
	if(!isset($connection)){
		$config = parse_ini_file($includepath);
		$connection = mysqli_connect('localhost', $config['username'], $config['password'],$config['dbname']);
	}
	if(!$connection){
		echo "failed connecting to database";
	}
	return $connection;
}
function db_query($query){
	$connection = db_connect();
	$result = mysqli_query($connection, $query);
	return $result;
}
function db_error() {
    $connection = db_connect();
    return mysqli_error($connection);
}
function sanitize($input){
	$connection = db_connect();
	return mysqli_real_escape_string($connection, $input);
}
function redirect_user_politely(){
	echo "<div class='userRedirect'><a href='http://easypack1.hekko24.pl/niestru'>Powrót na główną</a></div>";
}
function create_activation_string($username,$useremail){
	return md5($useremail . $username . "secret_ingredient");
		
}
function write_to_log($data){
	file_put_contents("log.txt", $data."\n", FILE_APPEND);
}
?>
