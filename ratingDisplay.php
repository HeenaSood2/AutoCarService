<!DOCTYPE html>
<html>
<head>
	<title></title>
<!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>	
<!-- <link href="/your-path-to-fontawesome/css/fontawesome.css" rel="stylesheet">
  <link href="/your-path-to-fontawesome/css/brands.css" rel="stylesheet">
  <link href="/your-path-to-fontawesome/css/solid.css" rel="stylesheet"> -->

</head>
<body>

</body>
</html>

<?php
  $starNumber = 2.5;

  for ($x = 1; $x <= $starNumber; $x++) {
      echo "<i class='fa fa-star' style='color:orange'></i>";
  }
  if (strpos($starNumber, '.')) {
     echo "<i class='fa fa-star-half-alt' aria-hidden='true' style='color:orange'></i>";
     $x++;
  }
  while ($x <= 5) {
      echo "<i class='far fa-star' style='color:orange ' ></i>";
      $x++;
  }
?>