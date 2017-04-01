<!DOCTYPE html>

<?php
$connectstr_dbhost = '';
$connectstr_dbname = 'assignment2_iwp';
$connectstr_dbusername = '';
$connectstr_dbpassword = '';

foreach ($_SERVER as $key => $value) {
    if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
        continue;
    }
    
    $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
    $connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
    $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
    $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}

$link = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname);

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

$query = "INSERT INTO user (id_user, name_user, password_user) VALUES (1, 'daniel', 'daniel')";
mysqli_query($dbc, $query);

try {
    $sql = "INSERT INTO user (id_user, name_user, password_user) VALUES (1, 'daniel', 'daniel')";
    $sth = $conn->query($sql);
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