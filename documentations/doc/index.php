<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/docs/layout/layouts.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/docs/sql/connector.php';

$conn = connect_to_db();

 ?>
<!DOCTYPE html>
<html>
<?php
	create_header();
 ?>
  <body>
		<?php
			$parent = $_GET["parent"];
			$title = $_GET["title"];
			$row = $conn->query("SELECT * FROM docs_by_creator WHERE title = '$title' AND parent = '$parent';")->fetch_assoc();
			create_layout($parent, "content", "-", $row["description"]);
		 ?>
		<div class="container well">
			<?php
				//Build doc
				$sql = "SELECT * FROM docs WHERE title = '$title' AND parent = '$parent';";
				$res = $conn->query($sql);

				$doc_contents = array();
				$rest_contents = array();

				while ($row = $res->fetch_assoc()) {
					if($row["type"] == "header"){
						array_push($doc_contents, $row["text"]);
					}
					array_push($rest_contents, $row);
				}

				create_doc_contents_for($title, $doc_contents);

				foreach ($rest_contents as $row) {
					switch ($row["type"]) {
						case 'header':
							create_doc_header($row["text"]);
							break;
						case 'text':
							create_doc_text($row["text"]);
							break;
						default:
							create_doc_code($row["type"], $row["text"]);
							break;
					}
				}

			 ?>

		</div>
		<?php
			//read_topics($conn);
			//read_contents($conn, "Programming");
			createBottomWRAPPER();
		 ?>

	</body>
	<?php
		create_scripts();
	 ?>
</html>
