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
 ?>
<!DOCTYPE html>
<html>
<?php
	create_header("docs - Create stuff");
 ?>
  <body>
		<?php
			create_layout("create.doc", "content", "-", "create a documentation", "no");
			if(isset($_GET["parent"]) && isset($_GET["type"]) && isset($_GET["title"])) {
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
					}
				}
			} else if (isset($_GET["parent"]) && isset($_GET["type"]) && isset($_GET["topic"])) {
				if($_GET["type"] == "set") {
					$parent = $_GET["parent"];
					$topic = $_GET["topic"];
					$edit = "doc";
				}
			}

			if($edit == "create") {
				$sql = "SELECT * FROM docs WHERE title = '$title' AND parent = '$parent';";
				$res = $conn->query($sql);
				$rest = build_updatedoc($res);
				create_createdoc($parent, $title, $description, $rest);
			} else if($edit != "doc") {
				create_createchooser();
				create_createcontent();
				create_createdoc();
			} else {
				create_createchooser();
				create_createcontent($topic, $parent);
				create_createdoc($parent, $title, $description, "", "set");
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
