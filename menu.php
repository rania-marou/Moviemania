<?php
function menu() {
	echo '<div class="logo" ><a href="index.php"> <img src="images/logo.png"/></a></div><br />';
	@session_start();
	echo '<div class="menu"> ';
	echo '<a class="button" href="index.php"><img class="menuicons" src="icons/home_icon.png">Home Page</a>';
		
	echo '<a class="button" href="search_movie.php"><img class="menuicons" src="icons/search_movie.png">Search Movie</a>';

	if(isset($_SESSION['SESS_ADMIN_LOGIN']) && $_SESSION['SESS_ADMIN_LOGIN'] =='0') {
		
		echo '<a class="button" href="member-profile.php"><img class="menuicons" src="icons/myprofile.png">My Profile</a>';
		echo '<a class="button" href="movie_rent.php"><img class="menuicons" src="icons/rentamovie.png"> Rent A Movie</a>';
	}
	else if(isset($_SESSION['SESS_ADMIN_LOGIN']) && $_SESSION['SESS_ADMIN_LOGIN']=='1')	{
		echo '<a class="button" href="admin-view_users.php"><img class="menuicons" src="icons/admin-view_users.png">Users</a>';
		echo '<a class="button" href="admin-view_movies.php"><img class="menuicons" src="icons/movies.png"> Movies </a>';
	}
	if (isset($_SESSION['SESS_MEMBER_LOGIN']))
		echo '<a class="button" href="logout.php"> <img class="menuicons" src="icons/logout.png">Logout</a>';
	else
		echo '<a class="button" href="login-form.php"><img class="menuicons" src="icons/login.png">Login</a>';
	echo '</div>';
}
?>
