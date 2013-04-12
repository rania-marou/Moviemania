<?php
  require_once('admin.php');
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Add Movie</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="icons/fav.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="icons/fav.ico" type="image/x-icon"> 
</head>
<body Onload="document.add_movie.title.focus();">
	<div class="content">

<?php 
		require_once('menu.php'); menu(); 
?>
<h1>Add Movie</h1>
<?php		
echo '
<p>
<form id="add_movie" name="add_movie" method="post" align="center" action="admin-add_movie_result.php">
   <table>
		<tr>
			<td>Title : </td> 
			<td><input type="text" name="title" id="title" size="50" maxlength="50"/></td>
		</tr>
		<tr>
			<td>Year :</td>
			<td><input type="text" name="year" id="year" size="50" maxlength="50" onKeypress="if (event.keyCode < 44 || event.keyCode > 57 || event.keyCode==45 || event.keyCode==47) event.returnValue = false;"/></td>
		</tr>
		<tr>
			<td>Director : </td>
			<td><input type="text" name="director" id="director" size="50" maxlength="50"/></td>
		</tr>
		<tr>
			<td>Actors : </td>
			<td><input type="text" name="actors" id="actors" size="50" maxlength="50"/></td>
		</tr>
		<tr>
			<td>Trailer : </td>
			<td><input type="text" name="trailer" id="trailer" size="50" maxlength="50"/></td>
		</tr>
		<tr>
			<td>Image : </td>
			<td><input type="text" name="image" id="image" size="50" maxlength="50"/></td>
		</tr>
		 <tr>
			<td>Genre : </td>
			<td><select name="genres_id" id="genres_id">	';
			require_once('config.php');
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
			$genreqry = "SELECT * FROM genre";
			$result=mysql_query($genreqry) or die(mysql_error());
            while($genre = mysql_fetch_array($result)) {
				echo '<option value="'.$genre['id'].'">'.$genre['genre_title'].'</option>';
			}
            echo '</select>
			</td>
</tr>
		
		<tr>
		    <td colspan="2" style="padding-top:20px;"><input type="submit" style="visibility:hidden;"/>
				<a class="button" onclick="document.add_movie.submit();"><img class="menuicons" src="icons/movie_add.png"/>Add Movie </a></td>
		</tr>
	</table>
</form>
</p>';
?>
</div>
<?php include "footer.php"; ?>
</body>
</html>


