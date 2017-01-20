<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Faculty Creative Works</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../deploy/scripts/html5shiv.js"></script>
      <script src="../deploy/scripts/respond.min.js"></script>
    <![endif]-->
  </head>
<body> 

<?php
//replace collegeid and year here
$college = 6;
$year = 2013;
include("../db.php");
//CTRLF all nursing and replace with college name
//have to fix nav individually right now

$stmt1 = $db->prepare('SELECT college_name, college_dean, college_img FROM colleges WHERE colleges.college_id=:id');
$stmt1->execute(array(":id"=>$college));
while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
	$college_name = $row['college_name'];
	$college_dean = $row['college_dean'];
	$college_img = $row['college_img'];
}
?>

	<?php include("leftnav.php"); ?>
	<div id="collegenav" class="hidden-xs hidden-sm">
	<div class="navtable">
	<h2><?php echo $college_name; ?></h2>
	<h3>Dean <?php echo $college_dean; ?></h3>
	</div>
	</div>
		
	<div id="rightnav">
	<ul id="nav">
	<div id="topTitle"><?php echo $college_name; ?></div><li class="current nursing_nav"><a href="#topcollege" id="top"></a></li>
	<div id="facultyTitle">Nursing</div><li class="nursing_nav"><a href="#nursing_departments"  id="faculty"></a></li>
	</ul>
	<div id="arrow" class="hidden-xs">
	<div id="arrowtext" style="color:rgba(0,100,177,0.55);">
	Next
	</div>
	<a href="#">
	<img src="../images/blue-arrow.png">
	</a>
	</div>
	</div>	


	<div class="row" id="main">
      <div class="col-xs-10 pull-right" data-speed="4" data-type="background" >
      <div id="nursing_col">
      </div>
	<section id="topcollege">
		<div class="row">
			<h1 class='nursing collegehome'><?php echo $college_name; ?></h1>
	    </div>
	</section>




	<?php 

				echo '<section id="nursing_departments" data-speed="4" data-type="background">';
				echo "<div class='row main-nursing'><div class='col-xs-11'>";
				echo "<div class='depthead'>";
				echo "<div class='depttop'>";
				echo "<h2 class='hidden-xs hidden-sm'>Nursing</h2>";
			echo "<h2 class='smallcol visible-xs visible-sm'>" . $college_name . "</h2>";
			echo "<h3 class='smallcol visible-xs visible-sm'>Dean " . $college_dean . "</h3>";
				echo "</div>";
				echo "<div class='allfac'>";
			$stmt = $db->prepare("SELECT faculty.faculty_id, faculty_img, faculty_first_name, faculty_last_name, faculty_middle_name, faculty_item_types, faculty_link FROM faculty, items, faculty_items, departments, colleges WHERE faculty.faculty_id=faculty_items.faculty_id AND items.item_id=faculty_items.item_id AND faculty.college_id=colleges.college_id AND colleges.college_id=:id AND item_date = 2013 ORDER BY faculty_last_name, faculty.faculty_id");
		    	$stmt->execute(array(':id'=>$college));
		    	$facid = '';
		    	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		    		if ($row['faculty_id'] != $facid) {
	    		echo "<div class='imgdiv'>
	    		<div class='facimg'>
	    		<a data-toggle='modal' href='#modal" . $row['faculty_id'] . "'>";
	    		if ($row['faculty_img'] != NULL){
	    			echo "<img src='" . $row['faculty_img'] . "'>";
	    		}
	    		else {
	    			echo "<img src='../images/UTA-logo.png' class='uta_logo'>";
	    		}
	    		echo "</a>
	    		</div>
	    		<div class='faccaption'>
	    		<span><b><a data-toggle='modal' href='#modal" . $row['faculty_id'] . "'>" . $row['faculty_first_name'] . " " . $row['faculty_middle_name'] . " " . $row['faculty_last_name'] . "</a></b></span>";
	    		echo "</div>
	    		</div>";
	    		echo "<div class='modal fade ' id='modal" . $row['faculty_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myLargeModal' area-hidden='true'>
	    		<div class='modal-dialog modal-lg'>
	    		<div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>x</button><h3><a href='" . $row['faculty_link'] . "' target='_blank'>" . $row['faculty_first_name'] . " " . $row['faculty_middle_name'] . " " . $row['faculty_last_name'] . "</a></h3></div>";
	    		echo "<div class='modal-body'>";
				$stmt2 = $db->prepare("SELECT categories.category_id, item_title, item_description, category_name FROM items, faculty, faculty_items, categories WHERE items.item_id=faculty_items.item_id AND faculty.faculty_id=faculty_items.faculty_id AND items.category_id=categories.category_id AND faculty.faculty_id=:faculty AND item_date = :year ORDER BY category_name, item_title");
	    		$stmt2->execute(array(':faculty'=>$row['faculty_id'], ':year'=>$year));
	    		$catid = '';
	    		while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
	    			if ($catid != $row2['category_id']) {
	    				echo "<h4>" . $row2['category_name'] . "</h4>";
	    			}
					if ($row2['item_title'] != NULL) {
						echo "<h5>" . $row2['item_title'] . "</h5>";
					}
					if ($row2['item_description'] != NULL) {
						echo "<p>" . $row2['item_description'] . "</p>";
					}
					$catid = $row2['category_id'];
	    		}
	    		echo "</div></div>
	    		</div>
	    		</div>";
	    		}
	    		$facid = $row['faculty_id'];
	    	}
	    	echo "</div></div></div></section>";
	?>
		
    </div>

	</div>





    <!-- Bootstrap core JavaScript -->
    <!-- Placed at the end of the document so the pages load faster -->
   <script src="../deploy/scripts/jquery.min.js"></script>
    <script src="../deploy/scripts/app.min.js"></script>
   	<script src="../deploy/scripts/init.js"></script>
   	<script src="../deploy/scripts/jquery.nav.js"></script>
  <script>
   		$(document).ready(function() {

   		   	$("#nav").onePageNav({
   				changeHash:true,
   				end: function() {
   					//alert ("we ended");
   					$("#topTitle").hide();
   					$("#facultyTitle").hide();
   				}
   			});

		$("#top").hover( function() {
	//		 var winwidth = $(window).width();
//if (winwidth > 800) {
   	$("#topTitle").toggle('slide');
  // }
   	});
   	$("#faculty").hover( function() {
   	//	 var winwidth = $(window).width();
//if (winwidth > 800) {
   		$("#facultyTitle").toggle('slide');
  // 	}
   	});

	/*$("#top").on('click', function(e) {
		e.preventDefault();
		 var winwidth = $(window).width();
if (winwidth < 800) {
		$("#topTitle").show();
	}
	});
	$("#topTitle").click(function() {
			var top = $("#topcollege").offset().top;
			$("#faculty").removeClass('current');
			$('html,body').animate({
				scrollTop: top
			}, function() {
				$("#top").addClass('current');
				$("#topTitle").hide();
				$("#facultyTitle").hide();
			});
		});
   	$("#faculty").on('click', function(e) {
   		e.preventDefault();
   		$("#facultyTitle").show();
   	});
   	$("#facultyTitle").click(function() {
   				var top = $("#nursing_departments").offset().top;
	   			$("#top").removeClass('current');
	   			$('html,body').animate({
	   				scrollTop: top
	   			}, function() {
	   				$("#facultyTitle").hide();
	   				$("#topTitle").hide();
	   			});
   			});
*/
   		});
   	</script>
   	<script>
   		$(document).ready(function(){
   			var inner = $(window).height();
   			var winwidth = $(window).width();
	   		$("#nursing_departments").css("min-height", inner);
	   		$("#nursing_departments").each(function() {
	   			var thisdept = $(this).find('.depthead').height();
	   			var depttop = ($(this).find('.depttop').height()) + 17;
	   			var availheight = inner - depttop;
   				var count = $(this).find('.imgdiv').length;
   				var facwidth = $(this).find('.allfac').width();
   				var poswide = Math.floor(facwidth/170);
   				var poshigh = Math.floor(availheight/215);
   				if ((poshigh < 2) || (poswide < 3)) {

   				}
   				else {
   				var totalfit = (poswide * poshigh);
	   			if (count > totalfit) {
	   				//24 is height of the link itself
	   				var leftover = availheight - (poshigh * 215) - 24;  				
	   				$(this).find('.imgdiv:eq(' + (totalfit - 1) + ')').after('<div class="viewmore" style="margin-top:' + (leftover * .2) + 'px; margin-bottom: ' + (leftover * .8) + 'px"><a href="#" class="morelink">More</a></div>');
	   				//set the padding top based on the amount of available space left over
	   				var divsleft = count - totalfit;
	   				var poshigh = Math.floor(inner/215);
	   				var newtotalfit = (poswide * poshigh);
	   				var leftover = inner - (poshigh * 215);
	   				if (divsleft < newtotalfit) {
						var rows = Math.floor(divsleft / poswide);
	   					if ( rows < 1) {
	   						// one row
	   						var padbottom = inner - 215;
	   						$(this).find('.imgdiv:eq(' + (count - 1) + ')').css("padding-bottom", padbottom);
	   					}
	   					else {
	   						//more than one row
	   						var padbottom = inner - (215 * rows);
	   						$(this).find('.imgdiv:eq(' + (count - 1) + ')').css("padding-bottom", padbottom);

	   					}
	   				}
	   				else if (divsleft == newtotalfit) {
	   					var padbottom = inner - (215 * poshigh);
	   					$(this).find('.imgdiv:eq(' + (count - 1) + ')').css("padding-bottom", padbottom);
	   				}
	   				else {
	   				for (var i = 1; i < Math.ceil((count - totalfit)/(newtotalfit)); i++) {
	   				$(this).find('.imgdiv:eq(' + (totalfit + (newtotalfit*i) - 1) + ')').after('<div class="viewmore" style="padding-top:' + (leftover * .2) + 'px; padding-bottom: ' + (leftover * .8) + 'px"><a href="#" class="morelink">More</a></div>');
	   					newdivsleft = divsleft - (newtotalfit*i);
	   				if (newdivsleft < newtotalfit) {
	   					var emptyspace = newtotalfit - newdivsleft;
	   					var rows = Math.floor(newdivsleft / poswide);
	   					if ( rows < 1) {
	   						//one row
	   						var padbottom = inner - 215;
	   						$(this).find('.imgdiv:eq(' + (count - 1) + ')').css("padding-bottom", padbottom);
	   					}
	   					else {
	   						//more than one row
	   						var padbottom = inner - (215 * rows);
	   						$(this).find('.imgdiv:eq(' + (count - 1) + ')').css("padding-bottom", padbottom);
	   					}
	   				}//end if
	   				else if (newdivsleft == newtotalfit) {
	   					var padbottom = inner - (215 * poshigh);
	   					$(this).find('.imgdiv:eq(' + (count - 1) + ')').css("padding-bottom", padbottom);
	   				}
	   				}//end for
	   			}//end if
   				}//end if	
   			}
   			});
});
$(window).bind("resize scrollStop", function() {
	    		$('.viewmore').remove();
	    		$(".imgdiv").css("padding-bottom", 0);
	    		var inner = $(window).height();
	    		var winwidth = $(window).width();
	   		$("#nursing_departments").css("min-height", inner);
	   		$("#nursing_departments").each(function() {
	   			var thisdept = $(this).find('.depthead').height();
	   			var depttop = ($(this).find('.depttop').height()) + 17;
	   			var availheight = inner - depttop;
   				var count = $(this).find('.imgdiv').length;
   				var facwidth = $(this).find('.allfac').width();
   				var poswide = Math.floor(facwidth/170);
   				var poshigh = Math.floor(availheight/215);
   				if ((poshigh < 2) || (poswide < 3)) {

   				}
   				else {
   				var totalfit = (poswide * poshigh);
	   			if (count > totalfit) {
	   				//24 is height of the link itself
	   				var leftover = availheight - (poshigh * 215) - 24;  				
	   				$(this).find('.imgdiv:eq(' + (totalfit - 1) + ')').after('<div class="viewmore" style="margin-top:' + (leftover * .2) + 'px; margin-bottom: ' + (leftover * .8) + 'px"><a href="#" class="morelink">More</a></div>');
	   				//set the padding top based on the amount of available space left over
	   				var divsleft = count - totalfit;
	   				var poshigh = Math.floor(inner/215);
	   				var newtotalfit = (poswide * poshigh);
	   				var leftover = inner - (poshigh * 215);
	   				if (divsleft < newtotalfit) {
						var rows = Math.floor(divsleft / poswide);
	   					if ( rows < 1) {
	   						// one row
	   						var padbottom = inner - 215;
	   						$(this).find('.imgdiv:eq(' + (count - 1) + ')').css("padding-bottom", padbottom);
	   					}
	   					else {
	   						//more than one row
	   						var padbottom = inner - (215 * rows);
	   						$(this).find('.imgdiv:eq(' + (count - 1) + ')').css("padding-bottom", padbottom);

	   					}
	   				}
	   				else if (divsleft == newtotalfit) {
	   					var padbottom = inner - (215 * poshigh);
	   					$(this).find('.imgdiv:eq(' + (count - 1) + ')').css("padding-bottom", padbottom);
	   				}
	   				else {
	   				for (var i = 1; i < Math.ceil((count - totalfit)/(newtotalfit)); i++) {
	   				$(this).find('.imgdiv:eq(' + (totalfit + (newtotalfit*i) - 1) + ')').after('<div class="viewmore" style="padding-top:' + (leftover * .2) + 'px; padding-bottom: ' + (leftover * .8) + 'px"><a href="#" class="morelink">More</a></div>');
	   					newdivsleft = divsleft - (newtotalfit*i);
	   				if (newdivsleft < newtotalfit) {
	   					var emptyspace = newtotalfit - newdivsleft;
	   					var rows = Math.floor(newdivsleft / poswide);
	   					if ( rows < 1) {
	   						//one row
	   						var padbottom = inner - 215;
	   						$(this).find('.imgdiv:eq(' + (count - 1) + ')').css("padding-bottom", padbottom);
	   					}
	   					else {
	   						//more than one row
	   						var padbottom = inner - (215 * rows);
	   						$(this).find('.imgdiv:eq(' + (count - 1) + ')').css("padding-bottom", padbottom);
	   					}
	   				}//end if
	   				else if (newdivsleft == newtotalfit) {
	   					var padbottom = inner - (215 * poshigh);
	   					$(this).find('.imgdiv:eq(' + (count - 1) + ')').css("padding-bottom", padbottom);
	   				}
	   				}//end for
	   			}//end if
   				}//end if	
   			}
   			});
		});
   	</script>
   	<script>
   	$(document).ready(function() {
   		$(window).scroll(function() {
   			var heightoflastsection = $("section:last-of-type").height();
   			if($(window).scrollTop() + $(window).height() > $(document).height() - heightoflastsection) {
		   		$("#arrow").hide();
		   	}
		   	else {
		   		$("#arrow").show();
		   	}
   			var busHeight = $("#topcollege").height();
		   	//for ff
		   	var isFirefox = typeof InstallTrigger !== 'undefined'; 
   		if (isFirefox == true) {
		   	var docheight = $('html, body').scrollTop();
		   } else {
		   	//for chrome
		   	var docheight = document.body.scrollTop;
		   }
		   	
		   	if (docheight > busHeight) {
   				$("#collegenav").fadeIn(400).css("display", "table");
   			}
			else {
				$('#collegenav').fadeOut(400);
        	}
   		});
   	});

   
   	</script>
   			<script>
		$("#arrow").on('click', function(e) {
	   		e.preventDefault();
	   		var thishref = $('.nursing_nav.current').children('a').attr('href');
	   			if (thishref) {
	   		if ($(thishref).next('section').length > 0) {
	   			var next = $(thishref).next('section');
	   			var top = next.offset().top;
	   			$(thishref).removeClass('curr');
	   			$('html,body').animate({
	   				scrollTop: top
	   			}, function() {
	   				next.addClass('curr');
	   			});
	   		}
	   	}
	   	});
	</script>
				<?php include ("../deploy/scripts/custom.js"); ?>  

  </body>
</html>
