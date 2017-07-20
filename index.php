<?php
require 'DBconfig/config.php';
session_start();
 ?>

 <!DOCTYPE html>
 <html>
 <head>
  <title>Sign-Up/Login Form</title>

<link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Lobster+Two|Sanchez" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css" />

<style>
body {
 background-color:#000000;
 /*background-attachment: */
 background-image: url(imgs/warm.jpg);
 background-repeat: no-repeat;
 background-size: cover;
 background-position: top right;
 }
</style>

 </head>

 <body>
   <!-- <ul class="navbar">
     <li><a href="listings.php">All listings</a></li>
     <li><a href="searchbycat.php">Search by category</a></li>
     <li><a href="createpost.php">Create a listing</a></li>
     <li><a href="mylistings.php">My listings</a></li>
     <li><a class="active" href="myrequests.php">My requests</a></li>
     <li><a href="#about">Logout</a></li>
   </ul>

   <div style="margin-left:25%;padding:1px 16px;height:1000px;"> -->

<center>
  <div class = "navbarhome" style = "padding: 50px">
     <h1 style="margin-left:40px"> Welcome to HAving! </h1>
 <form action="index.php" method="post">
  <div class="form">

            <img src="imgs/logo.jpg"><br><br>
            <p style="font-family: 'Sanchez', serif; font-size: 20px;"> Happy giving and receiving! </p>
          <form action="/" method="post">

            <input name="email" type="email" class="inputvalues" placeholder="Email" required/><br>
            <input name="password" type="password" class="inputvalues" placeholder="Password" required/><br>
            <input name="stayloggedin" type="checkbox" /> Keep me logged in<br>   <br>
          <input name="login" type="submit" id="btn" value="Log in!"/>
          </form><br><br>

          Don't have an account? Click <a href=register.php>here</a> to sign up!
      </div>

      <?php
      if (isset($_POST['login']))   {

          $email=$_POST['email'];
          $password=$_POST['password'];

          $query="select * from userinfotable WHERE email='$email' AND password='$password'";
          $query_run = mysqli_query($con, $query);

          if (mysqli_num_rows($query_run)>0) {
            //if the user and password set exist in the current database
            $_SESSION['email']=$email;
            $_SESSION['orgname']=$orgname;
            header('location:listings.php');

          }
          else {
            echo '<script type="text/javascript"> alert("Invalid. Please register.") </script>';
          }
        }


      ?>
</div>
<div style="margin-left:25%;padding:1px 16px;height:1000px;">


 </body>
 </center>
 </html>
