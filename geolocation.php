
<?php 
if(isset($_POST['submit'])){
	$address=$_POST['address'];
$address=str_replace(" ", "+", $address);

	?>
	<iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo $address; ?>&output=embed"></iframe>
	<?php
}


if(isset($_POST['submit_cordinates'])){
$latitude=$_POST['latitude'];
$longitude=$_POST['longitude'];
?>

<iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo $latitude; ?>,<?php echo $longitude; ?>&output=embed"></iframe>
<?php
}


 ?>

<form method="post">
	<p>
		<input type="text " name="address" placeholder="enter address">
	</p>
	<input type="submit" name="submit">

</form>
<form method="post">
	<p>
		<input type="text" name="latitude" placeholder="enter latitude">
	</p>
<p>
		<input type="text" name="longitude" placeholder="enter longitude">
	</p>
	<input type="submit" name="submit_cordinates" >
</form>
