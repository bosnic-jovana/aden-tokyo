<?php
    session_start();
    header("Content-type: applicaton/json");
    if(isset($_SESSION["user"])){
        if($_SESSION["user"]->id_role == 1){

            include "../../config/connection.php";
            include "../functions.php";
            if(isset($_GET["id"]) && isset($_GET["visibility"])){
                try{
                    $id = $_GET["id"];
                    $visibility = $_GET["visibility"];

                    $result = updateVisibilityMessages($id, $visibility);

                    if($result){
                        http_response_code(204);
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
    }
    else{
        header("Location: ../../403.php");
    }
?>