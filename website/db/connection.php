<?php
$pdo = null; // Connection object

// Connects to the database
function ConnectDB($user, $pass){
    global $pdo;
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=ta22nh831_db', $user, $pass); // Connects
    } catch (PDOException $e) { // If connection was not successful
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}

// Returns the connection object
function getConnection(){
    global $pdo;
    return $pdo;
}