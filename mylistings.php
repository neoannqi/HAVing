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
  #bttt:link, #bttt:visited {
      background-color: #FFD54F;
      color: black;
      padding: 5px 5px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      border-radius: 10px;
  }

  #bttt:hover, #bttt:active {
      background-color: #FFF176;
  }

  </style>
  </head>
  <body>
    <ul class="navbar">
      <li><a href="listings.php">All listings</a></li>
      <li><a href="searchbycat.php">Search by category</a></li>
      <li><a href="createpost.php">Create a listing</a></li>
      <li><a class="active" href="mylistings.php">My listings</a></li>
      <li><a href="myrequests.php">My requests</a></li>
      <li><a href="#about">Logout</a></li>
    </ul>

    <div style="margin-left:25%;padding:1px 16px;height:1000px;">

      <h1 style="margin-left:40px"> Listings made by you </h1>

  <div class="form">

  <?php
  $email=$_SESSION['email'];

	$result = mysqli_query($con,"SELECT * FROM posttable where email='$email'");

if (mysqli_num_rows($result) > 0) {

  echo "<table border='1'  align = 'center'>
  <tr>
  <th>Type</th>
  <th>Description</th>
  <th>Quantity</th>
  <th> Expdate </th>
  <th>Location</th>
  <th>Time</th>
  <th>Interested Parties </th>
  <th>Edit</th>
  <th>Delete</th>
  </tr>";
  while($row = mysqli_fetch_array($result)){
  $postid=$row['ID'];
  //$_SESSION[$postid] = $thatpost;
  echo "<tr>";
  echo "<td>" . $row['type'] . "</td>";
  echo "<td>" . $row['description'] . "</td>";
  echo "<td>" . $row['quantity'] . "</td>";
  if ($row['expdate'] == "0000-00-00") {
    echo "<td>" . "-" . "</td>";
  }
  else {
    echo "<td>" . $row['expdate'] . "</td>";
  }
  echo "<td>" . $row['location'] . "</td>";
  echo "<td>" . $row['time'] . "</td>";
  echo "<td>";

  $result_2 = mysqli_query($con, "SELECT Count('postid') as 'count' FROM requesttable where postid='$postid'");
  // if (mysqli_fetch_array($result_2)>0){
  $row = mysqli_fetch_assoc($result_2);
  $count = $row['count'];
  //echo "$count";
    if ($count == 0) {
      echo "No interested parties yet";
    }
    else {
      //$thatpost=$_SESSION['$postid'];
      ?>
      <a href = 'intparties.php?intparties=<?php echo $postid;?>'> <input id = "btn" type="button" value = "<?php echo "$count"; ?> parties interested"/ >
      <?php
    }

  echo "</td>";
  echo "<td>";
  ?>

  <a href='edit.php?edit=<?php echo $postid;?>' id = bttt>EDIT</a>

  <?php
  echo "</td>";

  echo "<td>";
  ?>
  <form action = "mylistings.php" method = "post">
  <input type= "submit" value="X" name= "<?php echo $postid;?>">
  </form>

    <?php
    if(isset($_POST[$postid])) {
      $delq = mysqli_query($con, "DELETE FROM posttable WHERE ID='$postid'");
      echo "<meta http-equiv='refresh' content='0;url=mylistings.php'>";
    }
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}
else {
  ?>
  <p class ="info">
    You've yet to post a listing. <br>
    You can post it in "Create a Listing". :) <br>

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
