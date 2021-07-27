<?php
session_start();
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
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
<a class="nav-link text-white mx-3 " href="serviceProviderHome.php"><strong>Home</strong></a>
</li>
<li class="nav-item ">
<a class="nav-link text-white  mx-3" href="allUserRequest.php"><strong>All Requests</strong></a>
</li>
<li class="nav-item ">
<a class="nav-link text-white  mx-3" href="fetchLocationCenter.php"><strong>Track Users</strong></a>
</li>
<li class="nav-item ">
<a class="nav-link text-white  mx-3" href="addServices.php"><strong>Add Services</strong></a>
</li>
<li class="nav-item ">
<a class="nav-link text-white  mx-3" href="discount.php"><strong>Discount</strong></a>
</li>
</ul>
</div>
</div>
</nav>

<div style="margin-top: 7%">

    <div class="container my-5">
      <!-- <div class="jumbotron"> -->
        <div class="card">
            
            <!-- <div class="card-body"> -->
<?php
$con=mysqli_connect("localhost","root","","car_service")or die("Can't Connect to Database");
$center= $_SESSION['centerN'];
$displayUser=mysqli_query($con, "SELECT * FROM userlocation where centerName= '$center'")or die("Failed to query time slots". mysqli_error());
// $displayUser=mysqli_query($con, "SELECT * FROM userlocation")or die("Failed to query time slots". mysqli_error());
echo '<table  style="text-align:center;" class="table table-dark table-hover table-bordered ">
                    <thead>
<tr>
                          <th >ID</th>
                          <th>Name</th>
                          <th >Phone Number</th>
                          <th >Latitude</th>
                          <th >Longitude</th>
                          <th >Request Status</th>
                           
                        </tr>
                      </thead>
                      <tbody>';
       
while($display=mysqli_fetch_assoc($displayUser)){
  echo "<form action='showmap.php' method='post'>";


echo ' <tr>
                          <td class="col-lg-1"><input name="id" style=" background-color:#262626; border:none; text-align:center;color:white;width:30%"   value='.$display['id'].' type="text" readonly></td>
                          <td class="col-lg-2"> <input name="name" style="width:100% ;text-align:center;background-color:#262626; border:none; color:white;" value='.$display['name'].' type="text" readonly></td>
                          <td class="col-lg-2"> <input name="phone" style="width:70% ;background-color:#262626; border:none; color:white;text-align:center;" value='.$display['phone'].' type="text" readonly></td>
                          <td class="col-lg-2"> <input name="lat" style="width:70%;background-color:#262626; border:none; color:white; text-align:center;" value='.$display['latitude'].' type="text" readonly></td>
                          <td class="col-lg-2"> <input name="long" style="width:70%;background-color:#262626; border:none; color:white; text-align:center;" value='.$display['longitute'].' type="text" readonly></td>
                          
                          <td>
                           <input class="btn btn-success mx-2" style="font-size:.7em" type="submit" id="accept" name="accept" value="Accept">
                          <input class="btn btn-danger mx-2 " style="font-size:.7em" type="submit" id="deny" name="deny" value="Deny">
                          <input type="submit" class="btn btn-primary mx-2" style="font-size:.7em" name="track" value="Start Tracking">
                             </td>
                         
                        </tr>';

echo "</form> ";
}

echo "</tbody>
                  </table>
            </div>
           </div>
    </div> </div>";

?>
  
</body>
</html>