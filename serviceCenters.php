   <?php
session_start();


// check discount  is present for the service center or not 


//$center=$_SESSION['centerN'];
$center="center1";
$conn=mysqli_connect("localhost","root","","car_service")or die("Can't Connect to Database");
$date1=date("Y-m-d");
$dis= mysqli_query($conn, "SELECT * FROM discount where `endDate` < '$date1' ")or die("Failed to query time slots". mysqli_error());
 $count=mysqli_num_rows($dis);
 if($count !=0 ){
 
  $up= mysqli_query($conn, "UPDATE discount SET startDate='', endDate='', discount='' where `endDate` < '$date1'" )or die("Failed to query time slots". mysqli_error());


 }



   ?>


    <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> 
    
    <title>Service Centers </title>
     <style>
        #dis
        {
            
            position:absolute;
            margin:0% 0% 0% 71%;
        }
        </style>
</head>
<body>


<!-- navbar -->

<nav class="navbar navbar-expand-md bg-dark fixed-top">
<div class="container" >
<a class="navbar-brand text-white ml-2" href="#"><span class="fa fa-car text-danger" style="margin-right: 7%" aria-hidden="true"></span><strong class="ml-2">AUTO CAR SERVICE</strong></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="collapsibleNavbar">
<ul class="navbar-nav ms-auto ">
<li class="nav-item ">
<a class="nav-link text-white " href="home.php"><strong>Home</strong></a>
</li>
</ul>
</div>
</div>
</nav>

</body>
</html>

<?php

$conn=mysqli_connect("localhost","root","","car_service")or die("Can't Connect to Database");
  $query=mysqli_query($conn,"SELECT * FROM service_center ORDER BY rating DESC") or die(mysqli_error($conn));
  echo "<section id='team'>;
        <div class='container my-5 py-5'>
            <div class='row mb-5'>
                <div class='row'>";
$len=1;
  while($row=mysqli_fetch_array($query)){
     if($len !=4 ){
               createColumn($row, $len);
                          }
               else if($len ==4){
                echo "<div class='container my-3 py-5'>
            <div class='row mb-5'>
                <div class='row'>";
                 createColumn($row, $len);

               }
               else if( $len<=7){
                   createColumn($row, $len);
                          }
                            $len++;
               }
              echo "</div> </div> </div>";          

            echo" </section>";

function createColumn($row, $len){
$var= "center".$len.".jpeg";




    echo " 
                            <div class='col-lg-4 col-md-6'>
                                <div class='card'>

<div  id='dis'   style='width:29%;background-color:#F7941E;'> ";

                                // echo "<h6 class='card-title' style='inline-block'> Discount=29% </h6>";
                                 // displaying discount for service centers
                                 $c=$row['centerName'];
                              $conn=mysqli_connect("localhost","root","","car_service")or die("Can't Connect to Database");
                                 $discount=mysqli_query($conn, "SELECT * FROM discount where `centerName` ='$c' ")or die("Failed to query discount". mysqli_error($conn));
                                       $row1=mysqli_fetch_array($discount);
                                           
                          if($row1['discount'] != ""){
                        
                                            echo "<h6 class='card-title' style='inline-block;text-align:center;'>  ". $row1['discount'] ."% Off</h6>";
                                          }

                                   
                                 echo "</div>

                                    <div class='card-body'>
                                        <img src='images/".$var ." ' class='img-fluid w-50 mb-3'>
                                        <h3>". $row['centerName']. "</h3>";
                                         echo "<p style='text-align:justify;'>" . $row['description'] ."</p>";
                                      $c=$row['centerName'];


// displaying discount for service centers
$conn=mysqli_connect("localhost","root","","car_service")or die("Can't Connect to Database");
        $discount=mysqli_query($conn, "SELECT * FROM discount where `centerName` ='$c' ")or die("Failed to query discount". mysqli_error($conn));
              $row1=mysqli_fetch_array($discount);
                   
 // if($row1['discount'] != ""){

 //                   echo "<p> Discount = " . $row1['discount'] ." %</p>";
 //                 }
                                  $starNumber=$row['rating'];
                      for ($x = 1; $x <= $starNumber; $x++) {

                        echo "<i class='fa fa-star' style='color:orange'></i>";
                                                                           

                                }
                if (strpos($starNumber, '.')) {
                  $var=explode('.', "$starNumber");
                   $decimal= (int)$var[1];
                     if(!($decimal<=0)){
                   echo "<i class='fa fa-star-half-alt' aria-hidden='true' style='color:orange'></i>";
                   $x++;
                 }
                }
                while ($x <= 5) {
                    echo "<i class='far fa-star' style='color:orange ' ></i>";
                    $x++;
                }

                echo "&nbsp &nbsp"; echo $row['rating'];
                                                        echo"<div class='d-flex flex-row justify-content-center'>
                                                 <div class='p-4'>";
                                                 echo "<form action='services.php' method='post'>   
                                       <input type='submit' name='service' class='btn btn-danger' value='Explore Services'>
                                                     <input type='hidden' name='serviceCenterName' value='" . $row['centerName']. "' >

                                                     </form>
                                                 </div>
                                             </div>
                                    </div>
                                </div>
                            </div>  ";
}
   mysqli_close($conn); 



?>