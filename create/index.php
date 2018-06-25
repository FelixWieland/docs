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
						$edit = true;
						$row = $res->fetch_assoc();
						$description = $row["description"];
					}
				}
			}

			if($edit) {
				$sql = "SELECT * FROM docs WHERE title = '$title' AND parent = '$parent';";
				$res = $conn->query($sql);
				$rest = "";

				while($row = $res->fetch_assoc()) {
					$type = $row["type"];
					$text = $row["text"];

					if($type == "header"){
						$pattern = '<div class="row"><div class="col-sd-12 col-md-12 col-lg-12"><div class="_create_pattern"><p>'.$type.'</p><input type="text" name="" value="'.$text.'"><button type="button" name="button" class="_elm_remove">X</button></div></div></div>';
						$rest = $rest.$pattern;

					} else if($type == "linebreak") {
						$pattern = '<div class="row"><div class="col-sd-12 col-md-12 col-lg-12"><div class="_create_pattern _linebreak"><button type="button" name="button" class="_elm_remove">X</button></div></div></div>';
						$rest = $rest.$pattern;

					} else if($type == "text") {
						$pattern = '<div class="row"><div class="col-sd-12 col-md-12 col-lg-12"><div class="_create_pattern"><p>'.$type.'</p><textarea id="demo" rows="8" cols="10" contenteditable="true">'.$text.'</textarea><button type="button" name="button" class="_elm_remove _large_elm_btn">X</button></div></div></div>';
						$rest = $rest.$pattern;

					} else if($type == "download") {
						/*
						var pattern = '<div class="row"><div class="col-sd-12 col-md-12 col-lg-12"><div class="_create_pattern"><p>%MUSTER%</p><textarea id="demo" rows="20" cols="10" contenteditable="true"></textarea><button type="button" name="button" class="_elm_remove _large_elm_btn">X</button></div></div></div>';
						var pattern = pattern.replace("%MUSTER%", type);
						elm.append(pattern);
						*/
					}
					else {
						$languages = array("%MUSTER%", "csharp", "c", "cpp", "rust");

						foreach ($languages as $key => $value) {
							if($value == "%MUSTER%"){
								$languages[$key] = $type;
							} else if($value == $type) {
								$languages[$key] = "Code";
							}
						}

						$dropdown = create_dropdown($languages);
						$pattern = '<div class="row"><div class="col-sd-12 col-md-12 col-lg-12"><div class="_create_pattern">'.$dropdown.'<textarea id="demo" rows="8" cols="10" contenteditable="true">'.$text.'</textarea><button type="button" name="button" class="_elm_remove _large_elm_btn">X</button></div></div></div>';
						$rest = $rest.$pattern;

					}
				}

				create_createdoc($parent, $title, $description, $rest);
			} else {
				create_createchooser();
				create_createcontent();
				create_createdoc();
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
