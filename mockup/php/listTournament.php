<?php

$servername = "classroom.cs.unc.edu";
$username = "tgreer";
$password = "horsejump5678";
$dbname = "tgreerdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if (isset($_REQUEST['userid'])) {
	$uid = $_REQUEST['userid'];

	$result= $conn->query("SELECT * FROM users u, tournament t, user_tournament_junction ut WHERE ut.userID=u.id AND ut.tournamentID=t.id AND u.id=" . $uid);
	if ($result->num_rows > 0) {
    // output data of each row
		while($row = $result->fetch_assoc()) {
			$total['tournament'][] =$row;
		}
	}else{
		echo "No Tournaments";
	}

}else{
	echo "Made it into listtournament";
	$sql = "SELECT * FROM tournament";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    // output data of each row
		while($row = $result->fetch_assoc()) {

			$total['tournament'][] =$row;
		}
	} else {
		echo "0 results";
	}
}
$conn->close();
?>