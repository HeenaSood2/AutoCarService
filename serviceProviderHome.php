<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <style>
        *
    {
         margin:0;
         padding:0;
         box-sizing:border-box;
     }

.card
{
    height: fit-content;
    border-radius:8px;
    box-shadow: 5px 5px 5px #0a0a0a;
    left: 30%;
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

</body>
</html>

<?php
session_start();
$conn=mysqli_connect("localhost","root","","car_service")or die("Can't Connect to Database");
$date=date("Y-m-d");
$c=$_SESSION['centerN'];
//$c='DEV AUTOMOTIVES';
$displaySlot=mysqli_query($conn, "SELECT * FROM slot_booking where centerName='$c' ")or die("Failed to query time slots". mysqli_error());

	$date=date("Y-m-d");

  echo "<div style='margin-top:7%;'>";
while($display=mysqli_fetch_assoc($displaySlot)){
	if(strcmp($date, $display["date"])==0){    // displaying only todays request

  echo' <div class="container mt-5 mx-3">
         <div class="card w-50" >
            <div class="col-lg-20">
                     <p class="mt-3 mx-2"><b> Username : </b>'. $display["username"].'</p>
                     <p class="mt-3 mx-2"><b> Contact Number : </b>'.$display["phone"].'</p>
                      <p class="mt-3 mx-2"><b> Requested Services : </b>'. $display["services"].'</p> 
                       <p class="mt-3 mx-2"><b> Date : </b>'. $display["date"].'</p> 
                      <p class="mt-3 mx-2"><b>Car Type : </b> '.$display["car_type"].'</p> 
                       <p class="mt-3 mx-2"><b> Timings : </b>'.$display["time"].'</p> 
                       <div style="margin-left:20%;">';
                       echo '<form method="post">  
                          <button name="accept" class="btn btn-danger"style="margin-bottom: 5%">Accept</button>
                          <button name="deny" class="btn btn-danger"style="margin-bottom: 5%">Deny</button>
                          <button name="delete" class="btn btn-danger"style="margin-bottom: 5%">Delete</button>
                           <button name="done" class="btn btn-danger"style="margin-bottom: 5%">Done</button>                          <input type="hidden" value="'.$display["id"].'" name="customerID">
                          </form>
                          </div>
	                 

                </div>
         </div>
        </div>

        ';
    }
}

echo "</form></div>";
if(isset($_POST['accept'])){
 $id=$_POST['customerID'];
	$que=mysqli_query($conn, "SELECT * FROM slot_booking where id= $id")or die("Failed to query time slots". mysqli_error());
	$res=mysqli_fetch_assoc($que);
	$phone=$res['phone'];
    $customDetails=mysqli_query($conn, "SELECT * FROM car_users where phone= $phone")or die("Failed to query user". mysqli_error());

$updateAcc="UPDATE slot_booking SET `status`= 'Accepted' where id= $id";
$result=mysqli_query($conn,$updateAcc)or die(mysqli_error($conn));   
// if($result){
//   echo "<script>alert('inserted')</script>";
// }

	$customer=mysqli_fetch_assoc($customDetails);
	$to=$customer['email'];

$sub='Acceptance of your request';
$message='Your request for services '.$res["services"]."\n".
'Slot Date :-'. $res["date"]."\n".
'Type of a car :-'. $res["car_type"]."\n".
'Timings : '.$res["time"]. "\n". "is approved :) ";
$header='From: soodheena72@gmail.com';
if(mail($to, $sub, $message, $header)){
	echo "<script>alert('mail to user has sent successfully');</script>";
}

else
echo "failed";

}

if(isset($_POST['deny'])){
 $id=$_POST['customerID'];
	$que=mysqli_query($conn, "SELECT * FROM slot_booking where id= $id")or die("Failed to query time slots". mysqli_error());
	$res=mysqli_fetch_assoc($que);
	$phone=$res['phone'];
    $customDetails=mysqli_query($conn, "SELECT * FROM car_users where phone= $phone")or die("Failed to query time slots". mysqli_error());
	$customer=mysqli_fetch_assoc($customDetails);
$to=$customer['email'];
$sub='Request Denied';
$message='Your request for services '.$res["services"]."\n".
'Slot Date :-'. $res["date"]."\n".
'Type of a car :-'. $res["car_type"]."\n".
'Timings : '.$res["time"]. "\n". "is denied by the service center :) ";
$header='From: soodheena72@gmail.com';
$updateDen="UPDATE slot_booking SET `status`= 'Rejected' where id= $id";
$result=mysqli_query($conn,$updateDen)or die(mysqli_error($conn));   

if(mail($to, $sub, $message, $header)){
echo "<script>alert('mail to user has sent successfully');</script>";
}
else
echo "failed";
}

if(isset($_POST['delete'])){
 $id=$_POST['customerID'];
 $del=mysqli_query($conn, "DELETE FROM slot_booking where id= $id")or die("Failed to query time slots". mysqli_error());
	if($del){
		echo "<script>alert('Data deleted successfully');</script>";
	}
}

if(isset($_POST['done'])){
 $id=$_POST['customerID'];
 //redirect to make a bill
   $que=mysqli_query($conn, "SELECT * FROM slot_booking where id= $id")or die("Failed to query time slots". mysqli_error());
  $res=mysqli_fetch_assoc($que);
  $phone=$res['phone'];
    $customDetails=mysqli_query($conn, "SELECT * FROM car_users where phone= $phone")or die("Failed to query time slots". mysqli_error());
  $customer=mysqli_fetch_assoc($customDetails);
$_SESSION['userEmail']=   $customer['email'];
//echo  $_SESSION['userEmail'];
//echo "<script>alert('".$_SESSION['userEmail']."')</script>";

echo "<script>location.href='Bill Generation/bill.php'</script>";
}


?>