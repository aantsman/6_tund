<?php

    require_once("../config_global.php");
    $database = "if15_anniant";
 
    
    function getAllData(){
        
        $mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("SELECT id, user_id, number_plate, color FROM car_plates");
        $stmt->bind_result($id_from_db, $user_id_from_db, $number_plate_from_db, $color_from_db);
        $stmt->execute();
        
        $row_nr = 0;
		
		echo "<table border=1>";
		echo "<tr> <th>rea nr</th> <th>auto numbrimärk</th> </tr>";
        // iga rea kohta mis on ab'is teeme midagi
        while($stmt->fetch()){
            //saime andmed kätte
            //echo $row_nr." ".$number_plate_from_db." <br>";
			
			//uus rida
			echo "<tr>";
			// rea nr tulba
			echo "<td>".$row_nr."</td>";
			// auto nr tulba
			echo "<td>".$number_plate_from_db."</td>";
			// panete rea kinni
			echo "</tr>";
			
			
			$row_nr++;
        }
        echo "</table>";
		
		
        /* iga rea kohta mis on ab'is teeme midagi
        while($stmt->fetch()){
            //saime andmed kätte
            echo($user_id_from_db);
            //? kuidas saada massiivi - SIIT JÄTKAME
        }
		*/
        
        $stmt->close();
        $mysqli->close();
    }
    
    
 ?>