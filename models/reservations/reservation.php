<?php
    session_start();
    header("Content-type: applicaton/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../../config/connection.php";
        include "../functions.php";
        try{
            $tipSobe = $_POST["tipSobe"];
            $brojOsoba = $_POST["brojOsoba"];
            $datumOd = $_POST["datumOd"];
            $datumOd = explode("/", $datumOd);
            $datumOd = mktime(00,00,00,$datumOd[0],$datumOd[1], $datumOd[2]);
            $datumDo = $_POST["datumDo"];
            $datumDo = explode("/", $datumDo);
            $datumDo = mktime(00,00,00,$datumDo[0],$datumDo[1], $datumDo[2]);
            $idSobe = $_POST["idSobe"]; 
            $errors = false;
            $errorMessages[] = [];

            if($tipSobe != 1 && $tipSobe != 2){
                $errors = true;
                array_push($errorMessages, "Please select type of room.");
            }
            if($brojOsoba != 2 && $brojOsoba != 3){
                $errors = true;
                array_push($errorMessages, "Please select number of guests.");
            }
            if($datumOd - $datumDo > 0){
                $errors = true;
                array_push($errorMessages, "Check out can't be before check in.");
            }
            if($idSobe == null){
                $errors = true;
            }
            if(!$errors){
                $cena = price($idSobe, $brojOsoba, $tipSobe);
                $idCene = $cena->id_price;
                $datumOd = date("Y-m-d", $datumOd);
                $datumDo = date("Y-m-d", $datumDo);
                
                if(isset($_SESSION["user"])){
                    $userId = $_SESSION["user"]->id_user;
                    $columns = "id_user, id_price, check_in, check_out";
                    $rezervacija = insert("reservation", $columns, [$userId, $idCene, $datumOd, $datumDo]);
                   if($rezervacija){
                        $odgovor = ["message" => "You have successfully made a reservation."];
                        echo json_encode($odgovor);
                        http_response_code(201);
                   }
                }
                else{
                    http_response_code(401);
                }
            }
            else{
                echo json_encode($errorMessages);
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