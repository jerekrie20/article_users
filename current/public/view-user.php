<?php
session_start();
// usage: http://localhost/wdv441/week05/public/article-view.php?articleID=4

// include the class definition so i can create an instance
require_once('../inc/user.class.php');

// create an instance of the class so i can access the database
$userClass = new userLogin();

//$getArray = $newsArticle->sanitize();

//var_dump($userClass->getList());


$dataArray =$userClass->getList();
//var_dump($dataArray);
if($_SESSION['userLevel'] == true ){
	require_once("../tpl/view-user.tpl.php");
}else{
	$_SESSION['validUser'] = false;
	header("location:user-login.php");
	exit;
}
?>
