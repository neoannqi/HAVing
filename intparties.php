<?php
session_start();
require 'DBconfig/config.php';

global $postid;

if (isset($_GET['intparties'])) {
  $postid=$_GET['intparties'];
}
else {
  $postid = end(explode('=', windows.location.href));
  }
?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Interested Parties</title>
  <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css" />
  <style>

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

     <h1 style="margin-left:40px"> Interested parties </h1>
  <div class="form">
  <?php

    $email=$_SESSION['email'];
    // $thatpost = $_SESSION['$postid'];
    $quantity_left = mysqli_query($con, "SELECT * from posttable where ID='$postid'");

echo "<table align= top right border='1'>
<tr>
<th> Quantity left </th>
</tr>";

while ($qty_left = mysqli_fetch_array($quantity_left)) {
  // $qty = $qty_left['qty'];
  echo "<tr>";
    echo "<td>" . $qty_left['quantity'] . "</td>";
  echo "</tr>";
}
echo "</table>";

echo "<table align=center border='1'>
<tr>
<th>Requester</th>
<th>Email</th>
<th>Quantity wanted</th>
<th>Coming down at</th>
<th> Decision </th>
<th> Status </th>
</tr>";

$result = "SELECT * FROM requesttable where postid='$postid'";
$result_2 = mysqli_query($con, $result);
// if (mysqli_fetch_array($result_2)>0){
while ($row_2 = mysqli_fetch_array($result_2)){
  $requester=$row_2['requester'];
  $organisation= "SELECT * from userinfotable WHERE email ='$requester'";
  $organ = mysqli_query($con, $organisation);
  $name = mysqli_fetch_array($organ);
  $orgname=$name['orgname'];

  echo "<tr>";
  echo "<td>" . $orgname . "</td>";
  echo "<td>" . $row_2['requester'] . "</td>";
  echo "<td>" . $row_2['quantity_req'] . "</td>";
  echo "<td>" . $row_2['time_req'] . "</td>";
  echo "<td>";

  $reqid=$row_2['reqid'];
  $approve='approve' . $reqid;
  $decline='decline' . $reqid;
?>

<form action="intparties.php" method="post">
<input type= "submit" value="Approve" name= "<?php echo $approve;?>"> <!-- tmp is the id for the row -->
<input type= "submit" value="Decline" name= "<?php echo $decline;?>"> </br>
</form>
<?php
		//If the approved button is clicked
		if (isset($_POST[$approve])) {
      //check if the supplier clicked before//
      $reqid=substr($approve, 7);
      $clickapprove = mysqli_query($con, "SELECT * from requesttable where status != 'Pending' and reqid = '$reqid'");
      //$unique_run = mysqli_query($con, $unique);
      if (mysqli_num_rows($clickapprove) > 0){
      echo '<script type="text/javascript"> alert("You\'ve already decided. :)") </script>';
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

        echo "<meta http-equiv='refresh' content='0;url=intparties.php?intparties=$postid'>";

      }
      elseif ($new_quantity<0) {
          echo '<script type="text/javascript"> alert("You do not have enough supply, either edit your approvals or quantity available.") </script>';
      }
      else {
          // $update_qty = "UPDATE posttable SET quantity='$new_quantity' WHERE ID='$postid'";
          // $update_status = "UPDATE requesttable SET status='Approved' WHERE reqid='$reqid'";
          //
          // mysqli_query($con, $update_qty);
          // mysqli_query($con, $update_status);
          // echo "<meta http-equiv='refresh' content='0;url=intparties.php'>";
      }

		}
  }
	if (isset($_POST[$decline])) {
      //check if the supplier clicked before//
      $reqid=substr($decline, 7);
      $unique_dec = mysqli_query($con, "SELECT * from requesttable where status != 'Pending' and reqid = '$reqid'");
      //$unique_run = mysqli_query($con, $unique);
      $clickdecline = mysqli_query($con, "SELECT * from requesttable where status = 'Approved' and reqid = '$reqid'");
      //to allow them to change their decision
      if (mysqli_num_rows($unique_dec) > 0){
        echo '<script type="text/javascript"> alert("You\'ve already decided. :)") </script>';
      }
      // elseif (mysqli_num_rows($clickdecline) > 0){
      //   $result_3 = mysqli_query($con, "SELECT * FROM requesttable where reqid='$reqid'");
      //   $row_3 = mysqli_fetch_array($result_3);
      //
      //   $new_quantity= ($row['quantity'] + $row_3['quantity_req']);
      //   $update_qty = "UPDATE posttable SET quantity='$new_quantity' WHERE ID='$postid'";
      //   $update_status = "UPDATE requesttable SET status='Declined' WHERE reqid='$reqid'";
      //
      //   mysqli_query($con, $update_qty);
      //   mysqli_query($con, $update_status);
      //   echo "<meta http-equiv='refresh' content='0;url=intparties.php'>";
    // }
    else {

			$update_status = "UPDATE requesttable SET status='Declined' WHERE reqid='$reqid'";
	    mysqli_query($con, $update_status);

	    echo "<meta http-equiv='refresh' content='0;url=intparties.php?intparties=$postid'>";

		}
  }

echo "</td>";
echo "<td>" . $row_2['status'] . "</td>";

echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>

	<br><br>
  <a href=mylistings.php> <input type="button" id="btn" value="Back"/> </a>

</div>
</body>
</html>
