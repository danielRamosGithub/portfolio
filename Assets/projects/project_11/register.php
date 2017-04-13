<!DOCTYPE html>
<?php
    require_once('connectVars-azure.php');
    // require_once('connectVars-localhost.php');

    $msg = "";

    // connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if(isset($_POST['submit'])) {

        // grab the info from the FORM
        $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $password = mysqli_real_escape_string($dbc, trim($_POST['password']));

        if(!empty($username) && !empty($password)) {
            // check if the username isn't taken
            $query = "SELECT * FROM user where user_name = '$username'";

            $data = mysqli_query($dbc, $query);

            if(mysqli_num_rows($data) == 0) {
                // username unique, insert into the database
                $query = "INSERT INTO user (user_name, user_password) VALUES ('$username', SHA('$password'))";
                mysqli_query($dbc, $query);

                $msg = "Your account has been successfully created.";
                echo '
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Sucess! ' .$msg. '</strong>
                        <a href="login.php" class="alert-link">You are ready to Log in. Click here!</a>
                    </div>';
                echo '<meta http-equiv="refresh" content="3;login.php">';
                mysqli_close($dbc);
            } else {
                $msg = 'An account already exist for this username!';
                echo '
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Warning! ' .$msg. '</strong>
                    </div>';
                $username = "";
            }
        } else {
            $msg = 'You must enter all the information needed!';
                echo '
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Warning! ' .$msg. '</strong>
                    </div>';
        }
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
                        <a class="navbar-brand" href="#">Book Lovers</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="index.php">Library</a></li>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="register.php">Register</a></li>
                        </ul>
                    </div>
                </div><!-- /.navbar-collapse -->
            </nav>
        </header>

        <main>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 form-box">
                        <h1>Sign Up Registration Info</h1>
                        <p>Please enter your username and desired password to register.</p>
                        <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="form-group">
                                <label for="exampleInputName" class="col-sm-4 control-label">User Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="exampleInputName" required name="username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="col-sm-4 control-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="exampleInputPassword1" required name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <input type="submit" class="btn btn-default" name="submit" value="Register"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- End container log in-->
        </main>

        <script src="js/jquery.min.js"></script>
        <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/dropdown.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>