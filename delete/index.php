<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/docs/layout/layouts.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/docs/sql/connector.php';

$conn = connect_to_db();

if(!isset($_SESSION["username"])) {
	header("Location: /docs/");
}

try {
	$title = $_GET["title"];
	$parent = $_GET["parent"];
	$pid = $_GET["pid"];
	$username = $_SESSION["username"];
} catch (\Exception $e) {}

if(isset($_POST["title"]) && isset($_POST["parent"]) && isset($_POST["pid"])) {
	$title = $_POST["title"];
	$parent = $_POST["parent"];
	$pid = $_POST["pid"];
	$username = $_SESSION["username"];
} else if(!isset($_GET["title"])){
	header("Location: /docs/");
}


$sql = "SELECT * FROM docs_by_creator WHERE title = '$title' AND parent = '$parent' AND pid = '$pid' AND username = '$username'";
$res = $conn->query($sql);
if(mysqli_num_rows($res) == 0) {
	header("Location: /docs/");
} else {
	if(isset($_POST["title"]) && isset($_POST["parent"]) && isset($_POST["pid"])) {

		$sql = "DELETE FROM docs_by_creator WHERE title = '$title' AND parent = '$parent' AND pid = '$pid' AND username = '$username'";
		$res = $conn->query($sql);
		$sql = "DELETE FROM docs WHERE title = '$title' AND parent = '$parent' AND pid = '$pid'";
		$res = $conn->query($sql);

		header("Location: /docs/profile/");
	}
}
?>
<!DOCTYPE html>
<html>
<?php
	create_header("docs - Create stuff");
 ?>
  <body>
		<?php
			create_layout("delete.doc", "content", "-", "do you really want to delete the doc?", "no");
		 ?>
		 <?php if (mysqli_num_rows($res) != 0): ?>

			 <div class="container">
				 <div class="row _create_choose">
					 <form action="/docs/delete/" method="post">
						 <div class="col-sm-12 col-md-6 col-lg-6">
							 <input hidden type="text" name="title" value="<?php echo $title; ?>">
							 <input hidden type="text" name="parent" value="<?php echo $parent; ?>">
							 <input hidden type="text" name="pid" value="<?php echo $pid; ?>">
							 <input type="submit" value="yes">
						 </div>
					 </form>
						<form action="/docs/profile/">
						 <div class="col-sm-12 col-md-6 col-lg-6">
							 <input type="submit" value="no">
						 </div>
				 	</form>
				 </div>
			 </div>
		 <?php endif; ?>
	</body>
	<?php
		create_scripts();
	 ?>
</html>
