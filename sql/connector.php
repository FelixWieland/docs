<?php
function connect_to_db()
{
	$conn = false;
	try {
		$conn = mysqli_connect("localhost", "root", "", "docs");
	} catch (\Exception $e) {
		$conn = mysqli_connect("db743985497.db.1and1.com", "dbo743985497", "docs%9919.PLACE", "db743985497");
	}
	if($conn == false){
		$conn = mysqli_connect("db743985497.db.1and1.com", "dbo743985497", "docs%9919.PLACE", "db743985497");
	}
	return $conn;

}
//db743985497
 ?>
