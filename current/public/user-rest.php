<?php
session_start();
require_once('../inc/user.class.php');



$userClass = new userLogin();

$userArray = array();

$userArray = $userClass->getlist();


// convert the array to json

echo json_encode($userArray);
?>