<?php 
    session_start();
    // require_once('connectVars-azure.php');
    require_once('connectVars-localhost.php');

    $msg = "";

    if(isset($_SESSION['user_id'])) {
        // connect to the database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // writing the query
        $query = "DELETE FROM user_order WHERE order_id = '".$_GET['order_id']."'";

        // executing the query
        mysqli_query($dbc, $query);

        $msg = "Your order has been successfully deleted from your tab.";
        echo '
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Sucess! ' .$msg. '</strong>
            </div>';
        echo '<meta http-equiv="refresh" content="3;orders.php">';
        mysqli_close($dbc);
    } else {
        $error_msg = 'Sorry, you must be log in to delete a order!';
        echo '
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Warning! ' .$error_msg. '</strong>
                <a href="login.php" class="alert-link">Click here to log in!</a>
            </div>';
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bar Tab</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS -->
        <!--<link href="css/style.css" rel="stylesheet">-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>