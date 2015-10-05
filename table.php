
<?php 
	require_once("functions.php");
	
	//kõik autod objektide kujul massiivis
	$car_array=getAllData();
?>

<h1>Tabel</h1>
<br>
<?php 
	
	//autod ükshaaval läbi käia
	for($i=0; $i<count($car_array); $i++){
		
		echo $car_array[$i]->number_plate."<br>";
	}

?>