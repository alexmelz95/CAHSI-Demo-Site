<!DOCTYPE html>
<html>
<head>
<title>CAHSI | Institution</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<link rel="stylesheet" href="css/main.css" />


<!-- Favicon-->
<link rel="shortcut icon" href="img/favicon.ico">

</head>
<body>
<!-- Header -->
<header id="header">
<div class="inner"> <a href="institution.php" class="logo"><img src="img/logo.png" style = "float:center" width:"104px" height="104px"></a>
<nav id="nav">
<a href="admin.php">Admin</a>
<a href="institution.php">Institutions:</a>
<a href="addIns.php">add</a> |
<!--<a href="deleteIns.php">Delete</a>-->
<a href="logout.php">Log out</a>
</nav>
</div>
</header>
<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>



<!-- Banner -->
<section id="banner">
<div style="padding:60px;margin-top:-160px;background-color:#1A2154;height:10px;">
<div class="inner">
<h1>Institution</span></h1>
</div>
</section>
<p></p>

<div class ="container">
<center><h1>Registered Institutions</h1></center>
    <br>
<center>
<?php
    include('asession.php');
    
    $user_check = $_SESSION['email'];
    $query="SELECT * FROM INSTITUTION";
    $result=mysqli_query($db, $query);
    if(!$result) {
        die('Could not query: '. mysqli_error());
    }
    ?>
    <div>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Institution Name</th>
                <th>Institution Acrnoym</th>
            </tr>
            </thead>
            <tbody>
            <?php if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $row["Iid"] ?></td>
                        <td><?php echo $row['Iname'] ?></td>
                        <td><?php echo $row['Iacronym'] ?></td>
                    </tr>
                <?php }
            } else {
                echo "0 results";
            } ?>
            </tbody>
        </table>
</center>
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
