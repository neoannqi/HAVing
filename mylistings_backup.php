<?php
session_start();
require 'DBconfig/config.php';
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Listings</title>
 	<link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet"/>
  <link rel="stylesheet" href="css/style.css" />
  <style>
  #edit:link, #edit:visited {
      background-color: #FFD54F;
      color: black;
      padding: 5px 5px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      border:1px solid black;
  }

  #edit:hover, #edit:active {
      background-color: #FFF176;
  }

  </style>
  </head>
  <body>
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

        <h1 style="margin-left:40px"> My Listings </h1>
  <div class="form">

  <?php
  $email=$_SESSION['email'];
	$result = mysqli_query($con,"SELECT * FROM posttable where email='$email'");

echo "<table border='1' align = 'center'>
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
echo "<tr>";
echo "<td>" . $row['type'] . "</td>";
echo "<td>" . $row['description'] . "</td>";
echo "<td>" . $row['quantity'] . "</td>";
echo "<td>" . $row['expdate'] . "</td>";
echo "<td>" . $row['location'] . "</td>";
echo "<td>" . $row['time'] . "</td>";
echo "<td>";

$result_2 = mysqli_query($con, "SELECT * FROM requesttable where postid='$postid'");
// if (mysqli_fetch_array($result_2)>0){
while ($row_2 = mysqli_fetch_array($result_2)){
echo $row_2['requester'];?>, <?php
echo $row_2['status'];?>, <?php
echo $row_2['quantity_req'];?>, <?php
echo $row_2['time_req'];


$reqid=$row_2['reqid'];
$approve='approve' . $reqid;
$decline='decline' . $reqid;
?>
<form action="mylistings.php" method="post">
<input type= "submit" value="Approve" name= "<?php echo $approve;?>"> <!-- tmp is the id for the row -->
<input type= "submit" value="Decline" name= "<?php echo $decline;?>"> </br>
</form>
<?php
		//If the approved button is clicked

		if (isset($_POST[$approve])) {
      //check if the supplier clicked before//
      $reqid=substr($approve, 7);
      $clickapprove = mysqli_query($con, "SELECT * from requesttable where status = 'Approved' and reqid = '$reqid'");
      //$unique_run = mysqli_query($con, $unique);
      if (mysqli_num_rows($clickapprove) > 0){
      echo '<script type="text/javascript"> alert("You\'ve already approved. :)") </script>';
    }
    else {
			$result_3 = mysqli_query($con, "SELECT * FROM requesttable where reqid='$reqid'");
			$row_3 = mysqli_fetch_array($result_3);

		    $new_quantity= ($row['quantity'] - $row_3['quantity_req']);

        if ($new_quantity==0){
               $update_when_none_1=mysqli_query($con, "DELETE FROM posttable WHERE ID='$postid'");
               $update_final_requester = "UPDATE requesttable SET status='Approved' WHERE reqid='$reqid'";
               $update_when_none_2=mysqli_query($con, "UPDATE requesttable SET status='Declined' WHERE postid='$postid' AND status='Pending'");

               mysqli_query($con, $update_when_none_1);
               mysqli_query($con, $update_final_requester);
               mysqli_query($con, $update_when_none_2);

               echo "<meta http-equiv='refresh' content='0;url=mylistings.php'>";

              }
              elseif ($new_quantity<0) {
                echo '<script type="text/javascript"> alert("You do not have enough supply, either edit your approvals or quantity available.") </script>';
              }

              else {
              $update_qty = "UPDATE posttable SET quantity='$new_quantity' WHERE ID='$postid'";
              $update_status = "UPDATE requesttable SET status='Approved' WHERE reqid='$reqid'";

              mysqli_query($con, $update_qty);
              mysqli_query($con, $update_status);
              echo "<meta http-equiv='refresh' content='0;url=mylistings.php'>";
              }

		}
  }
		if (isset($_POST[$decline])) {
      //check if the supplier clicked before//
      $reqid=substr($decline, 7);
      $unique_dec = mysqli_query($con, "SELECT * from requesttable where status = 'Declined' and reqid = '$reqid'");
      //$unique_run = mysqli_query($con, $unique);
      $clickdecline = mysqli_query($con, "SELECT * from requesttable where status = 'Approved' and reqid = '$reqid'");
      //to allow them to change their decision
    if (mysqli_num_rows($unique_dec) > 0){
      echo '<script type="text/javascript"> alert("You\'ve already declined. :)") </script>';
    }
    elseif (mysqli_num_rows($clickdecline) > 0){
      $result_3 = mysqli_query($con, "SELECT * FROM requesttable where reqid='$reqid'");
      $row_3 = mysqli_fetch_array($result_3);

      $new_quantity= ($row['quantity'] + $row_3['quantity_req']);
      $update_qty = "UPDATE posttable SET quantity='$new_quantity' WHERE ID='$postid'";
      $update_status = "UPDATE requesttable SET status='Declined' WHERE reqid='$reqid'";

      mysqli_query($con, $update_qty);
      mysqli_query($con, $update_status);
      echo "<meta http-equiv='refresh' content='0;url=mylistings.php'>";
    }
    else {

			$update_status = "UPDATE requesttable SET status='Declined' WHERE reqid='$reqid'";
		    mysqli_query($con, $update_status);

		    echo "<meta http-equiv='refresh' content='0;url=mylistings.php'>";

		}
  }

}
// }
// else {
//   echo "No interested parties yet";
// }
echo "</td>";
echo "<td>";
?>

<a href='edit.php?edit=<?php echo $row['ID'];?>' id = edit>EDIT</a>

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
mysqli_close($con);
?>
</div>
</body>
</html>
