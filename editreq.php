 <?php
session_start();
require 'DBconfig/config.php';


if (isset($_GET['edit'])) {
$reqid=$_GET['edit'];
$result = mysqli_query($con,"SELECT * FROM requesttable where reqid='$reqid'");
$row=mysqli_fetch_array($result);
}

if (isset($_POST['new_time_req']) or isset($_POST['new_quantity_req'])) {
    $reqid=$_POST['reqid'];
    $new_quantity_req=$_POST['new_quantity_req'];
    $new_time_req=$_POST['new_time_req'];
    $sql = "UPDATE requesttable SET quantity_req='$new_quantity_req', time_req='$new_time_req' WHERE reqid='$reqid'";
    $result=mysqli_query($con, $sql);
    echo "<meta http-equiv='refresh' content='0;url=myrequests.php'>";

}
?>

 <!DOCTYPE html>
 <html>
 <head>
   <title></title>
   <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
   <link rel="stylesheet" href="css/style.css" />

 </head>
 <body>
   <ul class="navbar">
     <li><a href="listings.php">All listings</a></li>
     <li><a href="searchbycat.php">Search by category</a></li>
     <li><a href="createpost.php">Create a listing</a></li>
     <li><a href="mylistings.php">My listings</a></li>
     <li><a class="active" href="myrequests.php">My requests</a></li>
     <li><a href="#about">Logout</a></li>
   </ul>

   <div style="margin-left:25%;padding:1px 16px;height:1000px;">

     <h1 style="margin-left:40px"> Edit </h1>
<div class = "form">

 <form id = "createPost" action = "editreq.php" class="myform" method="post">
  <input type="hidden" name="reqid" value="<?php echo $row['reqid'];?>"></br>

    <h3> Quantity: </h3>
  <input type = "number" class="inputvalues" name = "new_quantity_req" value="<?php echo $row['quantity_req'];?>" min="1" max="<?php $row['quantity']; ?>" > </br>
    <h3> Timing(s): </h3>
  <input type = "text" class="inputvalues" name = "new_time_req" value="<?php echo $row['time_req'];?>"> </br>
<br>
<input type = "submit" name = "submit" value = "Update" id="btn">
<a href=myrequests.php> <input type="button" id="btn" value="Back"/> </a>

</form>
</div>

 </body>
 </html>
