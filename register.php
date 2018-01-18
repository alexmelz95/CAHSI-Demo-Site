<?php
include("config.php");
$error = "";

if (!$db) {
    die('Could not connect: ' . mysqli_error());
}

$login_type = $_GET['logintype'];


$institutions = $db->query('SELECT Iname FROM INSITUTION');
$faculty = $db->query('SELECT Fid, Ffirst_name, Flast_name FROM FACULTY');
//$institutions = array();
//$index = 0;
//while ($row = mysqli_fetch_assoc($query)) {
//    $institutions[$index] = $row;
//    $index++;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = mysqli_real_escape_string($db, $_POST['firstname']);
    $mName = mysqli_real_escape_string($db, $_POST['mname']);
    $lastName = mysqli_real_escape_string($db, $_POST['lastname']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $ethnicity = mysqli_real_escape_string($db, $_POST['ethnicity']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $email = mysqli_real_escape_string($db, $_POST['email']);

    //Getting Institution ID
    $institution_name = mysqli_real_escape_string($db, $_POST['institution']);
    $institution_id = mysqli_query($db, "SELECT Iid FROM INSTITUTIONS WHERE Iname='$institution_name'");

    //Student Attributes
    $classification = mysqli_real_escape_string($db, $_POST['classification']);
    $major = mysqli_real_escape_string($db, $_POST['major']);


    //Password Hashing
    $randString = "WangZheRongYao";
    $hashedPwd = password_hash($email . $password . $randString, PASSWORD_DEFAULT);
    //$userType = $_POST['user'];

    if ($login_type == 'student') {
        //Check to see if student is authorized to make an acct
        $query = mysqli_query($db, "SELECT * FROM STUDENT WHERE Semail = '$email'");
        $student = array();
        $index = 0;
        while ($row = mysqli_fetch_assoc($query)) {
            $student[$index] = $row;
            $index++;
        }
        if (sizeof($student) == 0) {
            die('You are not an authorized student. Please speak to your local CAHSI advisor.');
        }
        //Building the query to update the student account
        $sql = "UPDATE STUDENT SET Sgender = '$gender', Siid = '$institution_id', Sclassification = '$classification', 
                Smajor = 'major', Sfirst_name = '$firstName', S_initial = '$mName', Slast_name = '$lastName', Spassword = '$hashedPwd' WHERE Semail = '$email'";
    } else {
        $query = mysqli_query($db, "SELECT * FROM FACULTY WHERE Femail = '$email'");
        $faculty = array();
        $index = 0;
        while ($row = mysqli_fetch_assoc($query)) {
            $faculty[$index] = $row;
            $index++;
        }
        if (sizeof($faculty) == 0) {
            die('You are not an authorized faculty member. Please speak to your local CAHSI advisor.');
        }
        $sql = "UPDATE FACULTY SET Fgender = '$gender', Ffirst_name = '$firstName', F_initial = '$mName', Flast_name = '$lastName', Fiid = '$institution_id', Fpassword = '$hashedPwd' WHERE Femail = '$email'";
    }

    if ($db->query($sql) === TRUE) {
        echo "You have been added successfully";
        header("location: login.php");
    } else {
        $error = $sql . "<br>" . $db->error;
    }
}
$db->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
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
                                <h2>Register</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            <form id="register-form" method="POST">
                                <div class="form-group">
                                    <input id="register-email" type="email" name="email" required
                                           class="input-material">
                                    <label for="register-email" class="label-material">Email Address </label>
                                </div>
                                <div class="form-group">
                                    <input id="register-password" type="password" name="password" required
                                           class="input-material">
                                    <label for="register-password" class="label-material">Enter New Password</label>
                                </div>
                                <div class="form-group">
                                    <input id="register-firstname" type="text" name="firstname" required
                                           class="input-material">
                                    <label for="register-username" class="label-material">First Name</label>
                                </div>
                                <div class="form-group">
                                    <input id="register-mname" type="text" name="mname" required
                                           class="input-material">
                                    <label for="register-username" class="label-material">Middle Name</label>
                                </div>
                                <div class="form-group">
                                    <input id="register-lastname" type="text" name="lastname" required
                                           class="input-material">
                                    <label for="register-username" class="label-material">Last Name</label>
                                </div>
                                <div class="form-group">
                                    <label for="institution">Select Institution</label><br>
                                    <select class="form-control m-bot15" id='register-institution' name="institution"
                                            required-class="input-material">
                                        <option>--Select--</option>
                                        <?php while ($row = mysqli_fetch_array($institutions)) {
                                            echo "<option value='" . $row['Iname'] ."'>" . $row['Iname'] ."</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input id="register-gender" type="text" name="gender" required
                                           class="input-material">
                                    <label for="register-gender" class="label-material">Gender</label>
                                </div>
                                <div class="form-group">
                                    <input id="register-ethnicity" type="text" name="ethnicity" required
                                           class="input-material">
                                    <label for="register-ethnicity" class="label-material">Ethnicity</label>
                                </div>
                                <?php if ($login_type == 'student') { ?>
                                    <div class="form-group">
                                        <input id="register-classification" type="text" name="classification" required
                                               class="input-material">
                                        <label for="register-classification" class="label-material">Student Classification</label>
                                    </div>
                                    <div class="form-group">
                                        <input id="register-major" type="text" name="major" required
                                               class="input-material">
                                        <label for="register-username" class="label-material">Major</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="mentor">Select Research Mentor (Note: Research Mentor must be registered in portal for student to register)</label><br>
                                        <select class="form-control m-bot15" id='register-institution' name="institution"
                                                required-class="input-material">
                                            <option>--Select--</option>
                                            <?php while ($row = mysqli_fetch_array($institutions)) {
                                                echo "<option value='" . $row['Iname'] ."'>" . $row['Iname'] ."</option>";
                                            } ?>
                                        </select>
                                    </div>
                                <?php } ?>
                                <input id="register" type="submit" value="Register" class="btn btn-primary">
                            </form>
                            <small>Already have an account?</small>
                            <a href="login.php" class="signup">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyrights text-center">
        <p>&copy; ICT 2017</p>

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
