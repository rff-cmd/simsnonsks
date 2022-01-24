<?php
session_start();

error_reporting(E_ALL & ~E_NOTICE);
//if user clicked on logout
if (isset($_POST['login']) && $_POST['login']=='Logout'){
	setcookie("data_login","");
	session_unset();
	session_destroy();
	header("Location: login/index.php");
}

// if the cookie doesn't exsist means the user hasn't been verified by the login page so send them
// back to the login page.
if(!isset($_COOKIE['data_login'])){
	session_unset();
	session_destroy();
	header("Location: index.php");
}else{
	$data_login=$_COOKIE['data_login'];
}

function access($page){
	$access=1;			
	if ($access==0) exit("If you were brough over here it's because you do not have permission to view this page $page");//header("Location: index.php");		
}
?>