<?php
session_start();

require_once('../inc/user.class.php');

$userClass = new userLogin();

$userClass->set($_POST);


if ($userClass->validateUser()){
  
   
    if(isset($_POST['login'])){
    $userClass->validUser();
    }

    if(isset($_POST['signup'])){
    $userClass->insertUser();
    }
    
}else{
    $errorsArray = $userClass->errors;
    if(isset($errorsArray['loginKey'])){
         echo $errorsArray['loginKey'];
         exit;
         //header("location:user-login.php");
    }
   
}

require_once("../tpl/user-login.tpl.php")
?>


