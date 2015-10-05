<?php

    require_once("../config_global.php");
    $database = "if15_anniant";
 
    
    function getAllData(){
        
        $mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
		
        $stmt = $mysqli->prepare("SELECT id, user_id, number_plate, color FROM car_plates WHERE deleted IS NULL");
        $stmt->bind_result($id_from_db, $user_id_from_db, $number_plate_from_db, $color_from_db);
        $stmt->execute();
        
		//massiiv kus hoiame autosid
		$array=array();
		
        // iga rea kohta mis on ab'is teeme midagi
        while($stmt->fetch()){
			//suvaline muutuja kus hoiame autoandmeid kuni massiivi lisamiseni
			
			//tühi objektkus hoiame väärtusi
			$car=new StdClass();
			
			$car->id=$id_from_db;
			$car->number_plate=$number_plate_from_db;
			$car->user_id=$user_id_from_db;
			$car->color=$color_from_db;
			
			//lisan auto massiivi
			array_push($array, $car);
			/*echo "<pre>";
			var_dump($array);
			echo "</pre>";*/
        }
		
		//saadan array tagasi
		return $array;

        
        $stmt->close();
        $mysqli->close();
    }
	
	function deleteCarData($car_id){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
		
		//uuendan välja deleted, lisan date now
        $stmt = $mysqli->prepare("UPDATE car_plates SET deleted=NOW() WHERE id=?");
        $stmt->bind_param("i", $car_id);
        $stmt->execute();
		
		//tühjendame aadressirea
		header("Location:table.php");
		
		$stmt->close();
		$mysqli->close();
		
	}
	
	function updateCarData($car_id, $number_plate, $color){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
		
		
        $stmt = $mysqli->prepare("UPDATE car_plates SET number_plate=?, color=? WHERE id=?");
        $stmt->bind_param("ssi", $number_plate, $color, $car_id);
        $stmt->execute();
		
		//tühjendame aadressirea
		//header("Location:table.php");
		
		$stmt->close();
		$mysqli->close();
		
	}
    
    
 ?>