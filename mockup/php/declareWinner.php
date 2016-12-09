<?php  

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$id = trim($_REQUEST['gameid']);
#$home_team = trim($_REQUEST['home_team']);
$home_score = trim($_REQUEST['home_score']);
#$away_team = trim($_REQUEST['away_team']);
$away_score= trim($_REQUEST['away_score']);
$conn = new mysqli("classroom.cs.unc.edu", "tgreer", "horsejump5678", "tgreerdb");

$result = $conn->query("UPDATE game SET home_score=". "'" . $home_score . "', away_score=" . "'" . $away_score . "' WHERE id=" . $id);
echo mysqli_error($conn);
$result = $conn->query("SELECT * from game WHERE id=" . $id);

$array_obj = $result->fetch_array();
json_encode($array_obj);

?>
