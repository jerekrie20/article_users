<?php

class userLogin{

    var $userdata = array();

    var $errors = array();

    var $db = null;

    var $userFromDatabase = array();
	
	function __construct() {
        // create a connection to our database
        $this->db = new PDO('mysql:host=localhost;dbname=wdv441;charset=utf8', 
            'wdv441_user', '2a@-un7_KjqbR61D');
			
		//var_dump($this->db);
	}


    //setting the result from the post array to the userdata array to work with
    function set($userdata) {
		$this->userdata = $userdata;
       
        
       // var_dump($this->userdata);
	}

    //vailidating the userdata array to make to check mainly for the honeypot
    function validateUser(){
        $isValid = true;
        /*
        if(empty($this->userdata['Username'])){
            $this->errors['username'] = "Please enter a username";
            $isValid = false;
        }
        if(empty($this->userdata['password'])){
            $this->errors['password'] = "Please enter a password";
            $isValid = false;
        }
        if(empty($this->userdata['password'])){
            $this->errors['password'] = "Please enter a password";
            
            $isValid = false;
        }
        */

        
        
        //Honey Pot
        if(!empty($this->userdata['loginKey'])){
            $this->errors['loginKey'] = "Please try again";
            
            $isValid = false;
        }
        //var_dump($isValid);
        return $isValid;
        
    }

    //hashing the password that was sent
    function hashPassword() {
        define("PASSWORD_SALT", "Th!s!SmYS@lTf0rMYP@Ss");

        $passwordFromUser = $this->userdata['password'];

        $passwordHash = hash("sha256", $passwordFromUser . PASSWORD_SALT);        

        return $passwordHash;
    }

    //

    
    //checking to see if a user is in databse
    function validUser(){
       
        $_SESSION['validUser'] = false;
        $_SESSION['userLevel'] = 1;

        if(isset($this->userdata['login'])){

            $hashPas = $this->hashPassword();
            $userName = $this->userdata['userName'];
            

            $sql = "SELECT * FROM user WHERE username=:userName AND userpassword=:userPW" ;
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':userName',$userName);
            $stmt->bindParam(':userPW',$hashPas);

            $stmt->execute();

            $resultArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
           // var_dump($resultArray[0]['username']);
            
            $numRows = count($resultArray);

            //var_dump($numRows);
           // var_dump($resultArray);
           // var_dump($resultArray['username']);
     
      
        if($numRows == 1){

            $_SESSION['validUser'] = true;
            $_SESSION['userLevel'] = $resultArray[0]['user_level'];
            $_SESSION['userID'] = $resultArray[0]['user_Id'];
            
            //$this->userdata = $resultArray;

           // var_dump($_SESSION);
            //var_dump( $this->userdata = $resultArray);
           
        }
        else{
           var_dump( $this->errors['invalidUser'] = "Invalid  username/password, Please Try Again");
           return false;
        }
        }

    }

    //inserting a newUser into Database

    function insertUser(){
        $isSaved = false;
       
        if(isset($this->userdata['signup'])){

             $stmt = $this->db->prepare(
                "INSERT INTO user 
                    (username, userpassword) 
                 VALUES (?, ?)");

            $isSaved = $stmt->execute(array(
            $this->userdata['userName'],
            $this->hashPassword(),
            )
        );

        if ($isSaved) {
            $this->validUser();
        }

    }

    return $isSaved;
}

function saveImage($fileArray) {
    //var_dump($fileArray);die;
    
    if (isset($fileArray["upload_file"])) {
        move_uploaded_file($fileArray["upload_file"]['tmp_name'], __DIR__ . 
            "/../public/images/" . $this->userdata['userName'] . "_user.jpg");
    }
            
}

function getList() {
    $dataList = array();
    
     if( $_SESSION['userLevel'] == 1){
           $userID = $_SESSION['userID'];
        // TODO: get the user and store into $dataList
            $stmt = $this->db->prepare("SELECT * FROM user WHERE user_Id = $userID");
            //$stmt->bindParam(':userID',$userID);
            $stmt->execute();

        $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // return the user

        return $dataList; 
    }
    
   
    if($_SESSION['userLevel'] == 8){
        // TODO: get the user and store into $dataList array($this->userdata['user_Id'])
            $stmt = $this->db->prepare("SELECT * FROM user");
            $stmt->execute();

       $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            // return the user

        return $dataList; 
    }
           
}

function getListFiltered(
    $searchColumn = null, 
    $searchFor = null, 
    $sortColumn = null, 
    $sortDirection = null,
    $page = null
) {
    
    $dataList = array();
    $searchColumn = filter_var($searchColumn, FILTER_UNSAFE_RAW);
    $sortColumn = filter_var($sortColumn, FILTER_UNSAFE_RAW);
    $sortDirection = filter_var($sortDirection, FILTER_UNSAFE_RAW);
    $page = filter_var($page, FILTER_SANITIZE_NUMBER_INT);
    
    $sql = "SELECT * FROM user ";

    // check we received search parameters
    if (!is_null($searchColumn) && !empty($searchColumn) && !is_null($searchFor) && !empty($searchFor)) {
        $sql .= "WHERE " . $searchColumn . " LIKE ? ";
    }

    if (!is_null($sortColumn) && !empty($sortColumn) && !is_null($sortDirection) && !empty($sortDirection)) {
        $sql .= " ORDER BY " . $sortColumn . " " . $sortDirection;
    }
    
    // setup paging if passed
    
    $how_many_on_page = 2;
    
    if (!is_null($page) && is_numeric($page)) {
        $sql .= " LIMIT " . (($how_many_on_page * $page - 1) - 1) . ", " . $how_many_on_page;
    }

//var_dump($page, $sql);
            
    $stmt = $this->db->prepare($sql);
  
    $stmt->execute((is_null($searchFor) || empty($searchFor) ? null : array(
        '%' . $searchFor . '%'
    )));
   
    
    
    if ($stmt->rowCount() > 0) {
        $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }		
    
    return $dataList;
}

function getListRest() {
    $dataList = array();
    $rightUser = false;
    if( $_SESSION['userLevel'] >= 1){
        $userID = $_SESSION['userID'];
     // TODO: get the user and store into $dataList
         $stmt = $this->db->prepare("SELECT * FROM user WHERE user_Id = $userID");
         //$stmt->bindParam(':userID',$userID);
         $stmt->execute();

     $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
         // return the user

     return $dataList; 
 }else{
        return $rightUser;
    }
           
}

function getAllListRest() {
    $dataList = array();
    $rightUser = false;
    if($_SESSION['userLevel'] == 8){
        // TODO: get the user and store into $dataList array($this->userdata['user_Id'])
            $stmt = $this->db->prepare("SELECT * FROM user");
            $stmt->execute();

       $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  
            // return the user

        return $dataList; 
    }else{
        return $rightUser;
    }
           
}


}



?>