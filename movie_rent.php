<?php
   require_once('auth.php')
   ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>View Movies</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="icons/fav.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="icons/fav.ico" type="image/x-icon"> 
</head>
<body>
<div class="content">
<?php 
		require_once('menu.php'); menu(); 
?>
<h1>View Movies</h1>

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
	
	if(isset($_GET['page']))
        $page=$_GET['page'];
    else    
	    $page=1;
	    
	//counting all the results for the pagination
	@$qry="SELECT * FROM movies";
	$result=mysql_query($qry) or die(mysql_error());
	$rows = mysql_num_rows($result);
	
	//Create query
	@$qry="SELECT * FROM movies LIMIT ".($page*RESULTS_PER_PAGE-RESULTS_PER_PAGE).", ".RESULTS_PER_PAGE; 
	$result=mysql_query($qry) or die(mysql_error());
	
	echo '<table class="results">
		<tr>
			<td><b>Trailer</b></td>
			<td><b>Title</b></td>
			<td><b>Year</b></td>
			
		</tr>';


	while(@$movie = mysql_fetch_array($result)) {
		echo '<tr>';
		echo '<td class="trailer"> <a href="'.$movie['trailer'].'" target="_blank"><img src="icons/trailer.png"></a> </td>';
		echo '<td><a href="view_movie.php?id='.$movie['id'].'">'.$movie['title'].'</a></td>';
		echo '<td>'.$movie['year'].'</td>';
		
      
		   echo '<td>
		   <form method="post" name="Rent_It" id="Rent_It" action="rent_results.php">
				';
				 if($movie['availability']==1)
                      echo '<input type="image" src="icons/rentit.png" name="Submit" value="Rent It!"/>';
                 else
                      echo '<img src="icons/notavailable.png"/>';
				echo '<input name="movie_id" type="hidden" id="movie_id" value="'.$movie['id'].'" />
			</form>
			</td>';
				echo '</tr>';
			}
		echo '<tr>
			<td colspan="4" style="text-align:center;padding-top:10px;vertical-align:middle;">
				<form method="get" name="page" id="page" action="movie_rent.php">';
					echo '<input type="hidden" name="page" id="page" value="'.$page.'"/>';
					
					
					if ($page > 1){
						echo'<input type="image" src="icons/left.png" onclick="document.page.page.value='.($page-1).'"/>';
					}
					
					$i=0;
					echo '<span style="padding:10px;position:relative;top:-8px;">';
					for($i=1;$i<=ceil($rows/RESULTS_PER_PAGE);$i++)
						if ($page == $i)
						    echo ' <b>'.$i.'</b> ';
						else
							echo ' <a href="movie_rent.php?page='.$i.'">'.$i.'</a> ';				     
					echo '</span>';					
					
					if ($page < ceil($rows/RESULTS_PER_PAGE)){
						echo'<input type="image" src="icons/right.png" onclick="document.page.page.value='.($page+1).'"/>';
					}
					
					
/*
					if ($page-RESULTS_PER_PAGE >= 0){
						echo'<input type="image" src="icons/left.png" onclick="document.page.page.value='.($page-RESULTS_PER_PAGE).'"/>';
					}
					echo '<span style="padding:10px;position:relative;top:-8px;">'.(ceil($page/RESULTS_PER_PAGE)+1).'/'.ceil($rows/RESULTS_PER_PAGE).'</span>';
					if ($page+RESULTS_PER_PAGE < $rows){
						echo'<input type="image" src="icons/right.png" onclick="document.page.page.value='.($page+RESULTS_PER_PAGE).'"/>';
					}
*/
				echo '</form>
			</td>
		</tr>';
	echo '</table>'; //close the table
?>
</div>
<?php include "footer.php"; ?>
</body>
</html>
