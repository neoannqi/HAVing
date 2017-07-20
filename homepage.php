<?php

session_start();
require 'DBconfig/config.php';

 ?>

 <!DOCTYPE html>
 <html>
 <head>
  <title>Homepage</title>
  <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css" />
  
 </head>

 <body>
            <!-- If possible, address by name i.e Welcome [name]-->
<div class="form">
<div>
  <a href=listings.php> <input type="submit" value="View Listings" class="myButton1"/> </a>
</div>
<div>
<a href=mylistings.php> <input type="submit" value="My Listings" class="myButton2"/> </a>
</div>
<div>
<a href=myrequests.php> <input type="submit" value="My Requests" class="myButton3"/> </a>
</div>
<!-- <a href="http://google.com"> <input type="submit" value="My Messages" class="myButton4"/> </a>
 -->

    <form class="myform" action="homepage.php" method="post">
     <input name="logout" type="submit" id="btn" value="Log out"/>
     <br>
     </form>

     </div>

     <?php
      if (isset($_POST['logout'])) {
           session_destroy();
           header('location:index.php');
      }
      //$POST follows form method="post"

     ?>
 </body>
 </html>
