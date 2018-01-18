<?php
    include('session.php');
?>

<!DOCTYPE html>
<html>
<head>
<style>
body {margin:0;}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
    position: fixed;
    top: 0;
    width: 100%;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: #cd50ff;
}
</style>
</head>
<body>

<ul>
  <li><a class="active" href="#user">USER</a></li>
  <li><a href="reports.html">Reports</a></li>
  <li><a href="logout.php">Log Out</a></li>
</ul>

<div style="padding:20px;margin-top:30px;background-color:#FFFFFF;height:1500px;">
<h1></h1>
<h2></h2>
<h2></h2>

<p></p>
</div>

</body>
</html>
