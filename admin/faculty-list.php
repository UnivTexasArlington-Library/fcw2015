<?php
$page_title = "Faculty by College/School/Department";
include_once "html-start.php";

$college_id = $_REQUEST['college_id']; 
$department_id = $_REQUEST['department_id']; 

//get college name
if (isset($college_id)) {
$sql = "SELECT *
FROM colleges
WHERE college_id = '$college_id'" 
    		   or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());

if ($record = mysql_fetch_array ($result)) {
echo "<h2>".$record['college_name']."</h2>";
}
}

else {
//if it's not a college, get department name
$sql = "SELECT *
FROM departments
WHERE department_id = '$department_id'" 
    		   or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());

if ($record = mysql_fetch_array ($result)) {
echo "<h2>".$record['department_name']."</h2>";
}
}
?>

<?php
//get all faculty members for college or department
$sql = "SELECT * FROM `faculty` WHERE college_id = '$college_id' or department_id = '$department_id' ORDER BY faculty_last_name"
    		   or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());

while ($record = mysql_fetch_array ($result)) {
?> 
    <div><a href="faculty.php?faculty_id=<?php echo $record['faculty_id'];?>"><?php echo $record['faculty_first_name']." ".$record['faculty_last_name']; ?></a></div>

<?php 
}
?>
</table>

<?php
include_once "html-end.php";
?>