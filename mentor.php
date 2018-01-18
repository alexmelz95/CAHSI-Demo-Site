<?php
include('fsession.php');
?>

<html>
<head>
    <title>CAHSI | Faculty</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="css/main.css" />


    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">

</head>
<body>
<!-- Header -->
<header id="header">
    <div class="inner"> <a href="faculty.php" class="logo"><img src="img/logo.png" style = "float:center" width:"104px" height="104px"></a>
        <nav id="nav">
            <a href="faculty.php">Faculty</a>
            <a href="reviewer.php">Reviewer</a>
            <a href="mentor.php">Mentor</a> |
            <a href="logout.php">Log Out</a>
        </nav>
    </div>
</header>
<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>



<!-- Banner -->
<section id="banner">
    <div style="padding:60px;margin-top:-160px;background-color:#1A2154;height:10px;">
        <div class="inner">
            <h1>Mentor</span></h1>
        </div>
</section>
<p></p>

<div class ="container">
    <!--<center><h6>student,student1 for student login</h6></center>
    <br>
    <center><h6>faculty,faculty1 for faculty login</h6></center>
    <br>-->
    <center><h1>List of Students</h1></center>
    <center>
        <?php
        include('fsession.php');

        $user_check = $_SESSION['email'];
        $query="SELECT * FROM studentInfo";
        $result=mysqli_query($db, $query);
        if(!$result) {
            die('Could not query: '. mysqli_error());
        }

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_array($result)) {
                if($row["Scahsi_Student"]==TRUE) {
                    $Cahsi = "Yes";
                } else {
                    $Cahsi = "No";
                }
                //CREATE VIEW studentInfo AS SELECT STUDENT.Sid, STUDENT.Sclassification, STUDENT.Scahsi_Student, STUDENT.Sgender, STUDENT.Smajor, STUDENT.Sfirst_name, STUDENT.S_initial, STUDENT.Slast_name, STUDENT.Semail, INSTITUTION.Iname from INSTITUTION JOIN STUDENT USING(Iid);
                echo "<b>ID:</b> " . $row["Sid"]. "  |  <b>Institution:</b> " . $row["Iname"]. "  |  <b>Classification:</b> " . $row["Sclassification"].  "  |  <b>CAHSI Student:</b> " . $Cahsi."  |  <b>Gender:</b> " . $row["Sgender"]."<br>". "<b>Major:</b> " . $row["Smajor"]. "  |  <b>First Name:</b> " . $row["Sfirst_name"]."  |  <b>Middle Name:</b> " . $row["S_initial"]."  |  <b>Last Name:</b> " . $row["Slast_name"]."  |  <b>Email:</b> " . $row["Semail"]. "<br>"."<br>";
            }
        } else {
            echo "0 results";
        }
        ?>

</div>

<!-- Footer -->
<section id="footer">
    <div class="inner">
        <center>
            <div class="copyright"> This material is based upon work supported by the National Science Foundation under Grant No. 1551221 and No. 1042341. Any opinions, findings, and conclusions or recommendations expressed in this material are those of the authors and do not necessarily reflect the views of the National Science Foundation.</div>
        </center>
    </div>
</section>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>



</body>
</html>
