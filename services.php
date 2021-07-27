
<?php
session_start();
 //$_SESSION['center']=$_POST['serviceCenterName'];

?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

  <style>
.alignment-top{
  position:absolute;
  top:24%;
}

#fix{
  position:fixed;
  left:54%;
  top:27%;
  /*top:60%;*/

  
}
  </style>
</head>
<body>
 <nav class="navbar navbar-expand-md bg-dark  fixed-top">
  <div class="container">
    <a class="navbar-brand text-white ml-2" href="#"><span class="fa fa-car text-danger" style="margin-right: 7%" aria-hidden="true"></span><strong >AUTO CAR SERVICE</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="collapsibleNavbar">
  <ul class="navbar-nav ms-auto ">
    <li class="nav-item ">
        <a  class="nav-link text-white mx-3 " href="home.php"><strong>Home</strong></a>
    </li>
     <li class="nav-item ">
        <a  class="nav-link text-white mx-3 " href="userRating.php"><strong>Feedback</strong></a>
    </li>
     <li class="nav-item ">
        <a  class=" text-white mx-3  btn btn-danger" href="userTellLocation.php"><strong>Find Me</strong></a>
    </li>
    <!-- <li class="nav-item ">
        <a  class=" text-white mx-3 btn btn-danger" href="index.html"><strong>My bill</strong></a>
    </li> -->
  </ul>
</div>
</div>
 </nav>    

  <div>
                     <img style=" margin: 5% 5% 5% 32%" src="images/logo1.jpeg" class="img-fluid "   alt="nothing" height="80px" width="80px">
                 
                  <h3  style="font-family:'times new roman';font-weight:bold;margin-left: 40%; position: absolute; top: 15%;" >
     <?php 
                  if(isset($_SESSION['center'])){
                   echo $_SESSION['center'];
                   $_SESSION["centerMail"]=$_SESSION['center'];
                   
                  }else{
                  echo $_POST['serviceCenterName'];
                  $_SESSION['center']=$_POST['serviceCenterName'];

                  $_SESSION["centerMail"]=$_SESSION['center'];
                }
   $serviceCenterName=$_SESSION['center'];
//$serviceCenterName= $_POST['serviceCenterName'];
//$serviceCenterName= 'DEV AUTOMOTIVES';


$conn=mysqli_connect("localhost","root","","car_service")or die("Can't Connect to Database");
$query=mysqli_query($conn, "SELECT * FROM services where centerName = '$serviceCenterName'");
$res=mysqli_fetch_array($query);
$var=$res['centerName'];
$query1=mysqli_query($conn, "SELECT * FROM service_center where centerName = '$serviceCenterName'");
$res1=mysqli_fetch_array($query1);
$_SESSION['centerMail']=$res1['email'];

//echo $_SESSION['centerMail'];

 //$_SESSION['center']=$res1['centerName'];
                  // echo $var;
                  
                  ?> </h3>
            
 
</div>

</body>
</html>

<?php


  echo "<form action='' method='post'>";
  echo '<div class="alignment-top">' ;   
  

while($row=mysqli_fetch_array($query)){

   echo ' <div class="container d-flex justify-content-center mx-5 mt-4 bg-white align-items-center w-50 " style= "border:1px solid black; border-radius:10px;background-color: whitesmoke;  box-shadow: 5px 5px 5px #0a0a0a;">
   
    <div class="mt-3 flex-wrap">
    <img class="img-fluid  mb-3" id="size" style="border-radius:5px;" src='.$row[4].'>
    </div>
    <div style="margin-left:7px;">
    <input type="checkbox" name="check_list[]" value="'.$row[2].'"> <label style="font-weight:bolder">'.$row[2].'</label>
    <p style="text-align:justify;" >'.$row[3].'</p>
    <button  class="btn btn-danger"style="margin-bottom: 5%">Normal: '.$row[5].'</button>
                          <button  class="btn btn-danger"style="margin-bottom: 5%">SUV: '.$row[6].'</button>
                          <button  class="btn btn-danger"style="margin-bottom: 5%">Luxury: '.$row[7].'</button>
    </div>
    
    </div>
    ';
}

echo '</div>';

$date=date("Y-m-d");
  $date1=strtotime($date);
  $maxDate=strtotime("+8 day",$date1);
  $maxDate= date('Y-m-d', $maxDate);
  
 
echo "<div  id='fix'>
<div class='card' style='width:78%;border:1px solid black; border-radius:10px;background-color: whitesmoke;  box-shadow: 5px 5px 5px #0a0a0a;'>
<label class='mt-3'><h2 style='text-align:center;text-decoration:underline;'>Select your time slot:</h2></label><br>

<label><h5 style='margin-left:15%  ;'>Choose date:</h5></label>
 <input type='date' name='slot' min='$date' style='height:60%;width:59%; margin-left: 15%  ;' max='$maxDate' ><br>

  <label><h5 style= 'margin-left:15%;'>Choose your car catogory:</h5></label>
<select  name='car' id='car'  style='width:59%;margin-left:15%;'>
  <option>Choose your car </option>
 <option value='normal'><b>Normal:-  3lac-13lac </b></option>
 <option value='suv'><b>SUV:-  14lac- 30lac</b></option>
 <option value='luxury'><b>Luxury:-  31 lac- Above</b></option>
</select><br><br>

<div class='px-7' style='margin-left: 7%;'> 
        
                       <input type='submit' value='09-10 AM'  name='slotBook' class='btn-danger btn-sm mx-2 my-2 '>
                          <input type='submit' value='10-11 AM' name='slotBook' class='btn-danger btn-sm mx-2 my-2'>
                          <input type='submit' value='11-12 AM' name='slotBook' class='btn-danger btn-sm mx-2 my-2'>
                           
                         <input type='submit' value='12-01 PM'  name='slotBook' class='btn-danger btn-sm mx-2 my-2'>
                         <input type='submit' value='02-03 PM' name='slotBook' class='btn-danger btn-sm mx-2 my-2'>
                         <input type='submit' value='03-04 PM'  name='slotBook' class='btn-danger btn-sm mx-2 my-2'>
                                   
                          <input type='submit' value='04-05 PM'  name='slotBook' class='btn-danger btn-sm mx-2 my-2'>
                         <input type='submit' value='05-06 PM'  name='slotBook' class='btn-danger btn-sm mx-2 my-2'>
                         <input type='submit' value='06-07 PM'  name='slotBook' class='btn-danger btn-sm mx-2 my-2'>
                       
                        <input type='submit' value='07-08 PM'  name='slotBook' class='btn-danger btn-sm mx-2 my-2'>
           
        </div>
<br><br>
</div></div>";

echo '<div class="container fixed-bottom " style="left:93%;margin:0% 0% 2% 0%;font-size:24px;">

<button class="btn bg-dark text-light " name="chat" style="border:1px;border-radius:70%;"><i class="fa fa-wechat fa-2x" ></i></button>

</div>';





echo "</form>";


if(isset($_POST['slotBook'])){

  $slot=$_POST['slot'];
  $carType= $_POST['car'];
  // $_SESSION['user']='Heena';
  // $_SESSION['phone']='7018706040';

    //  $_SESSION['user']=$umail;
    // $_SESSION["userId"]=$phone;

  $n=0;
  $time=$_POST['slotBook'];

  if(!empty($_POST['check_list'])){

foreach($_POST['check_list'] as $selected){

$arr[$n] = ($n+1). ". ". $selected;
$n++;
}
$mail=$_SESSION['user'];

$u=mysqli_query($conn,"Select * from car_users where email = '$mail'");
 $find=mysqli_fetch_array($u);
$services_str=implode(" ", $arr);
$to ='soodheena0001@gmail.com';
$sub='Request For Slot Booking';
$user= $find['username'];
$message='Username : '. $user."\n".
'Phone number : '.   $_SESSION["userId"]. "\n" .
'Services requested for : '.$services_str . "\n".
'Slot Date :-'. $slot."\n".
'Type of a car :-'. $carType."\n".
'Timings : '.$time;

$phone= $_SESSION["userId"];
$header='From: soodheena72@gmail.com';

//echo "<script> alert(".$var.");</script>";
$insertSlot="INSERT INTO `slot_booking`(`username`, `phone`, `services`, `date`, `car_type`, `time`, `centerName`) VALUES ('$user','$phone','$services_str','$slot','$carType','$time', '$var')";
$insertResult=mysqli_query($conn,$insertSlot)or die(mysqli_error($conn)); 

 if(mail($to, $sub, $message, $header)){
echo "<script> alert('mail has sent successfully to service center. Please wait until they accept your request');</script>";
 
}
else
echo "failed to send mail";

}
else{
  echo "<script>alert('Services can not be empty !! Please select services');</script>";
}


}

if(isset($_POST['chat']))
{
  
  //echo  $_SESSION['centerMail'];
echo "<script>location.href='chatboxUser.php'</script>";


}

?>