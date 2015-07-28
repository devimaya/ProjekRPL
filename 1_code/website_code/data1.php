<?php 
$link = mysql_connect('localhost', '13group5', 'bbcpww14');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db('13group5');

//$sql = "CREATE TABLE Reservations123(reservationID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, date INT NOT NULL, )";


//$date = $_POST['date'];


//$sql2 = "INSERT INTO Reservations123 (reservationID, date) VALUES ('', '$date')";


$sql2="INSERT INTO Graphdataa (jan,feb,march,april,may)
VALUES
('$_POST[jan]','$_POST[feb]','$_POST[march]','$_POST[april]','$_POST[may]')";


mysql_query($sql2, $link);

if(!result) {
die('Could not run query' . mysql_error());	
}
else {

function headerLocation($location,$message)
{
    $_SESSION['output'] = $message;
    header("Location:http://se1.engr.rutgers.edu/~13group5/demo2/chart.php ". $location);
    exit;
}
}

echo 'Connected successfully';
$_SESSION['output'] = $message;
    header("Location:http://se1.engr.rutgers.edu/~13group5/demo2/chart.php ". $location);
    exit;

echo $_POST[jan];
echo $_POST[feb];
echo $_POST[nov];
echo $_POST[dec];

mysql_close($link);
?>	
