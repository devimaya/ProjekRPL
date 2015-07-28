<?php 
$link = mysql_connect('localhost', '13group5', 'bbcpww14');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db('13group5');

//$sql = "CREATE TABLE Reservations123(reservationID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, date INT NOT NULL, )";


//$date = $_POST['date'];


//$sql2 = "INSERT INTO Reservations123 (reservationID, date) VALUES ('', '$date')";


$sql2="INSERT INTO Reservations123 (startdate, enddate,starttime,endtime,car,phonenumber)
VALUES
('$_POST[startdate]','$_POST[enddate]','$_POST[starttime]','$_POST[endtime]','$_POST[car]','$_POST[phonenumber]')";



mysql_query($sql2, $link);

if(!result) {
die('Could not run query' . mysql_error());	
}
else {
print 'Reservation Successful!';	
}

echo 'Connected successfully';
mysql_close($link);
?>	
