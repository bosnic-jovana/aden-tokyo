<?php
    header("Content-type: applicaton/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../../config/connection.php";
        include "../functions.php";

        try{
            $limit = $_POST["limit"];
            $kometari = topMessages($limit);
            echo json_encode($kometari);
            http_response_code(200);
        }
        catch(PDOException $exce){
            http_response_code(500);
        }
    }
    else{
        http_response_code(404);
    }
?>