<?php
$page_title = "Faculty Member";
include_once "html-start.php";

$faculty_id = $_REQUEST['faculty_id'];  

//get faculty member info
$sql = "SELECT *
FROM faculty
WHERE faculty_id = '$faculty_id'"
    		   or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());

//print summary of faculty info
if ($record = mysql_fetch_array ($result)) {
?>
<table>
<tr>
<td>ID</td>
<td>Action</td>
<td>Prefix</td>
<td>First Name</td>
<td>Middle Name</td>
<td>Last Name</td>
<td>Suffix</td>
<td>Title</td>
</tr>

  <tr>
    <td><?php echo $record['faculty_id']; ?></td>
    <td><a href="faculty-update.php?faculty_id=<?php echo $faculty_id;?>">edit</a> | <a href="faculty-delete.php?faculty_id=<?php echo $faculty_id;?>" onclick="return confirm('ARE YOU SURE you want to delete this faculty member?');">delete</a></td>   
    <td><?php echo $record['faculty_prefix']; ?></td>
    <td><?php echo $record['faculty_first_name']; ?></td>
    <td><?php echo $record['faculty_middle_name']; ?></td> 
    <td><?php echo $record['faculty_last_name']; ?></td>
    <td><?php echo $record['faculty_suffix']; ?></td> 
    <td><?php echo $record['faculty_title']; ?></td>

  </tr>
</table>

<?php	
echo "<h2>Items for ".$record['faculty_first_name']." ".$record['faculty_last_name']." <span style='font-size:80%;font-weight:normal;'>[<a href='items.php?faculty_id=$faculty_id'>add an item</a>]</span></h2>";
}
?>
<table>
<tr>
<td>ID</td>
<td>Action</td>
<td>Date</td>
<td>Category</td>
<td>Title</td>
</tr>

<?php
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

//print all items for faculty member
while ($record = mysql_fetch_array ($result)) {
?> 
  <tr>
    <td><?php echo $record['item_id']; ?></td>
    <td><a href="items.php?item_id=<?php echo $record['item_id'];?>&amp;faculty_id=<?php echo $faculty_id;?>">edit</a> | <a href="item-delete.php?item_id=<?php echo $record['item_id'];?>&amp;faculty_id=<?php echo $faculty_id;?>" onclick="return confirm('ARE YOU SURE you want to delete this item?');">delete</a></td>   
    <td><?php echo $record['item_date']; ?></td>
    <td><?php echo $record['category_name']; ?></td> 
    <td><?php echo $record['item_title']; ?></td>
  </tr>
<?php 
}
?>
</table>

<?php
include_once "html-end.php";
?>