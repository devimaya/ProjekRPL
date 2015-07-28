<?php
	//Opening connection and such
	$conn = mysql_connect('localhost','13group5','bbcpww14');
		if (!$conn) {
			die('<br/>Could not Connect: ' . mysql_error());
		}
	
	function extract_info($date) {
		global $conn;
		if (!mysql_select_db('13group5',$conn))	{ die('Failed to select DB: ' . mysql_error()); }
		$req = "SELECT starttime,endtime FROM Reservations123 WHERE startdate='$date'";
		$result = mysql_query($req, $conn);
		if (!$result) {
			die('<br/>There seems to be an error with our server: ' . mysql_error() . $req);
		} else {
			return $result;
		}
	}

	function manage_info($today) {
		echo "<small><center>For ",$today,"</center></small>";
		$information = extract_info($today);
		$rowN=0;
		while ($row = mysql_fetch_array($information, MYSQL_BOTH)) {
			$info[$rowN][0] = intval($row['starttime']);
			$info[$rowN][1] = intval($row['endtime']);
			$rowN++;
		}
		echo "<br/><table border='1' align='center'>";
		echo "<tr><th>TIME</th><th>SPOTS AVAILABLE</th></tr>";
		for ($hour=1; $hour<24; $hour++) { //foreach?
			$spot=0;
			echo "<tr>";
			//TIME:
				if ($hour < 11) {
					echo "<td> ", $hour, ":00am to ", ($hour+1), ":00am</td>";
				} elseif ($hour == 11) {
					echo "<td> 11:00am to Noon</td>";
				} elseif ($hour == 12) {
					echo "<td> Noon to 1:00pm</td>";
				} elseif ($hour == 23) {
					echo "<td> 11:00pm to Midnight</td>";
				} else {
					echo "<td> ", ($hour-12), ":00pm to ", ($hour-12+1), ":00pm</td>";
				}
			//SPOTS:
				for($i=$rowN; $i>0; $i--) {
					if ((intval($hour)>=$info[$i][0]) && (intval($hour)<=$info[$i][1])) {
						$spot++;
					}
				}
				if ($spot>0) {
					echo "<td>Have <b>",(20-$spot),"</b> spots open</td>";
				} else {
					echo "<td><b>All</b> spots open</td>";
				}
			echo "</tr>";
		}
		echo "</table>";
		return 0;
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  	<title>Garage Outside Display</title>
  	<meta charset="utf-8">
<!--[if lt IE 9]>
	<script src="js/html5.js"></script>
	<link rel="stylesheet" href="css/ie.css">
<![endif]-->
</head>
<body>
	<h2><center>Fit-A-Lot Parking Garage<br />Availability:</center></h2>
	<?php
		$ans_array=array();
		$ret_status=0;
		$today = '05/10/2013';

		manage_info($today);
	?>
<!-- Footer -->
<footer>
		<small><center>
		&copy; 2013 <strong>Fit-A-Lot Parking Garage</strong>
		</center></small>
</footer>
</body>
</html>

