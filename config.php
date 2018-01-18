<?php
   //Specify the Database server host
   define('DB_SERVER', 'earth.cs.utep.edu');
   //Specify the Database username
   define('DB_USERNAME', 'cs_hliu2');
   //Specify the Database password
   define('DB_PASSWORD', 'cs4342');
   //Choose the Database(name)
   define('DB_DATABASE', 'f17cs4342team10');
   //We make the connection.
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>
