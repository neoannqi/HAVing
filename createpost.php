<?php
session_start();
require 'DBconfig/config.php';

 ?>

 <!DOCTYPE html>
 <html>
<head>
  <title> Create a posting </title>
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" />

</head>

<body>
  <ul class="navbar">
    <li><a href="listings.php">All listings</a></li>
    <li><a href="searchbycat.php">Search by category</a></li>
    <li><a class="active" href="createpost.php">Create a listing</a></li>
    <li><a href="mylistings.php">My listings</a></li>
    <li><a href="myrequests.php">My requests</a></li>
    <li><a href="#about">Logout</a></li>
  </ul>

  <div style="margin-left:25%;padding:1px 16px;height:1000px;">

  <h1 style="margin-left:40px"> Create a Post </h1>

  <div class="form">
  <form id = "createPost" action = "createpost.php" class="myform" method="post" onsubmit="return validateForm()">
  <h3> Choose a Category: </h3>
    <input id = "search" type="radio" name="category" value="Food" onclick="chooseFood();" required> Food </br>
    <input id = "search" type="radio" name="category" value="Clothing" onclick="chooseOthers();"> Clothing </br>
    <input id = "search" type="radio" name="category" value="Stationery" onclick="return chooseOthers();"> Stationery </br>
    <input id = "search" type="radio" name="category" value="Necessities" onclick="return chooseOthers();"> Necessities </br>
    <input id = "search" type="radio" name="category" value="Household items" onclick="return chooseOthers();"> Household Items </br>
    <input id = "search" type="radio" name="category" value="Art" onclick="return chooseOthers();"> Art/Games </br>
    <input id = "search" type="radio" name="category" value="Equipment" onclick="return chooseOthers();"> Equipment </br>
    <input id = "search" type="radio" name="category" value="Others" onclick="return chooseOthers();"> Others </br>

<div id="foodform" style="display:none;">
  <h3> Type of item: </h3>
  <input type= "text" class="inputvalues" name = "type" size = "50" placeholder = "Canned food, mattress etc..." required> </br>
  <h3> Description: </h3>
  <input class="inputvalues" type = "text" name = "description" wrap = "soft" size = "100 400" height= "50pt" placeholder = "Indicate the brand, if it's halal (for food), units, description..." required> </br>
  <h3> Quantity: </h3>
  <input type = "number" class="inputvalues" name = "quantity" placeholder = "20" min="1" required> </br>
  <h3> Expiry date (if applicable): </h3>
  <input type = "date" class="inputvalues" name = "expdate" id = "expdate" required> </br>
  <h3> Collection point(s): </h3>
  <input type = "text" class="inputvalues" name = "location" size = "50" placeholder = "Clementi NTUC Counter 8" required> </br>
  <h3> Timing(s): </h3>
  <input type = "text" class="inputvalues" name = "time" size = "30" placeholder = "7pm - 9pm; 1030pm -1130pm" required> </br>
  </html>
    <!-- <script>
    function chooseFood() {
          document.getElementbyID("expdate").setAttribute("required", "");
          document.getElementbyID("guide").required = true;
        }

    </script> -->
  <html>
  <h3> For food products: </h3>
  <input type = "checkbox" name="guideline" font-size: "14px" id = "guide"> I agree to the <a href= "http://www.nea.gov.sg/docs/default-source/public-health/food-hygiene/Guidelines/guidelines-on-food-donation-.pdf"> NEA guideline of food donation</a>.</br></br> </br>

<input type = "submit" name = "submit" value = "Post" id="btn">
</div>

<div id="othersform" style="display:none;">
  <h3> Type of item: </h3>
  <input type= "text" class="inputvalues" name = "type" size = "50" placeholder = "Canned food, mattress etc..." required> </br>
  <h3> Description: </h3>
  <input class="inputvalues" type = "text" name = "description" wrap = "soft" size = "100 400" height= "50pt" placeholder = "Indicate the brand, if it's halal (for food), units, description..." required> </br>
  <h3> Quantity: </h3>
  <input type = "number" class="inputvalues" name = "quantity" placeholder = "20" min="1" required> </br>
  <h3> Collection point(s): </h3>
  <input type = "text" class="inputvalues" name = "location" size = "50" placeholder = "Clementi NTUC Counter 8" required> </br>
  <h3> Timing(s): </h3>
  <input type = "text" class="inputvalues" name = "time" size = "30" placeholder = "7pm - 9pm; 1030pm -1130pm" required> </br>

<input type = "submit" name = "submit" value = "Post" id="btn">
</div>

<script>

function chooseFood() {
      document.getElementById('foodform').style.display="block";
      document.getElementById('othersform').style.display="none";
    }


  function chooseOthers() {
        document.getElementById("foodform").style.display="none";
        document.getElementById("othersform").style.display= "block";
      }

</script>

</form>



<?php

	if (isset($_POST['submit'])) {

    $category = $_POST['category'];
		$type=$_POST['type'];
		$description=$_POST['description'];
		$quantity=$_POST['quantity'];
		$expdate=$_POST['expdate'];
		$location=$_POST['location'];
		$time=$_POST['time'];
    $email=$_SESSION['email'];
    $organisation= "SELECT * from userinfotable WHERE email ='$email'";
    $organ = mysqli_query($con, $organisation);
    $name = mysqli_fetch_array($organ);
    $orgname=$name['orgname'];

		$query= "insert into posttable (`category`, `type`, `description`, `quantity`, `expdate`,
        `location`, `time`, `email`, `orgname`) values('$category', '$type', '$description', '$quantity', '$expdate', '$location', '$time', '$email', '$orgname')";
    $query_run = mysqli_query($con, $query);
    echo "<meta http-equiv='refresh' content='0;url=mylistings.php'>";
	}

?>

</div>

</body>
</html>
