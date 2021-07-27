<?php
session_start();
$con=mysqli_connect("localhost","root","","car_service")or die("Can't Connect to Database");

?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>

	<title></title>
<style>
#wrap { width: 80%; height: 60%; padding: 0; overflow: hidden;border: 2px solid skyblue; margin-left: 10%; }
#frame { width: 90%; height: 60%;  zoom: 0.71;
-moz-transform: scale(0.71);
-moz-transform-origin: 0 0;
-o-transform: scale(0.71);
-o-transform-origin: 0 0;
-webkit-transform: scale(0.71);
-webkit-transform-origin: 0 0;}

</style>
</head>
<body>

</body>
</html>

<?php
$phone=$_POST['phone'];
if(isset($_POST['track'])){
echo '<div id="wrap">';
echo '<iframe width="100%" height="500" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q='.$_POST['lat'].','.$_POST['long'].'&amp;key=AIzaSyAMruoXxdnh3sylM2T0SsXX3H0xPDqAdNc&zoom=15" scrolling="yes"></iframe>';

echo '</div>';
echo '<a href="fetchLocationCenter.php" style="border:1px solid black; border-radius:2%; color :white; background-color:black;">Go Back </a>';

}

if(isset($_POST['accept'])){
	
	$fetchUser=mysqli_query($con, "SELECT * FROM car_users where phone= $phone")or die("Failed to query user data". mysqli_error());
$user=mysqli_fetch_assoc($fetchUser);
$to =$user['email'];
$sub='Acceptance of request';
$message='We will be reaching you soon :)';
$header='From: soodheena72@gmail.com';
if(mail($to, $sub, $message, $header)){
	echo "<script>alert('Mail has sent successfully to user.');
	location.href='fetchLocationCenter.php'</script>";
   
}
else
echo "failed to send acceptance mail to the user";

}

if(isset($_POST['deny'])){
	$fetchUser=mysqli_query($con, "SELECT * FROM car_users where phone= $phone")or die("Failed to query user data". mysqli_error());
$user=mysqli_fetch_assoc($fetchUser);
$to =$user['email'];
$sub='Request denied';
$message='Sorry, we cannot serve at this moment :( ';
$header='From: soodheena72@gmail.com';
if(mail($to, $sub, $message, $header)){
	echo "<h2> Mail has sent successfully to user. </h2>";
	$del= mysqli_query($con, "DELETE FROM userlocation where phone=$phone")or die("Failed to delete user data". mysqli_error());
	if($del ){
		echo "<script>alert('User request got deleted sucessfully');
	location.href='fetchLocationCenter.php'</script>";

	}
	else{
		echo "Cannot delete the request";
	}
}
else
echo "failed to send mail";

}

?>