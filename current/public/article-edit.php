<?php
// usage: http://localhost/dmacc/2022/week05/public/article-edit.php?articleID=1
// usage new: http://localhost/dmacc/2022/week05/public/article-edit.php
session_start();
// include the class definition so i can create an instance
require_once('../inc/NewsArticles.class.php');

// create an instance of the class so i can access the database
$newsArticle = new NewsArticles();

$artilceID = $_REQUEST['articleID'];



// check to see if we have a record to load
if (!empty($artilceID)) {
 	$newsArticle->load($artilceID);
	$dataArray = $newsArticle->dataArray;
}

if(isset($_POST['Cancel'])){
	header("location:article.php");
	exit;
}

if (isset($_POST['Save'])) {
	// pass the new data to the instance
	$newsArticle->set($_POST);
	
	// validate the data
	if ($newsArticle->validate()) {
		$newsArticle->sanitize();
		// save
		if ($newsArticle->save()) {
			header("location: article-save-success.php");
			// other things ok
			exit;
		} else {
			
		}
		
	} else {
		// errors
		$errorsArray = $newsArticle->errors;
		$dataArray = $newsArticle->dataArray;
	}
	
}

// code will still run 
if($_SESSION['validUser'] == true){
	require_once("../tpl/article-edit.tpl.php");
}else{
	$_SESSION['validUser'] = false;
	header("location:user-login.php");
	exit;
}


?>
