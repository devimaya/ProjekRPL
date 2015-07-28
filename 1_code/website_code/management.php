<?php
	//Opening connection and such
	$conn = mysql_connect('localhost','13group5','bbcpww14');
		if (!$conn) {
			die('<br/>Could not Connect: ' . mysql_error());
		}
	mysql_select_db('13group5',$conn);
	$tableInfo = "CREATE TABLE IF NOT EXISTS members(
					memberid int NOT NULL AUTO_INCREMENT,
						PRIMARY KEY(memberID),
					first_name varchar(30),
					last_name varchar(30),
					email varchar(60),
					password varchar(16),
					question varchar(60),
					answer varchar(30),
					reserveID int(11))";
		if (!mysql_query($tableInfo,$conn)) {
			die('<br/>Could not Create Table:' . mysql_error());
		}

	function validate_email_and_password($email, $password) {
		global $conn;
		if (!mysql_select_db('13group5',$conn)) { die('Failed to select DB: ' . mysql_error()); }
		$req = "SELECT * FROM members WHERE email = '$email' AND password = '$password' LIMIT 0, 30 ";
		$result = mysql_query($req, $conn);
		if (!$result) {
			die('<br/>Could not match email and pass: ' . mysql_error() . $req);
		} else {
			return $result;
		}
	}

	function validate_user($email, $pass) {
		$correct = validate_email_and_password($email, $pass);
		if ($correct) {
			return "Correct email and pass";
			//SET COOKIE
		} else {
			return "Wrong email and pass";
		}
	}

	function add_new_user($first, $last, $email, $pass, $question, $answer) {
		global $conn;
		if (!mysql_select_db('13group5',$conn)) { die('Failed to select DB: ' . mysql_error()); }
		$req = "INSERT INTO members (first_name, last_name, email, password, question, answer) VALUES ('$first', '$last', '$email', '$pass', '$question', '$answer')";
		$success = mysql_query($req, $conn);
		if (!$success) {
			die('Could not add user ' . $req . ' with ' . mysql_error());
		} else {
			//SET COOKIES
		}
		return $success;
	}

	function reserve_spot($startdate, $enddate, $starttime, $endtime, $car, $phonenumber, $email) {
		global $conn;
		if (!mysql_select_db('13group5',$conn)) { die('Failed to select DB: ' . mysql_error()); }
		$req="INSERT INTO Reservations123 (startdate, enddate,starttime,endtime,car,phonenumber) VALUES ('$startdate', '$enddate', '$starttime', '$endtime', '$car', '$phonenumber')";	
		$success = mysql_query($req, $conn);
		if (!$success) {
			die('Could not reserve spot ' . $req . ' with ' . mysql_error());
		} else {
			$req="SELECT LAST_INSERT_ID()";
			$reserveID = mysql_query($req, $conn);
			$req="UPDATE members SET reserveID='$reserveID' WHERE email='$email'";
			$success = mysql_query($req, $conn);
			if (!$success) {
				die('Could not match reservation ID with Member ' . $req . ' with ' . mysql_error());
			}
		}
		return $reserveID;
	}

/*	function verify_Email_and_Password($email, $pwd) {
		$query = "SELECT * FROM members WHERE email = ? AND password = ? LIMIT 1";
		if ($stmt = $conn->prepare($query)) {
			$stmt->bind_param('ss', $email, $pwd);
			$stmt->execute();
			if ($stmt->fetch()) {
				$stmt->close();
				return true;
			} else {
				echo "FAILED FETCH()!, DID NOT CLOSE() nor RETURN TRUE; RETURNING FALSE!";
				return false;
			}
		} else { echo "FAILED PREPARE(QUERY)!"; }
	}

	function add_user($first, $last, $pwd, $email, $qst, $ans) {
		$query = "INSERT INTO members (First_Name, Last_Name, Email, Password, Question, Answer) VALUES (?,?,?,?,?,?)";
		if ($stmt = $conn->prepare($query)) {
			$stmt->bind_param('ssssss',$first,$last,$email,$pwd,$qst,$ans)
			$stmt->execute();
			return true;
		} else {
			echo "FAILED to PREPARE(query)";
			return false;
		}
		$stmt->close();
	}

	function validate_User($email, $pwd) {
//		$mysql = new Mysql();
		$ensure_credentials = verify_Email_and_Password($email, md5($pwd));
		if ($ensure_credentials) {
			return "Correct email and password.";
//			setcookie(session_name(), 'authorized', time()+2592000);
//			header("location: index.php");
		} else {
			return "Wrong Email or Password entered. Try again.";
		}
	}
/*
	function log_User_Out() {
		if (isset($_SESSION['status'])) {
			unset($_SESSION['status']);
			if (isset($_COOKIE[session_name()])) {
				setcookie(session_name(), 'authorized', time()-3600);
			}
			session_destroy();
		}
	}

	function confirm_Member() {
		session_start();
		//if ($_SESSION['status'] != 'authorized') {
		//	header("location: login.php");
		if ($_COOKIE[session_name()] != 'authorized') {
			header("location: login.php");
		} else {
			echo $_COOKIE[session_name()] . "<br/>Cookie was set and authorized.<br/>";
			print_r($_COOKIE);
		}
	}
}
*/
?>

