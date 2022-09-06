<?php
    session_start();
    if(isset($_GET["id"])){
        if(isset($_SESSION["user"])){
            if($_SESSION["user"]->id_role == 1){
                include "../../config/connection.php";
                include "../functions.php";
        
                try{
                   $id = $_GET["id"];
                   $rezultat = deleteRoom($id);
                   if($rezultat){
                       header("Location: ../../index.php?page=admin");
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
            header("Location: ../../403.php");
        }
    }
    else{
        http_response_code(404);
    }
?>