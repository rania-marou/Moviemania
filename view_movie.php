<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Movie Details</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="icons/fav.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="icons/fav.ico" type="image/x-icon"> 
</head>
<body>
	<div class="content">

<?php 
		require_once('menu.php'); menu(); 
?>
<h1>Movie Details</h1>

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
	
	
	$movieid=$_GET['id'];
	
	//Create query
	$qry="SELECT movies.*, genre.* FROM movies, genre WHERE movies.id='$movieid' AND movies.genres_id=genre.id";  //LIMIT 0 , 5 
	$result=mysql_query($qry) or die(mysql_error());
       if (mysql_num_rows($result) != 1){
                        echo '<p class="main">The movie does not exist.</p>';
                        exit();
                }
	$qry="SELECT AVG(rate) as rate FROM rates WHERE movie_id='$movieid'";
	$rateresult=mysql_query($qry) or die(mysql_error());
	$qry="SELECT * FROM rents WHERE movie_id='$movieid'";
	$statistic=mysql_query($qry) or die(mysql_error());
	
	
	$movie = mysql_fetch_array($result);
	echo '<table border="0" cellspacing="10">';
	    echo '<tr><td rowspan="11"><img alt="Cover" height="280" src="'.$movie['image'].'"></td></tr>';
		echo '<tr><td><b>Title</b>:</td><td>'.$movie['title'].'</td></tr>';
		echo '<tr><td><b>Year</b>:</td><td>'.$movie['year'].'</td></tr>';
		echo '<tr><td><b>Director</b>:</td><td>'.$movie['director'].'</td></tr>';
		echo '<tr><td><b>Actors</b>:</td><td>'.$movie['actors'].'</td></tr>';
		echo '<tr><td><b>Trailer</b>:</td><td><a href="'.$movie['trailer'].'">'.parse_url($movie['trailer'], PHP_URL_HOST).'</a></td></tr>';
		echo '<tr><td><b>Genre</b>:</td><td>'.$movie['genre_title'].'</td></tr>'; ;
        echo '<tr><td><b>Availability</b>:</td><td>';
			 if($movie['availability'] == '0')
				 echo 'No';
			 else
				 echo 'Yes';
			 echo '</td></tr>';
        echo '<tr><td><b>Usage Statistics</b>:</td><td>'.mysql_num_rows($statistic).'</td></tr>';
       
		$rate = mysql_fetch_array($rateresult); 
		if (is_null($rate['rate'])){
			$movierate = '--';
		} else { 
			$movierate = $rate['rate']; 
		}
		echo '<tr><td><b>Rate</b>:</td><td>'.$movierate.'</td></tr>';
	    
		if(isset($_SESSION['SESS_MEMBER_LOGIN']) && $_SESSION['SESS_ADMIN_LOGIN']=='0') {
		 echo '<td colspan="2">
		   <form method="post" name="Rent_It" id="Rent_It" action="rent_results.php"> ';
				if($movie['availability']==1) 
					echo '<a class="button" onclick="document.Rent_It.submit();"><img class="menuicons" src="icons/rentit.png"/>Rent It!</a>';    
                else
                    echo '<a class="button" style="cursor:default;"><img class="menuicons" src="icons/notavailable.png"/>Not Available!</a>';    
                    
				echo '<input name="movie_id" type="hidden" id="movie_id" value="'.$movieid.'" />
			</form>
			</td>';	
		}
		if(isset($_SESSION['SESS_ADMIN_LOGIN']) && $_SESSION['SESS_ADMIN_LOGIN']=='1') {
			echo '<td> <form name="edit" method="post" id="edit" action="admin-edit_movie.php">
			<input type="hidden" name="id" id="id" value="'.$movieid.'" />
			<a class="button" onclick="document.edit.submit();"><img class="menuicons" src="icons/movie_edit.png"/>Edit </a>
		       </form>
		       </td>';
			
			echo '<td> <form name="delete" method="post" id="delete" action="admin-delete_movie_result.php">
				<input type="hidden" name="id" id="id" value="'.$movieid.'" />
				<a class="button" onclick="if (confirm(\'Are you sure you want to delete this movie?\')) document.delete.submit(); else return false;"><img class="menuicons" src="icons/movie_delete.png"/>Delete </a>
				 </form>
				   </td>';
			}
		echo '</table>';	 
?>  
</div>
<?php include "footer.php"; ?>
</body>
</html>
