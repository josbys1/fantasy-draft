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

$active_select = $conn->query("SELECT * FROM teachers WHERE active=1");
$broad_teacher_select= "SELECT MIN(id) as MINID, MAX(id) as MAXID FROM teachers";
  $range= $conn->query($broad_teacher_select); //gets min max values
$range_values=$range->fetch_assoc();
  $min = $range_values['MINID'];
  $max=$range_values['MAXID'];
if ($active_select->num_rows==0) { //no teachers active
    $conn->query("UPDATE teachers set active=1 WHERE id=".$min);
} else { //gets teacher id
   $current_teacher_id=intval($active_select->fetch_assoc()['id']);
    $next_teacher_id=$current_teacher_id+1;
    print($current_teacher_id);
    print($next_teacher_id);
    $conn->query("UPDATE teachers SET active=0 WHERE id=".$current_teacher_id);
    if ($next_teacher_id<=$max) {
      print("UPDATE teachers SET active=1 WHERE id=".$next_teacher_id);
        $conn->query("UPDATE teachers SET active=1 WHERE id=".$next_teacher_id);
    } else {
        $conn->query("UPDATE teachers SET active=1 WHERE id=".$min);
    }
}
