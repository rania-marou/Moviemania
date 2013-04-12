-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 23, 2011 at 12:49 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `videoclub`
--

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `genre_title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=greek AUTO_INCREMENT=6 ;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `genre_title`) VALUES
(1, 'Drama'),
(2, 'Comedy'),
(3, 'Action'),
(4, 'Thriller'),
(5, 'Animation');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `year` year(4) DEFAULT NULL,
  `director` varchar(100) CHARACTER SET latin1 NOT NULL,
  `actors` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `trailer` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `genres_id` int(10) unsigned DEFAULT NULL,
  `availability` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=greek AUTO_INCREMENT=28 ;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `year`, `director`, `actors`, `trailer`, `image`, `genres_id`, `availability`) VALUES
(1, 'The Shawshank Redemptions', 1994, 'Frank Darabont', ' Tim Robbins, Morgan Freeman and Bob Gunton', 'http://www.imdb.com/video/screenplay/vi882809625/', 'http://ia.media-imdb.com/images/M/MV5BMTM2NjEyNzk2OF5BMl5BanBnXkFtZTcwNjcxNjUyMQ@@._V1._SY317_.jpg', 1, 1),
(2, 'Immortals', 2011, 'Tarsem Singh', 'Henry Cavill, Mickey Rourke, John Hurt', 'http://www.imdb.com/video/imdb/vi4119502361/', 'http://2.bp.blogspot.com/-e5KqgzZXxqU/TrufF4KBZpI/AAAAAAAADqI/oW0JOsaa2mo/s1600/Immortals-Poster.jpeg', 3, 1),
(3, 'Jack and Jill', 2011, 'Dennis Dugan', 'Adam Sandler, Katie Holmes, Al Pacino', 'http://www.imdb.com/video/imdb/vi1576967193/', 'http://3.bp.blogspot.com/-QAH3G4v-rxo/TqWJh_MvO_I/AAAAAAAAAVg/-rMoW6gU_vk/s1600/jack-and-jill-movie.jpg', 2, 1),
(4, 'Puss in Boots', 2011, 'Chris Miller', 'Antonio Banderas, Salma Hayek, Zach Galifianakis', 'http://www.imdb.com/video/imdb/vi1870831129/', 'http://2.bp.blogspot.com/-AcN_ikcRK9o/TusgZrUPu6I/AAAAAAAABYc/teVuzwf1dx8/s1600/Puss-in-Boots-poster-2-384x600.jpg', 5, 1),
(5, 'The Twilight - Breakin Dawn', 2011, 'Bill Condon', 'Kristen Stewart, Robert Pattinson, Taylor Lautner', 'http://www.imdb.com/video/imdb/vi2052299801/', 'http://www.aboutmovies.org/sites/default/files/image_film_archive/twilight-breaking-dawn-poster1.jpg', 3, 1),
(6, 'Happy Feet 2', 2011, 'George Miller', 'Elijah Wood, Robin Williams, Pink', 'http://www.imdb.com/video/imdb/vi2726469145/', 'http://www.2810.gr/crete/images/2810photo/02/11142011162209.jpg', 5, 1),
(7, 'Tower Heist', 2011, 'Brett Ratner', 'Eddie Murphy, Ben Stiller, Casey Affleck', 'http://www.imdb.com/video/imdb/vi226663961/', 'http://www.movie-list.com/posters/big/zoom/towerheist.jpg', 3, 1),
(8, 'J.Edgar', 2011, 'Clint Eastwood', 'Leonardo DiCaprio, Armie Hammer, Naomi Watts', 'http://www.imdb.com/video/imdb/vi1849990169/', 'http://img1.ranker.com/list_img/48916/386855/full/j-edgar-movie-quotes.jpg?version=1320784455000', 1, 1),
(9, 'A Very Harold & Kumar 3D Christmas', 2011, 'Todd Strauss-Schulson', 'Kal Penn, John Cho, Neil Patrick Harris', 'http://www.imdb.com/video/imdb/vi975477785/', 'http://www.comingsoon.net/gallery/47174/A_Very_Harold___Kumar_3D_Christmas_2.jpg', 2, 1),
(10, 'In Time', 2011, 'Andrew Niccol', 'Justin Timberlake, Amanda Seyfried, Cillian Murphy', 'http://www.imdb.com/video/imdb/vi775265305/', 'http://www.sevenart.gr/dynamicpics/movies/poster/2054_in-time.jpg', 3, 1),
(11, 'The Descendants', 2011, 'Alexander Payne', 'George Clooney, Shailene Woodley, Amara Miller', 'http://www.imdb.com/video/imdb/vi402562585/', 'http://4.bp.blogspot.com/-kl_5OEzP7x8/Tdr0R4Yw_OI/AAAAAAAAAA4/OsFQcjAjq2o/s1600/The%2BDescendants%2BPoster.jpg', 2, 1),
(12, 'Inception', 2010, 'Christopher Nolan', 'Leonardo DiCaprio, Joseph Gordon-Levitt', 'http://www.imdb.com/video/imdb/vi4219471385/', 'http://trancemedia.files.wordpress.com/2011/02/inception-1.gif?w=624&h=876', 3, 1),
(13, 'How to Train Your Dragon', 2010, 'Dean DeBlois, Chris Sanders', 'Jay Baruchel, Gerard Butler, Christopher Mintz-Pla', 'http://www.imdb.com/video/imdb/vi1158218777/', 'http://2.bp.blogspot.com/_wFrWa3vPkHo/S7zyqQo-cJI/AAAAAAAAB8I/W83Ujg1h8Ss/s1600/how_to_train_your_dragon.jpg', 5, 0),
(14, 'Drive', 2011, 'Nicolas Winding Refn', 'Ryan Gosling, Carey Mulligan, Bryan Cranston', 'http://www.imdb.com/video/imdb/vi2772212761/', 'http://davidjrodger.files.wordpress.com/2011/10/drive-2011-movie-poster-ryan-gosling-in-this-very-cool-very-slick-american-indi-film.jpg?w=614&h=843', 1, 1),
(15, 'The Kings speech', 2010, 'Tom Hooper', 'Colin Firth, Geoffrey Rush, Helena Bonham Carter', 'http://www.imdb.com/video/imdb/vi806197529/', 'http://thefilmstage.com/wp-content/uploads/2010/11/the-kings-speech-poster.jpg', 1, 1),
(16, 'Black Swan', 2010, 'Darren Aronofsky', 'Natalie Portman, Mila Kunis, Vincent Cassel', 'http://www.imdb.com/video/imdb/vi1035245593/', 'http://impawards.com/2010/posters/black_swan.jpg', 1, 1),
(17, '50/50', 2011, 'Jonathan Levine', 'Joseph Gordon-Levitt, Seth Rogen, Anna Kendrick', 'http://www.imdb.com/video/imdb/vi3408305177/', 'http://impawards.com/2011/posters/fifty_fifty.jpg', 2, 1),
(18, 'Jodaeiye Nader az Simin', 2011, 'Asghar Farhadi', 'Peyman Moaadi, Leila Hatami and Sareh Bayat', 'http://www.imdb.com/video/imdb/vi2726140953/', 'http://www.impawards.com/intl/iran/2011/posters/nader_and_simin.jpg', 1, 1),
(19, 'Toy Story 3', 2010, 'Lee Unkrich', 'Tom Hanks, Tim Allen, Joan Cusack', 'http://www.imdb.com/video/imdb/vi3676898329/', 'http://upload.wikimedia.org/wikipedia/en/thumb/0/0e/Toy_story3_poster3-1-.jpg/405px-Toy_story3_poster3-1-.jpg', 5, 1),
(20, 'Warrior', 2011, 'Gavin O Connor', 'Tom Hardy, Nick Nolte, Joel Edgerton', 'http://www.imdb.com/video/imdb/vi3329989657/', 'http://www.enthunder.com/screenshot/ee7f/ee7fa010/Warrior-2011/Warrior-2011-cover.jpg', 3, 1),
(23, 'The Grey', 2012, 'Joe Carnahan', 'Liam Neeson, Dermot Mulroney, Frank Grillo', 'http://www.imdb.com/video/imdb/vi1014865433', 'http://collider.com/wp-content/uploads/the-grey-movie-poster-01.jpg', 1, 1),
(25, 'Anaconda', 1997, 'Luis Llosa', 'Jon Voight, Jennifer Lopez, Eric Stoltz', 'http://www.imdb.com/video/screenplay/vi2713059609/', 'http://wp.artemi.us/wp-content/uploads/2011/08/anaconda-original.jpg', 3, 1),
(26, 'Roman Holiday', 1953, 'William Wyler', 'Gregory Peck, Audrey Hepburn, Eddie Albert', 'http://www.imdb.com/video/screenplay/vi4098883609/', 'http://ecx.images-amazon.com/images/I/518EPG6E91L._SL500_AA300_.jpg', 2, 1),
(27, 'EuroTrip', 2004, 'Jeff Schaffer', 'Scott Mechlowicz, Jacob Pitts, Michelle Tracht', 'http://www.youtube.com/watch?v=SeoX8MZd81E', 'http://www.dvdsreleasedates.com/posters/800/E/EuroTrip-2004-movie-poster.jpg', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE IF NOT EXISTS `rates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `movie_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `rate` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=greek AUTO_INCREMENT=46 ;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `movie_id`, `user_id`, `rate`) VALUES
(5, 16, 8, 7),
(6, 16, 8, 7),
(7, 16, 8, 7),
(8, 16, 8, 7),
(9, 16, 8, 7),
(10, 16, 8, 7),
(11, 16, 8, 7),
(12, 16, 8, 7),
(13, 16, 8, 7),
(14, 16, 8, 7),
(15, 16, 8, 7),
(16, 16, 8, 7),
(17, 16, 8, 7),
(18, 16, 8, 7),
(19, 13, 8, 5),
(20, 13, 8, 5),
(21, 13, 8, 5),
(22, 13, 8, 5),
(23, 16, 8, 7),
(24, 13, 8, 5),
(25, 2, 8, 7),
(26, 7, 8, 8),
(27, 7, 8, 8),
(28, 7, 8, 8),
(29, 5, 8, 0),
(30, 4, 8, 6),
(31, 9, 8, 8),
(32, 3, 8, 4),
(33, 25, 3, 2),
(34, 10, 3, 6),
(35, 5, 3, 1),
(36, 9, 3, 10),
(37, 7, 3, 8),
(38, 3, 9, 4),
(39, 5, 9, 0),
(40, 8, 9, 8),
(41, 15, 9, 5),
(42, 19, 9, 6),
(43, 16, 9, 8),
(44, 2, 7, 5),
(45, 27, 7, 8);

-- --------------------------------------------------------

--
-- Table structure for table `rents`
--

CREATE TABLE IF NOT EXISTS `rents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `movie_id` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `return_date` datetime DEFAULT NULL,
  `returned` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=greek AUTO_INCREMENT=27 ;

--
-- Dumping data for table `rents`
--

INSERT INTO `rents` (`id`, `user_id`, `movie_id`, `date`, `return_date`, `returned`) VALUES
(1, 8, 16, '2011-12-12 23:22:08', '2011-12-20 16:19:35', 1),
(2, 8, 13, '2011-12-12 23:43:55', '2011-12-12 23:44:01', 1),
(3, 8, 2, '2011-12-12 23:44:09', '2011-12-15 20:08:54', 1),
(4, 8, 7, '2011-12-12 23:44:14', '2011-12-13 18:17:34', 1),
(5, 8, 9, '2011-12-12 23:44:19', '2011-12-13 18:20:32', 1),
(6, 8, 5, '2011-12-13 17:43:25', '2011-12-15 18:43:23', 1),
(7, 8, 4, '2011-12-13 17:43:59', '2011-12-15 20:08:58', 1),
(8, 8, 3, '2011-12-13 18:22:47', '2011-12-15 20:09:01', 1),
(9, 8, 2, '2011-12-15 18:43:08', '2011-12-15 20:08:54', 1),
(10, 8, 2, '2011-12-15 18:51:51', '2011-12-15 20:08:54', 1),
(11, 8, 16, '2011-12-15 20:10:18', '2011-12-20 16:19:35', 1),
(12, 8, 20, '2011-12-15 20:11:17', '2011-12-20 16:19:33', 1),
(13, 3, 5, '2011-12-20 16:14:41', '2011-12-20 16:15:02', 1),
(14, 3, 10, '2011-12-20 16:14:48', '2011-12-20 16:15:05', 1),
(15, 3, 25, '2011-12-20 16:14:56', '2011-12-20 16:15:08', 1),
(16, 3, 9, '2011-12-20 16:15:45', '2011-12-20 16:15:47', 1),
(17, 3, 7, '2011-12-20 16:16:42', '2011-12-20 16:16:45', 1),
(18, 3, 13, '2011-12-20 16:17:19', NULL, 0),
(19, 9, 3, '2011-12-20 16:17:34', '2011-12-20 16:18:20', 1),
(20, 9, 5, '2011-12-20 16:17:37', '2011-12-20 16:18:18', 1),
(21, 9, 8, '2011-12-20 16:17:42', '2011-12-20 16:18:15', 1),
(22, 9, 15, '2011-12-20 16:17:50', '2011-12-20 16:18:13', 1),
(23, 9, 19, '2011-12-20 16:17:55', '2011-12-20 16:18:11', 1),
(24, 9, 16, '2011-12-20 16:18:04', '2011-12-20 16:18:09', 1),
(25, 7, 2, '2011-12-20 16:23:32', '2011-12-20 16:23:46', 1),
(26, 7, 27, '2011-12-20 16:23:40', '2011-12-20 16:23:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET latin1 NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 NOT NULL,
  `email` varchar(60) NOT NULL DEFAULT 'user@videoclub.com',
  `root` tinyint(1) NOT NULL DEFAULT '0',
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=greek AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `root`, `firstname`, `lastname`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'rania@videoclub.com', 1, 'Ράνια', 'Μάρου'),
(2, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@videoclub.com', 0, 'Φώτης', 'Κόκκορας'),
(3, 'cuba', '827ccb0eea8a706c4c34a16891f84e7b', 'cuba@videoclub.com', 0, 'Κατερίνα', 'Πασχαλίδου'),
(7, 'george', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'george@videoclub.com', 0, 'Γιώργος', 'Βασιλάκος'),
(8, 'rania', 'd6bd4288dbcf5d2ae2053a35389e8c56', 'mrania@video.com', 0, 'Ράνια', 'Μαρουλακάκη'),
(9, 'giannis', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'giannis@videoclub.com', 0, 'Γιάννης', 'Σπανός');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
