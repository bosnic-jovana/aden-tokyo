<?php
    session_start();
    header("Content-type: applicaton/json");
    if(isset($_SESSION["user"])){
        if($_SESSION["user"]->id_role == 1){
            if(isset($_POST['idRoom'])){
                include "../../config/connection.php";
                include "../functions.php";
        
                try{
                    $idRoom = $_POST['idRoom'];
                    $nameRoom = $_POST['nameRoom'];
                    $album = $_POST['album'];
                    $description = $_POST['description'];
                 
                    $rezultat = updateRoom($idRoom, $nameRoom, $album, $description);
                    if($rezultat){
                        $response = ["message" => "Successfully updated."];
                        echo json_encode($response);
                    }
                }
                catch(PDOException $exce){
                    http_response_code(500);
                }
            }    
        }
        else{
            header("Location: ../../403.php");
        }
    }
    else{
        header("Location: ../../403.php");
    }
?>