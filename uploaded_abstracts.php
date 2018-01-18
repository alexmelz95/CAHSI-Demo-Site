<?php
include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>CAHSI | Abstract Review System</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
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
        <h1>Student</span></h1>
      </div>
    </section>
    <p></p>

    <div class="container" id="student">
      <!--<center><h6>student,student1 for student login</h6></center>
      <br>
      <center><h6>faculty,faculty1 for faculty login</h6></center>
      <br>-->
      <center><h3><a href="abstract.php">UPLOAD NEW ABSTRACT</a></h3></center>
      <hr>
      <center><h1>Uploaded Abstracts</h1></center>
      <br>
      <center>
        <?php
        $user_email = $_SESSION['email'];
        $user_query = $db->query("SELECT Sid FROM STUDENT WHERE Semail = '$user_email'");
        $user = mysqli_fetch_assoc($user_query);
        $user_id = $user['Sid'];
        $result = $db->query("SELECT Atitle, Afile FROM SUBMITS NATURAL JOIN ABSTRACT WHERE Sid = '$user_id'");
        if (!$result) {
          die('Could not query: ' . mysqli_error());
        }
        ?>
        <div>
          <table class="table">
            <thead class="thead-inverse">
              <tr>
                <th>Abstract Title</th>
                <th>File</th>
              </tr>
            </thead>
            <tbody>
              <?php if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {?>
                  <tr>
                    <td><?php echo $row["Atitle"] ?></td>
                    <td><a href="<?php echo $row["Afile"]?>"><?php echo $row["Afile"] ?></a></td>
                  </tr>
                <?php }
              } else {
                echo "0 results<br>".$user_id;
              } ?>
            </tbody>
          </table>
        </div>
      </center>
      <br>
      <!--    </center>-->
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
