<?php
session_start();
require 'DBconfig/config.php';

 ?>

 <!DOCTYPE html>
 <html>
<head>
  <title> Search by Category </title>
  <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css" />

</head>

<body>

  <ul class="navbar">
    <li><a href="listings.php">All listings</a></li>
    <li><a class="active" href="searchbycat.php">Search by category</a></li>
    <li><a href="createpost.php">Create a listing</a></li>
    <li><a href="mylistings.php">My listings</a></li>
    <li><a href="myrequests.php">My requests</a></li>
    <li><a href="#about">Logout</a></li>
  </ul>

  <div style="margin-left:25%;padding:1px 16px;height:1000px;">
    <h1 style="margin-left:40px"> Search by category </h1>

    <form id = "search" action = "listingsbycat.php" class="myform" method="get">
      <input type="radio" name="category" value="Food" check = "checked"> Food </br>
      <input type="radio" name="category" value="Clothing"> Clothing </br>
      <input type="radio" name="category" value="Stationery"> Stationery </br>
      <input type="radio" name="category" value="Necessities"> Necessities </br>
      <input type="radio" name="category" value="Household items"> Household Items </br>
      <input type="radio" name="category" value="Art"> Art/Games </br>
      <input type="radio" name="category" value="Equipment"> Equipment </br>
      <input type="radio" name="category" value="Others"> Others </br>
      <input type="radio" name="category" value="All"> All </br>

    <br>
    <br>
    <input type = "submit" name = "search" value = "Search" id="btn">

</form>

</div>

</body>
</html>
