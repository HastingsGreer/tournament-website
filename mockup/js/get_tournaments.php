<?php
$servername = "localhost";
$username = "root";
$password = "4479";
$dbname = "tournamenttown";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

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
$conn->close();
?>