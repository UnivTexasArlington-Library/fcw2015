<?php
include_once("../db.php");
$college = $_POST['college'];
if ($college == 0) {
	$stmt = $db->prepare("SELECT department_name, departments.department_id, colleges.college_id, college_name FROM colleges, departments WHERE departments.college_id=colleges.college_id ORDER BY college_name, department_name");
				$stmt->execute();
}
else {
				$stmt = $db->prepare("SELECT department_name, departments.department_id, colleges.college_id, college_name FROM colleges, departments WHERE departments.college_id=colleges.college_id AND colleges.college_id=:college ORDER BY college_name, department_name");
				$stmt->execute(array(":college"=>$college));
		}
				$colcount = $stmt->rowCount();
				if ($colcount < 1) {
					$department = NULL;
					echo "<h4>There are no departments under this college or school.</h4>";
				}
					$currentcollege = '';
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					if ($currentcollege != $row['college_id']) {
						echo "<h3>" . $row['college_name'] . "</h3>";
					}
					echo "<div class='checkbox' value='" . $row['department_id'] . "'>
						
							<input type='checkbox' name='department[]' value='" . $row['department_id'] . "'"; 
							$id = $row['department_id'];
							//echo $id;
							//try to get department to stay checked after submitting
							//if(isset($department[$id])) echo "checked='checked'";
							echo "><label>"
							 . $row['department_name'] . "
						</label>
					</div>";
					$currentcollege = $row['college_id'];
				}
				?>