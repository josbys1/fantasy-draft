<?php
$rawnames = $_POST['names'];
$names_array = explode(",", $rawnames);

include('dbinfo.php');
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "delete from students";
$result = $conn->query($sql);
$conn->query("ALTER TABLE students AUTO_INCREMENT = 1");
foreach($names_array as $row){
  $escaped_string=mysqli_real_escape_string($conn,$row);
  $q="INSERT INTO students (id,name,taken_by) VALUES (NULL,'".$escaped_string."','')";
  $conn->query($q);
  //echo($q);


}
echo("Added the values to the database. You may now close this window.");
//echo "Test complete";

?>
