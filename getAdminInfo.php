<?php
include('dbinfo.php');
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$insert_name="SELECT id,name,active FROM teachers";

$result = $conn->query($insert_name);

if ($result->num_rows > 0) {
    print("<div class='col-lg-6'><h1 class='text-center'>Lineup</h1><br>");
    while ($row = $result->fetch_assoc()) {
        if ($row['active']) {
            print "<h4>".$row['name']." is selecting</h4>";
        } else {
            print $row['name']."<br>";
        }
    }
    print("</div>");

    print("<div class='col-lg-6'><h1 class='text-center'>Current Roster</h1><br>");
    $result = $conn->query($insert_name);
    while ($row = $result->fetch_assoc()) { //for every teacher...print their students
        print("<h3>".$row['name']."</h3>");
        $student_query = $conn->query("SELECT name FROM students WHERE taken_by='".$row['name']."'");
        while ($student = $student_query->fetch_assoc()) {
            print $student['name']."<br>";
        }
    }
    print("</div>"); //end column div
} else {
  print("<div class='col-lg-6'><h1 class='text-center'>Lineup<br></h1><h4 class='text-center'>Nobody has joined the session.</h4></div>
  <div class='col-lg-6'><h1 class='text-center'>Current Roster</h1><br></div>");
}


?>
