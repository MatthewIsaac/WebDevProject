<!--------w-----------

    Project
    Name: Matt Isaac
    Date: November 2023
    Description: Final Project for WEBDEV2

--------------------->

<?php

session_start();
include("connect.php");

/*if(isset($_POST['submit']) && !empty($_POST['submit']))
{
	$_SESSION['search'] = $_POST['search'];

	header("Location: search.php");
}
*/

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Fairlane Children's Centre</title>
		<link rel="stylesheet" href="p1styles1.css" />
	</head>

	<body>
		<main>
			<header>		
				<nav id="top" title="HeaderNav">
					<ul>
						<?php if(!isset($_SESSION['user_name'])): ?>
							<li><a href="login.php">Log In</a></li>
							<li><a href="signup.php">Sign Up</a></li>
						<?php elseif($_SESSION['admin_status'] === true): ?>
							<li><a href="logout.php">Log out</a></li>
							<li><a href="#"><?= $_SESSION['user_name']?></a></li>
							<li><a href="admin.php">View Admin Page</a></li>
						<?php else: ?>
							<li><a href="logout.php">Log out</a></li>
							<li><a href="#"><?= $_SESSION['user_name']?></a></li>
						<?php endif ?>
					</ul>
				</nav>
				<div id="searchButton">
					<a href="search.php">Search</a>
					<input id="search" type="text" />
					<button name="submit">Search</button>
				</div>
				<p>Welcome, <?= $_SESSION['user_name']?></p>
			</header>

			<div id="mainHeading">
				<h1>Fairlane Children's Centre</h1>
				<h2>Fundraising</h2>
			</div>

			<div id="horizontalNavBar">
				<ul>
					<li><a href="#">HOME</a></li>
					<li><a href="#">ABOUT US</a></li>
					<li><a href="year.php">FUNDRAISING</a></li>
					<li><a href="#">MEET THE TEAM</a></li>
					<li><a href="forum.php">FORUM</a></li>
				</ul>
			</div>

			<div id="verticalNavBar">
				<ul id="aboutUs">
					<li><a href="#">ABOUT US</a></li>
				</ul>

				<ul id="restOfList">
					<li><a href="#">DIRECTOR'S MESSAGE</a></li>
					<li><a href="#">MISSION STATEMENT</a></li>
					<li><a href="#">ACTIVITIES</a></li>
					<li><a href="#">STAFF</a></li>
					<li><a href="#">SITE CREDITS</a></li>
					<li><a href="forum.php">FORUM</a></li>
					<li><a href="#">CONTACT US</a></li>
					<li><a href="upload.php">File Upload</a></li>
				</ul>
			</div>

			<div id="youAreHere">
				<a href="#">Home</a>
				<p> About Us</p>
			</div>

			<div id="substance">
				<h2>About Us</h2>
				<p id="findOut"><b>Find out more about what we do with our fundraised money</b></p>
				<p>This is just filler text, I'll have to write something meaningful here later.</p>
				
				<div id="textWithImageFloatRight">
					<p> Maybe put some more stuff here and a picture. Upcoming fundraiser info?</p>
				</div>
				
				<nav id="links" title="Links">
					<ul>
						<li><a href="#">Director's Message</a></li>
						<li><a href="#">Mission Statement</a></li>
						<li><a href="#">Staff</a></li>
					</ul>
				</nav>
			</div>

			<footer>
				<nav id="layerOne" title="FirstFooterNav">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="#">Contact Us</a></li>
					</ul>
				</nav>

				<nav id="layerTwo" title="SecondFooterNav">
					<p>Copyright C 2023 <a href="index.php">Fairlane Children's Centre</a></p>
				</nav>

				<nav id="layerThree" title="ThirdFooterNav">
					<p>369 Fairlane Ave, Winnipeg, MB, R2Y 0B6</p>
					<a href="#">Map</a>
				</nav>
			</footer>
		</main>
	</body>
</html>
