<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['MEMBER_ID']);
	unset($_SESSION['SESS_MEMBER_LOGIN']);
	unset($_SESSION['SESS_ADMIN_LOGIN']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
	header("refresh:3;url=index.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Logged Out</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="icons/fav.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="icons/fav.ico" type="image/x-icon"> 
</head>
<body>
	<div class="content">
<h1>Logout </h1>
<p align="center">&nbsp;</p>
<h4 align="center" class="err">You have been logged out.</h4>
<p align="center">Click here to <a href="login-form.php">Login</a></p>
</div>
<?php include "footer.php"; ?>
</body>
</html>
