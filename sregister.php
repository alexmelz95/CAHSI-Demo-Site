<?php
include("config.php");
$error = "";

if (!$db) {
    die('Could not connect: ' . mysqli_error());
}

$query = "SELECT Fid, Ffirst_name, Flast_name FROM FACULTY";
$mentors = mysqli_query($db, $query);
if (!$mentors) {
    die('Could not query: ' . mysqli_error());
}

$institutions = mysqli_query($db, "SELECT Iname FROM INSTITUTION");
if (!$institutions) {
    die('Could not query: ' . mysqli_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $institution_name = mysqli_real_escape_string($db, $_POST['institution']);
    $firstName = mysqli_real_escape_string($db, $_POST['firstname']);
    $mName = mysqli_real_escape_string($db, $_POST['mname']);
    $lastName = mysqli_real_escape_string($db, $_POST['lastname']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $ethnicity = mysqli_real_escape_string($db, $_POST['ethnicity']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $classification = mysqli_real_escape_string($db, $_POST['classification']);
    $major = mysqli_real_escape_string($db, $_POST['major']);
    $mentor_id = mysqli_real_escape_string($db, $_POST['faculty_id']);

    //Getting Institution ID
    $institution = mysqli_query($db, "SELECT Iid FROM INSTITUTION WHERE Iname= '$institution_name'");
    $result = mysqli_fetch_assoc($institution);
    $id = $result['Iid'];
    
    //Password Hashing
    $randString = "WangZheRongYao";
    $hashedPwd = password_hash($password . $randString, PASSWORD_DEFAULT);

    //Check if email is exit in DB
    /*$Semail = mysqli_query($db, "SELECT Semail FROM STUDENT WHERE Semail = '$email'");
    $student = array();
    $index = 0;
    while ($row = mysqli_fetch_assoc($Semail)) {
        $student[$index] = $row;
        $index++;
    }
    if (sizeof($student) > 0) {*/

    
    //Check if email is been registered
    $student_check = mysqli_query($db, "SELECT * FROM STUDENT WHERE Semail = '$email'");
    $student = array();
    $index = 0;
    while ($row = mysqli_fetch_assoc($student_check)) {
        $student[$index] = $row;
        $index++;
    }

    if (sizeof($student) <= 0) {
        //Building the query to update the student account
        $sql = "INSERT INTO STUDENT VALUES(NULL,'$id','$classification',TRUE,'$gender','$major','$firstName','$mName','$lastName','$email','$hashedPwd')";
        //$sql = "UPDATE STUDENT SET Iid = '$id', Sclassification = '$classification', Scahsi_Student = TRUE, Sgender = '$gender', Smajor = '$major', Sfirst_name = '$firstName', S_initial = '$mName', Slast_name = '$lastName', Spassword = '$hashedPwd' WHERE Semail = '$email'";

        if ($db->query($sql) === TRUE) {
            $student_id = mysqli_query($db, "SELECT Sid FROM STUDENT WHERE Semail= '$email'");
            $row = mysqli_fetch_assoc($student_id);
            $Sid = $row['Sid'];
            //$sql1 = "INSERT INTO SETHNICITY VALUES('$Sid','$ethnicity')";
            $sql2 = "INSERT INTO HAS VALUES('$Sid', '$mentor_id')";
            
            if ($db->query($sql2) === TRUE) {
                    header("location: slogin.php");
            } else {
                $error = "Error Occur.". $db->error;
                //header("location: slogin.php");
            }
        } else {
            $error = "Register failed.". $db->error;
        }
    } else {
        $error = "This email has been registered.";
    }
    /*} else {
        $error = "You are not an authorized student. Please speak to your local CAHSI advisor.";
    }*/
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
                                <h2>Student Register</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            <p style="color:#ff0000"><?php echo $error; ?></p>
                            <form id="register-form" method="POST">
                                <div class="form-group">
                                    <label for="institution">Select Institution</label><br>
                                    <select class="form-control m-bot15" id='register-institution' name="institution"
                                            required-class="input-material">
                                        <option>--Select--</option>
                                        <?php while ($row = mysqli_fetch_array($institutions)) {
                                            echo "<option value='" . $row['Iname'] . "'>" . $row['Iname'] . "</option>";
                                        } ?>
                                    </select>
                                </div>
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
                                    <input id="register-gender" type="text" name="gender" required
                                           class="input-material">
                                    <label for="register-gender" class="label-material">Gender</label>
                                </div>
                                <div class="form-group">
                                    <input id="register-ethnicity" type="text" name="ethnicity" required
                                           class="input-material">
                                    <label for="register-ethnicity" class="label-material">Ethnicity</label>
                                </div>
                                <div class="form-group">
                                    <input id="register-classification" type="text" name="classification" required
                                           class="input-material">
                                    <label for="register-classification" class="label-material">Student
                                        Classification</label>
                                </div>
                                <div class="form-group">
                                    <input id="register-major" type="text" name="major" required
                                           class="input-material">
                                    <label for="register-username" class="label-material">Major</label>
                                </div>
                                <div class="form-group">
                                    <label for="institution">Select Mentor (*Note Mentor must be registered for student
                                        to register.
                                        If mentor name does not appear, contact mentor for registration.*</label><br>
                                    <select class="form-control m-bot15" id='register-institution' name="faculty_id"
                                            required-class="input-material">
                                        <option>--Select--</option>
                                        <?php
                                        while ($row = mysqli_fetch_array($mentors)) {
                                            echo "<option value='" . $row['Fid'] . "'>" . $row['Flast_name'] . ', ' . $row['Ffirst_name'] . "</option>";
                                        } ?>
                                    </select>
                                </div>
                                <input id="register" type="submit" value="Register" class="btn btn-primary">
                            </form>
                            <small>Already have an account?</small>
                            <a href="slogin.php" class="signup">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyrights text-center">
        <p>&copy; UTEP | ICT 2017</p>

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
