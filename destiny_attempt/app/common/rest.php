<?php   include_once "inc/constants.inc.php";
	$verb = $_SERVER['REQUEST_METHOD'];
	$request =explode('/',trim($_SERVER['PATH_INFO'],'/'));
	$input = json_decode(file_get_contents('php://input'), true); 
	if($verb = 'GET'){
		//GET stuff
	}elseif($verb=='POST'){
		//SOME GET STUFF
	}elseif($verb=='PUT'){
		//SOME POST STUFF
	}elseif($verb=='DELETE'){
		//DELETE
	}
?>