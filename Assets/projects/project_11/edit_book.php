<!DOCTYPE html>
<?php 
    session_start();
    require_once('connectVars-azure.php');
    // require_once('connectVars-localhost.php');

    $msg = "";

    // connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // if the user is trying to edit the information from a book.
    $_SESSION["book_id"] = $_GET["book_id"];

    // setting the select query
    $query = "SELECT * FROM books WHERE book_id = '".$_GET['book_id']."'";

    $data = mysqli_query($dbc, $query);
    
    // setting the book info on the specific variables
    if (mysqli_num_rows($data) = 1) {
        $row = mysqli_fetch_array($data);
        // declaring the variables
        $book_title = $row['book_title']; 
        $book_genre = $row['book_genre']; 
        $review = $row['book_review']; 
        $reviewer = $row['book_review_person'];
        $reviewer_email = $row['review_person_email'];
        $store_link = $row['book_store_link'];

    } 
    else {
        $msg = "Something wrong happened!!!";
        echo '
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>' .$msg. '</strong>
                <a href="index.php" class="alert-link">Click here to check the go back to the library!</a>
            </div>';
    }

    if(isset($_POST['submit'])) {

        $book_id = $_SESSION["book_id"];
        echo "session depois do submit ". $_SESSION["book_id"];
        // grab the info from the FORM
        $book_title = mysqli_real_escape_string($dbc, trim($_POST['book_title']));
        $book_genre = mysqli_real_escape_string($dbc, trim($_POST['book_genre']));
        $reviewer = mysqli_real_escape_string($dbc, trim($_POST['reviewer']));
        $reviewer_email = mysqli_real_escape_string($dbc, trim($_POST['reviewer_email']));
        $review = mysqli_real_escape_string($dbc, trim($_POST['review']));
        $store_link = mysqli_real_escape_string($dbc, trim($_POST['store_link']));
        
        // setting the update query
        $query = "UPDATE books set book_title='$book_title', book_genre='$book_genre', book_review='$review', book_review_person='$reviewer', review_person_email='$reviewer_email', book_store_link='$store_link' WHERE book_id='$book_id'";

        // executing the query
        mysqli_query($dbc, $query);
        
        $msg = "You succesfully edit the information for this book.";
        echo '
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Sucess! ' .$msg. '</strong>
            </div>';
        // close connection to the database
        mysqli_close($dbc);
        echo '<meta http-equiv="refresh" content="1;index.php">';
    }
    
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
            <div class="container">
                <div class="row">
                    <h1>New Book</h1>
                </div>
                <div class="row">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <label for="book_title">Book Title</label>
                            <input type="text" class="form-control" id="book_title" name="book_title" required value="<?php echo $book_title; ?>">
                        </div>
                        <div class="form-group">
                            <label for="book_genre">Book Genre</label>
                            <input type="text" class="form-control" id="book_genre" name="book_genre" required value="<?php echo $book_genre; ?>">
                        </div>
                        <div class="form-group">
                            <label for="reviewer">Reviewer</label>
                            <input type="text" class="form-control" id="reviewer" name="reviewer" required value="<?php echo $reviewer; ?>">
                        </div>
                        <div class="form-group">
                            <label for="reviewer_email">Reviewer Email</label>
                            <input type="email" class="form-control" id="reviewer_email" name="reviewer_email" required value="<?php echo $reviewer_email; ?>">
                        </div>
                        <div class="form-group">
                            <label for="review">Review</label>
                            <textarea class="form-control" rows="4" id="review" name="review" required><?php echo $review; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="store_link">Store Link (A place to buy the book)</label>
                            <input type="text" class="form-control" id="store_link" name="store_link" value="<?php echo $store_link; ?>">
                        </div>
                         <input type="submit" class="btn btn-default" name="submit" value="Submit"/>
                         <button type="reset" class="btn btn-warning">Clear Inputs</button>
                    </form>
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