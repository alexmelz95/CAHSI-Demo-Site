<?php
    include('session.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>CAHSI | Abstract Review System</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="css/main.css"/>


    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
</head>
<body>
<!-- Header -->
<header id="header">
    <div class="inner"><a href="student.php" class="logo"><img src="img/logo.png" style="float:center" width="104px" height="104px"></a>
       <nav id="nav"> 
    <a href="student.php">Student</a>
     <a href="abstract.php">Abstract</a>
     <a href="poster.php">Poster</a>
     <a href="applications.php">Applications</a> |
     <a href="logout.php">Log Out</a>
    </nav>
    </div>
</header>
<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>


<!-- Banner -->
<section id="banner">
    <div style="padding:60px;margin-top:-160px;background-color:#1A2154;height:10px;">
        <div class="inner">
            <h1>Applications</span></h1>
        </div>
</section>
<p></p>

<div class="container" id="student">

    <center><h1>Registered Students</h1></center>
    <br>
    <center>
        <?php

        $query = "SELECT * FROM studentInfo";
        $result = mysqli_query($db, $query);
        if (!$result) {
            die('Could not query: ' . mysqli_error());
        }
        ?>
        <div>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Institution</th>
                    <th>Classification</th>
                    <th>CAHSI Student</th>
                    <th>Gender</th>
                    <th>Major</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <?php if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        if ($row["Scahsi_Student"] == TRUE) {
                            $Cahsi = "Yes";
                        } else {
                            $Cahsi = "No";
                        } ?>
                        <tr>
                            <td><?php echo $row["Sid"] ?></td>
                            <td><?php echo $row['Iname'] ?></td>
                            <td><?php echo $row['Sclassification'] ?></td>
                            <td><?php echo $Cahsi ?></td>
                            <td><?php echo $row['Sgender'] ?></td>
                            <td><?php echo $row['Smajor'] ?></td>
                            <td><?php echo $row['Sfirst_name'] ?></td>
                            <td><?php echo $row['S_initial'] ?></td>
                            <td><?php echo $row['Slast_name'] ?></td>
                            <td><?php echo $row['Semail'] ?></td>
                        </tr>
                    <?php }
                } else {
                    echo "0 results";
                } ?>
                </tbody>
            </table>
        </div>
    </center>
    <br><hr><br>
    <center><h1>Registered Faculty</h1></center>
    <br>
    <center>
        <?php
        include('asession.php');

        $user_check = $_SESSION['email'];
        $query = "SELECT * FROM facultyInfo";
        $result = mysqli_query($db, $query);
        if (!$result) {
            die('Could not query: ' . mysqli_error());
        }
        ?>
        <div>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Institution</th>
                    <th>Active</th>
                    <th>Gender</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <?php if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        while ($row = mysqli_fetch_array($result)) {
                            if ($row["Fis_active"] == TRUE) {
                                $active = "Yes";
                            } else {
                                $active = "No";
//                }
                        } ?>
                        <tr>
                            <td><?php echo $row["Fid"] ?></td>
                            <td><?php echo $row['Iname'] ?></td>
                            <td><?php echo $active ?></td>
                            <td><?php echo $row['Fgender'] ?></td>
                            <td><?php echo $row['Ffirst_name'] ?></td>
                            <td><?php echo $row['F_initial'] ?></td>
                            <td><?php echo $row['Flast_name'] ?></td>
                            <td><?php echo $row['Femail'] ?></td>
                        </tr>
                    <?php }}} else {echo "0 results";} ?>
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
            <div class="copyright"> &copy; UTEP | ICT 2017</div>
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
