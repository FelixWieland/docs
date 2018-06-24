<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/docs/layout/layouts.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/docs/sql/connector.php';

header('Content-Type: text/html; charset=UTF-8');

$conn = connect_to_db();

 ?>
<!DOCTYPE html>
<html>
<?php
	create_header();
 ?>
  <body>
		<?php

			//$row = $conn->query("SELECT * FROM topics WHERE topic = ")

			$title = $_GET["topic"];
			if($_GET["parent"] != "-"){
				$title = $_GET["parent"];
			}

			$parent = $_GET["parent"];
			$topic = $_GET["topic"];

			create_layout($title, "content");

			$sql = "SELECT * FROM contents WHERE topic = '$topic' AND name = '$parent';";
			$res = $conn->query($sql);
			$row = $res->fetch_assoc();
		 ?>
		 <?php if (mysqli_num_rows($res) != 0): ?>
			 <div class="container well">
  			 <h1><?php echo $row["header"]; ?></h1>
  			 <p class="_description_content">
  				 <?php echo $row["description"]; ?>
  			 </p>
  			 </div>
  			<div class="container-fluid well _parallax-wrapper _parallax-background-05"></div>
		 <?php endif; ?>

		<div class="container well">

			<?php
				//create_contents_for();
				if($title != "-"){

				}
				read_contents($conn, $_GET["topic"], $_GET["parent"]);
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
