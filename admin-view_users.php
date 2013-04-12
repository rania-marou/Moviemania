<?php
  require_once('admin.php');
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html 
xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Users</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="icons/fav.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="icons/fav.ico" type="image/x-icon"> 
</head>
<body>
	<div class="content">

<?php 
		require_once('menu.php'); menu(); 
?>
<h1>Users</h1>
	
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
	
	
	//Create query
	@$qry="SELECT * FROM users WHERE id LIKE '%$id%' AND username LIKE '%$username%' AND password LIKE '%$password%' AND root LIKE '%$root%' AND firstname LIKE '%$firstname%' AND lastname LIKE '%$lastname%'";  //LIMIT 0 , 5 
	$result=mysql_query($qry) or die(mysql_error());
	

	echo '<table>
		<tr>
			<td><b>Username</b></td>
			<td><b>Password</b></td>
			<td><b>Email</b></td>
			<td><b>Root</b></td>
			<td><b>Firstname</b></td>
			<td><b>Lastname</b></td>
			
		</tr>';

	//loop which shows the results in table
	while(@$users= mysql_fetch_array($result)) {
		echo '<tr>';
		echo '<td>'.$users['username'].'</td>';
		echo '<td>'.$users['password'].'</td>';
		echo '<td>'.$users['email'].'</td>';
		echo '<td>'.$users['root'].'</td>';
		echo '<td>'.$users['firstname'].'</td>';
		echo '<td>'.$users['lastname'].'</td>';
		
		echo '<td> <form name="edit" method="post" id="edit" action="admin-edit_user.php">
				<input type="hidden" name="id" id="id" value="'.$users['id'].'" />
		       <input type="image" src="icons/user_edit.png" value="Edit" />
		       </form>
		       </td>';
		   
		echo '<td> <form name="delete" method="post" id="delete" action="admin-delete_user_result.php">
				<input type="hidden" name="id" id="id" value="'.$users['id'].'" />
		       <input type="image" onclick="return confirm(\'Are you sure you want to delete this user?\')" src="icons/user_delete.png" value="Delete" />
		       </form>
		       </td>';
		       
	   echo '</tr>';
		      
	}
	
	echo '</table>'; //close the table
	echo '<br /> <br /> <td><a class="button" href="admin-add_user.php"><img class="menuicons"src="icons/user_add.png" />Add User </a>
	 </td>';
?>
</div>
<?php include "footer.php"; ?>
</body>
</html>

