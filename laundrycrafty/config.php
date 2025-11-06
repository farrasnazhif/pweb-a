<?php
session_start();

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'laundrycrafty');
define('DB_PORT', 8889);       

function db_connect(){
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    if($mysqli->connect_errno){
        die('DB connect error: '.$mysqli->connect_error);
    }
    $mysqli->set_charset('utf8mb4');
    return $mysqli;
}
