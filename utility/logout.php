<?php
if(!isset($_SESSION)){session_start();}
//logs the user out

session_destroy();
session_unset();

header("Location: /docs/");
 ?>
