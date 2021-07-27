<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
	$date=date("Y-m-d");


	
	$date1=strtotime($date);

	$maxDate=strtotime("+8 day",$date1);
	$maxDate= date('Y-m-d', $maxDate);
	echo $maxDate;
    echo "<input type='date' name='date' min='$date'  max='$maxDate'>";
	

	 ?>
</body>
</html>
 