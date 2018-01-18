<?php
include('session.php');
include("config.php");
$error = "";
$message = "";


if (!$db) {
  die('Could not connect: ' . mysqli_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = mysqli_real_escape_string($db, $_POST['title']);
  $file = mysqli_real_escape_string($db, $_POST['file']);
  $sql = "INSERT INTO ABSTRACT (Atitle, Afile, Aaverage, Astatus) VALUES('$title', '$file', '0', 'null')";
  if ($db->query($sql) === TRUE) {
    $user_email = $_SESSION['email'];
    $user_query = $db->query("SELECT Sid FROM STUDENT WHERE Semail = '$user_email'");
    $user = mysqli_fetch_assoc($user_query);
    $user_id = $user['Sid'];
    $num_submits_query = $db->query("SELECT COUNT(*) as submits FROM (SELECT Sid FROM SUBMITS WHERE Sid = '$user_id') as x");
    $num_submits_results = mysqli_fetch_assoc($num_submits_query);
    $num_of_submits = $num_submits_results['submits'];
    $abstract_id = $db->query("SELECT Aid FROM ABSTRACT WHERE Atitle= '$title'");
    $aid = mysqli_fetch_assoc($abstract_id);
    $Aid = $aid['Aid'];
    if($num_of_submits == 0){
      $lowest_faculty = $db->query("SELECT Fid, count(*) as cnt FROM REVIEWS GROUP BY Fid ORDER BY cnt ASC LIMIT 3");
      $faculty = array();
      while ($row = mysqli_fetch_assoc($lowest_faculty)) {
        $faculty[] = $row['Fid'];
      }
      $fac1_id = $faculty[0];
      $fac2_id = $faculty[1];
      $mentor_query = $db->query("SELECT Fid FROM HAS WHERE Sid = '$user_id'");
      $mentor = mysqli_fetch_assoc($mentor_query);
      $mentor_id = $mentor['Fid'];
      if($fac1_id == $mentor_id){
        $fac1_id = $faculty[2];
      }
      if($fac2_id == $mentor_id){
        $fac2_id = $faculty[2];
      }
      $sql2 = "INSERT INTO REVIEWS (Fid, Aid, Rscore, Rdescription) VALUES('$fac1_id','$Aid','9', 'null')";
      if ($db->query($sql2) === TRUE) {
        $sql3 = "INSERT INTO REVIEWS (Fid, Aid, Rscore, Rdescription) VALUES('$fac2_id','$Aid','9','null')";
        if ($db->query($sql3) === TRUE) {
          $sql4 = "INSERT INTO REVIEWS (Fid, Aid, Rscore, Rdescription) VALUES('$mentor_id','$Aid','9','null')";
          if ($db->query($sql4) === TRUE) {
            $sql5 = "INSERT INTO SUBMITS VALUES ('$user_id', '$Aid')";
            if ($db->query($sql5) === TRUE) {
              $message=  "Abstract Submitted Successfully!";
            } else {
              $error = $sql . "<br>" . $db->error;
            }
          } else {
            $error = $sql . "<br>" . $db->error;
          }
        } else {
          $error = $sql . "<br>" . $db->error;
        }
      } else {
        $error = $sql . "<br>" . $db->error;
      }
    } else{
      $old_aid_query = $db->query("SELECT MAX(Aid) as old_aid FROM SUBMITS WHERE Sid = '$user_id'");
      $old_aid_result = mysqli_fetch_assoc($old_aid_query);
      $old_aid = $old_aid_result['old_aid'];
      $sql6 = "UPDATE REVIEWS SET Aid = '$Aid' WHERE Aid = '$old_aid'";
      if ($db->query($sql6) === TRUE){
        $sql7 = "INSERT INTO SUBMITS VALUES ('$user_id', '$Aid')";
        if ($db->query($sql7) === TRUE){
          $message=  "Abstract Submitted Successfully!";
        } else{
          $error = $sql . "<br>" . $db->error;
        }
      } else{
        $error = $sql . "<br>" . $db->error;
      }
    }
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
  <title>Abstract Submission</title>
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
                  <h1>Abstract Submission</h1>
                </div>
              </div>
            </div>
          </div>
          <!-- Form Panel    -->
          <div class="col-lg-6 bg-white">
            <div class="form d-flex align-items-center">
              <div class="content">
                <p style="color:#ff0000"><?php echo $error; ?></p>
                <p style="color:#009966"><?php echo $message; ?></p>
                <p style="color:#ff0000"><?php echo $error; ?></p>
                <form id="abstract-form" method="POST">
                  <div class="form-group">
                    <input id="abstract-title" type="title" name="title" required
                    class="input-material">
                    <label for="abstract-title" class="label-material">Title </label>
                  </div>
                  <div class="form-group">
                    <input id="abstract-file" type="file" name="file" required
                    class="input-material accept=".doc, .docx">
                    <label for="abstract-file" class="label-material"></label>
                  </div>
                  <input id="abstract" type="submit" value="Submit" class="btn btn-primary">
                </form>
                <a href="student.php" class="signup">Student Page</a>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="copyright">This material is based upon work supported by the National Science Foundation under Grant No. 1551221 and No. 1042341. Any opinions, findings, and conclusions or recommendations expressed in this material are those of the authors and do not necessarily reflect the views of the National Science Foundation.</div>

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
