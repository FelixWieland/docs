<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/docs/layout/layouts.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/docs/sql/connector.php';

$conn = connect_to_db();

if(!isset($_SESSION["username"])) {
	exit;
}

$username = $_SESSION["username"];
$edit = false;
$description = "";
$parent = "";
$title = "";
$pid = "";
 ?>
<!DOCTYPE html>
<html>
<?php
	create_header("docs - Create stuff");
 ?>
  <body>
		<?php
			create_layout("create.doc", "content", "-", "create a documentation", "no");
			if(isset($_GET["parent"]) && isset($_GET["type"]) && isset($_GET["title"]) && isset($_GET["pid"])) {
				if($_GET["type"] == "content") {
					$title = $_GET['title'];
					$parent = $_GET['parent'];
					$sql = "SELECT * FROM docs_by_creator WHERE username = '$username' AND parent = '$parent' AND title = '$title'";
					$res = $conn->query($sql);
					if(mysqli_num_rows($res) != 0){
						//set editing var
						$edit = "create";
						$row = $res->fetch_assoc();
						$description = $row["description"];
						$pid = $_GET["pid"];
					}
				}
			} else if (isset($_GET["parent"]) && isset($_GET["type"]) && isset($_GET["topic"]) && isset($_GET["pid"])) {
				if($_GET["type"] == "set") {
					$parent = $_GET["parent"];
					$topic = $_GET["topic"];
					$edit = "doc";
					$pid = $_GET["pid"];
				}
			}

			if($edit == "create") {
				$sql = "SELECT * FROM docs WHERE title = '$title' AND parent = '$parent';";
				$res = $conn->query($sql);
				$rest = build_updatedoc($res);
				create_createdoc($parent, $title, $description, $pid, $rest);
			} else if($edit != "doc") {
				create_createchooser();
				create_createcontent();
				create_createdoc();
			} else {
				create_createchooser();
				create_createcontent($topic, $parent, $pid);
				create_createdoc($parent, $title, $description, $pid, "", "set");
			}

			//read_topics($conn);
			//read_contents($conn, "Programming");
			createBottomWRAPPER();

		 ?>
	</body>
	<?php
		create_scripts();
	 ?>
</html>
