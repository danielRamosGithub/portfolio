<!DOCTYPE html>
<?php 
    session_start();
    require_once('connectVars-azure.php');
    // require_once('connectVars-localhost.php');

    $msg = "";

    if(isset($_SESSION['user_id'])) {
        // echo $_GET['book_id'];
        // connect to the database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // writing the query
        $query = "DELETE FROM books WHERE book_id = '".$_GET['book_id']."'";

        // executing the query
        mysqli_query($dbc, $query);

        $msg = "Your book has been successfully deleted from the Library.";
        echo '
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Sucess! ' .$msg. '</strong>
            </div>';
        echo '<meta http-equiv="refresh" content="3;index.php">';
        mysqli_close($dbc);
    } else {
        $error_msg = 'Sorry, you must be log in to delete a book!';
        echo '
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Warning! ' .$error_msg. '</strong>
                <a href="login.php" class="alert-link">Click here to log in!</a>
            </div>';
    }

    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Query to select all the books from the database
    $query = "SELECT * FROM books";
    // execute the query
    $data = mysqli_query($dbc, $query);
?>
<html lang="en">
    <head>
        <title>Book Lovers</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="css/normalize.css" rel="stylesheet">-->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <script src="js/jquery.min.js"></script>
        <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/dropdown.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>