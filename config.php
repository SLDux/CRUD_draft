<?php

$host = "localhost";
$username = "root";
$password = "root";
$dbname = "crud_draft";
    // DOES THIS HAVE TO BE THE SAME AS THE DATABASE NAME IN THE DBCREATE FILE? 
$dsn = "mysql:host=$host;dbname=$dbname"; 
    //i'm not sure what that does 
$options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

?> 