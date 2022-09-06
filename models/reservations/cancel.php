<?php
    session_start();
    if(isset($_GET["id"])){
        if(isset($_SESSION["user"])){
           
            include "../../config/connection.php";
            include "../functions.php";
        
            try{
                $id = $_GET["id"];
                $result = cancelReservation($id);
                if($result){
                    http_response_code(200);
                    header("Location: ../../index.php?page=reservations");
                }
            }
            catch(PDOException $exce){
                http_response_code(500);
            }
        }
        else{
            header("Location: ../../403.php");
        }
    }
    else{
        http_response_code(404);
    }
?>