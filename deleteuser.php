<?php
include("config.php");
include('asession.php');
$message = "";
$error = "";

if (!$db) {
    die('Could not connect: ' . mysqli_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = mysqli_real_escape_string($db, $_POST['id']);
    $userType = $_POST['user'];
    
    if($userType == 'Student') {
        //Check if student is exit in DB
        $students = mysqli_query($db, "SELECT Sid FROM STUDENT WHERE Sid = '$id'");
        $studentId = array();
        $index = 0;
        while ($row = mysqli_fetch_assoc($students)) {
            $studentId[$index] = $row;
            $index++;
        }
        if (sizeof($studentId) > 0) {
            //Building the query to delete the student account
            $sql = "DELETE FROM STUDENT WHERE Sid = '$id'";
        }
    }
    
    if($userType == 'Faculty') {
        //Check if faculty is exit in DB
        $facultys = mysqli_query($db, "SELECT Fid FROM FACULTY WHERE Fid = '$id'");
        $facultyId = array();
        $index = 0;
        while ($row = mysqli_fetch_assoc($facultys)) {
            $facultyId[$index] = $row;
            $index++;
        }
        if (sizeof($facultyId) > 0) {
            //Building the query to delete the faculty account
            $sql = "DELETE FROM FACULTY WHERE Fid = '$id'";
        }
    }
    
    if ($db->query($sql) === TRUE) {
        $message=  $userType . " #" . $id . " is deleted from our DB!";
    } else {
        $error= $userType . " #" . $id . " is not in our DB!";
    }
}
$db->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Delete User</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
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
                                <h1>CAHSI</h1>
                                <h2>Abstract Review System</h2>
                                <h2>Delete User</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            <p style="color:#009966"><?php echo $message; ?></p>
                            <p style="color:#ff0000"><?php echo $error; ?></p>
                            <form id="register-form" method="POST">
                                <div class="form-group">
                                <label for="admin">Student: </label>
                                <input name="user" id="user" type="radio" value="Student">
                                <label for="regularUser">Faculty: </label>
                                <input name="user" id="user" type="radio" value="Faculty">
                                </div>
                                <div class="form-group">
                                    <input id="register-email" type="text" name="id" required
                                           class="input-material">
                                    <label for="register-email" class="label-material">ID Number </label>
                                </div>
                                <input id="register" type="submit" value="Delete" class="btn btn-primary">
                            </form>
                            <a href="admin.php" class="signup">Admin Page</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Javascript files-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/front.js"></script>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
<!---->
<script>
    (function (b, o, i, l, e, r) {
        b.GoogleAnalyticsObject = l;
        b[l] || (b[l] =
            function () {
                (b[l].q = b[l].q || []).push(arguments)
            });
        b[l].l = +new Date;
        e = o.createElement(i);
        r = o.getElementsByTagName(i)[0];
        e.src = '//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e, r)
    }(window, document, 'script', 'ga'));
    ga('create', 'UA-XXXXX-X');
    ga('send', 'pageview');
</script>
</body>
</html>
