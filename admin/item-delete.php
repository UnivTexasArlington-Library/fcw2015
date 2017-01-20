
<?php
$page_title = "Delete Item";
include_once "html-start.php";

$item_id = $_REQUEST['item_id'];
$faculty_id = $_REQUEST['faculty_id'];

#delete the item
$sql = "delete from items
      where item_id	= '$item_id'";
$result = mysql_query($sql, $conn);

if (!$result) 
 {
print "There was a database error when executing <PRE>$sql</PRE>";
print mysql_error();
exit;
 }
 
#delete the item/faculty association
$sql = "delete from faculty_items
      where item_id = '$item_id'";
$result = mysql_query($sql, $conn);

if (!$result) 
 {
print "There was a database error when executing <PRE>$sql</PRE>";
print mysql_error();
exit;
 }
 
//go back to the main page
header("Location: faculty.php?faculty_id=$faculty_id");