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
     <li><a href="index.php">Logout</a></li>
   </ul>

   <div style="margin-left:25%;padding:1px 16px;height:1000px;">

     <h1 style="margin-left:40px"> All Listings </h1>

     <p style= "font-size: 18px"> Search by item name:</p>
   <input class="w3-input w3-border w3-padding" type="text" placeholder="Search for items..." id="myInput" onkeyup="myFunction()">

   <script>
   function myFunction() {
       var input, filter, ul, li, a, i;
       input = document.getElementById("myInput");
       filter = input.value.toUpperCase();
       ul = document.getElementById("Listings");
       li = ul.getElementsByTagName("li");
       for (i = 0; i < li.length; i++) {
           a = li[i].getElementsByTagName("h2")[0];
           if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
               li[i].style.display = "";
           } else {
               li[i].style.display = "none";

           }
       }
   }
   </script>

  <div class="form">

  <?php
      $email=$_SESSION['email'];
	$result = mysqli_query($con,"SELECT * FROM posttable where email!='$email'");?>

<ul class="postlist2" id="Listings">
<?php
if (mysqli_num_rows($result) >0) {
  while($row = mysqli_fetch_array($result)) {
    $tmp=$row['ID'];
    $supplier=$row['email'];
    $requester=$_SESSION['email'];
    ?>
    <li>
    <h2><?php echo $row['type'];?> </h2>
    <?php echo $row['description'];?> <br>
    Quantity: <?php echo $row['quantity'];?> <br>
    Location: <?php echo $row['location'];?> <br>
    Time: <?php echo $row['time'];?> <br>
    <?php
    if ($row['expdate'] != "0000-00-00") {
      ?> Expiry date: <?php echo $row['expdate'];
    } ?> <br>
    Donated by: <?php echo $row['orgname'];?> <br>
    <br>
      <form name="form" method="POST" action="listings.php">
      <input id = "grab" type = "number" class="inputvalues" name = "quantity_req" placeholder = "20" id="reqamount" min="1" max="<?php echo $row['quantity']; ?>" >
      <input id = "grab" type = "text" class="inputvalues" name = "time_req" placeholder = "730pm" id="reqtime">
         <input type="submit"  value="Grab" name="<?php echo $tmp;?>">
       </form>
    </li>
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
        echo "<meta http-equiv='refresh' content='0;url=myrequests.php'>";
    	}
    }
  }
  else {
  ?>
    <p class = "info">
      No post yet, create a post <a href="createpost.php"> here </a>
    </p>
    <?php
  }
  mysqli_close($con);
  ?>

</div>
</body>
</html>
