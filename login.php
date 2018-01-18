<?php
//We include the configuration file
include("config.php");
include("reports.php");
$error = "";

//Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $myusername = mysqli_real_escape_string($db, $_POST['username']);
    $mypassword = mysqli_real_escape_string($db, $_POST['password']);

    if ($myusername == "admin" && $mypassword == "admin1") {
        $_SESSION['login_user'] = $myusername;
        echo 'Logged in as: ADMIN<br>';
        echo '<a href="http://cs4342.cs.utep.edu/team10/reports.html">Reports</a><br>';
        //echo '<a href="#">Add User</a><br>';
        header("location: portal_index.php?user=admin");
    } else if ($myusername == "user" && $mypassword == "user1") {
        $_SESSION['login_user'] = $myusername;
        echo 'Logged in as: User<br>';
        echo '<a href="http://cs4342.cs.utep.edu/team10/reports.html">Reports</a><br>';
        header("location: portal_index.php?user=reviewer");
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CAHSI Abstract | Review System</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.sea.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Font Awesome CDN-->
    <!-- you can replace it by local Font Awesome-->
    <script src="https://use.fontawesome.com/99347ac47f.js"></script>
    <!-- Font Icons CSS-->
    <link rel="stylesheet" href="https://file.myfontastic.com/da58YPMQ7U5HY8Rb6UxkNf/icons.css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>
<div class="page login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
            <div class="row">
                <!-- Logo & Information Panel-->
                <div class="col-lg-6">
                    <div class="info d-flex align-items-center">
                        <div class="content">
                            <div class="logo">
                                <?php if ($login_type == 'student'){ ?>
                                <h1>CAHSI</h1>
                                <h2>Great Minds in STEM Research
                                    Paper Competition and Poster Presentation<br>Abstract and Poster Review Portal</h2><br>
                                <h3>Welcome! If you are a new student to the system, please click the Sign Up button to
                                    input your
                                    information.</h3>
                                <?php } else{ ?>
                                <h1>CAHSI</h1>
                                <h2>Great Minds in STEM Research
                                    Paper Competition and Poster Presentation<br>Abstract and Poster Review Portal</h2><br>
                                <h3>Welcome! If you are a new reviewer to the system, please click the Sign Up button to
                                    input your
                                    information.</h3>
                                <?php } ?>
                            </div>
                            <p></p>
                        </div>
                    </div>
                </div>
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            <p style="color:#ff0000"><?php echo $error; ?></p>
                            <form id="login-form" method="post" action="login.php">
                                <div class="form-group">
                                    <input id="login-username" type="text" name="username" required=""
                                           class="input-material">
                                    <label for="login-username" class="label-material">User Name</label>
                                </div>
                                <div class="form-group">
                                    <input id="login-password" type="password" name="password" required=""
                                           class="input-material">
                                    <label for="login-password" class="label-material">Password</label>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Login">
                                <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                            </form>
                            <a href="#" class="forgot-pass">Forgot Password?</a><br>
                            <small>Do not have an account?</small>
                            <a href="register.php" class="signup">Signup</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyrights text-center">
    </div>
</div>
<!-- Javascript files-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/front.js"></script>

</body>
</html>
