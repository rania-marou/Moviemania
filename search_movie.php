<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Search</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="icons/fav.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="icons/fav.ico" type="image/x-icon"> 
</head>
<body Onload="document.Search.title.focus();">
<div class="content">

<?php 
		require_once('menu.php'); menu(); 
?>
<h1>Search</h1>

<form id="search"  name="Search" method="post" align="center" action="search_results.php">
   <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
		<tr>
			<td nowrap="nowrap">Title : </td> 
			<td><input type="text" name="title" id="title" size="30" maxlength="50"/></td>
		</tr>
		<tr>
			<td nowrap="nowrap">Year : </td>
			<td><input type="text" name="year" onKeypress="if (event.keyCode < 44 || event.keyCode > 57 || event.keyCode==45 || event.keyCode==47) event.returnValue = false;" id="year" size="30" maxlength="50"/></td>
		</tr>
		<tr>
			<td nowrap="nowrap">Actor : </td>
			<td><input type="text" name="actors" id="actors" size="30" maxlength="50"/></td>
		</tr>
		<tr>
			<td nowrap="nowrap">Genre :
			</td>
			<?php
				echo '<td><select name="genres_id" id="genres_id">	';
				echo '<option value="all">All</option>';
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
				
			
				mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'latin1', character_set_server = 'latin1'", $link)
				or die(mysql_error());
				$genreqry = "SELECT * FROM genre";
				$result=mysql_query($genreqry) or die(mysql_error());
				while($genre = mysql_fetch_array($result)) {
					echo '<option value="'.$genre['id'].'">'.$genre['genre_title'].'</option>';
				}
				echo '</select></td>';
			?>
		</tr>
		<tr>
			<td colspan="2" style="padding-top:20px;"><a class="button" onclick="document.Search.submit();"><img class="menuicons" src="icons/search.png"/>Search </a></td>
		</tr>
	</table>
	<input type="submit" style="visibility:hidden;"/>
</form>

</div>
<?php include "footer.php"; ?>
</body>
</html>
