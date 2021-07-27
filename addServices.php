<?php
session_start();

?>



<!doctype html>
<html lang="en">
  <head>
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Add Services</title>
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
            document.getElementById("addbtn").click();
            document.getElementById("addbtn").style.display="none";

        }
      </script>
  <body>
      
  <div class="container mt-5">
       <button type="button" class="btn btn-primary " id="addbtn" data-bs-toggle="modal" data-bs-target="#myModal">Add Services </button> 
      <div class="modal" id="myModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Add Services</h4>
                      <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                  </div>
                  <div class="modal-body">
                      <form method="post" action="">
                          <div class="mb-3">
                       <label class="form-label">Service Name</label>
                       <input type="text" class="form-control"  name="service" required>
                      </div> 
                      
                      
                      <div class="mb-3">
                        <label class="form-label">Normal Price</label>
                        <input type="text"  placeholder="ex: 1000-2000"  name="normal" class="form-control" required>
                       </div> 

                       <div class="mb-3">
                        <label class="form-label">SUV Price</label>
                        <input type="text" class="form-control" placeholder="ex: 1000-2000" name="suv" required>
                       </div> 

                       <div class="mb-3">
                        <label class="form-label">Luxury Price</label>
                        <input type="text" class="form-control" placeholder="ex: 1000-2000" name="luxury" required>
                       </div> 
                       <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="desc" id="desc" cols="60" class="form-control" rows="2" required>

                        </textarea>
                       </div>
                       <div class="btn-group " role="group"> 
                        <input type="submit" class="form-control btn btn-primary " name="add" value="ADD" required>

                       </div> 
                       

                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    
  </body>
</html>

<?php
if(isset($_POST["add"])){
   $center=$_SESSION['centerN'];
 //echo "<script>alert('hi');</script>";
  $service=$_POST['service'];
 if(is_numeric($service))
  {
             echo "<script>alert('Please enter only characters');</script>";
                              }
else{


// $center='DEV AUTOMOTIVES';

$description=$_POST['desc'];
$normal=$_POST['normal'];
$suv=$_POST['suv'];
$luxury=$_POST['luxury'];
$image="images/paid.jpg";
$con=mysqli_connect("localhost","root","","car_service")or die("Can't Connect to Database");

$reg="INSERT INTO services(`centerName`,`serviceName`,`description`,`image`,`normal`,`suv`,`luxury`)
 VALUES ('$center','$service','$description','$image','$normal','$suv','$luxury')";
$result=mysqli_query($con,$reg)or die(mysqli_error($con));   

 if($result)
  {       
 echo "<script>alert('Service added successfully');
  location.href='serviceProviderHome.php'</script>";  
  } 
 else
 {    
      echo "<script>alert('Unsuccessfull, Please try again! ');
         location.href='addServices.php';
      </script>";  
  }

}
}
?>
