<?php
require_once('../inc/user.class.php');

$userClass = new userLogin();

$userArray = array();

// load the article if we have it
if (isset($_REQUEST['articleID']) && $_REQUEST['articleID'] > 0) 
{
    $newsArticle->load($_REQUEST['articleID']);
    $articleDataArray = $newsArticle->dataArray;
}

// convert the array to json
echo json_encode($articleDataArray);
?>