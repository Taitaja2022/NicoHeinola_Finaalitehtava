<?php

function loginController()
{
    if (isset($_POST["user"], $_POST["pass"])) { 
        $pass = $_POST["pass"];
        $user = $_POST["user"];

        checkLogin($user, $pass);
    }
    if (!isLogged()) {
        require "./views/login.view.php";
    } else {
        adminController();
    }
}
