<?php
  require_once('admin.php');
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edit User Results</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="icons/fav.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="icons/fav.ico" type="image/x-icon"> 
</head>
<body>
<div class="content">	

<?php 
		require_once('menu.php'); menu(); 
?>
<h1>Edit User Results</h1>
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
	
	//get the values	
	if (isset($_POST['username']) && $_POST['username'] != '')
		$username =$_POST['username'] ;
    else {
		echo 'Username required';
		exit();
    }
    
    if (isset($_POST['password']) && $_POST['password'] != '')
		$password = "password='".md5($_POST['password'])."', " ;
    else {
		$password='';
    }
	
	if (isset($_POST['email']) && $_POST['email'] != '')
		$email =$_POST['email'] ;
    else {
		echo 'E-mail required';
		exit();
    }
	
	if (isset($_POST['firstname']) && $_POST['firstname'] != '')
		$firstname =$_POST['firstname'] ;
    else {
		echo 'firstname required';
		exit();
    }
    
    if (isset($_POST['lastname']) && $_POST['lastname'] != '')
		$lastname =$_POST['lastname'] ;
    else {
		echo 'Lastname required';
		exit();
    }
	
	if (isset($_POST['admin']) && $_POST['admin'] != '')
		$admin =$_POST['admin'] ;
    else {
		echo 'Privilages required';
		exit();
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
        
        
        $checkResult=0;
         if($user['root'] == '1' && $_POST['admin'] == '0') { //an o xristis einai diaxeiristis k twra ton kanw mi diaxxeiristi
                $checkQry="SELECT * FROM users WHERE root='1'"; //psakse olous tous root
                $checkResult=mysql_query($checkQry);
                if (mysql_num_rows($checkResult) == 1){
                        echo '<p class="main">Cannot edit this user, cause is the only admin.</p>';
                        exit();
                }
        }
	
	//Create query
	$qry="UPDATE users SET username='$username' , $password email='$email' , root='$admin' , firstname='$firstname' , lastname='$lastname' WHERE id='$id' " ; 
	$result=mysql_query($qry) or die(mysql_error());

	echo'<b>The following user has been edited successfully</b>';
	echo '<table>
		<tr>
			<td>Username :</td>
			<td>'.$username.'</td>
		</tr>
		<tr>
			<td>Name :</td>
			<td>'.$firstname.' '.$lastname.'</td>
		</tr>
		<tr>
			<td>Email :</td>
			<td>'.$email.'</td>
		</tr>
	</table>'; //close the table
?>
</div>
<?php include "footer.php"; ?>
</body>
</html>
