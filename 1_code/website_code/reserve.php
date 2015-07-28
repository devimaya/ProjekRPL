<?php
	session_name("attemptReserve");
	if (!session_start()) { die('Could not start session.'); }
	if (!require_once 'management.php') { die('Could not require management.'); }

	/* If COOKIE-login is still in effect remove it.
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-3600);
	}*/

// Reserve spot method
	if (!empty($_POST['startdate']) && !empty($_POST['enddate']) && !empty($_POST['starttime']) && !empty($_POST['endtime']) && !empty($_POST['car']) && !empty($_POST['phonenumber'])) {
		$email = "mattbrazza@gmail.com";
		$reserveID = reserve_spot($_POST['startdate'],$_POST['enddate'],$_POST['starttime'],$_POST['endtime'],$_POST['car'],$_POST['phonenumber'],$email);
		if (!$reserveID) {
			die('<br/>Could not create reservation ' . mysql_error());
		}
	}
?>

<!-- <!DOCTYPE html> -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!-- <html lang="en"> -->
<head>
	<title>Register</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/jquery-1.7.1.min.js"></script>
	<script src="js/superfish.js"></script>
<!--[if lt IE 8]>
	<div style=' clear: both; text-align:center; position: relative;'>
	<a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
		<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
	</a>
	</div>
<![endif]-->
<!--[if lt IE 9]>
	<script src="js/html5.js"></script>
	<link rel="stylesheet" href="css/ie.css">
<![endif]-->
</head>
<body>
<!-- Header -->
<header>
	<div class="inner">
		<h1 class="logo"><a href="home.html">Fit-A-Lot</a></h1>
	</div>
	<nav>
		<ul class="sf-menu">
			<li><a href="home.html">Home</a></li>
			<li><a href="account.php">Account</a>
				<ul>
				<li><a href="register.php">Register</a></li>
				<li><a href="account.php">Log-In</a></li>
				<li><a href="#">Account Info</a> <!-- account_edit.php -->
					<ul>
					<li><a href="#">Edit Account</a></li> <!-- account_edit.php -->
					<li><a href="#">Delete Account</a></li> <!-- account_delete.php -->
					</ul></li>
				<li><a href="account.php">Log Out</a></li> <!-- REMOVE Cookies -->
				</ul></li>
			<li class="current"><a href="reserve.php">Reserve</a>
				<ul>
				<li class="current"><a href="reserve.php">Create a Reservation</a></li>
				<li><a href="#">Edit Reservation</a></li> <!-- reserve_edit.php -->
				<li><a href="#">Delete Reservation</a></li> <!-- reserve_delete.php -->
				</ul></li>
			<li><a href="contacts.html">Contact Us</a></li>
			<li><a href="about.html">About</a></li>
			<li><a href="data.html">Manager</a>
				<ul>
				<li><a href="data.html">Insert Data</a></li>
				<li><a href="chart.php">View Graph</a></li>
				</ul></li>
		</ul>
		<div class="clear"></div>
	</nav>
</header>
<!-- Content -->
<section id="content"><div class="ic"></div>
	<div class="container_24">
		<div class="grid_24 content-border">
			<div class="top-content-box">
				<ul id="mp-pags-cont-extra">
					<li><a href="reserve.php">Reserve</a></li>
					<li><a href="register.php">Register</a></li>
					<li><a href="account.php">Log-in</a></li>
				</ul>
			</div>
			<div class="top-row">
				<h1 class="aligncenter">
					We are here to help you <br/>fit right in.
				</h1>
				<div class="wrapper">
					<div class="grid_5 prefix_1 alpha">
						<div class="wrapper">
							<span class="dropcap color-1">A.</span>
							<div class="extra-wrap">
								<strong class="str-1 color-1">
									Reserve:<br/>
									Guarantee your spot when you arrive by reserving now
								</strong>
							</div>
						</div>
					</div>
					<div class="grid_5">
						<div class="wrapper">
							<span class="dropcap color-2">B.</span>
							<div class="extra-wrap">
								<strong class="str-1 color-2">
									Register:<br/>
									Register an account to make reservations faster and easier
								</strong>
							</div>
						</div>
					</div>
					<div class="grid_5 suffix_1 omega">
						<div class="wrapper">
							<span class="dropcap color-3">C.</span>
							<div class="extra-wrap">
								<strong class="str-1 color-3">
									Log-in:<br/>
									Log into your account to edit your profile or reserve a spot
								</strong>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="wrapper indent-top">
				<article class="grid_23 prefix_1 alpha omega">
					<h2><center>Fit-A-Lot Account:</center></h2>
					<div class="wrapper">
						<center>
							<dl class="def-list-1">
								<dt class="color-3">
									Register
								</dt>
								<dd>
									<div id="login">
										<form method="post" action="">
											<p class="contact"><label for="start date">Start Date</label></p>
												<input id="startdate" name="startdate" placeholder="mm/dd/yyyy"  id='startdate' maxlength="10" type="text">
											<p class="contact"><label for="end date">End Date</label></p>
												<input id="enddate" name="enddate" placeholder="05/10/2013"  id='enddate' maxlength="10" type="text">
											<p class="contact"><label for="username">Start Time</label></p>
												<input id="starttime" name="starttime" placeholder="hh:mm" id='starttime' type="text">
											<p class="contact"><label for="endtime">End Time</label></p>
												<input id="endtime" name="endtime" placeholder="18:00" id='endtime' type="text">
											<p class="contact"><label for="car">Car</label></p>
												<input id="car" name="car" placeholder="vehicle" id='vehicle' type="text">
											<p class="contact"><label for="phonenumber">Phone Number</label></p>
												<input id="phonenumber" name="phonenumber" placeholder="(xxx)-xxx-xxxx" id='phonenumber' type="text">
											<input class="buttom" name="submit" id="submit" tabindex="5" value="Reserve!" type="submit">
										</form>
<?php
	if (isset($reserveID)) {
		echo "<META http-equiv='REFRESH' content='0;URL=about.html'>";
	}
?>
									</div><!--end register-->
									<div class="aligncenter">
										<a href="account.php" class="link">Login to existing account</a>
									</div>
								</dd>
							 </dl>
						</center>
					</div>
				</article>
			</div>
        </div>
        <div class="clear"></div>
    </div>
</section>
<!-- Footer -->
<footer>
	<div class="copyright">
		&copy; 2013 <strong>Fit-A-Lot Parking Garage</strong><!-- instert=>class="footer-logo"-->
		<div>Website Template designed by <a href="http://www.templatemonster.com/" rel="nofollow">TemplateMonster.com</a></div>
	</div>
	<ul class="social-list">
		<li><a href="#"><img src="images/social-link-1.jpg" alt=""></a></li>
		<li><a href="#"><img src="images/social-link-2.jpg" alt=""></a></li>
		<li><a href="#"><img src="images/social-link-3.jpg" alt=""></a></li>
	</ul>
</footer>
</body>
</html>
