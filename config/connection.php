<?php

require_once "config.php";

accessToPages();

try {
    $konekcija = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo $ex->getMessage();
}

function accessToPages(){
    $open = fopen(LOG_FILE, "a");
    if($open){
        $date = date("d-m-Y H:i:s");
        fwrite($open, "{$_SERVER['PHP_SELF']}".SEPARATOR."{$_SERVER['QUERY_STRING']}".SEPARATOR."{$_SERVER['REMOTE_ADDR']}".SEPARATOR."{$date}\n");
        fclose($open);
    }
}

