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