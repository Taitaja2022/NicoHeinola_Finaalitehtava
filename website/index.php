<?php

require "./controllers/frontController.php";
require "./models/liikuntamatka.php";
require "./db/connection.php";

session_start();
ConnectDB("root", "");

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = "/";
}

switch ($page) {
    case "/":
        frontController();
        break;
}