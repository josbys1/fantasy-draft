<?php
$rawnames = $_POST['names'];
$teacher_name = $_POST['teacher-name'];
$names_array = explode(",", $rawnames);

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "draft";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$q="INSERT INTO teachers (active,id,arr,name) VALUES (0,NULL,'".serialize($names_array)."','".$teacher_name."')";
$conn->query($q);
echo($q);

echo("Added the values to the database. You may now close this window.");
//echo "Test complete";

?>
