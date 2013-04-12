<?php
  require_once('admin.php');
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edit User</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function validate(form_id,email) {
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   var address = document.forms[form_id].elements[email].value;
   if(reg.test(address) == false) {
      alert('Invalid Email Address');
      return false;
   }
   else
	  document.edit_user.submit();
}
</script>
<link rel="icon" href="icons/fav.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="icons/fav.ico" type="image/x-icon"> 
</head>
<body Onload="document.edit_user.username.focus();">

<div class="content">
<?php 
		require_once('menu.php'); menu(); 
?>
<h1>Edit User</h1>
<?php
	require_once('config.php');
	
	if (isset($_POST['id']) && $_POST['id'] != '')
		$id =$_POST['id'] ;
    else {
		echo 'ID required';
		exit();
    }
   	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}	
	
	//Get all results as UTF-8
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'latin1', character_set_server = 'latin1'", $link)
	or die(mysql_error());
		
	//Create query
	@$qry="SELECT * FROM users WHERE id='$id'"; 
	$result=mysql_query($qry) or die(mysql_error());
	
	$user = mysql_fetch_array($result);

	echo '
<form id="edit_user" name="edit_user" method="post" align="center" action="admin-edit_user_result.php">
   <table>
        <tr>
			<td><input type="hidden" name="id" id="id" value="'.$user['id'].'"/></td>
		</tr>
		<tr>
			<td>Username : </td> 
			<td><input type="text" name="username" id="username" value="'.$user['username'].'" size="20" maxlength="50" /></td>
		</tr>
		<tr>
			<td>Password : </td>
			<td><input type="password" name="password" id="password" value="" size="20" maxlength="50"/></td>
		</tr>
		<tr>
			<td>Email : </td>
			<td><input type="text" name="email" id="email" value="'.$user['email'].'" size="20" maxlength="50"/></td>
		</tr>
		<tr>
			<td>Firstname : </td>
			<td><input type="text" name="firstname" id="firstname" value="'.$user['firstname'].'" size="20" maxlength="50"/></td>
		</tr>
		<tr>
			<td>Lastname : </td>
			<td><input type="text" name="lastname" id="lastname" value="'.$user['lastname'].'" size="20" maxlength="50"/></td>
		</tr>
		<tr>
			<td>Administrator : </td>
			<td><select name="admin" id="admin">
			    <option value="0" ';
		if($user['root'] == '0')
			echo ' selected ';
		echo '>No</option>';
		echo '
				<option value="1"';
		if($user['root'] == '1')
			echo ' selected ';
		echo '>Yes</option>
				</select>
			</td>
		</tr>
		<tr>
		    <td colspan="2" style="padding-top:20px;"><input onclick="return validate(\'edit_user\',\'email\');" type="submit" style="visibility:hidden;"/>
				<a class="button" onclick="return validate(\'edit_user\',\'email\');"><img class="menuicons" src="icons/user_edit.png"/>Edit User </a></td>
		</tr>
	</table>
</form>';
?>
</div>
<?php include "footer.php"; ?>
</body>
</html>
