<?php
function connect_to_db()
{
	$conn = false;
	try {
		$conn = mysqli_connect();
	} catch (\Exception $e) {
		$conn = mysqli_connect();
	}
	if($conn == false){
		$conn = mysqli_connect();
	}
	return $conn;

}
 ?>
