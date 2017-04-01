<!DOCTYPE html>

<?php
$servername = "127.0.0.1:53355";
$username = "";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=assignment2_iwp", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
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