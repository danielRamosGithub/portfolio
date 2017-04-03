<!DOCTYPE html>

<?php
// require_once('connectVars-azure.php');
require_once('connectVars-localhost.php');

try {
    $conn = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME , DB_USER, DB_PASSWORD);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    // echo "Connection failed: " . $e->getMessage();
    }

$conn = null;
?>
<html lang="en">
    <head>
        <title>Assingment 2 - Intro to web programming</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <h1>Assignment 2 for Intro to Web Programming</h1>
    </body>
</html>