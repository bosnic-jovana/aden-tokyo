<?php


define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"]."/aden");
define("ENV_FILE", ABSOLUTE_PATH."/config/.env");
define("LOG_FILE", ABSOLUTE_PATH."/data/log.txt");
define("ERROR_LOG", ABSOLUTE_PATH."/data/errorsLog.txt");
define("SUCCESS_LOG", ABSOLUTE_PATH."/data/successLog.txt");
define("SEPARATOR", "\t");

define("SERVER", env("SERVER"));
define("DATABASE", env("DATABASE"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

function env($value){
    $open = fopen(ENV_FILE, "r");
    $file = file(ENV_FILE);
    $valueEnv = "";

    foreach($file as $f){
        $config = explode("=", $f);
        if($value == $config[0]){
            $valueEnv = trim($config[1]);
            break;
        }
    }
    return $valueEnv;
}