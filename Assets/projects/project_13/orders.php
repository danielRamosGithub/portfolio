<!DOCTYPE html>
<?php
    require_once('connectVars-azure.php');
    // require_once('connectVars-localhost.php');

    // start the session
    session_start();

    // clear the error message
    $error_msg = "";

    // if the user isn't logged in, try to log them in'
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        // connecting to the database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // Query to select all the books from the database
        $query = "SELECT * FROM user_order WHERE id_user = '$user_id'";
        // execute the query
        $data = mysqli_query($dbc, $query);

        echo mysqli_error($dbc);
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
                    </div><!-- /.navbar-collapse -->
                </nav>
            </div>
        </header>

        <main>
            <!--Container Log in-->
            <div class="container">
                <div class="row">
                    <h2>Check your Orders</h2>
                </div>
                <div class="row">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Order Name</th>
                            <th>Entry </th>
                            <th>Main Dish</th>
                            <th>Beverage</th>
                            <th>Desert</th>
                            <th></th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_array($data)) {
                            echo '<tr>
                                    <td>' .$row['order_name']. '</td>
                                    <td>' .$row['order_entry']. '</td>
                                    <td>' .$row['order_main']. '</td>
                                    <td>' .$row['order_beverage']. '</td>
                                    <td>' .$row['order_desert']. '</td>
                                    <td><a class="btn btn-danger" href="delete.php?order_id=' .$row['order_id']. '" role="button">Delete</a></tr>';
                        }
                        ?>
                    </table>
                </div>
            </div> <!-- End container log in-->
        </main>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>