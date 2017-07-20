<?php
session_start();
require 'DBconfig/config.php';
 ?>

 <!DOCTYPE html>
 <html>
 <head>
  <title>Registration Form</title>
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
   input {
     size: "100 400";
   }
  </style>
 </head>

 <body>

   <center>
     <div class = "navbarhome" style = "padding: 50px">
       <form class="myform" action="register.php" method="post">

         <div class="form">

          <h1 style = "margin-left:40px">Register here!</h1>
          <form action="register.php" method="post">

            <br>
            <br>
            <input name="name" type="text" class="inputvalues" placeholder="Name" required /><br>
            <input name="orgname" type="text" class="inputvalues" placeholder="Organization Name" required/><br>
            <input name="email" type="email" class="inputvalues" placeholder="Organization Email" required/><br>
             <!--Check if can store email instead-->
            <input name="password" type="password" class="inputvalues" placeholder="Password" required /><br>
            <input name="cpassword" type="password" class="inputvalues" placeholder="Confirm Password" required /><br><br>
          <input name="submit_btn" type="submit" value="Sign up!"/>
          <br>
          <br>
          <a href=index.php> <input type="button" id="btn" value="Back"/> </a>

          </form>

          <?php
          if (isset($_POST['submit_btn'])) {
           // echo '<script type="text/javascript"> alert("Registered") </script>';

            $name=$_POST['name'];
            $orgname=$_POST['orgname'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $cpassword=$_POST['cpassword'];


          if ($password==$cpassword) {
            $query="select * from userinfotable WHERE email='$email' " ;
            $query_run = mysqli_query($con, $query);

            if (mysqli_num_rows($query_run)>0) {
              //there is already an account with the email
              echo '<script type="text/javascript"> alert("Email is already registered") </script>';
            }
            else {
            {
              $query= "insert into userinfotable values('$name', '$orgname', '$email', '$password')";
              $query_run = mysqli_query($con, $query);

              if ($query_run) {
                 echo '<script type="text/javascript"> alert("You are registered. Proceed to Login") </script>';
                 // redirecting back to login page
                 echo "<meta http-equiv='refresh' content='0;url=index.php'>";
              }
              else {
                echo '<script type="text/javascript"> alert("Error") </script>';


              }
            }
          }
        }

            else {
                    echo '<script type="text/javascript"> alert("Password does not match") </script>';
                  }

         }

           ?>

      </div>
    </center>

</div>
 </body>
 </html>
