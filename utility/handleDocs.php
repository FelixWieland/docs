<?php
if(!isset($_SESSION)){session_start();}

require_once $_SERVER['DOCUMENT_ROOT'].'/docs/sql/connector.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/docs/utility/functions.php';

//Handles all doc actions - CREATE UPDATE DELETE // -> DELETE not YET
$conn = connect_to_db();

if(!isset($_SESSION["username"])) {
	exit;
}

$header = false;
$content = false;
$description = false;
$username = $_SESSION['username'];

if(isset($_POST["header"]) && isset($_POST["content"])){
	$header = $_POST["header"];
	$content = $_POST["content"];
} else {
	exit;
}

//First: Check if doc exits

$parent = $header["parent"];
$title = $header["title"];
$description = $header["description"];
$pid = $header["pid"];


$doc_exits = check_if_doc_exits($conn, $parent, $title);

if($doc_exits) {
	//Handle doc exits
	$own_doc = check_if_own_doc($conn, $parent, $title, $username);

	if($own_doc) {
		//Own doc
		// -> DELETE DOC THEN INSERT NEW
		$sql = "UPDATE docs_by_creator SET lastchange_dat=current_date() WHERE pid='$pid' AND parent='$parent' AND title='$title' AND username='$username';";
		$res = $conn->query($sql);

		$sql = "DELETE FROM docs WHERE title='$title' AND parent='$parent';";
		$res = $conn->query($sql);

		insert_doc($conn, $title, $parent, $content, $pid);
		echo "%UPDATED_DOC%";

	} else {
		//Handle not own doc
		// NO SQL
	}
} else {
	//insert doc
	//INSERT IN DOC CREATION AND IN DOC

	$sql = "INSERT INTO docs_by_creator (id, pid, username, parent, title, description, creation_dat, lastchange_dat) VALUES (null, '$pid', '$username', '$parent', '$title', '$description', current_date(), current_date());";
	$res = $conn->query($sql);

	insert_doc($conn, $title, $parent, $content, $pid);
	echo "%CREATED_DOC%";
}


function insert_doc($conn, $title, $parent, $content, $pid)
{
	foreach ($content as $row) {
		$text = $row["value"];
		$type = $row["type"];
		$sql = "INSERT INTO docs (id, pid, title, parent, type, text) VALUES (null, '$pid', '$title', '$parent', '$type', '$text');";
		$res = $conn->query($sql);
	}
}


 ?>
