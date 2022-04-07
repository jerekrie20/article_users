<?php
session_start();
require_once('../inc/user.class.php');



$userClass = new userLogin();

$userArray = array();

if(isset($_POST['getUserList']) && $_POST['getUserList'] == 'one' ){
    $userArray = $userClass->getListRest();
}

if(isset($_POST['getUserList']) && $_POST['getUserList'] == 'all' ){
    $userArray = $userClass->getAllListRest();
}

require_once('../tpl/user-rest-get.tpl.php');
?>