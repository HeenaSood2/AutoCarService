<?php

$conn=mysqli_connect("localhost","root","","car_service")or die("Can't Connect to Database");

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

	<style>
		.divStyle{
	position: fixed;
	border:solid 1px;
	width: 22%;
	height: 39%;
	margin: 10% 8% 2% 70%;
	padding: 2rem;
	top:10%;

}
	</style>
</head>
<body>

</body>
</html>

<?php
//echo $_SESSION['center']=$_POST['serviceCenterName'];
$serviceCenterName= 'DEV AUTOMOTIVES';
$query=mysqli_query($conn, "SELECT * FROM services where centerName = '$serviceCenterName'");
$res=mysqli_fetch_array($query);
echo "<table  border='1' cellspacing='0' style='width:67%' >
<tr>
<th>Image</th>
<th>Service Name</th>
<th>Description</th>
<th>Normal Car Pricing</th>
<th>SUV Car Pricing </th>
<th>Luxury Car Pricing </th>
</tr>";
       
       
	echo "<form action='' method='post'>";
while($row=mysqli_fetch_array($query)){
 echo "<tr>";
	echo "
     <td> <img src='$row[4]' style='height:100px; width:100px;'></td>
	

	 <td> <input type='checkbox' name='check_list[]' value='$row[2]'> <label style='font-weight:bolder'>".$row[2]."</label></td>
     <td style='width:36%'>".$row[3]."</td>
     <td style='text-align:center'> Normal : " . $row[5] . "</td>
     <td  style='text-align:center'> SUV : " . $row[6] . "</td>
     <td  style='text-align:center'> Luxury : " . $row[7] . "</td>";
	
 echo "</tr>";
}

echo "</table>";

$date=date("Y-m-d");
	$date1=strtotime($date);
	$maxDate=strtotime("+8 day",$date1);
	$maxDate= date('Y-m-d', $maxDate);

   echo "
   <div class='divStyle'>
    <h4>Select your Time slot :</h4>   
    <input type='date' name='slot' min='$date'  max='$maxDate'><br>

     <label><h4>Choose your car catogory:</h4></label>
  <select name='car' id='car'>
  	 <option>Choose your car </option>
    <option value='normal'><b>Normal:-  3lac-13lac </b></option>
    <option value='suv'><b>SUV:-  14lac- 30lac</b></option>
    <option value='luxury'><b>Luxury:-  31 lac- Above</b></option>
  </select><br><br>

             <input type='submit' value='09-10 AM'  name='slotBook'>
             <input type='submit' value='10-11 AM' name='slotBook'>
             <input type='submit' value='11-12 AM' name='slotBook'>
             <input type='submit' value='12-01 PM'  name='slotBook'>
             <input type='submit' value='02-03 PM' name='slotBook'>
             <input type='submit' value='03-04 PM'  name='slotBook'>
             <input type='submit' value='04-05 PM'  name='slotBook'>
             <input type='submit' value='05-06 PM'  name='slotBook'>
             <input type='submit' value='06-07 PM'  name='slotBook'>
             <input type='submit' value='07-08 PM'  name='slotBook'>

<br><br>
</div>
             ";


echo "</form>";

if(isset($_POST['slotBook'])){

	$slot=$_POST['slot'];
	$carType= $_POST['car'];
  $_SESSION['user']='Heena';
  $_SESSION['phone']='7018706040'; 
  $n=0;
  $time=$_POST['slotBook'];


	if(!empty($_POST['check_list'])){

foreach($_POST['check_list'] as $selected){

$arr[$n] = ($n+1). ". ". $selected;
$n++;
}
$services_str=implode(" ", $arr);
$to ='soodheena0001@gmail.com';
$sub='Request For Slot Booking';
$message='Username : '.  $_SESSION['user']."\n".
'Phone number : '.  $_SESSION['phone']. "\n" .
'Services requested for : '.$services_str . "\n".
'Slot Date :-'. $slot."\n".
'Type of a car :-'. $carType."\n".
'Timings : '.$time;
$user=$_SESSION['user'];
$phone=$_SESSION['phone'];
$header='From: soodheena72@gmail.com';
$insertSlot="INSERT INTO `slot_booking`(`username`, `phone`, `services`, `date`, `car_type`, `time`) VALUES ('$user','$phone','$services_str','$slot','$carType','$time')";
$insertResult=mysqli_query($conn,$insertSlot)or die(mysqli_error($conn)); 

if(mail($to, $sub, $message, $header)){
echo "<h1> mail has sent successfully";

}

else
echo "failed to send mail";

}
else{
  echo "<script>alert('Services can not be empty !! Please select services');</script>";
}


}


?>