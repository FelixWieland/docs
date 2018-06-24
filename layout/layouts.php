<?php
if(!isset($_SESSION)){session_start();}

function create_header($for="docs", $type="std") {
	switch ($type) {
		case 'std':
			echo '
			<head>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">

				<title>'.$for.'</title>

				<link href="/docs/css/bootstrap.min.css" rel="stylesheet">
				<link rel="stylesheet" href="/docs/css/prism.css">
				<link href="/docs/css/main.css" rel="stylesheet">
				<link href="/docs/css/create.css" rel="stylesheet">
				<link href="/docs/css/profile.css" rel="stylesheet">
			</head>
			';
			break;

		default:
			// code...
			break;
	}

}

function create_layout($for="docs.place", $type="std", $for_two=" ", $for_three=" ", $set_creator=" ")
{
	$creator = "";
	if($for_two==" "){
		$for_two = "Documentations about ".$for;
	}
	if($for_three != " "){
		$for_two = $for_three;
	}
	if(isset($_SESSION["username"]) && $set_creator == " "){
		$creator = '<a href="/docs/create/" class="_create_marker">_create</a>';
	}
	switch ($type) {
		case 'std':
			echo '
			<div class="_navbar">
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
						<h2 class="_description_small _bg_black">Just a place for docs</h2>
					</div>
					<div class="col-sm-2"></div>
				</div>
			</div>
			<div class="_second_navbar _bg_black">
			'.$creator.'
			</div>
			';
			break;
		case 'content':
			echo '
			<div class="_navbar">
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
						<h2 class="_description_small _bg_black">'.$for_two.'</h2>
					</div>
					<div class="col-sm-2"></div>
				</div>
			</div>
			<div class="_second_navbar _bg_black">
				'.$creator.'
			</div>
			';
			break;

		default:
			// code...
			break;
	}


}

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

function create_scripts()
{
	echo '
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="/docs/js/bootstrap.min.js"></script>
	<script src="/docs/js/prism.js"></script>
	<script src="/docs/js/docs.js"></script>
	';
}

function create_doc_contents_for($header, $contents)
{
	echo "<h3>".$header."</h3>";
	echo '<ul class="_doc_contents_list">';
	foreach ($contents as $text) {
		echo '<li><a href="#a_'.$text.'">'.$text."</a></li>";
	}
	echo "</ul>";
}

function create_doc_header($header){
	echo '<h4 id="a_'.$header.'">'.$header.'</h4>';
}

function create_doc_text($text='')
{
	echo '<div class="_doc_text">'.$text.'</div>';
}

function create_doc_code($code_type="language-markup", $code){
	echo '<pre class="line-numbers _doc_code "><code class="language-'.$code_type.'">'.$code.'</code></pre>';
}

function create_download_button($text, $link, $filename) {
	echo '<a class="_doc_download_button" href="/docs/downloads/'.$link.'" download="'.$filename.'">'.$text.'</a>';
}
function create_footer()
{
	echo '
	<div class="_footer">
		Copyright (c) 2018 Copyright by Felix Wieland All Rights Reserved.
	</div>
	';
}
function create_menubar() {
	$profile = "";
	$logout = "";
	if(isset($_SESSION["username"])){
		$profile = '<a href="/docs/profile/"><li>_Profile</li></a>';
		$logout = '<a href="/docs/utility/logout.php"><li>_Logout</li></a>';
	}

	echo '
	<div id="_menu-field-id" class="col-sm-12 col-md-8 col-lg-6 _menu-field">
		<ul>
			<a href="/docs/"><li>_Topics</li></a>
			<li id="_login-id">_Login</li>
			'.$profile.'
			'.$logout.'

		</ul>
	</div>
	';
}


//--
function read_topics($conn)
{
	echo "<h1>Topics</h1><br>";
	$sql = "SELECT * FROM topics";
	$res = $conn->query($sql);
	while($row = $res->fetch_assoc()){
		echo '<a class="_content_link" href="/docs/documentations/?topic='.$row["topic"].'&parent=-"><div class="_topic_elm col-sm-6 col-md-4 col-lg-3">'.$row["topic"].'</div></a>';
	}
}

function read_contents($conn, $topic, $parent='-')
{
	$cto = $parent;
	if ($parent == "-") {
		$cto = $topic;
	}
	echo "<h1>Contents of ".$cto."</h1><br>";
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

function read_doc($conn, $parent, $name, $title)
{
	$sql = "SELECT * FROM docs WHERE parent = '$parent' AND title = '$title'";
	$res = $conn->query($sql);

	while($row = $res->fetch_assoc()){
		echo "<!--".$row['name']."-->";

	}
}

function create_login_menu()
{
	echo '
	<div id="_login-field-id" class="container _login_field">
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
	</div>
	';
}

function create_all_closer() {
	echo '
	<div id="_closer_of_all">
		X
	</div>
	';
}

function create_upscroller()
{
	echo '
		<div class="_upscroller">&Lambda;</div>
	';
}

function createBottomWRAPPER()
{
	create_menubar();
	create_footer();
	create_login_menu();
	create_all_closer();
	create_upscroller();
}
 ?>
