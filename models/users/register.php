<?php
    header("Content-type: applicaton/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../../config/connection.php";
        include "../functions.php";

        try{

            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $password = $_POST["password"];

            $reFirstLastName = "/^[A-ZŠĐŽČĆ][a-zšđžčć]{2,14}(\s[A-ZŠĐŽČĆ][a-zšđžčć]{2,14})?$/";
            $reEmail = "/^[\w\.\-]+\@([a-z\d]+\.)+[a-z]{2,3}$/";
            $rePhone = "/^(\+381\s|0)6[0-69]\s[0-9]{3}\s[0-9]{3,4}$/";
            $rePass = "/^.{5,40}$/";

            $errors = false;
            $errorPoruke = [];

            if(!preg_match($reFirstLastName, $firstName)){
                $errors= true;
            }
            if(!preg_match($reFirstLastName, $lastName)){
                $errors = true;
            }
            if(!preg_match($reEmail, $email)){
                $errors = true;
            }
            if(!preg_match($rePhone, $phone)){
                $errors = true;
            }
            if(!preg_match($rePass, $password)){
                $errors = true;
            }
            
            if($errors){
                http_response_code(409);
            }
            else{
                $pass = md5($password);
                $role = 2;

                $columns = "first_name, last_name, phone, email, password, id_role";
                $userValues = [$firstName, $lastName, $phone, $email, $pass, $role];
                $insertUser = insert("users", $columns, $userValues);

                if($insertUser){
                    $response = ["message" => "You are now registered."];
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
        http_response_code(404);
    }
?>