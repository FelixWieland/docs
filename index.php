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
			create_layout();
		 ?>
		<div class="container well">
			<?php
				//create_contents_for();
				read_topics($conn);
			 ?>

		</div>
		<div class="container-fluid well _margin_normal _parallax-wrapper _parallax-background-0<?php echo rand(5,5); ?>">

			<br><br><br><br><br><br><br>
		</div>
		<div class="container well _margin_normal ">
			<div class="_bubble">
				<p class="_intro_1">Whats this here?!</p>
			</div>
			<div class="_bubble">
			<p class="_intro_2">this is just a place for docs.</p>
			</div>
			<div class="_bubble">
				<p class="_intro_1">But why? The are already so many doc-pages outsite ...</p>
			</div>
			<div class="_bubble">
				<p class="_intro_2">Just because.</p>
			</div>
			<br><br><br><br><br><br><br>
		</div>
		<div class="container-fluid well _margin_normal _parallax-wrapper _parallax-background-0<?php echo rand(5,5); ?>">
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		</div>
		<div class="container well _margin_normal">
			<br><br><br><br><br><br><br>
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
