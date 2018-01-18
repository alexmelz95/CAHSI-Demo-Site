<?php
    include('fsession.php');
    $message = "";
    $error = "";
    
    if (!$db) {
        die('Could not connect: ' . mysqli_error());
    }
    
    $abstracts = mysqli_query($db, "SELECT Atitle FROM ABSTRACT WHERE Aaverage = '0.0'");
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $abstract_title = mysqli_real_escape_string($db, $_POST['abstracts']);
            $abstract_score = mysqli_real_escape_string($db, $_POST['score']);
            $abstract_com = mysqli_real_escape_string($db, $_POST['comment']);
            
            $abstract_file = mysqli_query($db, "SELECT Afile FROM ABSTRACT WHERE Atitle= '$abstract_title'");
            $row = mysqli_fetch_assoc($abstract_file);
            //echo row["Afile"];
            
            $sql = "UPDATE ABSTRACT SET Aaverage = '$abstract_score', Astatus = '$abstract_com' WHERE Atitle = '$abstract_title'";
            
            if ($db->query($sql) === TRUE) {
                header("location: reviewer.php");
            } else {
                $error = "Score and comment submission failed";
            }
            
        }
?>
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
    <div class="inner"> <a href="reviewer.php" class="logo"><img src="img/logo.png" style = "float:center" width:"104px" height="104px"></a>
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
            <h1>Reviewer</span></h1>
        </div>
</section>
<p></p>

<div class ="container">
<h1>ABSTRACTS:</h1>
<center>
<p style="color:#009966"><?php echo $message; ?></p>
<p style="color:#ff0000"><?php echo $error; ?></p>
</center>
<form id="register-form" method="POST">
<select class="form-group" id='abstracts' name="abstracts"
required-class="input-material">
<option>--Select--</option>
<?php while ($row = mysqli_fetch_array($abstracts)) {
    echo "<option value='" . $row['Atitle'] . "'>" . $row['Atitle'] . "</option>";
} ?>
</select>
<br>
<div class="form-group">
<label for="register-classification" class="label-material">Score</label>
<input id="register-classification" type="text" name="score" required
class="input-material">
</div>
<br>
<div class="form-group">
<label for="register-username" class="label-material">Comment</label>
<input id="register-major" type="text" name="comment" required
class="input-material">
</div>
<br>
<center>
<input id="register" type="submit" value="Submit" class="btn btn-primary">
</center>
<br>
</form>
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
