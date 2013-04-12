<?php
  require_once('admin.php');
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Add User</title>
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
	  document.add_user.submit();
}
</script>
<link rel="icon" href="icons/fav.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="icons/fav.ico" type="image/x-icon"> 
</head>
<body Onload="document.add_user.username.focus();">
<div class="content">	

<?php 
		require_once('menu.php'); menu(); 
?>
<h1>Add User</h1>
<form id="add_user" name="add_user" method="post" align="center" action="admin-add_user_result.php">
   <table>
		<tr>
			<td>Username : </td> 
			<td><input type="text" name="username" id="username" size="20" maxlength="50"/></td>
		</tr>
		<tr>
			<td>Password :</td>
			<td><input type="password" name="password" id="password" size="20" maxlength="50"/></td>
		</tr>
		<tr>
			<td>Email : </td>
			<td><input type="text" name="email" id="email" size="20" maxlength="50"/></td>
		</tr>
		<tr>
			<td>Firstname : </td>
			<td><input type="text" name="firstname" id="firstname" size="20" maxlength="50"/></td>
		</tr>
		<tr>
			<td>Lastname : </td>
			<td><input type="text" name="lastname" id="lastname" size="20" maxlength="50"/></td>
		</tr>
		<tr>
			<td>Administrator : </td>
			<td><select name="admin" id="admin">
			    <option value="0">No</option>
				<option value="1">Yes</option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td colspan="2" style="padding-top:20px;"><input onclick="return validate('add_user','email');" type="submit" style="visibility:hidden;"/>
				<a class="button" onclick="return validate('add_user','email');"><img class="menuicons" src="icons/user_add.png"/>Add User </a></td>
		</tr>												
	</table>
</form>
</div>
<?php include "footer.php"; ?>
</body>
</html>

