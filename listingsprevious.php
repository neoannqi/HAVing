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

 </head>

 <body>
   <ul class="navbar">
     <li><a class="active" href="listings.php">All listings</a></li>
     <li><a href="searchbycat.php">Search by category</a></li>
     <li><a href="createpost.php">Create a listing</a></li>
     <li><a href="mylistings.php">My listings</a></li>
     <li><a href="myrequests.php">My requests</a></li>
     <li><a href="#about">Logout</a></li>
   </ul>

   <div style="margin-left:25%;padding:1px 16px;height:1000px;">

     <h1 style="margin-left:40px"> All Listings </h1>
  <div class="form">


  <?php
      $email=$_SESSION['email'];
	$result = mysqli_query($con,"SELECT * FROM posttable where email!='$email'");

echo "<table border='1'>
<tr>
<th> Organisation </th>
<th>Type</th>
<th>Description</th>
<th>Quantity</th>
<th>Expdate</th>
<th>Location</th>
<th>Time</th>
<th>Grab</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
$tmp=$row['ID'];
$supplier=$row['email'];
$requester=$_SESSION['email'];

echo "<tr>";
echo "<td>" . $row['orgname'] . "</td>";
echo "<td>" . $row['type'] . "</td>";
echo "<td>" . $row['description'] . "</td>";
echo "<td>" . $row['quantity'] . "</td>";
echo "<td>" . $row['expdate'] . "</td>";
echo "<td>" . $row['location'] . "</td>";
echo "<td>" . $row['time'] . "</td>";
echo "<td>"
?>

  <form name="form" method="POST" action="listings.php">
  <input type = "number" class="inputvalues" name = "quantity_req" placeholder = "20" id="reqamount" min="1" max="<?php echo $row['quantity']; ?>" > </br>
  <input type = "text" class="inputvalues" name = "time_req" placeholder = "730pm" id="reqtime"> </br>
     <input type="submit"  value="Grab" name="<?php echo $tmp;?>">

   </form>
    <?php
    echo "</td>";
?>


<?php
   if (isset($_POST[$tmp])) {
   	$quantity_req=$_POST['quantity_req'];
    $time_req=$_POST['time_req'];
    //check if the user grabbed before//
    $unique = mysqli_query($con, "SELECT * from requesttable where postid = '$tmp' and requester = '$requester'");
    //$unique_run = mysqli_query($con, $unique);
    if (mysqli_num_rows($unique) > 0){
    echo '<script type="text/javascript"> alert("You\'ve indicated interest already, please edit in \'My Requests\'") </script>';
    }
    else {
      $query= "insert into requesttable (`supplier`, `requester`, `postid`, `quantity_req`,
        `status`, `time_req`) values( '$supplier', '$requester', '$tmp', '$quantity_req', 'Pending', '$time_req')";
      $query_run = mysqli_query($con, $query);
    }
	}
?>

<?php
echo "</td>";
echo "</tr>";

}
echo "</table>";

mysqli_close($con);
?>

</div>
</body>
</html>
