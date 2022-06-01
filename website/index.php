<?php

require "./controllers/frontController.php";
require "./models/liikuntamatka.php";
require "./db/connection.php";

// Database connection & Session
session_start();
ConnectDB("root", "");

// Finds what page user is on
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = "/";
}

// Uses the correct controller with matching url
switch ($page) {
    case "/":
        frontController();
        break;
}