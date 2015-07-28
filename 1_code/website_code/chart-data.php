<?php

// generate some random data:

srand((double)microtime()*1000000);


$link = mysql_connect('localhost', '13group5', 'bbcpww14');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db('13group5');

$query = mysql_query("SELECT jan,feb,march,april,may FROM Graphdataa");

$data = array();
while($row = mysql_fetch_array($query)) {
    // Append to the array
    $data[] = $row['jan'];
	$data[] = $row['feb']; 
	$data[] = $row['march']; 
	$data[] = $row['april']; 
	$data[] = $row['may']; 
	
}

$max = 50;


// use the chart class to build the chart:
include_once( 'ofc-library/open-flash-chart.php' );
$g = new graph();

// Parking Spot Occupied , March 2007
$g->title( 'Parking Spots '. date("Y"), '{font-size: 26px;}' );

$g->set_data( $data );
// label each point with its value
$g->set_x_labels( array('Jan','Feb','Mar','Apr','May') );

// set the Y max
$g->set_y_max( 50 );
// label every 10 
$g->y_label_steps(5 );

// display the data
echo $g->render();
?>
