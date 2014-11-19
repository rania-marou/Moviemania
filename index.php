<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!--[if IE]><script type="text/javascript" src="excanvas.js"></script><![endif]-->
<script type="text/javascript" src="coolclock.js"></script>
<script type="text/javascript" src="moreskins.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Home Page</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="icons/fav.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="icons/fav.ico" type="image/x-icon"> 
<script src="calendar/js/jscal2.js"></script>
<script src="calendar/js/lang/en.js"></script>
<link rel="stylesheet" type="text/css" href="calendar/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="calendar/css/border-radius.css" />
</head>
<body onload="CoolClock.findAndCreateClocks()">
	<div class="content">
<?php 
		require_once('menu.php'); menu(); 
?>
	
<h1>Home Page</h1>

<?php
    if(isset($_SESSION['SESS_MEMBER_LOGIN']) && $_SESSION['SESS_MEMBER_LOGIN'] =='1'){
        echo'<h2>Welcome '.$_SESSION['SESS_FIRST_NAME'].'</h2>';
        echo '<p>This is your Home Page!</p>';
    }    
    else
        echo'<h2>Welcome!</h2>';

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
    
    /* TOP RENTS */
    
    $qry="SELECT movies.id, movies.title, movies.year, movies.trailer, count(rents.movie_id) AS counter FROM rents, movies WHERE rents.movie_id=movies.id GROUP BY movie_id ORDER BY counter DESC LIMIT 0, 10";
	$result=mysql_query($qry) or die(mysql_error());
/*
    ♡♥❤★☆✩✯✰
*/
	echo '<div class="left"><br /><div class="topMovies">❤ Top 10 movie rents ❤</div>
	<table class="results" style="border:2px solid #19595C;">
			<tr><td colspan="4"></td></tr>
			<tr>
				<td><b>Trailer</b></td>
				<td><b>Title</b></td>
				<td><b>Year</b></td>
				<td style="text-align:center;"><b>Rents</b></td>
			</tr>';
			
	while($movie = mysql_fetch_array($result)) {
		echo '<tr>';
		echo '<td class="trailer"> <a href="'.$movie['trailer'].'"><img src="icons/trailer.png"></a> </td>';
		echo '<td><a href="view_movie.php?id='.$movie['id'].'">'.$movie['title'].'</a></td>';
		echo '<td>'.$movie['year'].'</td>';
		echo '<td style="text-align:center;">'.$movie['counter'].'</td>';
		echo '</tr>';
	}
	echo '</table></div>';
	
	/* TOP RATED */
	
	$qry="SELECT movies.id, movies.title, movies.year, movies.trailer, AVG(rate) as rate FROM rates, movies WHERE rates.movie_id=movies.id GROUP BY movies.id ORDER BY rate DESC LIMIT 0, 10";
	$result=mysql_query($qry) or die(mysql_error());
    
	echo '<div class="right"><br /><div class="topMovies">✩ Top 10 movie rates ✩</div>
	<table class="results" style="border:2px solid #19595C;">
			<tr><td colspan="4"></td></tr>
			<tr>
				<td><b>Trailer</b></td>
				<td><b>Title</b></td>
				<td><b>Year</b></td>
				<td style="text-align:center;"><b>Rate</b></td>
			</tr>';
			
	while($movie = mysql_fetch_array($result)) {
		echo '<tr>';
		echo '<td class="trailer"> <a href="'.$movie['trailer'].'"><img src="icons/trailer.png"></a> </td>';
		echo '<td><a href="view_movie.php?id='.$movie['id'].'">'.$movie['title'].'</a></td>';
		echo '<td>'.$movie['year'].'</td>';
		echo '<td style="text-align:center;">';
		printf("%.1f", $movie['rate']);
		echo '</td>';
		echo '</tr>';
	}
	echo '</table></div><div class="clear"></div>';
?>

</div>
<?php include "footer.php"; ?>
    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
              cont          : "calendar",
              bottomBar		: false,
              fdow          : 1,
              selectionType : Calendar.SEL_MULTIPLE,
      });
    //]]></script>
</body>
</html>
