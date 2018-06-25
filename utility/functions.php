<?php
if(!isset($_SESSION)){session_start();}

function generate_salt($p_length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ%&§!';
    $randomString = '';
    for ($i = 0; $i < $p_length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function check_email($p_email) {
   if ( strpos($p_email, '@') !== false ) {
      $split = explode('@', $p_email);
      return (strpos($split['1'], '.') !== false ? true : false);
   }
   else {
      return false;
   }
}

function check_if_username_exits($conn, $p_username) {
	$sql = "SELECT username FROM users WHERE username = '$p_username';";
	if(is_valid_sql($sql)){
		$res = $conn->query($sql);
		if(mysql_num_rows($res)==0){
			return false;
		} else {
			return true;
		}
	} else {
		return false;
	}
}

function check_if_email_exits($conn, $p_email) {
	$sql = "SELECT email FROM users WHERE email = '$p_email';";
	if(is_valid_sql($sql)){
		$res = $conn->query($sql);
		if(mysql_num_rows($res)==0){
			return false;
		} else {
			return true;
		}
	} else {
		return false;
	}
}

function is_valid_sql($p_query) {
	$notAllowedCommands = array('DELETE', 'TRUNCATE', 'DROP', 'USE');
	if(preg_match('[' . implode(' |', $notAllowedCommands ) . ']i', $p_query) == true) {
    return true;
	}
	else {
	  return false;
	}
}

function register($conn, $email, $hash, $salt, $username) {
	$sql = "INSERT INTO `users` (`id`, `email`, `username`, `password`, `salt`, `layer`, `avatar`) VALUES (NULL, '$email', '$username', '$hash', '$salt', '1', '');";
	if(is_valid_sql($sql)){
		$res = $conn->query($sql);
		if($res) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

//Function is not usefull couase mysqli alrady have mysqli_num_rows
function mysql_num_rows($res) {
	$null = true;
	while($row = $res->fetch_assoc()) {
		$null = false;
	}
	return true;
}

function login($conn, $email) {
	$sql = "SELECT * FROM users WHERE email = '$email';";
	if(is_valid_sql($sql)) {
		$res = $conn->query($sql);
		return $res;
	} else {
		return false;
	}
}

function set_loggedin($username, $email, $layer) {
	$_SESSION["username"] = $username;
	$_SESSION["email"] = $email;
	$_SESSION["layer"] = $layer;
}

function check_if_own_doc($conn, $p_parent, $p_title, $p_username) {
	$sql = "SELECT * FROM docs_by_creator WHERE title = '$p_title' AND parent = '$p_parent' AND username = '$p_username';";
	$res = $conn->query($sql);
	$row = $res->fetch_assoc();

	if(mysqli_num_rows($res)) {
		//Is own doc
		return true;
	} else {
		//Not own doc
		return false;
	}
}

function check_if_doc_exits($conn, $parent, $title) {
	$sql = "SELECT * FROM docs_by_creator WHERE title = '$title' AND parent = '$parent';";
	$res = $conn->query($sql);#

	$row = $res->fetch_assoc();

	if(mysqli_num_rows($res)) {
		//Documentation already exits
		return true;
	} else {
		//Document dont exits
		return false;
	}

}

?>
