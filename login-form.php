<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Login Form</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="icons/fav.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="icons/fav.ico" type="image/x-icon"> 
</head>
<body Onload="document.loginForm.login.focus();">
	<div class="content">
	<?php
    
    require_once('menu.php'); menu();
    ?>
<form id="loginForm" name="loginForm" method="post" action="login-exec.php">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
      <td width="112"><b>Login</b></td>
      <td width="188"><input name="login" type="text" id="login" value="admin" /></td>
    </tr>
    <tr>
      <td><b>Password</b></td>
      <td><input name="password" type="password" id="password" value="admin" /></td>
    </tr>
    <tr>
      <td><input type="submit" style="visibility:hidden;"/></td>
      <td style="padding-top:20px;"><a class="button" onclick="document.loginForm.submit();"><img class="menuicons" src="icons/login.png"/>Login </a></td>
    </tr>
  </table>
</form>
</div>
<?php include "footer.php"; ?>
</body>
</html>
