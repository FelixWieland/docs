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
	create_header();
 ?>
  <body>
		<?php
			create_layout("create.doc", "content", "-", "create a documentation", "no");
		 ?>

		 <div class="container">
			 <div class="row _create_choose">
				 <div class="col-sd-12 col-md-6 col-lg-6" id="_create_choose_content-id">
						Content
				 </div>
				 <div class="col-sd-12 col-md-6 col-lg-6" id="_create_choose_doc-id">
						Documentation
				 </div>
			 </div>
		 </div>
		 <div id="_create_documentation-hidden-id">
			 <div id="_documentation_create_place-id" class="container well">
				 <div class="row">
					 <div class="col-sd-12 col-md-12 col-lg-12 _create_toolbar">
						 <div class="_create_tool">
							 add_header
						 </div>
						 <div class="_create_tool">
							add_text
						 </div>
						 <div class="_create_tool">
							 add_code
						 </div>
						 <div class="_create_tool">
							 add_download
						 </div>
						 <div class="_create_tool">
							 add_linebreak
						 </div>
					 </div>
				 </div>
				 <div class="row">
					 <div class="col-sd-12 col-md-12 col-lg-12">
						 <div class="_create_pattern">
							 <p>Parent</p><input type="text" name="" value="">
						 </div>
					 </div>
				 </div>
				 <div class="row">
					 <div class="col-sd-12 col-md-12 col-lg-12">
						 <div class="_create_pattern">
							 <p>Title</p><input type="text" name="" value="">
						 </div>
					 </div>
				 </div>
				 	<div class="row">
					 	<div class="col-sd-12 col-md-12 col-lg-12">
						 	<div class="_create_pattern">
								<p>Description</p><input type="text" name="" value="">
						 	</div>
					 	</div>
				 	</div>
				 	<br>
			 	</div>
				<div class="container">
					<div class="row">
						<div class="">
							<div class="col-sd-12 col-md-12 col-lg-12">
								<p id="_create_save_doc-id">Save</p>
							</div>
						</div>
					</div>
				</div>
		 </div>
		 <div id="_create_content-hidden-id">
			 <br><br>
			 <div class="container">
				 <div class="row">
					 <div class="col-sd-12 col-md-12 col-lg-12">
						 <div class="_create_pattern">
							 <p>Topic</p><input type="text" name="" value="">
						 </div>
					 </div>
				 </div>
				 <div class="row">
					 <div class="col-sd-12 col-md-12 col-lg-12">
						 <div class="_create_pattern">
							 <p>Parent</p><input type="text" name="" value="">
						 </div>
					 </div>
				 </div>
				 <div class="row">
					 <div class="col-sd-12 col-md-12 col-lg-12">
						 <div class="_create_pattern">
							 <p>Content</p><input type="text" name="" value="">
						 </div>
					 </div>
				 </div>
			 </div>
			 <div class="container">
				 <div class="row">
					 <div class="">
						 <div class="col-sd-12 col-md-12 col-lg-12">
							 <p id="_create_save_content-id">Save</p>
						 </div>
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
