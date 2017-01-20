<?php
$page_title = "Colleges, Schools, Departments";
include_once "html-start.php";
?>

<h2>Colleges and Schools</h2>
<table>
<tr>
<td>ID</td>
<td>Action</td>
<td>Name</td>
<td>Dean</td>
<td>Dean Title</td>
<td>Image</td>
</tr>

<?php
//get college info
$sql = "SELECT *
FROM colleges
ORDER BY college_name"
    		   or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());

while ($record = mysql_fetch_array ($result)) {
?>

  <tr>
    <td><?php echo $record['college_id']; ?></td>
    <td><a href="college.php?college_id=<?php echo $record['college_id'];?>">edit</a></td>   
    <td><?php echo $record['college_name']; ?></td>
    <td><?php echo $record['college_dean']; ?></td>
    <td><?php echo $record['college_dean_title']; ?></td> 
    <td><?php echo $record['college_img']; ?></td>
  </tr>
  
<?php
}
?>
</table>

<h2>Departments</h2>
<table>
<tr>
<td>ID</td>
<td>Action</td>
<td>Name</td>
<td>Chair</td>
<td>Chair Title</td>
<td>College ID</td>
</tr>

<?php
//get department info
$sql = "SELECT *
FROM departments
ORDER BY department_name"
    		   or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());

while ($record = mysql_fetch_array ($result)) {
?> 
  <tr>
    <td><?php echo $record['department_id']; ?></td>
    <td><a href="dept.php?department_id=<?php echo $record['department_id'];?>">edit</a></td>   
    <td><?php echo $record['department_name']; ?></td>
    <td><?php echo $record['department_chair']; ?></td> 
    <td><?php echo $record['department_chair_title']; ?></td>
    <td><?php echo $record['college_id']; ?></td>
  </tr>
<?php 
}
?>
</table>

<?php
include_once "html-end.php";
?>