<!DOCTYPE html>
<?php 
    session_start();
    require_once('connectVars-azure.php');
    // require_once('connectVars-localhost.php');

    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Query to select all the books from the database
    $query = "SELECT * FROM books WHERE book_id = '".$_GET['book_id']."'";
    // execute the query
    $data = mysqli_query($dbc, $query);

    if (mysqli_num_rows($data) == 1) {
        $row = mysqli_fetch_array($data);
        // declaring the variables
        $book_title = $row['book_title']; 
        $book_genre = $row['book_genre']; 
        $review = $row['book_review']; 
        $reviewer = $row['book_review_person'];
        $reviewer_email = $row['review_person_email'];
        $store_link = $row['book_store_link'];
    } else {
        $msg = "Something wrong happened!!!";
        echo '
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Sucess! ' .$msg. '</strong>
                <a href="index.php" class="alert-link">Click here to check the go back to the library!</a>
            </div>';
    }
?>
<html lang="en">
    <head>
        <title>Assingment 2 - Intro to web programming</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="css/normalize.css" rel="stylesheet">-->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-default">
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php">Book Lovers</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="index.php">Library</a></li>
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
        </header>

        <main>
            <div class="container" id="book-information">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1>Book Information</h1>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        <h2>Book Title</h2>
                        <p><?php echo $book_title; ?></p>
                    </div>
                    <div class="col-md-4">
                        <h2>Book Genre</h2>
                        <p><?php echo $book_genre; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        <h2>Reviewer</h2>
                        <p><?php echo $reviewer; ?></p>
                    </div>
                    <div class="col-md-4">
                        <h2>Reviewer E-mail</h2>
                        <p><?php echo $reviewer_email; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        <h2>Review</h2>
                        <p><?php echo $review; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        <h2>Store Link</h2>
                        <p><?php echo $store_link; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <a class="btn btn-primary" href="index.php" role="button">Back to Library</a>
                    </div>
                </div>
            </div> <!-- div container -->

        </main>

        <script src="js/jquery.min.js"></script>
        <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/dropdown.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>