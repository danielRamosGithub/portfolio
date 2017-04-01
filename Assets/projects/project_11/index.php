<!DOCTYPE html>

<?php
require_once('connectVars-azure.php');

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

try {
    $sql = "INSERT INTO user (user_id, user_name, user_password) VALUES (1, 'daniel', 'daniel')";
    $sth = $link->query($sql);
} catch(PDOException $e) {
    echo $e->getMessage();
}

mysqli_close($link);
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