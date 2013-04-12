<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if($_SESSION['SESS_ADMIN_LOGIN'] == '0' || !isset($_SESSION['SESS_ADMIN_LOGIN'])) {
                header("location: access-denied.php");
                exit();
        }
?>
