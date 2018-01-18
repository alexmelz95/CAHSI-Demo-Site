<?php
    include('asession.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>CAHSI | Reports</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="css/main.css"/>


    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">

</head>
<body>
<!-- Header -->
<header id="header">
  <div class="inner"><a href="student.php" class="logo"><img src="img/logo.png" style="float:center" width:"104px"
                                                             height="104px"></a>
        <nav id="nav">
            <a href="admin.php">Admin</a>
            <a href="reports.php">reports</a> |
            <a href="logout.php">Log out</a>
        </nav>
    </div>
</header>
<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>


<!-- Banner -->
<section id="banner">
    <div style="padding:60px;margin-top:-160px;background-color:#1A2154;height:10px;">
        <div class="inner">
            <h1>Report</span></h1>
        </div>
</section>
<p></p>

<div class="container">
    <center><h1>Reports:</h1>
    <form id="register-form" method="POST">
        <select class="form-control m-bot15" id='reports' name="reports"
                required-class="input-material">
            <option>--Select--</option>
            <option>Active Faculty Information</option>
            <option>Abstracts Submitted Per Institution</option>
            <option>Students and Mentors</option>
        </select>
        <br>
        <input id="register" type="submit" value="View" class="btn btn-primary"></center>
        <br><br>
    </form>
    <?php
    include('asession.php');

    $user_check = $_SESSION['email'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $report_name = mysqli_real_escape_string($db, $_POST['reports']);
    ?>
    <div class="container" style="text-align: center;">
        <!--report 1-->
        <?php if ($report_name == "Active Faculty Information") {
        $query = "SELECT * FROM FACULTY JOIN FTYPE WHERE FACULTY.Fid = FTYPE.Fid AND FTYPE.Ftype = 'Mentor' AND FACULTY.Fis_active = 1";
        $result = mysqli_query($db, $query);
        ?>
        <h1>Active Faculty Information</h1>
        <div>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Institution ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Faculty Type</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <?php if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo $row["Fid"] ?></td>
                            <td><?php echo $row['Iid'] ?></td>
                            <td><?php echo $row['Ffirst_name'] ?></td>
                            <td><?php echo $row['Flast_name'] ?></td>
                            <td><?php echo $row['Fgender'] ?></td>
                            <td><?php echo $row['Ftype'] ?></td>
                            <td><?php echo $row['Femail'] ?></td>
                        </tr>
                    <?php }
                } else {
                    echo "0 results";
                }
                } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container" style="text-align: center;">
        <!--report 2-->
        <?php if ($report_name == "Abstracts Submitted Per Institution") {
        $query = "SELECT Iacronym, COUNT(*) FROM ABSTRACT, INSTITUTION JOIN SUBMITS JOIN STUDENT WHERE ABSTRACT.Aid = SUBMITS.Aid AND STUDENT.Sid = SUBMITS.Sid AND STUDENT.Iid = INSTITUTION.Iid AND INSTITUTION.Iacronym = 'UTEP'";
        $result = mysqli_query($db, $query);
        ?>
        <h1>Abstracts Submitted by Institution</h1>
        <div>
            <table>
                <thead>
                <tr>
                    <th>Institution</th>
                    <th>Institution Count</th>
                </tr>
                </thead>
                <tbody>
                <?php if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo $row["Iacronym"] ?></td>
                            <td><?php echo $row["COUNT(*)"] ?></td>
                        </tr>
                    <?php
                    }} else {
                    echo "0 results";
                }
                } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container" style="text-align: center;">
        <!--report 3-->
        <?php if ($report_name == "Students and Mentors") {
        $query = "SELECT Sfirst_name, Slast_name, Ffirst_name, Flast_name FROM FACULTY, STUDENT JOIN SUBMITS JOIN HAS JOIN REVIEWS WHERE HAS.Fid = REVIEWS.Fid AND HAS.Sid = SUBMITS.Sid AND SUBMITS.Sid = STUDENT.Sid AND REVIEWS.Fid =FACULTY.Fid";
        $result = mysqli_query($db, $query);
        ?>
        <h1>Students/Mentors</h1>
        <div>
            <table>
                <thead>
                <tr>
                    <th>Student: First Name</th>
                    <th>Student: Last Name</th>
                    <th>Mentor: First Name</th>
                    <th>Mentor: Last Name</th>
                </tr>
                </thead>
                <tbody>
                <?php if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo $row["Sfirst_name"] ?></td>
                            <td><?php echo $row['Slast_name'] ?></td>
                            <td><?php echo $row['Ffirst_name'] ?></td>
                            <td><?php echo $row['Flast_name'] ?></td>
                        </tr>
                    <?php }
                } else {
                    echo "0 results";
                }
                }
                } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <!-- Footer -->
<center>
    <section id="footer">
        <div class="inner">
            <div class="copyright"> &copy; UTEP | ICT 2017</div>
        </div>
    </section>
</center>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
