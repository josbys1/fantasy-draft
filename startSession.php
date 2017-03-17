


<?php

include('dbinfo.php');

$login = $_GET['login'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$insert_name="INSERT INTO teachers (id,name,active) VALUES (NULL,'".$login."',0)";
$check_name = "SELECT id, name,active FROM teachers WHERE name = '".$login."'";
$check_query=$conn->query($check_name);
if($check_query->num_rows == 0&&isset($login)){
  if ($conn->query($insert_name) === true) {
    echo '<script language="javascript">';
echo 'alert("Welcome to the session! When it is your turn, you will select from the list below.")';
echo '</script>';
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
?>
