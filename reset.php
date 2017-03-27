<?php

include('dbinfo.php');
$login = $_GET['login'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "delete from teachers";
$result = $conn->query($sql);
$conn->query("ALTER TABLE teachers AUTO_INCREMENT = 1");
$conn->query("update students set taken_by=NULL");
echo "Test complete";
?>
