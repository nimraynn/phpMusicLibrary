<?

/*

	phpMusicLibrary
	version 0.1

	@nimraynn (https://gibhub.com/nimraynn)

	index.php
	15/02/2017 13:28

*/

include_once 'includes/db_connect.php';     // Fetch our database connection
include_once 'includes/functions.php';      // Fetch our configuration & functions

// Start a PHP session
sec_session_start();

// Check if we are logged in
if (login_check($mysqli) == TRUE) {
	$logged = 'in';
} else {
	$logged = 'out';
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>phpMusicLibrary: Home</title>
	<link href="https://fonts.googleapis.com/css?family=Lato|Raleway" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div id="header">
		<h1><a href="index.php" id="sitetitle">phpMusicLibrary</a></h1>
		<ul>
			<li class="current">
				<a href="index.php">HOME</a>
			</li>
			<li>
				<a href="artists.php">ARTISTS</a>
			</li>
			<li>
				<a href="albums.php">ALBUMS</a>
			</li>
			<li>
				<a href="songs.html">SONGS</a>
			</li>
			<li>
				<?php if ($logged == 'in') : ?>
				<a href="../includes/logout.php">LOGOUT</a>
				<?php else : ?>
				<a href="login.php">LOGIN</a>
				<? endif; ?>
			</li>
		</ul>
	</div>
	<div id="body">
		<div id="home">
			<div class="content">
				<div>
					<h2>Welcome</h2>
					<ul class="services">
						<li>
							<img src="images/agent.jpg" alt="Image">
							<p>
								This is just a place holder, so you can see what the site would look like.
							</p>
						</li>
						<li>
							<img src="images/money.jpg" alt="Image">
							<p>
								This is just a place holder, so you can see what the site would look like.
							</p>
						</li>
						<li>
							<img src="images/flag.jpg" alt="Image">
							<p>
								This is just a place holder, so you can see what the site would look like.
							</p>
						</li>
						<li>
							<img src="images/report.jpg" alt="Image">
							<p>
								This is just a place holder, so you can see what the site would look like.
							</p>
						</li>
					</ul>
					<a href="services.html" class="more">Learn more</a>
				</div>
			</div>
			<div class="sidebar">
				<div>
					<?php if ($logged == 'in') : ?>
					<h2><?php echo htmlentities($_SESSION['username']); ?></h2>
					<h3>Welcome back <?php echo htmlentities($_SESSION['username']); ?>!</h3>
					<p>
						I'll add some personalised stuff here later.
					</p>
					<?php else : ?>
					<h2>Login</h2>
					<h3>Add a login box here</h3>
					<p>
						Add some registration details here
					</p>
					<?php endif; ?>
				</div>
				<div>
					<h2>Last.fm</h2>
					<ul>
						<li>
							<p>
								Try to add some last.fm functionality here. Try and clone your WordPress plugin.
							</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div id="body2">
		<div id="home2">
			<div id="content2">
				<h2>Latest</h2>
					<ul class="blog2">
						<li>
							<span><a href="album.php?artist=pink_floyd&album=dark_side_of_the_moon"><img src="images/artists/pink_floyd/dark_side_of_the_moon.jpg" alt="Image" id="albumthumb"></a></span>
							<div>
								<h3><a href="album.php?artist=pink_floyd&album=dark_side_of_the_moon">Dark Side of the Moon</a></h3>
								<span class="date2">PINK FLOYD - Released: 1 Mar 1973</span>
								<p>
									The Dark Side of the Moon is the eighth album by the English rock band Pink Floyd, released on 1 March 1973 by Harvest Records. The album built on ideas explored in earlier recordings and live shows, but lacks the extended instrumental excursions following the departure of founding member and principal contributor, Syd Barrett, in 1968 that characterised their earlier work. It thematically explores conflict, greed, the passage of time, and mental illness, the latter partly inspired by Barrett's deteriorating mental state.
								</p>
							</div>
						</li>
						<li>
							<span><a href="album.php?artist=pink_floyd&album=wish_you_were_here"><img src="images/artists/pink_floyd/wish_you_were_here.png" alt="Image" id="albumthumb"></a></span>
							<div>
								<h3><a href="album.php?artist=pink_floyd&album=wish_you_were_here">Wish You Were Here</a></h3>
								<span class="date2">PINK FLOYD - Released: 12 Sept 1975</span>
								<p>
									Wish You Were Here is the ninth studio album by the English rock band Pink Floyd, released on 12 September 1975 by Harvest Records in the United Kingdom and a day later by Columbia Records in the United States. Inspired by material the group composed while performing around Europe, Wish You Were Here was recorded during numerous recording sessions at Abbey Road Studios in London, England. Two of the album's four songs criticise the music business, another expresses alienation and the multi-part track "Shine On You Crazy Diamond" is a tribute to Syd Barrett, whose mental breakdown had forced him to leave the group seven years earlier after the release of the group's debut studio album The Piper at the Gates of Dawn. It was also lead writer Roger Waters's idea to split "Shine On You Crazy Diamond" into two parts and use it to bookend the album around three new compositions, introducing a new concept as the group had done with their previous album, The Dark Side of the Moon. As with The Dark Side of the Moon, the band used studio effects and synthesizers, and brought in guest singers to supply vocals on some tracks of the album. These singers were Roy Harper, who provided the lead vocals on "Have a Cigar", and the Blackberries, who added backing vocals to "Shine On You Crazy Diamond".
								</p>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
		<div>
			<a href="https://github.com/nimraynn/phpMusicLibrary" target="_blank" id="github">Github</a>
		</div>
		<p>
			&copy; Copyright 2017. All rights reserved.<br />Powered by <a href="https://github.com/nimraynn/phpMusicLibrary" target="_blank">phpMusicLibrary</a>
		</p>
	</div>
</body>
</html>