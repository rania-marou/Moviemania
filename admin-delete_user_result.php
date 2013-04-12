<?php
  require_once('admin.php');
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Delete User Result</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="icons/fav.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="icons/fav.ico" type="image/x-icon"> 
</head>
<body>
<div class="content">	

<?php 
		require_once('menu.php'); menu(); 
?>
<h1>Delete User Result</h1>
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
			
	if (isset($_POST['id']))
		  $id=$_POST['id'];
	else {
		  echo 'no user selected!';
		  exit();
	}
	
	 $qry="SELECT * FROM users WHERE id='".$_POST['id']."';";
        $result=mysql_query($qry);
        
        if($result) {
                if(mysql_num_rows($result) == 1) {
                        $user = mysql_fetch_assoc($result);
                }
        }else {
                die("No user selected");
        }
        
        /* check if there is at least one admin left */
        $checkResult=0;
        if($user['root'] == '1'){ //an o xristis einai diaxeiristis
                $checkQry="SELECT * FROM users WHERE root='1'"; //psakse olous tous root
                $checkResult=mysql_query($checkQry);
                if (mysql_num_rows($checkResult) == 1){
                        echo '<p class="main">Cannot delete this user, cause is the only admin.</p>';
                        exit();
                }
        }
	
		
	//Create query
	$qry="DELETE FROM users WHERE id='$id'";
	$result=mysql_query($qry) or die(mysql_error());

	echo'<b>The user has been deleted successfully</b>';
	
?>
</div>
<?php include "footer.php"; ?>
</body>
</html>
