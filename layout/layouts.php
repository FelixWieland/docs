<?php
if(!isset($_SESSION)){session_start();}

/* At First: The Following functions dont require a Database connection,
   because they rely on Sessions, Gets, Posts, or Files.

	 In Version 1.1 there are many functions that are not refactored yet.
 */

function create_header($for="docs", $type="std") {
	switch ($type) {
		case 'std':
			echo '<head>
							<meta charset="utf-8">
							<meta http-equiv="X-UA-Compatible" content="IE=edge">
							<meta name="viewport" content="width=device-width, initial-scale=1">
							<title>'.$for.'</title>
							<link href="/docs/css/bootstrap.min.css" rel="stylesheet">
							<link rel="stylesheet" href="/docs/css/prism.css">
							<link href="/docs/css/main.css" rel="stylesheet">
							<link href="/docs/css/create.css" rel="stylesheet">
							<link href="/docs/css/profile.css" rel="stylesheet">
						</head>';
			break;
		default:
			break;
	}
}

function create_layout($for="docs.place", $type="std", $description=" ", $emptyset=" ", $set_creator=" ") {
	$creator = "";
	if($description==" "){
		$description = "Documentations about ".$for;
	}
	if($emptyset != " "){
		$description = $emptyset;
	}
	if(isset($_SESSION["username"]) && $set_creator == " "){
		$creator = '<a href="/docs/create/" class="_create_marker">_create</a>';
	}
	switch ($type) {
		case 'std':
			echo '<div class="_navbar">
							<a href="/docs" class="_home_link"><div class="_logo"></div></a>
							<ul class="_links">
								<li id="_menu-id">_Menu</li>
							</ul>
						</div>
						<div class="_viewattr _bg_main_green">
							<div class="_triangle_v1 _bg_main_blue"></div>
							<div class="_triangle_v2 _bg_main_rust"></div>
							<div class="_triangle_v3 _bg_main_yellow"></div>
							<div class="container-fluid">
								<div class="col-sm-2"></div>
								<div class="col-sm-8">
									<h1 class="_description _bg_black">'.$for.'</h1>
									<h2 class="_description_small _bg_black">Just a place for docs</h2>
								</div>
								<div class="col-sm-2"></div>
							</div>
						</div>
						<div class="_second_navbar _bg_black">
						'.$creator.'
						</div>';
			break;
		case 'content':
			echo '<div class="_navbar">
							<a href="/docs" class="_home_link"><div class="_logo"></div></a>
							<ul class="_links">
								<li id="_menu-id">_Menu</li>
								<!--<li><a href="#">_Blog</a></li>-->
								<!--<li><a href="#">_IDE</a></li>-->
							</ul>
						</div>
						<div class="_viewattr _bg_main_green">
							<div class="_triangle_v1 _bg_main_blue"></div>
							<div class="_triangle_v2 _bg_main_rust"></div>
							<div class="_triangle_v3 _bg_main_yellow"></div>
							<div class="container-fluid">
								<div class="col-sm-2"></div>
								<div class="col-sm-8">
									<h1 class="_description _bg_black">'.$for.'</h1>
									<h2 class="_description_small _bg_black">'.$description.'</h2>
								</div>
								<div class="col-sm-2"></div>
							</div>
						</div>
						<div class="_second_navbar _bg_black">
							'.$creator.'
						</div>';
			break;
		default:
			break;
	}
}

function create_scripts() {
	echo '<script src="/docs/js/jquery.js"></script>
				<script src="/docs/js/bootstrap.min.js"></script>
				<script src="/docs/js/prism.js"></script>
				<script src="/docs/js/docs.js"></script>
				<script src="/docs/js/click_listeners.js"></script>';
}

function create_footer() {
	echo '<div class="_footer">
					Copyright (c) 2018 Copyright by Felix Wieland All Rights Reserved.
			  </div>';
}

function create_menubar() {
	$profile = "";
	$logout = "";
	$login = '<li id="_login-id">_Login</li>';

	if(isset($_SESSION["username"])){
		$profile = '<a href="/docs/profile/"><li>_Profile</li></a>';
		$logout = '<a href="/docs/utility/logout.php"><li>_Logout</li></a>';
		$login = '';
	}

	echo '<div id="_menu-field-id" class="col-sm-12 col-md-8 col-lg-6 _menu-field">
					<ul>
						<a href="/docs/"><li>_Topics</li></a>
						'.$login.'
						'.$profile.'
						'.$logout.'
					</ul>
				</div>';
}

function create_login_menu() {
	echo '<div id="_login-field-id" class="container _login_field">
					<div class="_login_field-l">
						<div id="_login-field-login-id" class="container">
							<div class="col-sm-12 col-md-12 col-lg-12 _login_field_title">
								Login
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 _login_field_input">
								<p>E-Mail </p><input id="_login-input-id_email" type="text" name="" value="">
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 _login_field_input">
								<p>Passwort </p><input id="_login-input-id_password" type="password" name="" value="">
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 _login_field_submit">
								<button id="_login-submit-id" type="button" name="button">Login</button>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 _login_field_switchReg">
								<button type="button" name="button"> -> Registrieren</button>
							</div>
						</div>
					</div>
					<div class="_login_field-r">
						<div id="_login-field-login-id" class="container">
							<div class="col-sm-12 col-md-12 col-lg-12 _login_field_title">
								Registrieren
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 _login_field_input">
								<p>E-Mail </p><input id="_register-input-id_email" type="text" name="" value="">
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 _login_field_input">
								<p>Username </p><input id="_register-input-id_username" type="text" name="" value="">
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 _login_field_input">
								<p>Passwort </p><input id="_register-input-id_password" type="password" name="" value="">
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 _login_field_submit">
								<button id="_register-submit-id" type="button" name="button">Registrieren</button>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 _login_field_switchReg">
								<button type="button" name="button"> -> Login</button>
							</div>
						</div>
					</div>
				</div>';
}

function create_all_closer() {
	echo '<div id="_closer_of_all">X</div>';
}

function create_upscroller() {
	echo '<div class="_upscroller">&Lambda;</div>';
}

function create_createdoc($p_parent="", $p_title="", $p_description="", $p_rest="") {
	$visible = "";
	$unchangeable = "";
	if($p_rest != "" && $p_rest != " "){
		$visible = 'style="display: block;"';
		$unchangeable = 'disabled';
	}
	echo '<div id="_create_documentation-hidden-id" '.$visible.'>
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
									<p>Parent</p><input type="text" name="" '.$unchangeable.' value="'.$p_parent.'">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sd-12 col-md-12 col-lg-12">
								<div class="_create_pattern">
									<p>Title</p><input type="text" name="" '.$unchangeable.' value="'.$p_title.'">
								</div>
							</div>
						</div>
						 <div class="row">
							 <div class="col-sd-12 col-md-12 col-lg-12">
								 <div class="_create_pattern">
									 <p>Description</p><input type="text" name=""  '.$unchangeable.' value="'.$p_description.'">
								 </div>
							 </div>
						 </div>
						 <br>
						 '.$p_rest.'
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
				</div>';
}

function create_createcontent() {
	echo '<div id="_create_content-hidden-id">
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
				</div>';
}

function create_createchooser() {
	echo ' <div class="container">
					 <div class="row _create_choose">
						 <div class="col-sd-12 col-md-6 col-lg-6" id="_create_choose_content-id">
								Content
						 </div>
						 <div class="col-sd-12 col-md-6 col-lg-6" id="_create_choose_doc-id">
								Documentation
						 </div>
					 </div>
				 </div>';
}

function create_dropdown($list) {
	$x = "<select>";
	foreach ($list as $key => $value) {
		$pattern = '<option value="'.$value.'">'.$value.'</option>';
		$x = $x.$pattern;
	}
	return $x."</select>";
}

//The following functions are for displaying the docs (Working well so far)

function create_doc_contents_for($header, $contents) {
	echo "<h3>".$header."</h3>";
	echo '<ul class="_doc_contents_list">';
	foreach ($contents as $text) {
		echo '<li><a href="#a_'.$text.'">'.$text."</a></li>";
	}
	echo "</ul>";
}

function create_doc_header($header) {
	echo '<h4 id="a_'.$header.'">'.$header.'</h4>';
}

function create_doc_text($text='') {
	echo '<div class="_doc_text">'.$text.'</div>';
}

function create_doc_code($code_type="language-markup", $code) {
	echo '<pre class="line-numbers _doc_code "><code class="language-'.$code_type.'">'.$code.'</code></pre>';
}

function create_download_button($text, $link, $filename) {
	echo '<a class="_doc_download_button" href="/docs/downloads/'.$link.'" download="'.$filename.'">'.$text.'</a>';
}

// The following functions require a Database-Connection Object -> named always $conn

function read_topics($conn) {
	echo "<h1>Topics</h1><br>";
	$sql = "SELECT * FROM topics";
	$res = $conn->query($sql);
	while($row = $res->fetch_assoc()){
		echo '<a class="_content_link" href="/docs/documentations/?topic='.$row["topic"].'&parent=-"><div class="_topic_elm col-sm-6 col-md-4 col-lg-3">'.$row["topic"].'</div></a>';
	}
}

function read_contents($conn, $topic, $parent='-') {
	$contents_of = $parent;
	if ($parent == "-") {
		$contents_of = $topic;
	}
	echo "<h1>Contents of ".$contents_of."</h1><br>";
	if($parent=="-"){
		$sql = "SELECT * FROM contents WHERE topic = '$topic' AND parent = '-' OR parent = '';";
		$res = $conn->query($sql);
		while($row = $res->fetch_assoc()){
			echo '<a class="_content_link" href="/docs/documentations/?topic='.$row["topic"].'&parent='.$row["name"].'"><div class="_content_elm col-sm-6 col-md-4 col-lg-3">'.$row["name"].'</div></a>';
		}
	} else {
		$sql = "SELECT * FROM contents WHERE topic = '$topic' AND parent = '$parent'";
		$res = $conn->query($sql);
		$count = 0;
		while($row = $res->fetch_assoc()){
			echo '<a class="_content_link" href="/docs/documentations/?topic='.$row["topic"].'&parent='.$row["name"].'"><div class="_content_elm col-sm-6 col-md-4 col-lg-3">'.$row["name"].'</div></a>';
		}
		if ($count == 0) {
			$sql = "SELECT * FROM docs WHERE parent = '$parent' GROUP BY title";
			$res = $conn->query($sql);
			while($row = $res->fetch_assoc()){
				echo '<a class="_content_link" href="/docs/documentations/doc/?parent='.$parent.'&title='.$row["title"].'"><div class="_content_elm col-sm-6 col-md-4 col-lg-3">'.$row["title"].'</div></a>';
			}
		}
	}
}

/*The following functions are just wrappers for other functions so that for
  example the fopoter can be created with a single function call
*/

function createBottomWRAPPER() {
	create_menubar();
	create_footer();
	create_login_menu();
	create_all_closer();
	create_upscroller();
}

//Old outdated Functions
/*
// --> Outdated with Version 1.1 cause: Docus are not Stored as a file anymore
function create_contents_for($for="", $type="std")
{
	$for_c = "documentations/".$for."/";
	$for = $_SERVER['DOCUMENT_ROOT']."/docs/documentations/".$for;
	switch ($type) {
		case 'std':
			$directories = glob($for.'/*');

			foreach ($directories as $dir) {
				$dir = str_replace($_SERVER['DOCUMENT_ROOT']."/docs/", "", $dir);
				if(strpos($dir, 'index.php') !== false){
					continue;
				}
				$dir_c = $dir;
				$dir = str_replace("//", "/", $dir);
				echo '<a class="_content_link" href="/docs/'.$dir.'"><div class="_content_elm col-sm-6 col-md-4 col-lg-3">'.str_replace($for_c, "", $dir_c).'</div></a>';
			}
			break;
		case 'content':
			break;
		default:
			// code...
			break;
	}
}
*/

 ?>
