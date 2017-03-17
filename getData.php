
<?php
error_reporting(1);
include('dbinfo.php');
$login = $_GET["login"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name,taken_by FROM students";
$sql2 = "SELECT id, name,active FROM teachers WHERE name = '".$login."' LIMIT 1";
$result = $conn->query($sql);
$result2 = $conn->query($sql2);
$isActive = $result2->fetch_assoc()['active'];

if ($result->num_rows > 0) {
    // output data of each row
  if ($isActive) {
      print "<table class='table'><tr><th>ID</th><th>Name</th><th>Selection</th>";
      while ($row = $result->fetch_assoc()) {
          if ($row['taken_by']=="") {
              print "<tr><td>" . $row["id"]. "</td><td>" . $row["name"] . "</td><td><button class='btn btn-outline-primary' onclick='btnclick(this.id)' id='".$row["id"]."'>Select</button></td></tr>";
          } else {
              print "<tr><td>" . $row["id"]. "</td><td>" . $row["name"] . "</td><td><button class='btn btn-danger' id='".$row["id"]."'>Taken by: ".$row['taken_by']."</button></td></tr>";
          }
      }
  } else {
      $n = $conn->query("SELECT name FROM teachers WHERE active = 1 LIMIT 1")->fetch_assoc()['name'];
      if(!isset($n)){
        $n = "Nobody";
      }
      print("It is not your turn currently. <b>".$n."</b> is currently making a choice.");
  }
} else {
  print("The student list is currently empty.")
}
$conn->close();

?>
