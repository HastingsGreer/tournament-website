<?php
$servername = "classroom.cs.unc.edu";
$username = "tgreer";
$password = "horsejump5678";
$dbname = "tgreerdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM tournament WHERE NOW() BETWEEN start_date AND end_date";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $total['tournament'][] =$row;
    }
} else {
    $total= "0 results";
}
$conn->close();
echo json_encode($total);


?>