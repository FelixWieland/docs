<?php
if(!isset($_SESSION)){session_start();}

require_once $_SERVER['DOCUMENT_ROOT'].'/docs/sql/connector.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/docs/utility/functions.php';

$conn = connect_to_db();

//Handles all search requests

$search = $_POST["search"];
$topic = "";
$id = "";

if(isset($_POST["topic"])){
	$topic = $_POST["topic"];
}
if(isset($_POST["id"])) {
	$id = $_POST["id"];
}

$ids = array();

$sql = "SELECT id, pid FROM contents WHERE topic LIKE '%$topic%' AND id > $id AND name LIKE '%$search%'";
$res = $conn->query($sql);
while($row = $res->fetch_assoc()) {
	array_push($ids, $row["id"]);
	echo $row["id"];
	echo $row["pid"];
}

try {
	$s_ids = join("','", $ids);
	$sql = "SELECT * FROM docs_by_creator WHERE pid IN ('$s_ids')'";
	$res = $conn->query($sql);
	while($row = $res->fetch_assoc()) {
		echo $row["id"];
	}
} catch (\Exception $e) {

}


 ?>
