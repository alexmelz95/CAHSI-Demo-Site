<?php
    include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>CAHSI | Abstract Review System</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<link rel="stylesheet" href="css/main.css" />


 <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">

</head>
<body>
<!-- Header -->
<header id="header">
  <div class="inner"> <a href="student.php" class="logo"><img src="img/logo.png" style = "float:center" width:"104px" height="104px"></a>
    <nav id="nav">
    <a href="student.php">Student</a>
     <a href="uploaded_abstracts.php">Abstracts</a>
     <a href="poster.php">Poster</a>
     <a href="logout.php">Log Out</a>
    </nav>
  </div>
</header>
<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>



<!-- Banner -->
<section id="banner">
<div style="padding:60px;margin-top:-160px;background-color:#1A2154;height:10px;">
  <div class="inner">
    <h1>Welcome,
<?php
    $user_email = $_SESSION['email'];
    $sql = "SELECT * FROM STUDENT WHERE Semail = '$user_email'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    echo $row['Sfirst_name'] . " ". $row['Slast_name'];
    ?>!
</span></h1>
  </div>
</section>
<p></p>

<div class ="container">
<center><h1> CALL FOR ABSTRACTS</h1></center>
  <center>
	<img src="img/deadlines2.png" style = "float:center" width:"350px" height="350px">
  </center>
<center><p><b>CAHSI is joining forces with Great Minds in STEM by holding the CAHSI annual summit in a joint event with the HENAAC Conference 2017.</b></p>

<p>CAHSI<sup>'</sup>s collaboration is focused on supporting the recruitment, retention, and advacement of Hispanics in computing by strengthening CAHSI<sup>'</sup>s
student and professional networks through our annual networking lunch, hackathon, and technical and professional development sessions.</p>
<p><a href="http://www.greatmindsinstem.org/conference/conference-home">www.greatmindsinstem.org/conference/conference-home/a></p></center>
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
