<!DOCTYPE html>
<?php
    require_once('connectVars-azure.php');
    // require_once('connectVars-localhost.php');

    // start the session
    session_start();

    // clear the error message
    $error_msg = "";

    // if the user isn't logged in, try to log them in'
    if(!isset($_SESSION['user_id'])) {
        if(isset($_POST['submit'])) {
            // connect to the datebase
            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            
            // grab the user-entered log in date
            $user_username = mysqli_real_escape_string($conn, trim($_POST['username']));
            $user_password = mysqli_real_escape_string($conn, trim($_POST['password']));

            // retrieve the user
            $query = "SELECT user_id, user_name from user where user_name = '$user_username' AND user_password = SHA('$user_password')";
            $data = mysqli_query($conn, $query);

            if(mysqli_num_rows($data) == 1) {
                $row = mysqli_fetch_array($data);
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['user_name'];
                
                echo '<meta http-equiv="refresh" content="1;index.php">';
            } else {
                $error_msg = 'Sorry, you must enter a valid username or password to log in!';
                echo '
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Warning! ' .$error_msg. '</strong>
                    </div>';
            }
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
                    </div><!-- /.navbar-collapse -->
                </nav>
            </div>
        </header>

        <main>
            <!--Container Log in-->
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 form-box">
                        <h1>Login</h1>
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
                                    <input type="submit" class="btn btn-default" name="submit" value="Login"/>
                                </div>
                            </div>
                        </form>
                        <p>New user? <a href="register.php">Click here to Register!</a></p>
                    </div>
                </div>
            </div> <!-- End container log in-->
        </main>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>