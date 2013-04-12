<?php
  require_once('admin.php');
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Add Movie Results</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="icons/fav.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="icons/fav.ico" type="image/x-icon"> 
</head>
<body>
<div class="content">	

<?php 
		require_once('menu.php'); menu(); 
?>
<h1>Add Movie Results</h1>
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
	if (isset($_POST['title']) && $_POST['title'] != '')
		$title =$_POST['title'] ;
    else {
		echo 'Title required';
		exit();
    }
    //fill the gaps of a wrong year
    if (isset($_POST['year']) && $_POST['year'] != '')
		$year =$_POST['year'] ;
   
	
	if (isset($_POST['director']) && $_POST['director'] != '')
		$director =$_POST['director'] ;
    else {
		echo 'Director required';
		exit();
    }
	
	if (isset($_POST['actors']) && $_POST['actors'] != '')
		$actors =$_POST['actors'] ;
   
    
    if (isset($_POST['trailer']) && $_POST['trailer'] != '')
		$trailer =$_POST['trailer'] ;
  
	
	if (isset($_POST['image']) && $_POST['image'] != '')
		$image=$_POST['image'] ;
		
	if (isset($_POST['genres_id']) && $_POST['genres_id'] != '')
		$genres_id=$_POST['genres_id'] ;
	
	if (isset($_POST['availability']) && $_POST['availability'] != '')
		$availability=$_POST['availability'] ;		
  
    
	//Get all results as UTF-8
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'latin1', character_set_server = 'latin1'", $link)
	or die(mysql_error());
	
	//Create query
	@$qry="INSERT INTO `movies`(`title`, `year`, `director`, `actors`, `trailer`, `image` , `genres_id`,  `availability`) VALUES ('$title' , '$year' , '$director' ,'$actors','$trailer','$image','$genres_id','1')"; 
	$result=mysql_query($qry) or die(mysql_error());

	echo'<b>The following movie has been added successfully</b>';
	echo '<table>
		<tr>
			<td>Title:</td>
			<td>'.$title.'</td>
		</tr>
		<tr>
			<td>Year :</td>
			<td>'.$year.'</td>
		</tr>
		<tr>
			<td>Director :</td>
			<td>'.$director.'</td>
		</tr>
		<tr>
			<td>Actors :</td>
			<td>'.$actors.'</td>
		</tr>
		<tr>
			<td>Trailer :</td>
			<td>'.$trailer.'</td>
		</tr>
		<tr>
			<td>Image :</td>
			<td>'.$image.'</td>
		</tr>
		
	</table>';//close the table
?>
</div>
<?php include "footer.php"; ?>
</body>
</html>

