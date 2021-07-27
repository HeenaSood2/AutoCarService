<?php
session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Discount</title>
    <style>
        .modal-header
        {
            background-color: #F7941E;
            color:white;
        }

       
    </style>
  </head>
  <script>


       window.onload=function(){
            document.getElementById("adddis").click();
            document.getElementById("adddis").style.display="none";

        }
      </script>
  <body>
  <?php
  
  Echo "<form method='post'>";
  $date=date("Y-m-d");

$date1=strtotime($date);

$maxDate=strtotime("+8 day",$date1);
$maxDate= date('Y-m-d', $maxDate);
 Echo " <div class='container mt-5'>
       <button type='button'  class='btn btn-primary ' id='adddis' data-bs-toggle='modal' data-bs-target='#myModal'>Add Discount </button> 
      <div class='modal' id='myModal'>
          <div class='modal-dialog'>
              <div class='modal-content'>
                  <div class='modal-header'>
                      <h4 class='modal-title'>Add Discount</h4>
                      <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                  </div>
                  <div class='modal-body'>
                       <div class='mb-3'>
                       <label class='form-label'>Discount</label>
                       <input type='text' class='form-control' maxlength='2' name='discount'  required>
                   
                      </div> 
                      
                      
                      <div class='mb-3'>
                        <label class='form-label'>Select Start Date</label>
                        <input type='date' name='from' min='$date'  max='$maxDate' class='form-control' required >
                        
                       </div> 

                     

                       <div class='mb-3'>
                        <label class='form-label'> Select End Date</label>
                        
                        <input type='date' name='to' min='$date'  max='$maxDate' class='form-control' required>
                       </div> 

        
                       <div class='btn-group ' role='group'> 
                       
                        <input type='submit' name='setDiscount' class='form-control btn btn-primary ' value='Submit'>
                       </div> 
                       

                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>"
?>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    
  </body>
</html>
<?php
if(isset($_POST['setDiscount'])){
//$_SESSION['center']="DEV AUTOMOTIVES";
$center= $_SESSION['centerN'];

$discount=$_POST['discount'];
$from=$_POST['from'];
$to=$_POST['to'];
if(!is_numeric($discount))
  {
             echo "<script>alert('Please enter only digits');</script>";
                              }
else{

if($from>$to)
{
    echo "<script>alert('start date cannot be greater than end date');</script>";
}
else{
  $conn=mysqli_connect("localhost","root","","car_service")or die("Can't Connect to Database");

$selectQuery=mysqli_query($conn,"SELECT * from discount where centerName='$center'") or die(mysqli_error($conn));
$count=mysqli_num_rows($selectQuery);
if($count>0){
	$updateQuery=mysqli_query($conn,"UPDATE discount SET discount=$discount,startDate= '$from',endDate='$to' where centerName='$center' ") or die(mysqli_error($conn));
	if($updateQuery){
		echo "<script>alert('Discount Updated Successfully');</script>";
        echo "<script>location.href='serviceProviderHome.php'</script>";
	}
}
// else{
// $insertDiscount=mysqli_query($conn,"INSERT INTO discount (centerName, discount,startDate,endDate) VALUES ('$center', $discount, '$from', '$to')") or die(mysqli_error($conn));
// if($insertDiscount){
// 	echo 'discount Inserted Successfully';
// }
}
}
}

?>