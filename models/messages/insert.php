<?php
    session_start();
    header("Content-type: applicaton/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_SESSION['user'])){
            include "../../config/connection.php";
            include "../functions.php";
    
            try{
                $message = $_POST["message"];
                $reMessage = "/^.{3,255}$/";
                
                if(!preg_match($reMessage, $message)){
                    http_response_code(409);
                }
                else{
                    $userId = $_SESSION['user']->id_user;
                    $columns = "message, id_user";
                    $values = [$message, $userId];
                    $result = insert("users_messages", $columns, $values);
                    if($result){
                        $response = ["message" => "Message is sent."];
                        echo json_encode($response);
                        http_response_code(201);
                    }
                } 
            }
            catch(PDOException $exce){
                http_response_code(500);
            }
        }
        else{
            http_response_code(401);
        }
    }
    else{
        http_response_code(404);
    }
?>