<?php
$page_title = "Update a College or School";
include_once "html-start.php";

$college_name = mysql_real_escape_string($_POST['college_name']);  
$college_dean = mysql_real_escape_string($_POST['college_dean']);  
$college_dean_title = mysql_real_escape_string($_POST['college_dean_title']);  
$college_img = mysql_real_escape_string($_POST['college_img']);  

$college_id = $_REQUEST['college_id'];

//if the form has been submitted, perform database actions
if ($_REQUEST["Submit"] == "Submit") {

//if it exists, update the database
if (isset($_REQUEST["college_id"])) {

$sql = "UPDATE colleges SET  college_name = '$college_name',  college_dean = '$college_dean',  college_dean_title = '$college_dean_title',  college_img = '$college_img' WHERE college_id = '$_REQUEST[college_id]'" or die (mysql_error());
mysql_query($sql);
} //end if

//all done - go to college/department page
header("Location: coll-dept.php");  
}

//print the form
else {
//if it exists, get data
if (isset($_REQUEST["college_id"])) {
$sql = "SELECT * FROM colleges 
			  WHERE college_id = '$_REQUEST[college_id]'" or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());
$record = mysql_fetch_array ($result);
}
?>

<form id="form1" name="form1" method="post" action="">
<label for="college_name">College Name</label><input type="text" value="<?php echo $record["college_name"]; ?>" name="college_name" id="college_name" />
<br class="clear" /> 
<label for="college_dean">College Dean</label><input type="text" value="<?php echo $record["college_dean"]; ?>" name="college_dean" id="college_dean" />
<br class="clear" /> 
<label for="college_dean_title">College Dean Title</label><input type="text" value="<?php echo $record["college_dean_title"]; ?>" name="college_dean_title" id="college_dean_title" />
<br class="clear" /> 
<label for="college_img">College Img</label><input type="text" value="<?php echo $record["college_img"]; ?>" name="college_img" id="college_img" />
<br class="clear" /> 
<p><input type="submit" name="Submit" value="Submit" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php">cancel</a></p>
</form>
<?php } 
include_once "html-end.php";
?>
