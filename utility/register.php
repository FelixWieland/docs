<?php
if(!isset($_SESSION)){session_start();}

require_once $_SERVER['DOCUMENT_ROOT'].'/docs/sql/connector.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/docs/utility/functions.php';
//Register a User in the Database

$conn = connect_to_db();

$email = $_POST["email"];
$password = $_POST["password"];
$username = $_POST["username"];
$url = $_POST["url"];

$salt = generate_salt();
$hash = crypt($password, $salt);;

if(check_email($email)){
	if(check_if_username_exits($conn, $username)){
		if(check_if_email_exits($conn, $email)){
			if(register($conn, $email, $hash, $salt, $username)) {
				echo "%REGISTERED%";
				set_loggedin($username, $email, "1");
			} else {
				echo "%REGISTERFAILED%";
			}
		} else {
			echo "%EMAILEXISTS%";
		}
	} else {
		echo "%USERNAMEEXISTS%";
	}
} else {
	echo "%NOVALIDMAIL%";
}

 ?>
