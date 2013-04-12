<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	
	//Connect to mysql server
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
	
	//Sanitize the POST values
	$login = $_POST['login'];
	$password = md5($_POST['password']);

	//If there are input validations, redirect back to the login form
	if($login == '' || $password == '') {
		session_write_close();
		header("location: login-failed.php");
		exit();
	}
	
	//Create query
	$qry="SELECT * FROM users WHERE username='$login' AND password='".$password."'";
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$user = mysql_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_LOGIN'] = "1";
			$_SESSION['SESS_ADMIN_LOGIN'] = $user['root'];
			$_SESSION['SESS_FIRST_NAME'] = $user['firstname'];
			$_SESSION['SESS_LAST_NAME'] = $user['lastname'];
			$_SESSION['MEMBER_ID'] = $user['id'];
			session_write_close();
			header("location: index.php");
			exit();
		}else {
			//Login failed
			header("location: login-failed.php");
         exit();
		}
	}else {
		die("Query failed");
	}
?>
