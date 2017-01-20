<?php
$page_title = "Update a Department";
include_once "html-start.php";

$department_name = mysql_real_escape_string($_POST['department_name']);  
$department_chair = mysql_real_escape_string($_POST['department_chair']);  
$department_chair_title = mysql_real_escape_string($_POST['department_chair_title']);  
$college_id = mysql_real_escape_string($_POST['college_id']);  

$department_id = $_REQUEST['department_id'];

//if the form has been submitted, perform database actions
if ($_REQUEST["Submit"] == "Submit") {

//if it exists, update the database
if (isset($_REQUEST["department_id"])) {

$sql = "UPDATE departments SET  department_name = '$department_name',  department_chair = '$department_chair',  department_chair_title = '$department_chair_title',  college_id = '$college_id' WHERE department_id = '$_REQUEST[department_id]'" or die (mysql_error());
mysql_query($sql);
} //end if

//all done - go to college/department page
header("Location: coll-dept.php");  
}

//print the form
else {
//if it exists, get data
if (isset($_REQUEST["department_id"])) {
$sql = "SELECT * FROM departments 
			  WHERE department_id = '$_REQUEST[department_id]'" or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());
$record = mysql_fetch_array ($result);
}
?>

<form id="form1" name="form1" method="post" action="">
<label for="department_name">Department Name</label><input type="text" value="<?php echo $record["department_name"]; ?>" name="department_name" id="department_name" />
<br class="clear" /> 
<label for="department_chair">Department Chair</label><input type="text" value="<?php echo $record["department_chair"]; ?>" name="department_chair" id="department_chair" />
<br class="clear" /> 
<label for="department_chair_title">Department Chair Title</label><input type="text" value="<?php echo $record["department_chair_title"]; ?>" name="department_chair_title" id="department_chair_title" />
<br class="clear" /> 
<label for="college_id">College ID (enter a single number from the list below)</label><input type="text" value="<?php echo $record["college_id"]; ?>" name="college_id" id="college_id" />
<br class="clear" /> 
<?php
//get categories
$sql2 = "SELECT * FROM colleges"
    		   or die (mysql_error());
$result2 = mysql_query($sql2, $conn) or die (mysql_error());
while ($record2 = mysql_fetch_array ($result2)) {
	
  echo $record2['college_id']." ".$record2['college_name'].", "; 
 }
?>
<p><input type="submit" name="Submit" value="Submit" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php">cancel</a></p>
</form>
<?php } 
include_once "html-end.php";
?>
