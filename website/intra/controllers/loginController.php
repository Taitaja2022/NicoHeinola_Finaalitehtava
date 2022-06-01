<?php

/**
 * handles logging in
 */
function loginController()
{
    // If user has filled the login form and sent it
    if (isset($_POST["user"], $_POST["pass"])) { 
        $pass = $_POST["pass"]; // Password
        $user = $_POST["user"];

        checkLogin($user, $pass); // Checks for correct username and password
    }

    // Goes to the intra page if correct password and username
    if (!isLogged()) {
        require "./views/login.view.php";
    } else {
        adminController();
    }
}
