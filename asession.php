<?php
   include('config.php');
    
   // Start the session
   session_start();
   // Verifying if the login_user session variable is empty
   if(!empty($_SESSION['email'])){
	   
	   //We assign the session value to the $user_check variable
	   $user_check = $_SESSION['email'];

	   //Ask if the user is already in our database.
	   $ses_sql = mysqli_query($db,"select Ffirst_name from FACULTY where Ffirst_name = '$user_check'");
	   
	   //$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
       $row = mysqli_fetch_assoc($ses_sql);
	   //We assign the result to the $login_session variable
	   $login_session = $row['Ffirst_name'];
	   
	   //If the $login_session is not set then the user does not exist
	   if(!isset($login_session)){
	      header("location:logout.php");
	   }
	}else{
		//If login_user variable session is empty, we redirect the user to the login page
		header("location:flogin.php");
	}
?>
