 <?php
session_start();
require 'DBconfig/config.php';

if (isset($_GET['edit'])) {
$id=$_GET['edit'];
$result = mysqli_query($con,"SELECT * FROM posttable where ID='$id'");
$row=mysqli_fetch_array($result);
}

if (isset($_POST['new_cat']) or isset($_POST['new_type']) or isset($_POST['new_description']) or isset($_POST['new_quantity']) or isset($_POST['new_expdate']) or isset($_POST['new_location']) or isset($_POST['new_time'])) {

    $id=$_POST['ID'];
    $new_cat = $_POST['new_cat'];
    $new_type=$_POST['new_type'];
    $new_description=$_POST['new_description'];
    $new_quantity=$_POST['new_quantity'];
    $new_expdate=$_POST['new_expdate'];
    $new_location=$_POST['new_location'];
    $new_time=$_POST['new_time'];
    $sql = "UPDATE posttable SET type='$new_type', description='$new_description', quantity='$new_quantity', expdate='$new_expdate', location='$new_location', time='$new_time' WHERE id='$id'";
    $result=mysqli_query($con, $sql);
    echo "<meta http-equiv='refresh' content='0;url=mylistings.php'>";
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
     <li><a class="active" href="mylistings.php">My listings</a></li>
     <li><a href="myrequests.php">My requests</a></li>
     <li><a href="#about">Logout</a></li>
   </ul>

   <div style="margin-left:25%;padding:1px 16px;height:1000px;">

     <h1 style="margin-left:40px"> Edit </h1>
     <div class="form">
     <form id = "createPost" action = "mylistings.php" class="myform" method="post" onsubmit="return validateForm()">
     <input type="hidden" name="ID" value="<?php echo $row['ID'];?>"></br>
     <?php $cat = $row['category'];

     if ($cat=='Food') {
       echo "<script> document.getElementById('expdate').style.visibility = 'visible' </script>";
     }
     ?>

      <h3> Category </h3>
       <input id = "search" type="radio" name="new_cat" value="Food" <?php echo ($cat=='Food')?'checked':''?> onclick="hide();" required> Food </br>
       <input id = "search" type="radio" name="new_cat" value="Clothing" <?php echo ($cat=='Clothing')?'checked':''?>> Clothing </br>
       <input id = "search" type="radio" name="new_cat" value="Stationery" <?php echo ($cat=='Stationery')?'checked':''?>> Stationery </br>
       <input id = "search" type="radio" name="new_cat" value="Necessities" <?php echo ($cat=='Necessities')?'checked':''?>> Necessities </br>
       <input id = "search" type="radio" name="new_cat" value="Household items" <?php echo ($cat=='Household items')?'checked':''?>> Household Items </br>
       <input id = "search" type="radio" name="new_cat" value="Art" <?php echo ($cat=='Art')?'checked':''?>> Art/Games </br>
       <input id = "search" type="radio" name="new_cat" value="Equipment" <?php echo ($cat=='Equipment')?'checked':''?>> Equipment </br>
       <input id = "search" type="radio" name="new_cat" value="Others" <?php echo ($cat=='Others')?'checked':''?>> Others </br>

    <h3> Type of item: </h3>
  <input type= "text" class="inputvalues" name = "new_type" size = "50" value="<?php echo $row['type'];?>" > </br>
  <h3> Description: </h3>
  <input class="inputvalues" type = "text" name = "new_description" wrap = "soft" size = "80 100" value="<?php echo $row['description'];?>"> </br>
  <h3> Quantity: </h3>
  <input type = "number" class="inputvalues" name = "new_quantity" value="<?php echo $row['quantity'];?>" min="1"> </br>
  <script>
  function hide() {
    if (<?php echo $row['expdate'];?> != "0000-00-00") {
      document.getElementById('expdate').style.visibility = 'visible';
    }
    else {
      document.getElementById('expdate').style.visibility = 'hidden';
    }
  }
  </script>

  <h3> Collection point(s): </h3>
  <input type = "text" class="inputvalues" name = "new_location" size = "50" value="<?php echo $row['location'];?>"> </br>
  <h3> Timing(s): </h3>
  <input type = "text" class="inputvalues" name = "new_time" size = "30" value="<?php echo $row['time'];?>"> </br>
  <div id = "expdate" style="display:none;">
  <h3> Expiry date (if applicable): </h3>
  <input type = "date" class="inputvalues" name = "new_expdate" value="<?php echo $row['expdate'];?>"> </br>
<h3> For food products: </h3>
<input type = "checkbox" name="guideline" font-size: "14px"> I agree to the <a href= "http://www.nea.gov.sg/docs/default-source/public-health/food-hygiene/Guidelines/guidelines-on-food-donation-.pdf"> NEA guideline of food donation</a>.</br></br> </br>
</div>
<input type = "submit" name = "submit" value = "Update" id="btn">
<a href=mylistings.php> <input type="button" id="btn" value="Back"/> </a>

</form>
 </div>

 </body>
 </html>
