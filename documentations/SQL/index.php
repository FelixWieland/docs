<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/docs/layout/layouts.php';
 ?>
<!DOCTYPE html>
<html lang="de" dir="ltr">
	<?php
		create_header("SQL");
	 ?>
	<body>
		<?php
			create_layout("SQL", "content");
		 ?>
		<div class="container well">
			<h1>Contents for SQL</h1><br>
			<?php
				create_contents_for("SQL");
			 ?>
		</div>
		<div class="_upscroller">&Lambda;</div>
		<?php
			create_footer();
		 ?>
	</body>
	<?php
		create_scripts();
	 ?>
</html>
