<?php
$pdo = null;

function ConnectDB($user, $pass){
    global $pdo;
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=ta22nh831_db', $user, $pass);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}

function getConnection(){
    global $pdo;
    return $pdo;
}