<?php
    header("Content-type: applicaton/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../../config/connection.php";
        include "../functions.php";

        try{

            $roomCat = $_POST["roomCat"];
            $guestsNum = $_POST["guestsNum"];
            $accType = $_POST["accType"];
            $sortPrice = $_POST["sortPrice"];
       
            $rooms = filterSortSobe($roomCat, $guestsNum, $accType, $sortPrice);
            
            if(count($rooms) != 0){
                echo json_encode($rooms);
                http_response_code(200);
            }
            
        }
        catch(PDOException $exce){
            http_response_code(500);
        }
    }
    else{
        http_response_code(404);
    }
?>