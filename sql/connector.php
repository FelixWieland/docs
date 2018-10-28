<?php
function connect_to_db()
{
	$conn = false;
	try {
		//db743985497
		$conn = mysqli_connect("localhost", "root", "root", "db743985497", 8889);
	} catch (\Exception $e) {
		//$conn = mysqli_connect();
		echo $e;
	}
	return $conn;
}
 ?>
