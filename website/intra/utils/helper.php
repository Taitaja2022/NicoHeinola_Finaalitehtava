<?php

/**
 * Checks if username and password are correct
 */
function checkLogin($user, $pass)
{
    if ($user == "admin" && $pass == "taitaja2022") {
        $_SESSION["isLogged"] = true;
    }
    return true;
}

/**
 * Returns true if user has logged in, otherwise false.
 */
function isLogged()
{
    if (isset($_SESSION["isLogged"]) && $_SESSION["isLogged"]) {
        return true;
    }
    return false;
}

/**
 * Logs the user out
 */
function logOut()
{
    $_SESSION["isLogged"] = false;
}

/**
 * Makes a string folder-friendly
 */
function sanitizeName($file)
{
    $file = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $file);
    $file = mb_ereg_replace("([\.]{2,})", '', $file);
    return $file;
}

/**
 * Removes new lines.
 * Used for descriptions of trips so they don't break
 */
function sanitizeString($text)
{
    $text = preg_replace("/\r|\n/", "", $text);
    return $text;
}
