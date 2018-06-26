<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/docs/layout/layouts.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/docs/sql/connector.php';

$conn = connect_to_db();

if(!isset($_SESSION["username"])) {
	exit;
}

 ?>
<!DOCTYPE html>
<html>
<?php
	create_header("docs - API");
 ?>
  <body>
		<?php
			$username = $_SESSION["username"];
			create_layout("API.doc", "content", "-", "Just a API", "no");
		 ?>
		 <div class="container well">
       
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
