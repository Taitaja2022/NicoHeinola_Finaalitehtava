<?php

require "./controllers/frontController.php";
require "./models/liikuntamatka.php";
require "./db/connection.php";

session_start();
ConnectDB("ta22nh831_user", "OSh9aiheTh2k");

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