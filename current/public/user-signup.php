<?php
require_once('../inc/user.class.php');

$userClass = new userLogin();
var_dump($_POST);
var_dump($_FILES);
$userClass->set($_POST);



if ($userClass->validateUser()){
    

    if(isset($_POST['signup'])){
    $userClass->insertUser();
    if (is_array($_FILES) && isset($_FILES['upload_file'])) {
         $userClass->saveImage($_FILES);
    }
   
    }
    
}else{
    $errorsArray = $userClass->errors;
    if(isset($errorsArray['loginKey'])){
         echo $errorsArray['loginKey'];
         exit;
         //header("location:user-login.php");
    }
   
}

require_once("../tpl/user-signup.tpl.php")
?>


