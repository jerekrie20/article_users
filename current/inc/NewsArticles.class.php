<?php

class NewsArticles {

	// stores the data for a news article
	var $dataArray = array();
	
	// stores a list of errors from validation
	var $errors = array();
	
	// stores a connection to the database
	var $db = null;
	
	function __construct() {
        // create a connection to our database
        $this->db = new PDO('mysql:host=localhost;dbname=wdv441;charset=utf8', 
            'wdv441_user', '2a@-un7_KjqbR61D');
			
		//var_dump($this->db);
	}
		
	// stores the array to the property on the class
	function set($dataArray) {
		$this->dataArray = $dataArray;
	}
		
	function load($id) {
        // flag to track if the article was loaded
        $isLoaded = false;

        // load from database
        // create a prepared statement (secure programming)
        $stmt = $this->db->prepare("SELECT * FROM newsarticles WHERE articleID = ?");
        
        // execute the prepared statement passing in the id of the article we 
        // want to load
        $stmt->execute(array($id));

        // check to see if we loaded the article
        if ($stmt->rowCount() == 1) {
            // if we did load the article, fetch the data as a keyed array
            $dataArray = $stmt->fetch(PDO::FETCH_ASSOC);
            //var_dump($dataArray);
            
            // set the data to our internal property            
            $this->set($dataArray);
                        
            // set the success flag to true
            $isLoaded = true;
        }
        
        //var_dump($stmt->rowCount());
        
        // return success or failure
        return $isLoaded;
	}

    // save a news article (inserts and updates)
    function save() {
        // create a flag to track if the save was successful
        $isSaved = false;
        
        // determine if insert or update based on articleID
        // save data from dataArray property to database
        if (empty($this->dataArray['articleID'])) {
							
            // create a prepared statement to insert data into the table
            $stmt = $this->db->prepare(
                "INSERT INTO newsarticles 
                    (articleTitle, articleContent, articleAuthor, articleDate) 
                 VALUES (?, ?, ?, ?)");

            // execute the insert statement, passing in the data to insert
            $isSaved = $stmt->execute(array(
                    $this->dataArray['articleTitle'],
                    $this->dataArray['articleContent'],
                    $this->dataArray['articleAuthor'],
                    $this->dataArray['articleDate']
                )
            );
            
            // if the execute returned true, then store the new id back into our 
            // data property
            if ($isSaved) {
                $this->dataArray['articleID'] = $this->db->lastInsertId();
            }
        } else { 
			// if this is an update of an existing record, create a prepared update 
			// statement
            $stmt = $this->db->prepare(
                "UPDATE newsarticles SET 
                    articleTitle = ?,
                    articleContent = ?,
                    articleAuthor = ?,
                    articleDate = ?
                WHERE articleID = ?"
            );
                    
            // execute the update statement, passing in the data to update
            $isSaved = $stmt->execute(array(
                    $this->dataArray['articleTitle'],
                    $this->dataArray['articleContent'],
                    $this->dataArray['articleAuthor'],
                    $this->dataArray['articleDate'],
                    $this->dataArray['articleID']
                )
            );            
        }
                        
        // return the success flage
        return $isSaved;
    }
   
	// TODO: implement the sanitize function that will sanitize the article data
	function sanitize() {
       
            $this->dataArray['articleDate'] = filter_var($this->dataArray['articleDate'], FILTER_SANITIZE_NUMBER_INT);

            $this->dataArray['articleTitle'] = filter_var($this->dataArray['articleTitle'], FILTER_SANITIZE_STRIPPED);


         return $this->dataArray;
        
		
	}
	
	// TODO: implement validations for the article data
    //Checking to see if any fields is empty
	function validate() {	

		$isValid = true;

        if(empty($this->dataArray['articleID'])){

        }else{
            $this->dataArray['articleID'] = filter_var($this->dataArray['articleID'], FILTER_VALIDATE_INT);
        };

		if (empty($this->dataArray['articleTitle'])) {
			$this->errors['articleTitle'] = "Title is required";
			$isValid = false;
		};

        if (empty($this->dataArray['articleContent'])) {
			$this->errors['articleContent'] = "Content is required";
			$isValid = false;
		};

        if (empty($this->dataArray['articleAuthor'])) {
			$this->errors['articleAuthor'] = "Author is required";
			$isValid = false;
		}else{
            $this->dataArray['articleAuthor'] = filter_var($this->dataArray['articleAuthor'], FILTER_VALIDATE_REGEXP,
            array("options"=>array("regexp"=>"/[a-zA-Z]/")));
        };

        if (empty($this->dataArray['articleDate'])) {
			$this->errors['articleDate'] = "Date is required";
			$isValid = false;
		};

        
       
	
		return $isValid;
	}

    // get a list of news articles as an array    
    function getList() {
        $dataList = array();

        // TODO: get the news articles and store into $dataList
        $stmt = $this->db->prepare("SELECT * FROM newsarticles");
        $stmt->execute();

       $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // return the list of articles
        return $dataList;        
    }

    function getListFiltered($searchColumn, $searchFor,$sortColumn,$sortDirection){
        $dataList = array();
        $searchColumn = filter_var($searchColumn, FILTER_SANITIZE_STRING);
        $sql = "SELECT * FROM newsarticles WHERE " . $searchColumn . " LIKE ? ORDER BY " .$sortColumn . ". $sortDirection .";

        $stmt = $this->db->prepare($sql);

        $stmt->execute(array('%' . $searchFor . '%'));

        if ($stmt->rowCount() > 0){
            $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $dataList;  
    }
    
}
?>