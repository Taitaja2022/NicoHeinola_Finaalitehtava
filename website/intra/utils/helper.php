<?php

function checkLogin($user, $pass){
    if ($user == "admin" && $pass == "taitaja2022"){
        $_SESSION["isLogged"] = true;
    }
    return true;
}

function isLogged(){
    if(isset($_SESSION["isLogged"]) && $_SESSION["isLogged"]){
        return true;
    }
    return false;
}

function logOut(){
    $_SESSION["isLogged"] = false;
}

function sanitizeName($file){
    $file = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $file);
    // Remove any runs of periods (thanks falstro!)
    $file = mb_ereg_replace("([\.]{2,})", '', $file);
    return $file;
}

function sanitizeString($text){
    $text = preg_replace("/\r|\n/", "", $text);
    return $text;
}