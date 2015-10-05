<?php

    require_once("../config_global.php");
    $database = "if15_anniant";
 
    
    function getAllData(){
        
        $mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("SELECT id, user_id, number_plate, color FROM car_plates");
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
    
    
 ?>