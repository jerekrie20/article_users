<?php
// usage: http://localhost/wdv441/week05/public/article-view.php?articleID=4

// include the class definition so i can create an instance
require_once('../inc/NewsArticles.class.php');

// create an instance of the class so i can access the database
$newsArticle = new NewsArticles();

//$getArray = $newsArticle->sanitize();

$artilceID = $_GET['articleID'];

if (!$newsArticle->load($artilceID) ){
	die("article not found");
	exit;
}


$dataArray = $newsArticle->dataArray;

require_once("../tpl/article-view.tpl.php");
?>
