<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Search Results</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="icons/fav.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="icons/fav.ico" type="image/x-icon"> 
</head>
<body>
<div class="content">
<?php 
		require_once('menu.php'); menu(); 
?>
<h1>Search Results</h1>

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
	echo '<p> Searching for :' ;
	
	if (isset($_POST['title']) && $_POST['title'] != '') {
		$title = ' title  LIKE \'%' .$_POST['title'].'%\'' ;
		echo '<br />Title: '.$_POST['title'];
	}	
    else
		$title = ' 1 = 1';
    
    
    if (isset($_POST['year']) && $_POST['year'] != '') {
		$year = ' year = '.$_POST['year']; 
		echo '<br />Year: '.$_POST['year'];
	}
    else
		$year = ' 1 = 1';
	
	if (isset($_POST['actors']) && $_POST['actors'] != ''){
		$actors = ' actors  LIKE \'%' .$_POST['actors'].'%\'' ;
		echo '<br />Actors: '.$_POST['actors'];
	}
    else
		$actors = ' 1 = 1'; //dont mind if is empty
		
	if (isset($_POST['genres_id']) && $_POST['genres_id'] != 'all') {
		$genres_id = ' genres_id  ='.$_POST['genres_id'] ;
		$qry="SELECT * FROM genre WHERE id=".$_POST['genres_id'];
	    $result=mysql_query($qry) or die(mysql_error());
	    $genre = mysql_fetch_array($result);
		echo '<br />Genre: '.$genre['genre_title'];
	}	
    else
		$genres_id = ' 1 = 1';	
	
	//Get all results as UTF-8
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'latin1', character_set_server = 'latin1'", $link)
	or die(mysql_error());
	
	if(isset($_POST['page']))
        $page=$_POST['page'];
    else    
	    $page=1;
	
	//Create query
	$qry="SELECT * FROM movies WHERE $title AND $year AND $actors AND $genres_id";
	$result=mysql_query($qry) or die(mysql_error());
	$rows = mysql_num_rows($result);
	
	$qry="SELECT * FROM movies WHERE $title AND $year AND $actors AND $genres_id LIMIT ".($page*RESULTS_PER_PAGE-RESULTS_PER_PAGE).", ".RESULTS_PER_PAGE;
	$result=mysql_query($qry) or die(mysql_error());
	 
	 
	echo '</p>';
 if (mysql_num_rows($result)== 0){
	 echo '<br /> <br /> Your search had no results. Please try again.';
 }
 else {
	
	echo '<table class="results">
		<tr>
		    <td><b>Trailer</b></td>
			<td><b>Title</b></td>
			<td><b>Year</b></td>
		</tr>';

	//loop which shows the results in table
	while($movie = mysql_fetch_array($result)) {
		echo '<tr>';
		echo '<td class="trailer"> <a href="'.$movie['trailer'].'"><img src="icons/trailer.png"></a> </td>';
		echo '<td><a href="view_movie.php?id='.$movie['id'].'">'.$movie['title'].'</a></td>';
		echo '<td>'.$movie['year'].'</td>';
		echo '</tr>';
	}
	echo '<tr>
		<td colspan="3" style="text-align:center;padding-top:10px;vertical-align:middle;">
			<form method="post" name="page" id="page" action="search_results.php">';
				echo '<input type="hidden" name="page" id="page" value="'.$page.'"/>';
				echo '<input type="hidden" name="title" id="title" value="'.$_POST['title'].'"/>';
				echo '<input type="hidden" name="year" id="year" value="'.$_POST['year'].'"/>';
				echo '<input type="hidden" name="actors" id="actors" value="'.$_POST['actors'].'"/>';
				echo '<input type="hidden" name="genres_id" id="genres_id" value="'.$_POST['genres_id'].'"/>';
				if ($page > 1){
						echo'<input type="image" src="icons/left.png" onclick="document.page.page.value='.($page-1).'"/>';
					}
					
					$i=0;
					echo '<span style="padding:10px;position:relative;top:-8px;">';
					for($i=1;$i<=ceil($rows/RESULTS_PER_PAGE);$i++)
						if ($page == $i)
						    echo ' <b>'.$i.'</b> ';
						else
							echo ' <a href="#" style="text-decoration:underline;" onclick="document.page.page.value='.$i.';document.page.submit();">'.$i.'</a> ';				     
					echo '</span>';					
					
					if ($page < ceil($rows/RESULTS_PER_PAGE)){
						echo'<input type="image" src="icons/right.png" onclick="document.page.page.value='.($page+1).'"/>';
					}

			echo '</form>
		</td>
	</tr>';
 }
	echo '</table>'; //close the table
?>

</div>
<?php include "footer.php"; ?>
</body>
</html>
