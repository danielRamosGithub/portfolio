<?php 
    session_start();
    require_once('connectVars-azure.php');
    // require_once('connectVars-localhost.php');

    // error message variable
    $msg = "";

    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // saving the data from a book.
    if(isset($_POST['submit'])) {
        // grabing the user id
        $user_id = $_SESSION["user_id"];
        // grab the info from the FORM
        $order_name = mysqli_real_escape_string($dbc, trim($_POST['order_name']));
        $order_entry = mysqli_real_escape_string($dbc, trim($_POST['order_entry']));
        $order_main = mysqli_real_escape_string($dbc, trim($_POST['order_main']));
        $order_beverage = mysqli_real_escape_string($dbc, trim($_POST['order_beverage']));
        $order_desert = mysqli_real_escape_string($dbc, trim($_POST['order_desert']));

        if (!isset($order_name) ) {
            $error_msg = 'Sorry, Order Name must not be Blank!!!';
            echo '
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Warning! ' .$error_msg. '</strong>
                </div>';
        } else if (!isset($order_entry) ) {
            $error_msg = 'Sorry, Entry must not be Blank!!!';
            echo '
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Warning! ' .$error_msg. '</strong>
                </div>';
        } else if (!isset($order_main) ) {
            $error_msg = 'Sorry, Main Dish must not be Blank!!!';
            echo '
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Warning! ' .$error_msg. '</strong>
                </div>';
        } else if (!isset($order_beverage) ) {
            $error_msg = 'Sorry, Beverage must not be Blank!!!';
            echo '
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Warning! ' .$error_msg. '</strong>
                </div>';
        } else if (!isset($order_desert)) {
            $error_msg = 'Sorry, Desert must not be Blank!!!';
            echo '
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Warning! ' .$error_msg. '</strong>
                </div>';
        } else {
            // setting the insert query
            $query = "INSERT INTO user_order (order_name, order_entry, order_main, order_beverage, order_desert, id_user) VALUES ('$order_name', '$order_entry', '$order_main', '$order_beverage', '$order_desert', $user_id)";
            
            // execute the query
            mysqli_query($dbc, $query);

            echo mysqli_error($dbc);

            $msg = "You created a new order. In a couple of minutes it will be served for you!!! Thank you!";
            echo '
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Sucess! ' .$msg. '</strong>
                    <a href="orders.php" class="alert-link">Click here to check your orders!</a>
                </div>';
            // echo '<meta http-equiv="refresh" content="3;login.php">';
            // close connection to the database
            mysqli_close($dbc);

            $order_name = ""; 
            $order_entry = ""; 
            $order_main = ""; 
            $order_beverage = "";
            $order_desert = "";
        }
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

        <header>
            <div class="container">
                <nav class="navbar navbar-default">
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="index.php">Downtown Bar</a>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <?php
                                if(isset($_SESSION['user_id'])) {
                                    echo '<li><a href="logout.php">Logout</a></li>';
                                }
                                else {
                                    echo '<li><a href="login.php">Login</a></li>';
                                }
                                ?>
                                <li><a href="register.php">Register</a></li>
                            </ul>
                        </div>
                    </div><!-- /.navbar-collapse -->
                </nav>
            </div>
        </header>

        <div class="container">
            <div class="row">
                <h1>Bar Tab</h1>
            </div>
            <?php
                if(isset($_SESSION['user_id'])) {
                    echo '<div class="row"><h3> Welcome, '.$_SESSION['user_name'].'! Make your order!</h3></div>';
            
                echo '<div class="row">
                    <form method="post" action="'.$_SERVER['PHP_SELF'].'">
                        <div class="form-group">
                            <label for="order_name">Order Name</label>
                            <input type="text" class="form-control" id="order_name" name="order_name">
                        </div>
                        <div class="form-group">
                            <label for="order_entry">Entry</label>
                            <input type="text" class="form-control" id="order_entry" name="order_entry">
                        </div>
                        <div class="form-group">
                            <label for="order_main">Main dish</label>
                            <input type="text" class="form-control" id="order_main" name="order_main">
                        </div>
                        <div class="form-group">
                            <label for="order_beverage">Beverage</label>
                            <input type="text" class="form-control" id="order_beverage" name="order_beverage">
                        </div>
                        <div class="form-group">
                            <label for="order_desert">Desert</label>
                            <input type="text" class="form-control" id="order_desert" name="order_desert">
                        </div>
                            <input type="submit" class="btn btn-default" name="submit" value="Submit"/>
                            <button type="reset" class="btn btn-warning">Clear Inputs</button>
                            <a class="btn btn-info" href="orders.php" role="button">My Orders</a>
                    </form>
                </div>';
                } else {
                    echo '<div class="row"><h3>Login to place your orders!</h3></div>';
                }
            ?>
        </div> <!-- div.container -->

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>