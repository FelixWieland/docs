<?php
if(!isset($_SESSION)){session_start();}

require_once $_SERVER['DOCUMENT_ROOT'].'/docs/sql/connector.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/docs/utility/functions.php';

//Handles all doc actions - CREATE UPDATE DELETE

$conn = connect_to_db();

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

/*
header = {
	parent: isEmpty_1,
	title: isEmpty_2,
	description: isEmpty_3
};
*/

$parent = $header["parent"];
$title = $header["title"];
$description = $header["description"];


$doc_exits = check_if_doc_exits($conn, $parent, $title);

if($doc_exits){
	//Handle doc exits
	$own_doc = check_if_own_doc($conn, $parent, $title, $username);

	if($own_doc) {
		//Own doc
		// -> DELETE DOC THEN INSERT NEW
		$sql = "UPDATE docs_by_creator SET lastchange_dat=current_date() WHERE parent='$parent' AND title='$title' AND username='$username';";
		$res = $conn->query($sql);

		$sql = "DELETE FROM docs WHERE title='$title' AND parent='$parent';";
		$res = $conn->query($sql);

		insert_doc($conn, $title, $parent, $content);
		echo "%UPDATED_DOC%";

	} else {
		//Handle not own doc
		// NO SQL
	}
} else {
	//insert doc
	//INSERT IN DOC CREATION AND IN DOC

	$sql = "INSERT INTO docs_by_creator (id, username, parent, title, description, creation_dat, lastchange_dat) VALUES (null, '$username', '$parent', '$title', '$description', current_date(), current_date());";
	$res = $conn->query($sql);

	insert_doc($conn, $title, $parent, $content);
	echo "%CREATED_DOC%";
}


function insert_doc($conn, $title, $parent, $content)
{
	foreach ($content as $row) {
		$text = $row["value"];
		$type = $row["type"];
		$sql = "INSERT INTO docs (id, title, parent, type, text) VALUES (null, '$title', '$parent', '$type', '$text');";
		$res = $conn->query($sql);
	}
}


 ?>
