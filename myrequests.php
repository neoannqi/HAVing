<?php
session_start();
require 'DBconfig/config.php';
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Listings</title>
  <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css" />
  <style>
  #edit:link, #edit:visited {
      background-color: #FFD54F;
      color: black;
      padding: 5px 5px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      border-radius: 10px;
  }

  #edit:hover, #edit:active {
      background-color: #FFF176;
  }
  </style>
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

     <h1 style="margin-left:40px"> Requests sent by you </h1>

  <div class="form">


  <?php

    $email=$_SESSION['email'];
	$result = mysqli_query($con,"SELECT requesttable.reqid, posttable.type, posttable.location, requesttable.quantity_req, requesttable.time_req, requesttable.status FROM requesttable, posttable WHERE requesttable.postid = posttable.ID AND requesttable.requester = '$email'");

if (mysqli_num_rows($result) > 0) {
  echo "<table border='1' align='center'>
  <tr>
  <th>Type</th>
  <th> Location </th>
  <th>Quantity</th>
  <th> Timing </th>
  <th>Status</th>
  <th> Edit </th>
  <th> Delete </th>
  </tr>";

  while($row = mysqli_fetch_array($result)){
  echo "<tr>";
  $reqid= $row['reqid'];
  echo "<td>" . $row['type'] . "</td>";
  echo "<td>" . $row['location'] . "</td>";
  echo "<td>" . $row['quantity_req'] . "</td>";
  echo "<td>" . $row['time_req'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>"

  ?>
  <a href='editreq.php?edit=<?php echo $row['reqid'];?>' id = edit>EDIT</a>
  <?php
  echo "</td>";

  echo "<td>";
  ?>
  <form action = "myrequests.php" method = "post">
  <input type= "submit" value="X" name= "<?php echo $reqid;?>">
  </form>
    <?php

    if(isset($_POST[$reqid])) {
      $delq = mysqli_query($con, "DELETE FROM requesttable WHERE reqid='$reqid'");
      echo "<meta http-equiv='refresh' content='0;url=myrequests.php'>";
    }
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}
else {
  ?>
  <p class ="info">
    Look through "All listings" to find items you may be interested in. <br>
    OR search by a category here :) <br>
<--
  </p>
<br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br>
    <?php
}

mysqli_close($con);
?>

</div>
</body>
</html>
