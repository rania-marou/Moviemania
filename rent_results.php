<?php
   require_once('auth.php')
   ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Rent Success</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="icons/fav.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="icons/fav.ico" type="image/x-icon"> 
</head>
<body>
<div class="content">	

<?php 
		require_once('menu.php'); menu(); 
?>
<h1>Rent Success</h1>
<?php 
     require_once('config.php');
//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Get all results as UTF-8
    mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'latin1', character_set_server = 'latin1'", $link)
	or die(mysql_error());
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	//Get all results as UTF-8
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'latin1', character_set_server = 'latin1'", $link)
	or die(mysql_error());
	
	//put the value of the searchform in sdata
	$movieid=$_POST['movie_id'];
	
	//Create query
	$qry="INSERT INTO rents (`movie_id`, `user_id` , `date` ) VALUES ('$movieid', '".$_SESSION['MEMBER_ID']."', '".date("Y/m/d H:i:s")."')";
	mysql_query($qry, $link) or die(mysql_error());
	echo '<br /><h3>You Rent it! Check your profile!</h3>';   
	echo '<h3>Thank you.</h3>';
	
	$qry="UPDATE movies SET availability = '0' WHERE id='".$movieid."' ";
	mysql_query($qry, $link) or die(mysql_error());
?>  
</div>
<?php include "footer.php"; ?>
</body>
</html>

