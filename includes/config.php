<?php
//Database connection info
  $servername = "localhost";
  $username = "Webgebruiker";
  $password = "Labo2019";
  $dbname = "SithShopDB";

  $conn = mysqli_connect($servername,$username,$password,$dbname);

  if(!$conn)
  {
    die("Connection failed: ".mysqli_connect_error());
  }
 ?>
