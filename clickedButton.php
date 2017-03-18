
<?php
include('dbinfo.php');
 $id=$_POST['id'];
 $name=$_POST['name'];
 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }

 $sql = "UPDATE students SET taken_by='".$name. "' WHERE id=".$id;
 $sql2 = "SELECT * FROM teachers WHERE name='".$name."'";
$broad_teacher_select= "SELECT MIN(id) as MINID, MAX(id) as MAXID FROM teachers";
 $conn->query($sql);
 $result_teachers = $conn->query($sql2); //gets teacher id
 $range= $conn->query($broad_teacher_select); //gets min max values
 $range_values=$range->fetch_assoc();
 $min = $range_values['MINID'];
 $max=$range_values['MAXID'];

 $current_teacher_id=intval($result_teachers->fetch_assoc()['id']);
 $next_teacher_id=$current_teacher_id+1;
$conn->query("UPDATE teachers SET active=0 WHERE id=".$current_teacher_id);
if ($current_teacher_id>=$max) {
    $next_teacher_id=$min;
}
$conn->query("UPDATE teachers SET active=1 WHERE id=".$next_teacher_id);

$list_of_arr=$conn->query("SELECT * FROM teachers WHERE id>=".$next_teacher_id);
$k = $list_of_arr->fetch_assoc();
while(isset($k)){
    $choice_array=unserialize($k['arr']);
    foreach ($choice_array as $j) {
      echo("RUnning a foreach");
        $matched_query=$conn->query("SELECT * FROM students WHERE taken_by='' AND name LIKE '%".$j."%'");
        $matched_row=$matched_query->fetch_assoc();
        if (isset($matched_row)) {
            $qu="UPDATE students SET taken_by='".$k['name']."' WHERE id='".$matched_row['id']."'";
            echo($qu);
            $conn->query($qu);
            break;
        }
      }
      print("Changing the value of k");
    $k=$list_of_arr->fetch_assoc();
}
$conn->close();

 ?>
