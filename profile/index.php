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
	create_header("docs - Profile");
 ?>
  <body>
		<?php
			$username = $_SESSION["username"];

			create_layout("profile.doc", "content", "-", "See your Profile", "no");

			$sql = "SELECT count(*) as total from docs_by_creator WHERE username = '$username';";
			$res = $conn->query($sql)->fetch_assoc();
		 ?>
		 <div class="container well">
			 <div class="row _bg_main_rust">
				 <div class="col-sd-12 col-md-12 col-lg-12 _profile_username">
					 <?php echo $username; ?>
				 </div>
				 <div class="col-sd-3 col-md-3 col-lg-3 _profile_avatar">
					 <img src="/docs/media/avatar/default.png" alt="avatar">
				 </div>
				 <div class="col-sd-9 col-md-9 col-lg-9 _profile_infos">
					 <ul>
					 	<li>You created <?php echo $res["total"]; ?> documentation/s already</li>
					 </ul>
				 </div>
			 </div>
			 <div class="row">
				 <div class="col-sd-12 col-md-12 col-lg-12 _profile_documentations">
					 <?php
					 	$sql = "SELECT docs_by_creator.pid, contents.topic, docs_by_creator.parent, docs_by_creator.title FROM docs_by_creator INNER JOIN contents ON docs_by_creator.pid = contents.id OR docs_by_creator.pid = '-1' WHERE docs_by_creator.username = '$username'";
						$res = $conn->query($sql);
						while($row = $res->fetch_assoc()){
							echo '
								<ul>
						 			<li><a href="/docs/documentations/doc/?pid='.$row["pid"].'&topic='.$row["topic"].'&parent='.$row["parent"].'&title='.$row["title"].'">'.$row["title"].'</a><a href="/docs/create/?pid='.$row["pid"].'&topic='.$row["topic"].'&type=content&parent='.$row["parent"].'&title='.$row["title"].'">_Edit</a><a href="/docs/delete/?pid='.$row["pid"].'&topic='.$row["topic"].'&type=doc&parent='.$row["parent"].'&title='.$row["title"].'">_Delete</a></li>
								</ul>
							';
						}
					  ?>
				 </div>
			 </div>
			</div>
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
