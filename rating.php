<?php

$conn=mysqli_connect("localhost","root","","car_service")or die("Can't Connect to Database");
  $query=mysqli_query($conn," SELECT centerName, round((sum(rating)/count(rating) ), 1) as'ratings' FROM ratings GROUP BY centerName") or die(mysqli_error($conn));

    while($row=mysqli_fetch_array($query)){

    	$cName=$row['centerName'];
       mysqli_query($conn,"UPDATE service_center SET rating = ". $row['ratings']. " where centerName = '$cName'") or die(mysqli_error($conn));

  }


?>