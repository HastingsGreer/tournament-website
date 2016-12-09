<?php  

$id = trim($_REQUEST['gameid']);
$home_team = trim($_REQUEST['home_team']);
$home_score = trim($_REQUEST['away_team']);
$away_team = trim($_REQUEST['away_team']);
$away_score= trim($_REQUEST['away_score']);


$conn = new mysqli($servername, $username, $password, $dbname);

$result = $conn->query("UPDATE INTO game SET home_score=". "'" . $home_score . "', away_score=" . "'" . $away_score . "' WHERE id=" . $id);

$result = $conn->query("SELECT * WHERE id=" . $id);

$array_obj = $result->fetch_array();
$json_encode($array_obj);

?>
