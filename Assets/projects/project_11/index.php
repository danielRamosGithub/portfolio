<!DOCTYPE html>
<?php 
    session_start();
    // require_once('connectVars-azure.php');
    require_once('connectVars-localhost.php');

    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Query to select all the books from the database
    $query = "SELECT * FROM books";
    // execute the query
    $data = mysqli_query($dbc, $query);
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
            <div class="container">
                <?php
                if(isset($_SESSION['user_id'])) {
                         echo '<div class="row">
                                    <h3> Welcome, '.$_SESSION['user_name'].'!</h3>
                              </div>';
                    }
                ?>
                <div class="row">
                    <h4>Below we have a list of books in our library. Enjoy!</h4>
                </div>
                <div class="row">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Book Title</th>
                            <th>Book Genre</th>
                            <th>Reviewer</th>
                            <th>Reviewer Email</th>
                            <th></th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_array($data)) {
                            echo '<tr>
                                    <td>' .$row['book_title']. '</td>
                                    <td>' .$row['book_genre']. '</td>
                                    <td>' .$row['book_review_person']. '</td>
                                    <td>' .$row['review_person_email']. '</td>
                                    <td>';
                                    if(isset($_SESSION['user_id'])) {
                                        echo '
                                              <a class="btn btn-info" href="book_info.php?book_id=' .$row['book_id']. '" role="button">More Info</a>
                                              <a class="btn btn-warning" href="book.php?book_id=' .$row['book_id']. '" role="button">Edit</a>
                                              <a class="btn btn-danger" href="delete.php?book_id=' .$row['book_id']. '" role="button">Delete</a>
                                             ';
                                    } else {
                                        echo '
                                              <a class="btn btn-info" href="book_info.php?book_id=' .$row['book_id']. '" role="button">More Info</a>
                                              <a class="btn btn-warning disabled" href="#" role="button">Edit</a>
                                              <a class="btn btn-danger disabled" href="#" role="button">Delete</a>
                                             ';
                                    }
                             echo ' </td>       
                                   </tr>';
                        }
                        ?>
                    </table>
                </div>
                <div class="row">
                    <p>Help our library grow. Click on the button bellow to add a new book.</p>
                    <a class="btn btn-primary" href="book.php" role="button">Add Book</a>
                </div>
            </div> <!-- div container -->

        </main>

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/dropdown.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>