<?php

function is_logged_in(){
    return isset($_SESSION['user']);
}

function require_login(){
    if(!is_logged_in()){
        header('Location: index.php');
        exit;
    }
}

function current_user(){
    return $_SESSION['user'] ?? null;
}