<?php 
	session_start(); 
	include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Faculty Creative Works</title>

    <!-- Bootstrap core CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="deploy/scripts/html5shiv.js"></script>
      <script src="deploy/scripts/respond.min.js"></script>
    <![endif]-->
   <!--insert google analytics script-->
  </head>
<body data-spy="scroll"> 

	<div id="leftnav" class="hidden-sm hidden-xs">
	<a href="http://library.uta.edu/"><img src="images/Library-Logo-verticalWhite2.png" id="liblogo"></a><br/>

<!--Web menu-->
	<ul id="homenav">
	<li><a href="index.php">Faculty Creative <br />Works 2014</a></li>
	<li><a href="index.php#home">Colleges &amp; Schools,<br/> UTA Libraries</a></li>
	<li><a href="2013/index.php">FCW 2013</a></li>
    <li class="current"><a href="search.php">Search</a></li>
	</ul>
			

	</div>
	<div id="leftnav">
<div id="infoparent"><a href="2014/about.php" id="info"><span>i</span></a>
	<div id="infoText" class="hidden-xs hidden-sm"><a href="2014/about.php">About, Acknowledgments, &amp;  Contact</a></div></div>	<div id="shareparent">
	<a href="" id="share"><img src="images/share.png"></a>
	<div id="sharediv">
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://library.uta.edu/fcw/" data-count="none">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<div class="fb-share-button" data-href="http://library.uta.edu/fcw/2013/" data-width="60" data-type="button"></div>
		<script src="//platform.linkedin.com/in.js" type="text/javascript">
		  lang: en_US
		</script>
		<script type="IN/Share" data-url="http://library.uta.edu/fcw/"></script>
	</div>
	</div>
	</div>
	<div id='mobilemenu'>
	<a href="http://library.uta.edu/" class='visible-sm visible-xs'><img src="images/Library-Logo-verticalWhite2.png" id="liblogo"></a><br/>
<button type='button' class='navbar-toggle visible-sm visible-xs' data-toggle='collapse' data-target='#mobilenav'>
	<span class='icon-bar'></span>
    <span class='icon-bar'></span>
	<span class='icon-bar'></span>
</button>

<!--Mobile Menu-->
<div id="mobilenav" class="collapse">
	<a href="index.php">2014 Faculty Creative Works</a>
	<a href="index.php#home" class="active">Colleges &amp; Schools,<br/> UTA Libraries</a>
    <a href="2013/index.php">FCW 2013</a>
	<a href="search.php">Search</a>
	</div>
</div>
		<!--<div id="rightnav">
	<div id="arrow">
	<a href="#">
	<div id="arrowtext">
	Next
	</div>
	<img src="images/white-arrow.png">
	</a>
	</div>
	</div>
	-->

      
    <!-- Section #1 -->
	<section id="mainsection" data-speed="6" data-type="background">
			<div class="row">
			<div class='col-xs-10 pull-right' id="about">
	

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$valid = true;
	$year = 2013;
	if (empty($_POST['name'])) {
		//$nameErr = "First name is required";	
				//$valid = false;
		$name = NULL;
	}
	else {
		$_SESSION['name'] = $_POST['name'];
		$name = test_input($_SESSION['name']);
	if (preg_match('/[\^£$%&*()}{@#~?;<>,|=_+¬-]/', $name))
       	{
       		$nameErr = "Only letters and white space allowed"; 
					$valid = false;
       	}

	}
	if ($_POST['college'][0] == 0) {
		//$requestorErr = "Requestor type is required";
				//$valid = false;
		$college = NULL;
	}
	else {
		$_SESSION['college'] = $_POST['college'][0];
		$college = $_SESSION['college'];
	}

	if(empty($_POST['department'])) {
		$department = NULL;
		$countDepartment = $_SESSION['department'];
	} else {
		$_SESSION['department'] = $_POST['department'];
		$department = $_SESSION['department'];
		$_SESSION['department'] = count($department);
		$countDepartment = $_SESSION['department'];
	}

	if(empty($_POST['category'])) {
		$category = NULL;
		$countCategory = $_SESSION['category'];
	} else {
		$_SESSION['category'] = $_POST['category'];
		$category = $_SESSION['category'];
		$_SESSION['category'] = count($category);
		$countCategory = $_SESSION['category'];
	}

	if (($name == NULL) && ($college == NULL) && ($department == NULL) && ($category == NULL)) {
					echo "<h3>Please enter a search term</h3>";
			$valid = false;
	}
	if ($valid == true) {

		$sql = "SELECT * FROM colleges, departments, faculty, faculty_items, items, categories WHERE items.item_id=faculty_items.item_id AND faculty_items.faculty_id=faculty.faculty_id AND colleges.college_id = faculty.college_id AND items.category_id=categories.category_id "; 
		if ($department != NULL) {
			$sql .= "AND colleges.college_id=departments.college_id AND faculty.department_id=departments.department_id AND (";
			for ($m=1; $m < $countDepartment +1; $m++) {
			$valuem = $m -1;
			$searchm = $department[$valuem];
			if ($m > 1) {
				$sql .= " OR ";
			}
			$sql .= "departments.department_id = " . $searchm . "";
			}
			$sql .= ") ";
		}
		if ($college != NULL) {
			$sql .= "AND colleges.college_id=" . $college . " ";
		}
		if ($category != NULL) {
				$sql .= "AND (";
			for ($a=1; $a < $countCategory +1; $a++) {
			$valuea = $a -1;
			$searcha = $category[$valuea];
			if ($a > 1) {
				$sql .= " OR ";
			}
			$sql .= "categories.category_id = " . $searcha . "";
			}
			$sql .= ") ";
		}
		
		if ($name != NULL) {
			$sql .= "AND (faculty_first_name LIKE '%" . $name . "%' OR faculty_last_name LIKE '%" . $name . "%')";
		}
		$sql .= "ORDER BY faculty_last_name, faculty_first_name";

				//echo $sql;
if ($sql != NULL) {
		$stmt4 = $db->prepare($sql);
		$stmt4->execute();
echo "<div class='row'>
<div class='col-sm-10'>
<h2>Search Results</h2>
<div class='col-sm-4'><a href='#searchform' id='modsearch'>Modify your search</a></div>
<div class='depthead'>
";
$resultcount = $stmt4->rowCount();
if ($resultcount < 1) {
	echo "<h4>No results for this search. Try a different one.</h4>";
}
while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
			if ($row4['faculty_id'] != $facid) {
	    		echo "<div class='imgdiv'>
	    		<div class='facimg'>
	    		<a data-toggle='modal' href='#modal" . $row4['faculty_id'] . "'>";
	    		if ($row4['faculty_img'] != NULL){
	    			echo "<img src='" . $row4['faculty_img'] . "'>";
	    		}
	    		else {
	    			echo "<img src='images/UTA-logo.png' class='uta_logo'>";
	    		}
	    		echo "</a>
	    		</div>
	    		<div class='faccaption'>
	    		<span><b><a data-toggle='modal' href='#modal" . $row4['faculty_id'] . "'>" . $row4['faculty_first_name'] . " " . $row4['faculty_middle_name'] . " " . $row4['faculty_last_name'] . "</a></b></span>";
	    		echo "</div>
	    		</div>";
	    		echo "<div class='modal fade ' id='modal" . $row4['faculty_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myLargeModal' area-hidden='true'>
	    		<div class='modal-dialog modal-lg'>
	    		<div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>x</button><h3>" . $row4['faculty_first_name'] . " " . $row4['faculty_middle_name'] . " " . $row4['faculty_last_name'] . "</h3></div>";
	    		echo "<div class='modal-body'>";
				$stmt5 = $db->prepare("SELECT categories.category_id, item_title, item_description, category_name FROM items, faculty, faculty_items, categories WHERE items.item_id=faculty_items.item_id AND faculty.faculty_id=faculty_items.faculty_id AND items.category_id=categories.category_id AND faculty.faculty_id=:faculty ORDER BY category_name, item_title");
	    		/*$stmt5 = $db->prepare($sqlnew);*/
	    		$stmt5->execute(array(':faculty'=>$row4['faculty_id']));
	    		$catid = '';
	    		while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
	    			if ($catid != $row5['category_id']) {
	    				echo "<h4>" . $row5['category_name'] . "</h4>";
	    			}
					if ($row5['item_title'] != NULL) {
						echo "<h5>" . $row5['item_title'] . "</h5>";
					}
					if ($row5['item_description'] != NULL) {
						echo "<p>" . $row5['item_description'] . "</p>";
					}
					$catid = $row5['category_id'];
	    		}
	    		echo "</div></div>
	    		</div>
	    		</div>";
	    		}
	    		$facid = $row4['faculty_id'];
	    	}

echo "</div></div></div>";
}



	}
	else {
		echo "<h3>There was an error with your search, please try again</h3>";
		}

}
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = strip_tags($data);
	$data = filter_var($data, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	//$data = htmlspecialchars($data);
	return $data;	
}

?>

						<h2 id='searchform'>Search</h2>
			<form method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' role="form" class="form-horizontal">
			<div class="form-group<?php if ($nameErr != NULL) {echo " has-error";}?>">
			<label for="name" class="col-sm-2 control-label">First or Last Name: </label>
			<div class="col-sm-7">
			<input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
			<span class="help-block"><?php echo $nameErr ?></span>
			</div>
			<div class="col-sm-2 col-xs-6 col-xs-offset-5">
			<input type="submit" value="Search" class="btn btn-primary">
			</div>
			</div>
			  <h3>Filter by:</h3>


			<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" id="collegetitle">
          College or School
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
        <div class="form-group">
				<div class="col-xs-10">
					<select name="college[]" class="form-control" id="collegeselect">
					<option value='0'>Choose a college or school</option>
					<?php
					$stmt2 = $db->prepare("SELECT college_id, college_name FROM colleges ORDER BY college_id");
					$stmt2->execute();
					$options = $stmt2->fetchAll();
					foreach ($options as $option=>$innerArray) {
						 echo '<option value="' . $innerArray[0] . '"';
						 if ($college == $innerArray[0]) {
					        echo "selected";
					    	}
					    echo ">";
					    echo $innerArray[1];
						echo "</option>";
				}
					?>
					</select>
				</div>
			</div>
		<a href="" id="clearcol">Clear Selected</a>
      </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" id="deptTitle">
          Department
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse in">
      <div class="panel-body">
 			<div class="form-group">
				<div class="col-xs-10" id="departments">
				<?php 
				if ($college != NULL) {
				$stmt = $db->prepare("SELECT department_name, departments.department_id, colleges.college_id, college_name FROM colleges, departments WHERE departments.college_id=colleges.college_id AND colleges.college_id=:college ORDER BY college_name, department_name");
				$stmt->execute(array(":college"=>$college));
				$colcount = $stmt->rowCount();
				if ($colcount < 1) {
					$department = NULL;
					echo "<h4>There are no departments under this college or school.</h4>";
				}
				}
				else {
				$stmt = $db->prepare("SELECT department_name, departments.department_id, colleges.college_id, college_name FROM colleges, departments WHERE departments.college_id=colleges.college_id ORDER BY college_name, department_name");
				$stmt->execute();
				}
				$currentcollege = '';
				if (isset($_POST['department']))
    			{
		        foreach ($department as $selectedDept)
		            $selectedD[$selectedDept] = "checked";
		    	}
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					if ($currentcollege != $row['college_id']) {
						echo "<h3>" . $row['college_name'] . "</h3>";
					}
					else {
					}
					$id = $row['department_id'];
					echo "<div class='checkbox' value='" . $row['department_id'] . "'>
						
							<input type='checkbox' name='department[]' value='" . $row['department_id'] . "' "; 
							echo $selectedD[$id];
							echo "><label>"
							 . $row['department_name'] . "
						</label>
					</div>";
					$currentcollege = $row['college_id'];
				}
				?>
				</div>
			</div>
					<a href="" id="cleardept">Clear Selected</a>

    </div>
  </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" id="catTitle">
          Type of Creative Work
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        
			<div class="form-group<?php if ($firstnameErr != NULL) {echo " has-error";}?>">
			<div class="col-xs-10">
			<?php
			$stmt3 = $db->prepare("SELECT category_id, category_name FROM categories ORDER BY category_name");
			$stmt3->execute();
			 if (isset($_POST['category']))
    			{
		        foreach ($category as $selectedCat)
		            $selected[$selectedCat] = "checked";
		    }
			while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
				$id = $row3['category_id'];
				echo "<div class='checkbox' value='" . $row3['category_id'] . "'>
				
					<input type='checkbox' name='category[]' value='" . $row3['category_id'] . "' ";
					echo $selected[$id];
					echo "><label>" . $row3['category_name'] . "</label>
					</div>";
			}
			?>
			</div>
      		</div>
      				<a href="" id="cleartype">Clear Selected</a>
    </div>
  </div>
</div>

<div class="form-group">
<div class="col-xs-6 col-xs-offset-5">
<input type="submit" value="Search" class="btn btn-primary">
<br/>
</div>
		<a href="" id="clearall">Clear All</a>
</div>
			</form>

	</section>
    <!-- Bootstrap core JavaScript -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="deploy/scripts/jquery.min.js"></script>
    <script src="deploy/scripts/app.min.js"></script>
   	<script src="deploy/scripts/init.js"></script>
   	<script src="deploy/scripts/jquery.nav.js"></script>
   	<script>
   	$(document).ready(function() {
   		$("#clearall").on('click', function(e){
   			e.preventDefault();
   			$("input[name='department[]']").removeAttr('checked');
			$("#deptTitle").html("Department");   			
			$("input[name='category[]']").removeAttr('checked');
			$("#catTitle").html("Type of Work");
   			$("#collegeselect").prop('selectedIndex',0);
	 		$("#collegeselect").change();
   		});
   	$("#clearcol").on('click', function(e) {
	 	e.preventDefault();
	 	$("#collegeselect").prop('selectedIndex',0);
	 	$("#collegeselect").change();
	 });
   	   $("#cleardept").on('click', function(e){
   			e.preventDefault();
   			$("input[name='department[]']").removeAttr('checked');
			$("#deptTitle").html("Department");
   		});
   		$("#cleartype").on('click', function(e){
   			e.preventDefault();
   			$("input[name='category[]']").removeAttr('checked');
			$("#catTitle").html("Type of Work");
   		});
   		
   	$("#collegeselect").change( function() {
   		$("input[name='department[]']").removeAttr('checked');
		$("#deptTitle").html("Department");
		$("#deptTitle").removeClass("collapsed");
		$("#collapseTwo").addClass("in").css("height", "auto");
   		var currentcollege = $("#collegeselect option:selected").text();
   		$("#collegetitle").html("College or School: " + currentcollege);
   		var col = $("#collegeselect option:selected").val();
   		//alert (col);
   		var data = $.ajax({
   			type: "POST",
   			url: "departments.php",
   			data: {college:col},
   			dataType: "html"
   		});
   		data.done(function() {
   			//alert("Data saved ");
   		});
   		data.success(function(result) {
   			//alert (result);
   			$("#departments").html(result);
   		});
   		data.fail(function() {
   			//alert("failed");
   		});
   	if (currentcollege == "Choose a college or school") {
   		$("#collegetitle").html("College or School");
   	}
   	});
   	 	});
   	$(document).ready(function() {
		var currentcollege = $("#collegeselect option:selected").text();
		   		if (currentcollege != "Choose a college or school") {
   		$("#collegetitle").html("College or School: " + currentcollege);
   	}
   	   	else {
   		$("#collegetitle").html("College or School");
   	}
   	});	
   	$(document).ready(function() {
   		 $("#deptTitle").html("Department");
   		var selecteddepts = '';
   			 $("input[name='department[]']:checked").each(function() {
   			 	var seld = $(this).next("label").text();
			   	 if (selecteddepts == '') {
   			   	selecteddepts = seld;
   			   }
   			   else {
   			   	selecteddepts = selecteddepts + ", " + seld;
   			   }
   			});
			   	$("#deptTitle").html("Department: " +  selecteddepts);
   		//display checked depts and checked categories in top bar
   		$("#departments").on('click', "input[name='department[]']", function() {
   			  //$("#deptTitle").html("Department");
   		var selecteddepts = '';
   		//alert ($(this).val());
   			 $("input[name='department[]']:checked").each(function() {
   			 	var seld = $(this).next("label").text();
   			 	//alert ($(this).next("label").text());
			   	 if (selecteddepts == '') {
   			   	selecteddepts = seld;
   			   	console.log(selecteddepts);
   			   }
   			   else {
   			   	selecteddepts = selecteddepts + ", " + seld;
   			   }
   			});
   		$("#deptTitle").html("Department: " +  selecteddepts);
   	});
   		 $("#catTitle").html("Type of Work");
   		var selectedcats = '';
   			 $("input[name='category[]']:checked").each(function() {
   			 	var celd = $(this).next("label").text();
			   	 if (selectedcats == '') {
   			   	selectedcats = celd;
   			   }
   			   else {
   			   	selectedcats = selectedcats + ", " + celd;
   			   }
   			});
			   	$("#catTitle").html("Type of Work: " +  selectedcats);
   		//display checked depts and checked categories in top bar
   		

   		$("input[name='category[]']").click(function() {
   			     		 $("#catTitle").html("Type of Work");
   		var selectedcats = '';
   			 $("input[name='category[]']:checked").each(function() {
   			 	var celd = $(this).next("label").text();
			   	 if (selectedcats == '') {
   			   	selectedcats = celd;
   			   }
   			   else {
   			   	selectedcats = selectedcats + ", " + celd;
   			   }
   			});
			   	$("#catTitle").html("Type of Work: " +  selectedcats);
   	});
   	});
   	</script>
   	<script>	
   	 $("#arrow").hover(function() {
   		$("#arrowtext").toggle('slide');
   	});
	 $("#infoparent").hover(function() {
		$("#infoText").toggle('slide');
	});

      $("#shareparent").hover(function() {
      	var winwidth = $(window).width();
      	if (winwidth > 800) {
   		$("#sharediv").toggle('slide');
   		$("#share").animate({opacity:'1'},1);
   	}
   	});
   	$("#shareparent").mouseleave(function() {
   		$("#share").animate({opacity:'.4'},1);
   		$("#sharediv").hide();
   	});
       
     $("#share").click(function(e) {
     	         e.preventDefault();
      	var winwidth = $(window).width();
      	if (winwidth < 799) {
         $("#sharediv").toggle();
         $("#share").animate({opacity:'1'},1);
     }
      });
   	</script>
      <script>
     $(document).ready(function() {
         $(".facimg img").each(function() {
         $(this).bind('load', function() {
            var image = $(this);
            var theImage = new Image();
            theImage.src = image.attr("src");
            var imageWidth = theImage.width;
            var imageHeight = theImage.height;
            var ratio = parseInt(imageWidth) / parseInt(imageHeight);
         if (ratio > 1) {
            $(this).addClass("horizontalimg");
         }
         });
         });
         
      });
      
      $(document).ready(function() {
         var inwidth = $(".navbar-toggle").width();
         var leftwidth = $("#mobilemenu").width();
         var paddLeft = (leftwidth - inwidth - 15)/2;
         $("#mobilenav").css("margin-left", paddLeft);
         var winwidth = $(window).width();
         if (winwidth < 799) {

            var spaceleft = (winwidth * .02);
           var marLeft = 10 + 35 + 32 + spaceleft;
         $("#sharediv").css("left", marLeft);
         if (winwidth < 612) {
         var sharewid = $("#share").width();
         var marLeft = ((sharewid - 32)/2) + 35;
         $("#sharediv").css("left", marLeft);
         }
         } 

         if (winwidth < 612) {
         var sharewid = $("#share").width();
         var marLeft = ((sharewid - 32)/2) + 35;
         $("#sharediv").css("left", marLeft);
         }
         else if (winwidth < 799) {
            var spaceleft = (winwidth * .02);
           var marLeft = 10 + 35 + 32 + spaceleft;
         $("#sharediv").css("left", marLeft);
         }
         
         $(window).resize(function() {
         var inwidth = $(".navbar-toggle").width();
         var leftwidth = $("#mobilemenu").width();
         var paddLeft = (leftwidth - inwidth - 15)/2;
         $("#mobilenav").css("margin-left", paddLeft);
         var winwidth = $(window).width();
         if (winwidth < 799) {
            var spaceleft = (winwidth * .02);
           var marLeft = 10 + 35 + 32 + spaceleft;
         $("#sharediv").css("left", marLeft);
         if (winwidth < 612) {
         var sharewid = $("#share").width();
         var marLeft = ((sharewid - 32)/2) + 35;
         $("#sharediv").css("left", marLeft);
         }
         }
         if (winwidth < 612) {
         var sharewid = $("#share").width();
         var marLeft = ((sharewid - 32)/2) + 35;
         $("#sharediv").css("left", marLeft);
         }
         else if (winwidth < 799) {
            var spaceleft = (winwidth * .02);
           var marLeft = 10 + 35 + 32 + spaceleft;
         $("#sharediv").css("left", marLeft);
         }
          });
       });
      </script>
   	   	<script>
   $(document).ready(function() {
   		var inner = $(window).height();
   		$("#about").css("min-height",inner);
   		$(window).resize(function() {
   			var inner = $(window).height();
   			$("#about").css("min-height",inner);
   		});
   	});
   	</script>
   	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-16674574-4']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
  </body>
</html>