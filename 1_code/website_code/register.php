<?php
//	session_name("attemptLogIn");
	if (!session_start()) { die('Could not start session.'); }
	if (!require 'management.php') { die('Could not require management.'); }

/* If COOKIE-login is still in effect remove it.
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-3600);
	}
*/

// Did the user a correct password/email and click submit?
	if ($_POST && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['question']) && !empty($_POST['answer']) && !empty($_POST['repass']) && !empty($_POST['reemail'])) {
		if ($_POST['password'] != $_POST['repass']) {
			$success="Non matching password";
		} else if ($_POST['email'] != $_POST['reemail']) {
			$success ="Non matching emails";
		} else {
			$success = add_new_user($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'], $_POST['question'], $_POST['answer']);
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
			<li class="current"><a href="account.php">Account</a>
				<ul>
				<li class="current"><a href="register.php">Register</a></li>
				<li><a href="account.php">Log-In</a></li>
				<li><a href="#">Account Info</a> <!-- account_edit.php -->
					<ul>
					<li><a href="#">Edit Account</a></li> <!-- account_edit.php -->
					<li><a href="#">Delete Account</a></li> <!-- account_delete.php -->
					</ul></li>
				<li><a href="account.php">Log Out</a></li> <!-- REMOVE Cookies -->
				</ul></li>
			<li><a href="reserve.php">Reserve</a>
				<ul>
				<li><a href="reserve.php">Create a Reservation</a></li>
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
											<label for="firstname"><strong>First Name: </strong>
											<small>(30 characters)</small></label>
											<input type="text" name="firstname" />
											<br />
											<label for="lastname"><strong>Last Name: </strong>
											<small>(30 characters)</small></label>
											<input type="text" name="lastname" />
											<br />
											<label for="email"><strong>Email: </strong>
											<small>(60 characters)</small></label>
											<input type="text" name="email" />
											<label for="reemail"><strong>Email again: </strong>
											<small>For confirmation</small></label>
											<input type="text" name="reemail" />
											<br />
											<label for="password"><strong>Password: </strong>
											<small>(16 characters)</small></label>
											<input type="password" name="password" />
											<label for="repass"><strong>Password again: </strong>
											<small>For confirmation</small></label>
											<input type="password" name="repass" />
											<br />
											<label for="question"><strong>Security Question: </strong>
											<small>(60 characters)</small></label>
											<input type="text" name="question" />
											<br />
											<label for="answer"><strong>Answer: </strong>
											<small>(30 characters)</small></label>
											<input type="text" name="answer" />
											<br />
											<input type="submit" id="submit" value="Register" name="submit" />
										</form>
<?php
	if (isset($success)) {
		//echo "<h4 class='alert'>" . $success . "</h4>";
		echo "<META http-equiv='REFRESH' content='0;URL=account.php'>";
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
