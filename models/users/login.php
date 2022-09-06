<?php
    session_start();
    header("Content-type: applicaton/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../../config/connection.php";
        include "../functions.php";

        try{
            $email = $_POST["emailLog"];
            $password = $_POST["passLog"];
            $reEmail = "/^[\w\.\-]+\@([a-z\d]+\.)+[a-z]{2,3}$/";
            $rePass = "/^.{5,40}$/";
            $errors = [];

            if(!preg_match($reEmail, $email)){
               array_push($errors, "Email must contain @, and it could only use lowercase letters, numbers, '.' and '-'.");
            }
            if(!preg_match($rePass, $password)){
                array_push($errors, "Password must contain at least 5 character.");
            }

            if(count($errors) != 0){

                succOrErrLogFile($email, "Parameters didn't pass regular expressions.", true);
                emailWarning($email);
                http_response_code(409);
                header("Location: ../../index.php?page=login");
            }
            else{
                $pass = md5($password);

                $userObj = logovanje($email, $pass);

                if($userObj){
                    $_SESSION["user"] = $userObj;

                    succOrErrLogFile($email, "Successful login.");
                    http_response_code(200);
                    if($_SESSION["user"]->id_role == 1){
                        header("Location: ../../index.php?page=admin");
                    }
                    else{
                        header("Location: ../../index.php");
                    }
                }
                else{
                    succOrErrLogFile($email, "The parameters do not match the database.", true);
                    emailWarning($email);
                    http_response_code(500);
                    header("Location: ../../index.php?page=login");
                }
            }
        }
        catch(PDOException $exce){
            succOrErrLogFile($email, $exce->getMessage(), true);
            emailWarning($email);
            http_response_code(500);
            header("Location: ../../index.php?page=login");
        }
    }
    else{
        http_response_code(404);
    }
?>