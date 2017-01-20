<?php
$page_title = "Add/Edit a Faculty Item";
include_once "html-start.php";

$item_link = mysql_real_escape_string($_POST['item_link']);  
$item_title = mysql_real_escape_string($_POST['item_title']);  
$item_date = mysql_real_escape_string($_POST['item_date']);  
$item_location = mysql_real_escape_string($_POST['item_location']);  
$item_description = mysql_real_escape_string($_POST['item_description']);  
$item_subtype = mysql_real_escape_string($_POST['item_subtype']);  
$item_refereed = mysql_real_escape_string($_POST['item_refereed']);  
$item_peerreview = mysql_real_escape_string($_POST['item_peerreview']);  
$category_id = mysql_real_escape_string($_POST['category_id']);  

$faculty_id = $_REQUEST['faculty_id'];

//get logged in user; remove @UTA.EDU (last 8 characters) from end of string
$last_modified_user = substr($_SERVER['REMOTE_USER'], 0, -8);

//if the form has been submitted, perform database actions
if ($_REQUEST["Submit"] == "Submit") {

//if it's an existing item, update the database
if (isset($_REQUEST["item_id"])) {

$sql = "UPDATE items SET  item_link = '$item_link',  item_title = '$item_title',  item_date = '$item_date',  item_location = '$item_location',  item_description = '$item_description',  item_subtype = '$item_subtype',  item_refereed = '$item_refereed',  item_peerreview = '$item_peerreview',  category_id = '$category_id' WHERE item_id = '$_REQUEST[item_id]'" or die (mysql_error());
mysql_query($sql);
} //end if

//or if it's a new item, insert into database
else {
 $query = "INSERT INTO items ( item_link, item_title, item_date, item_location, item_description, item_subtype, item_refereed, item_peerreview, category_id )  VALUES ( '$item_link', '$item_title', '$item_date', '$item_location', '$item_description', '$item_subtype', '$item_refereed', '$item_peerreview', '$category_id' )"; 
 $result = mysql_query($query); 
  
if (!$result) 
  {
  print "There was a database error when executing <PRE>$sql</PRE>";
  print mysql_error();
  } //end if

//associate the new item with the faculty member, using the auto increment value (last_insert_id) from the previous query
 $query2 = "INSERT INTO faculty_items ( faculty_id, item_id )  VALUES ( '$faculty_id', LAST_INSERT_ID() )"; 
 $result2 = mysql_query($query2); 

if (!$result2) 
  {
  print "There was a database error when executing <PRE>$sql</PRE>";
  print mysql_error();
  } //end if  
  
}
//go back to the faculty member's page
header("Location: faculty.php?faculty_id=$faculty_id");  
}

//print the form
else {
//if it's an existing event, get event details
if (isset($_REQUEST["item_id"])) {
$sql = "SELECT * FROM items 
			  WHERE item_id = '$_REQUEST[item_id]'" or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());
$record = mysql_fetch_array ($result);
}
?>

<form id="form1" name="form1" method="post" action="">
<label for="item_link">Item Link</label><input type="text" value="<?php echo $record["item_link"]; ?>" name="item_link" id="item_link" />
<br class="clear" /> 
<label for="item_title">Item Title</label><input type="text" value="<?php echo htmlspecialchars($record["item_title"]); ?>" name="item_title" id="item_title" />
<br class="clear" /> 
<label for="item_date">Item Date</label><input type="text" value="<?php echo $record["item_date"]; ?>" name="item_date" id="item_date" />
<br class="clear" /> 
<label for="item_location">Item Location</label><input type="text" value="<?php echo $record["item_location"]; ?>" name="item_location" id="item_location" />
<br class="clear" /> 
<label for="item_description">Item Description</label><input type="text" value='<?php echo htmlspecialchars($record["item_description"]); ?>' name="item_description" id="item_description" />
<br class="clear" /> 
<label for="item_subtype">Item Subtype</label><input type="text" value="<?php echo $record["item_subtype"]; ?>" name="item_subtype" id="item_subtype" />
<br class="clear" /> 
<label for="item_refereed">Item Refereed</label><input type="text" value="<?php echo $record["item_refereed"]; ?>" name="item_refereed" id="item_refereed" />
<br class="clear" /> 
<label for="item_peerreview">Item Peerreview</label><input type="text" value="<?php echo $record["item_peerreview"]; ?>" name="item_peerreview" id="item_peerreview" />
<br class="clear" /> 
<label for="category_id">Category Id (enter a single number from the list below)</label><input type="text" value="<?php echo $record["category_id"]; ?>" name="category_id" id="category_id" />
<br class="clear" /> 
<?php
//get categories
$sql2 = "SELECT * FROM categories"
    		   or die (mysql_error());
$result2 = mysql_query($sql2, $conn) or die (mysql_error());
while ($record2 = mysql_fetch_array ($result2)) {
	
  echo $record2['category_id']." ".$record2['category_name'].", "; 
 }

?>
 <p><input type="submit" name="Submit" value="Submit" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php">cancel</a></p>
</form>
<?php } 
include_once "html-end.php";
?>
