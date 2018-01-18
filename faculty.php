<!DOCTYPE html>
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
    <h1>Faculty:
    <?php
        include('fsession.php');
        $user_email = $_SESSION['email'];
        $sql = "SELECT * FROM FACULTY WHERE Femail = '$user_email'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($result);
        echo $row['Ffirst_name'] . " ". $row['Flast_name'];
    ?>
</span></h1>
        </div>
</section>
<p></p>

<div class ="container">
    <center><h1>Account Info</h1></center>
<center>
<?php
    $abstracts = mysqli_query($db, "SELECT Atitle FROM ABSTRACT WHERE Aaverage = '0.0'");
    
    $user_check = $_SESSION['email'];
    $query="SELECT * FROM FACULTY where Femail = '$user_check'";
    $result=mysqli_query($db, $query);
    if(!$result) {
        die('Could not query: '. mysqli_error());
    }
    echo "<b>Signed in As: </b>" .$user_check ."<br>"."<br>";
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_array($result)) {
            if($row["Fis_active"]==TRUE) {
                $active = "Yes";
            } else {
                $active = "No";
            }
            //CREATE VIEW facultyInfo AS SELECT FACULTY.Fid, FACULTY.Fis_active,FACULTY.Fgender, FACULTY.Ffirst_name, FACULTY.F_initial, FACULTY.Flast_name, FACULTY.Femail, INSTITUTION.Iname from INSTITUTION JOIN FACULTY USING(Iid);
            echo "<b>ID:</b> " . $row["Fid"].  "  |  <b>Active:</b> " . $active."  |  <b>Gender:</b> " . $row["Fgender"]."<br>".  "<b>First Name:</b> " . $row["Ffirst_name"]."  |  <b>Middle Name:</b> " . $row["F_initial"]."  |  <b>Last Name:</b> " . $row["Flast_name"]."  |  <b>Email:</b> " . $row["Femail"]. "<br>"."<br>";
        }
    } else {
        echo "0 results";
    }
?>
</center>
<center><h1>Abstracts</h1></center>
<select class="form-group" id='abstracts' name="abstracts"
required-class="input-material">
<option>--Select--</option>
<?php while ($row = mysqli_fetch_array($abstracts)) {
    echo "<option value='" . $row['Atitle'] . "'>" . $row['Atitle'] . "</option>";
    }
 ?>
</select>
<br>
<center>
<input id="register" type="submit" value="Download" class="btn btn-primary">
</center>
<center>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $abstract_title = mysqli_real_escape_string($db, $_POST['abstracts']);
        $abstract_file = mysqli_query($db, "SELECT Afile FROM ABSTRACT WHERE Atitle= 'nnnn'");
        $row = mysqli_fetch_assoc($abstract_file);
        //echo $row["Afile"];
        
    }
?>
</center>
    <left>
        <img src="img/logo3.jpg" style = "float:center" width:"80px" height="80px">
    </left>
    <right>
        <img src="img/nsflogo.png" style = "float:center" width:"80px" height="80px" align="right">
    </right>

</div>
</div>

<!-- Footer -->
<section id="footer">
    <div class="inner">
        <center>
            <div class="copyright">This material is based upon work supported by the National Science Foundation under Grant No. 1551221 and No. 1042341. Any opinions, findings, and conclusions or recommendations expressed in this material are those of the authors and do not necessarily reflect the views of the National Science Foundation.</div>
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
