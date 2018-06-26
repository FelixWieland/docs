<?php
if(!isset($_SESSION)){session_start();}

require_once $_SERVER['DOCUMENT_ROOT'].'/docs/sql/connector.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/docs/utility/functions.php';

//Handles all content actions - CREATE UPDATE DELETE
$conn = connect_to_db();

if(!isset($_SESSION["username"])) {
	exit;
}

$topic = $_POST["topic"];
$parent = $_POST["parent"];
$pid = $_POST["pid"];
$name = $_POST["content"];
$header = $_POST["header"];
$description = $_POST["description"];
$username = $_SESSION["username"];

$sql = "INSERT INTO contents (id, pid, name, topic, parent, header, description, type, username) VALUES (null, '$pid', '$name', '$topic', '$parent', '$header', '$description', '$type', 'username');";
$res = $conn->query($sql);

if($res) {
	echo "%CREATED_CONTENT%";
}
 ?>
