<?php
$page_title = "Faculty by College/School, Department, or Name";
include_once "html-start.php";
?>
<h2>Faculty by College <span style="font-size:80%;font-weight:normal;">[<a href="coll-dept.php">update college/school/dept</a>]</span></h2>
<p>
<?php
//get colleges/schools
$sql = "SELECT * FROM colleges
		ORDER by college_name"
    		   or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());
$names = array();
while($record = mysql_fetch_array($result)) {
    $names[] = "<a href='faculty-list.php?college_id=".$record['college_id']."'>".$record['college_name']."</a>";
}

echo implode(', ', $names);
?>
</p>

<h2>Faculty by Department <span style="font-size:80%;font-weight:normal;">[<a href="coll-dept.php">update college/school/dept</a>]</span></h2>
<p>
<?php
//get departments
$sql = "SELECT * FROM departments
		ORDER by department_name"
    		   or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());
$names = array();
while($record = mysql_fetch_array($result)) {
    $names[] = "<a href='faculty-list.php?department_id=".$record['department_id']."'>".$record['department_name']."</a>";
}

echo implode(', ', $names);
?>
</p>

<h2>Faculty by Last Name <span style="font-size:80%;font-weight:normal;">[<a href="faculty-update.php">add new faculty member</a>]</span></h2>
<h2>ABCD</h2>
<p>
<?php
//get faculty
$sql = "SELECT * FROM faculty where faculty_last_name like 'A%' or faculty_last_name like 'B%' or faculty_last_name like 'C%' or faculty_last_name like 'D%'
		ORDER by faculty_last_name"
    		   or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());
$names = array();
while($record = mysql_fetch_array($result)) {
    $names[] = "<a href='faculty.php?faculty_id=".$record['faculty_id']."'>".$record['faculty_first_name']." ".$record['faculty_last_name']."</a>";
}

echo implode(', ', $names);
?>
</p>
<h2>EFGH</h2>
<p>
<?php
//get faculty
$sql = "SELECT * FROM faculty where faculty_last_name like 'E%' or faculty_last_name like 'F%' or faculty_last_name like 'G%' or faculty_last_name like 'H%'
		ORDER by faculty_last_name"
    		   or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());
$names = array();
while($record = mysql_fetch_array($result)) {
    $names[] = "<a href='faculty.php?faculty_id=".$record['faculty_id']."'>".$record['faculty_first_name']." ".$record['faculty_last_name']."</a>";
}

echo implode(', ', $names);
?>
</p>
<h2>IJKL</h2>
<p>
<?php
//get faculty
$sql = "SELECT * FROM faculty where faculty_last_name like 'I%' or faculty_last_name like 'J%' or faculty_last_name like 'K%' or faculty_last_name like 'L%'
		ORDER by faculty_last_name"
    		   or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());
$names = array();
while($record = mysql_fetch_array($result)) {
    $names[] = "<a href='faculty.php?faculty_id=".$record['faculty_id']."'>".$record['faculty_first_name']." ".$record['faculty_last_name']."</a>";
}

echo implode(', ', $names);
?>
</p>
<h2>MNOP</h2>
<p>
<?php
//get faculty
$sql = "SELECT * FROM faculty where faculty_last_name like 'M%' or faculty_last_name like 'N%' or faculty_last_name like 'O%' or faculty_last_name like 'P%'
		ORDER by faculty_last_name"
    		   or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());
$names = array();
while($record = mysql_fetch_array($result)) {
    $names[] = "<a href='faculty.php?faculty_id=".$record['faculty_id']."'>".$record['faculty_first_name']." ".$record['faculty_last_name']."</a>";
}

echo implode(', ', $names);
?>
</p>

<h2>QRST</h2>
<p>
<?php
//get faculty
$sql = "SELECT * FROM faculty where faculty_last_name like 'Q%' or faculty_last_name like 'R%' or faculty_last_name like 'S%' or faculty_last_name like 'T%'
		ORDER by faculty_last_name"
    		   or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());
$names = array();
while($record = mysql_fetch_array($result)) {
    $names[] = "<a href='faculty.php?faculty_id=".$record['faculty_id']."'>".$record['faculty_first_name']." ".$record['faculty_last_name']."</a>";
}

echo implode(', ', $names);
?>
</p>

<h2>UVWXYZ</h2>
<p>
<?php
//get faculty
$sql = "SELECT * FROM faculty where faculty_last_name like 'U%' or faculty_last_name like 'V%' or faculty_last_name like 'W%' or faculty_last_name like 'X%' or faculty_last_name like 'Y%' or faculty_last_name like 'Z%'
		ORDER by faculty_last_name"
    		   or die (mysql_error());
$result = mysql_query($sql, $conn) or die (mysql_error());
$names = array();
while($record = mysql_fetch_array($result)) {
    $names[] = "<a href='faculty.php?faculty_id=".$record['faculty_id']."'>".$record['faculty_first_name']." ".$record['faculty_last_name']."</a>";
}

echo implode(', ', $names);
?>
</p>

<?php
include_once "html-end.php";
?>