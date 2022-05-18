<?php

require "./controllers/frontController.php";

$url = $_SERVER['REQUEST_URI'];

switch ($url) {
    case "/":
        frontController();
        break;
}
