<?php
require_once('../inc/NewsArticles.class.php');

$newsArticle = new NewsArticles();


$allArticles = $newsArticle->getList();

require_once("../tpl/article.tpl.php");

?>

