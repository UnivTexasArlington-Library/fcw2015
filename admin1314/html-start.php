<?php
include_once "db_fns.php";
include_once "db_connect.php";
?>
<html lang="en">
<head>
<!-- <meta charset="iso-8859-1"> -->
<meta charset="UTF-8">
<title><?php echo $page_title; ?></title>
<?php
//if it's the contents page, include form validation
if ($_SERVER['PHP_SELF'] == '/usmexicowar/admin/contents.php')
{
?>
<script language="JavaScript1.2" type="text/javascript">

function validForm(passForm){

	if(passForm.content_title.value == "" || passForm.content_title.value == null){
		//if the content title is not entered, send the following message to the user
		alert("Please enter a Title.")
		/*place the cursor in the Content Title field*/
		passForm.content_title.focus()
		return false
	}
	if(passForm.format_id.value == "" || passForm.format_id.value == 0){
		//if the format ID is not entered, send the following message to the user
		alert("Please enter a Format ID.")
		/*place the cursor in the Format ID field*/
		passForm.format_id.focus()
		return false
	}
	return true
}

</script>
<?php
}
?>
<?php
//if it's the biography page, include form validation
if ($_SERVER['PHP_SELF'] == '/usmexicowar/admin/biography.php')
{
?>
<script language="JavaScript1.2" type="text/javascript">

function validForm(passForm){
	//regular expression to match required date format
	re = /^(\d{4})-(\d{1,2})-(\d{1,2})$/;
	
    if(passForm.bio_birth_date.value != '' && !passForm.bio_birth_date.value.match(re)) {
      alert("Invalid Birth Date format: " + passForm.bio_birth_date.value);
      passForm.bio_birth_date.focus();
      return false;
    }
	 if(passForm.bio_death_date.value != '' && !passForm.bio_death_date.value.match(re)) {
      alert("Invalid Death Date format: " + passForm.bio_death_date.value);
      passForm.bio_death_date.focus();
      return false;
    }
	return true
}

</script>
<?php
}
?>
<style>
form label {
	float: left;
	max-width: 600px;
	margin-bottom: 5px;
	margin-top: 5px;
}
input {width:100%;}
.clear {
	display: block;
	clear: both;
	width: 100%;
	margin-bottom:10px;
}
td {padding:10px;vertical-align:top;border:1px solid #ccc;}
#form1 {max-width:600px;padding:10px;}
form p {width:100px;}

.download-csv {
	background-image: url("https://library-test.uta.edu/sites/default/files/default_images/Microsoft_Excel_2013_logo.svg_0.png"); 
	background-size: 20px 20px;
    background-repeat: no-repeat;	
	padding-left:24px;
}

.tooltip{
    display: inline;
    position: relative;
}


.tooltip:hover:after{
    background: #333;
    background: rgba(0,0,0,.8);
    border-radius: 5px;
    bottom: 26px;
    color: #fff;
    content: attr(title);
    left: 20%;
    padding: 5px 15px;
    position: absolute;
    z-index: 98;
    width: 220px;
	content: attr(title);
}

.tooltip:hover:before{
    border: solid;
    border-color: #333 transparent;
    border-width: 6px 6px 0 6px;
    bottom: 20px;
    content: "";
    left: 50%;
    position: absolute;
    z-index: 99;
}

</style>
</head>

<body>
<h1>Faculty Creative Works</h1>
<?php 
//if it's not the home page, print a breadcrumb trail
if ($_SERVER['PHP_SELF'] != '/fcw/admin/index.php')
{
?>
<p><a href="index.php">Home</a> > <?php echo $page_title; ?></p>
<?php
}
?>
<h2><?php echo $page_title; ?></h2>
