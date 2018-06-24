<?php
if(!isset($_SESSION)){session_start();}

require_once $_SERVER['DOCUMENT_ROOT'].'/docs/sql/connector.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/docs/utility/functions.php';
//logs a user in

$conn = connect_to_db();

$email = $_POST["email"];
$password = $_POST["password"];

$ok = login($conn, $email);
if($ok){
	$row = $ok->fetch_assoc();

	$hash = $row["password"];
	$salt = $row["salt"];

	if($hash == crypt($password, $salt)){
		echo "%LOGGEDIN%";

		set_loggedin($row["username"], $email, $row["layer"]);

	}
}



 ?>
