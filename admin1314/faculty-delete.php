
<?php
$page_title = "Delete Faculty Member";
include_once "html-start.php";

$faculty_id = $_REQUEST['faculty_id'];

//get all items for faculty member
$sql = "SELECT items.*, categories.category_name
FROM items, faculty_items, faculty, categories
WHERE faculty.faculty_id = faculty_items.faculty_id 
AND faculty_items.item_id = items.item_id 
AND categories.category_id = items.category_id
AND faculty.faculty_id = '$faculty_id'
ORDER BY item_date DESC, category_name, item_id DESC"
    		   or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());

//if there are items associated with faculty member, print error message
if ($record = mysql_fetch_array ($result)) {
	?>
<p>There are <a href="faculty.php?faculty_id=<?php print $faculty_id;?>">items associated with the faculty member</a>. These items must be deleted before you can delete the faculty member record.</p>
<?php
}

else {
#if there are no more associated items, delete the faculty member
$sql = "delete from faculty
      where faculty_id	= '$faculty_id'";
$result = mysql_query($sql, $conn);

if (!$result) 
 {
print "There was a database error when executing <PRE>$sql</PRE>";
print mysql_error();
exit;
 }
 //go back to the main page
header("Location: index.php");
}
 
