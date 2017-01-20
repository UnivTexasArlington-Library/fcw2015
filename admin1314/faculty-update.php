<?php
$page_title = "Add/Edit a Faculty Member";
include_once "html-start.php";

$faculty_prefix = mysql_real_escape_string($_POST['faculty_prefix']);  
$faculty_first_name = mysql_real_escape_string($_POST['faculty_first_name']);  
$faculty_middle_name = mysql_real_escape_string($_POST['faculty_middle_name']);  
$faculty_last_name = mysql_real_escape_string($_POST['faculty_last_name']);  
$faculty_suffix = mysql_real_escape_string($_POST['faculty_suffix']);  
$faculty_title = mysql_real_escape_string($_POST['faculty_title']);  
$faculty_img = mysql_real_escape_string($_POST['faculty_img']);  
$faculty_link = mysql_real_escape_string($_POST['faculty_link']);  
$department_id = mysql_real_escape_string($_POST['department_id']);  
$college_id = mysql_real_escape_string($_POST['college_id']);  
$faculty_item_types = mysql_real_escape_string($_POST['faculty_item_types']);  

$faculty_id = $_REQUEST['faculty_id'];

//get logged in user; remove @UTA.EDU (last 8 characters) from end of string
$last_modified_user = substr($_SERVER['REMOTE_USER'], 0, -8);

//if the form has been submitted, perform database actions
if ($_REQUEST["Submit"] == "Submit") {

//if it's an existing item, update the database
if (isset($_REQUEST["faculty_id"])) {

$sql = "UPDATE faculty SET faculty_prefix = '$faculty_prefix',  faculty_first_name = '$faculty_first_name',  faculty_middle_name = '$faculty_middle_name',  faculty_last_name = '$faculty_last_name',  faculty_suffix = '$faculty_suffix',  faculty_title = '$faculty_title',  faculty_img = '$faculty_img',  faculty_link = '$faculty_link',  department_id = '$department_id',  college_id = '$college_id',  faculty_item_types = '$faculty_item_types' WHERE faculty_id = '$_REQUEST[faculty_id]'" or die (mysql_error());
mysql_query($sql);
} //end if

//or if it's a new item, insert into database
else {
 $query = "INSERT INTO faculty ( faculty_prefix, faculty_first_name, faculty_middle_name, faculty_last_name, faculty_suffix, faculty_title, faculty_img, faculty_link, department_id, college_id, faculty_item_types )  VALUES ( '$faculty_prefix', '$faculty_first_name', '$faculty_middle_name', '$faculty_last_name', '$faculty_suffix', '$faculty_title', '$faculty_img', '$faculty_link', '$department_id', '$college_id', '$faculty_item_types' )"; 
 $result = mysql_query($query); 
  
if (!$result) 
  {
  print "There was a database error when executing <PRE>$sql</PRE>";
  print mysql_error();
  } //end if

}
//all done - go to main admin page
header("Location: index.php");  
}

//print the form
else {
//if it's an existing faculty member, get data
if (isset($_REQUEST["faculty_id"])) {
$sql = "SELECT * FROM faculty 
			  WHERE faculty_id = '$_REQUEST[faculty_id]'" or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());
$record = mysql_fetch_array ($result);
}
?>

<form id="form1" name="form1" method="post" action="">
<label for="faculty_prefix">Faculty Prefix</label><input type="text" value="<?php echo $record["faculty_prefix"]; ?>" name="faculty_prefix" id="faculty_prefix" />
<br class="clear" /> 
<label for="faculty_first_name">Faculty First Name</label><input type="text" value="<?php echo $record["faculty_first_name"]; ?>" name="faculty_first_name" id="faculty_first_name" />
<br class="clear" /> 
<label for="faculty_middle_name">Faculty Middle Name</label><input type="text" value="<?php echo $record["faculty_middle_name"]; ?>" name="faculty_middle_name" id="faculty_middle_name" />
<br class="clear" /> 
<label for="faculty_last_name">Faculty Last Name</label><input type="text" value="<?php echo $record["faculty_last_name"]; ?>" name="faculty_last_name" id="faculty_last_name" />
<br class="clear" /> 
<label for="faculty_suffix">Faculty Suffix</label><input type="text" value="<?php echo $record["faculty_suffix"]; ?>" name="faculty_suffix" id="faculty_suffix" />
<br class="clear" /> 
<label for="faculty_title">Faculty Title</label><input type="text" value="<?php echo $record["faculty_title"]; ?>" name="faculty_title" id="faculty_title" />
<br class="clear" /> 
<label for="faculty_img">Faculty Img</label><input type="text" value="<?php echo $record["faculty_img"]; ?>" name="faculty_img" id="faculty_img" />
<br class="clear" /> 
<label for="faculty_link">Faculty Link</label><input type="text" value="<?php echo $record["faculty_link"]; ?>" name="faculty_link" id="faculty_link" />
<br class="clear" /> 
<label for="department_id">Department Id (enter a single number from the list below)</label><input type="text" value="<?php echo $record["department_id"]; ?>" name="department_id" id="department_id" />
<br class="clear" /> 
<?php
//get categories
$sql2 = "SELECT * FROM departments
		ORDER BY department_name"
    		   or die (mysql_error());
$result2 = mysql_query($sql2, $conn) or die (mysql_error());
while ($record2 = mysql_fetch_array ($result2)) {
	
  echo $record2['department_id']." ".$record2['department_name'].", "; 
 }

?>
<label for="college_id">College Id (enter a single number from the list below)</label><input type="text" value="<?php echo $record["college_id"]; ?>" name="college_id" id="college_id" />
<br class="clear" /> 
<?php
//get categories
$sql3 = "SELECT * FROM colleges"
    		   or die (mysql_error());
$result3 = mysql_query($sql3, $conn) or die (mysql_error());
while ($record3 = mysql_fetch_array ($result3)) {
	
  echo $record3['college_id']." ".$record3['college_name'].", "; 
 }

?>
<br class="clear" /> 
<label for="faculty_item_types">Faculty Item Types</label><input type="text" value="<?php echo $record["faculty_item_types"]; ?>" name="faculty_item_types" id="faculty_item_types" />
<br class="clear" /> 
<p><input type="submit" name="Submit" value="Submit" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php">cancel</a></p>
</form>
<?php } 
include_once "html-end.php";
?>
