<?php
   require_once('auth.php')
   ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Rate Success</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="icons/fav.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="icons/fav.ico" type="image/x-icon"> 
</head>
<body>
<div class="content">

<?php 
		require_once('menu.php'); menu(); 
?>
<h1>Rate Success</h1>
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
	$rate=$_POST['rate'];
	$movieid=$_POST['movie_id'];
	
	$result = mysql_query('UPDATE rates SET rate = "'.$rate.'" WHERE user_id = '.$_SESSION['MEMBER_ID'].' AND movie_id = '.$movieid)
	or die(mysql_error());
	if (mysql_affected_rows()==0) {
        $result = mysql_query("INSERT INTO rates (`movie_id`, `user_id` , `rate` ) VALUES ('$movieid', '".$_SESSION['MEMBER_ID']."', '".$rate."')");
         echo '<br /><h3>You Rate it!</h3>';   
         echo '<h3>Thank you.</h3>';
    }
    else {
		echo '<br /><h3>Your rate was updated!</h3>';   
		echo '<h3>Thank you.</h3>';
	}
?>  
</div>
<?php include "footer.php"; ?>
</body>
</html>
