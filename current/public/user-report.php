<?php

session_start();

require_once('../inc/user.class.php');


$userClass = new userLogin();

$userList = array();

if (isset($_GET['download']) && $_GET['download'] == "1") {

	// echo the data
	$userList = $userClass->getListFiltered(
		(isset($_GET['filterColumn']) ? $_GET['filterColumn'] : null),
		(isset($_GET['filterText']) ? $_GET['filterText'] : null),
		(isset($_GET['sortColumn']) ? $_GET['sortColumn'] : null),
		(isset($_GET['sortDirection']) ? $_GET['sortDirection'] : null)
	);

	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="article_report_' . date("YmdHis") . '.csv"');
	
	foreach ($userList as $rowData) {
		echo '"' . implode('","', $rowData) . '"';
		echo "\r\n";
	}
	
	exit;
}

// check to see if button was click
if (isset($_GET['btnViewReport'])) {
	
    // run report
	$userList = $userClass->getListFiltered(
		(isset($_GET['filterColumn']) ? $_GET['filterColumn'] : null),
		(isset($_GET['filterText']) ? $_GET['filterText'] : null),
		(isset($_GET['sortColumn']) ? $_GET['sortColumn'] : null),
		(isset($_GET['sortDirection']) ? $_GET['sortDirection'] : null),
		(isset($_GET['page']) ? $_GET['page'] : 1)
	);
}

//var_dump($_SERVER["QUERY_STRING"], $_GET);die;
$nextPageGet = $_GET;
$backPageGet = $_GET;

$nextPageGet['page'] = (isset($nextPageGet['page']) ? $nextPageGet['page'] + 1 : 2);
$nextPageLink = http_build_query($nextPageGet);

$backPageGet['page'] = (isset($backPageGet['page']) ? $backPageGet['page'] -1 : 2);
$backPageLink = http_build_query($backPageGet);


//$backPageLink = http_build_query($_GET);




if($_SESSION['userLevel'] == true && $_SESSION['userLevel'] >= 8){
	require_once('../tpl/user-report.tpl.php');
}else{
	$_SESSION['validUser'] = false;
	header("location:user-login.php");
	exit;
}




?>