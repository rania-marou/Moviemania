<?php
	require_once('auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Member Profile</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
   function checkrate(num){
	   var val = document.getElementById(num).rate.value;
	   	   if(val == "-" ) {
		   alert("No rate selected!");
		   return false;
	   }
	   document.getElementById(num).submit();
	   return true;
   }
</script>

<link rel="icon" href="icons/fav.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="icons/fav.ico" type="image/x-icon"> 
</head>
<body>
<div class="content">

<?php 
	require_once('menu.php'); menu(); 
?>
<h1>My Profile</h1>
	<p>This is your profile!</p>
<?php 
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
	
	
	//Create query
	$qry="SELECT movies.* , rents.date FROM movies , rents  WHERE rents.returned='0' AND rents.user_id = '".$_SESSION['MEMBER_ID']."' AND rents.movie_id = movies.id GROUP BY movies.title ORDER BY rents.date DESC";
	$result=mysql_query($qry) or die(mysql_error());
	if(mysql_num_rows($result)>0) {
		echo '<table>
			<tr><td colspan="3"> <b>Movies to return : </b>
			</td>
			</tr>
			<tr>
				<td><b>Title</b></td>
				<td><b>Date</b></td>
				<td></td>	
			</tr>';

		//loop which shows the results in table
		while($movie = mysql_fetch_array($result)) {
			echo '<tr>';
			echo '<td><a href="view_movie.php?id='.$movie['id'].'">'.$movie['title'].'</a></td>';
			echo '<td>'.date("d/m/Y H:i", strtotime($movie['date'])).'</td>';
			echo '<td>
			   <form method="post" name="'.$movie['id'].'" id="'.$movie['id'].'" action="return_results.php">
					<a href="#" onclick="document.getElementById('.$movie['id'].').submit();"><img class="menuicons"src="icons/returnmovie.png" />Return It! </a>
					<input name="movie_id" type="hidden" id="movie_id" value="'.$movie['id'].'" />
				</form>
				</td>';
			echo '</tr>';
		}
		echo '</table>';
    }
    else 
        echo '<b><br />Not recent rental.</b>';
	
	//Create query
	$qry="SELECT movies.* , rents.return_date , rates.rate FROM movies , rents LEFT OUTER JOIN rates ON rates.user_id = rents.user_id AND rents.movie_id = rates.movie_id WHERE rents.returned='1' AND rents.user_id='".$_SESSION['MEMBER_ID']."' AND rents.movie_id=movies.id GROUP BY movies.id ORDER BY rents.return_date DESC";
	$result=mysql_query($qry) or die(mysql_error());
	if(mysql_num_rows($result)>0) {
	echo '<br /> <br /><table>
	    <tr><td colspan="2"> <b>Seen movies : </b>
	    </td>
	    </tr>
		<tr>
			<td><b>Title</b></td>
			<td><b>Return date</b></td>	
		</tr>';

	//loop which shows the results in table
	while($movie = mysql_fetch_array($result)) {
		echo '<tr>';
		echo '<td><a href="view_movie.php?id='.$movie['id'].'">'.$movie['title'].'</a></td>';
		echo '<td>'.date("d/m/Y H:i", strtotime($movie['return_date'])).'</td>';
		echo '<td>
		   <form method="post" name="'.$movie['id'].'" id="'.$movie['id'].'" action="rate_movie.php">
				<select name="rate" id="rate" >';
				echo '<option';
				   if(isset($movie['rate'])) echo ' selected ';
				         echo ' value="-">--</option>';
                 echo '<option ';
                    if($movie['rate'] == '0') echo ' selected ';
                         echo 'value="0">0</option>';
                 echo '<option ';
                    if($movie['rate'] == '1') echo ' selected ';
                         echo 'value="1">1</option>';        
				echo '<option ';
                    if($movie['rate'] == '2') echo ' selected ';
                         echo 'value="2">2</option>';
				echo '<option ';
                    if($movie['rate'] == '3') echo ' selected ';
                         echo 'value="3">3</option>';
				echo '<option ';
                    if($movie['rate'] == '4') echo ' selected ';
                         echo 'value="4">4</option>';
                echo '<option ';
                    if($movie['rate'] == '5') echo ' selected ';
                         echo 'value="5">5</option>';         
                echo '<option ';
                    if($movie['rate'] == '6') echo ' selected ';
                         echo 'value="6">6</option>';         
                echo '<option ';
                    if($movie['rate'] == '7') echo ' selected ';
                         echo 'value="7">7</option>';         
				echo '<option ';
                    if($movie['rate'] == '8') echo ' selected ';
                         echo 'value="8">8</option>';
				echo '<option ';
                    if($movie['rate'] == '9') echo ' selected ';
                         echo 'value="9">9</option>';
				echo '<option ';
                    if($movie['rate'] == '10') echo ' selected ';
                         echo 'value="10">10</option>';
				echo '</select>
		
				<a href="#" onclick="return checkrate('.$movie['id'].');"><img class="menuicons" src="icons/rate.png" />Rate It! </a>
				<input name="movie_id" type="hidden" id="movie_id" value="'.$movie['id'].'" />
			</form>
			</td>';
		echo '</tr>';
	}
	echo '</table>';
}
 else 
        echo '<b><br /> <br /> <br />Not seen movies.</b>';	
		
?>
</div>
<?php include "footer.php"; ?>
</body>
</html>
