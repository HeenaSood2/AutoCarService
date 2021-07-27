
<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Change Password</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
       <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <!-- <link rel="stylesheet" href="assets/css/style-starter.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
               <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" ></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" ></script> -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" >  -->
   <!--  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" ></script> -->

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script> -->


    <title>forgot password</title>
    
</head>
<body>

<!-- navbar -->

<nav class="navbar navbar-expand-md bg-dark fixed-top">
<div class="container">
<a class="navbar-brand text-white ml-2" href="#"><span class="fa fa-car" aria-hidden="true"></span><strong class="ml-2" style="font-size:1.5em ">AUTO CAR SERVICE</strong></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="collapsibleNavbar">
<ul class="navbar-nav ms-auto ">
<li class="nav-item ">
<a class="nav-link text-white " href="home.php" style="font-size:1.5em "><strong>Home</strong></a>
</li>
</ul>
</div>
</div>
</nav>

<section  style="margin-top:6%;" >
      <div class="container">
         <div class="row no-gutters mx-auto " style="width:45%;margin-left:14%;margin-top:8%;">
            <div class="col-xs-7 ">
               <h1 class="font-weight-bold py-3 text-center">Change Password</h1><br/>
            </div>
               <form method="post" action="">
                          
               <div class="form-row" id="mobilediv">
                       <div class="col-lg-8 mx-auto">
                           <input type="text" name="phone" placeholder="Mobile Number" style="margin-left:25%" class="form-control my-3  p-4 " autocomplete="off" id="mob"  value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>" >
                           <br>
                             <button type="button" id="sendotp" style="margin-left:25%" class="btn1">Send OTP</button>
                       </div>
                 </div>

                 <div class="form-row" id="otpdiv">
                       <div class="col-lg-8 mx-auto">
                           <input type="text" name="otp1" id="otp" placeholder="Enter OTP" style="margin-left:25%" class="form-control my-3 p-4" autocomplete="off"   >
                           <br>
                           <div class="countdown"  style="margin-left:25%"></div> 
                      <a href="#" id="resend_otp" style="margin-left:25%;font-size:15px;" type="buttton">Resend</a>  
                       </div>  
                 
                  </div>   
                  <!-- <a href="#" id="resend_otp"  type="buttton" >Resend</a>  -->
                       <div id="passworddiv">           
                 <div class="form-row" >
                    <div class="col-lg-8 mx-auto"> 
                  <input type="password" style="margin-left:25%" class="form-control my-3 p-4" id="pass" placeholder="Enter new password" name="newpass" autocomplete="off" ><br>
                  <br>
                    </div>
                    </div>
                   
                    <div class="form-row" >
                        <div class="col-lg-8 mx-auto"> 
                  <input type="password" class="form-control my-3 p-4" id="pass" style="margin-left:25%" placeholder="Re-Enter password" name="conpass" autocomplete="off" ><br>
                  </div>
                  </div>

                  <div class="form-row  " >
                    <div class="col-lg-8 mx-auto"> 
                   <input type="submit" class=" btn1" style="margin-left:25%" name="changePass"  value="Change Password" >
                  </div>
                </div>
            </div>
            <br>
            <br>
                <div class="form-row  " >
                    <div class="col-lg-8 mx-auto"> 
                        <input  type="submit" id="verifyotp" style="margin-left:25%"  name="verify" value="Verify OTP" class="btn1"><br>
                   </div>
              </div>    
               </form>
            </div>
        </div> 
</section>

<script type="text/javascript" >
    $(document).ready(function(){
        function validate_mobile(mob)
        {
            var pattern= /^[6-9]\d{9}$/;
            if(mob=='')
            {
                return false;
            }
            else if(!pattern.test(mob))
            {
                return false;
            }
            else 
            {
                return true;
            }
        }

        

         

         //send otp 
         $('#sendotp').click(function(){
            
               
                        var phone =document.getElementById('mob').value;
            if(phone==null || phone==""){
              alert("Please Enter Mobile Number");
            }

             var mob=$('#mob').val();
             if(validate_mobile(mob)==false) $('.otp_msg').html('<div class="alert alert-danger" style="position:absolute">Enter Valid mobile number</div>').fadeIn();
             else{
                
                 var url="sendResendOTP.js";
                 $.getScript(url, function(){
                    $(document).ready(function(){
                    send_otp(mob);
                 });
             });
               
                 window.setTimeout(function()
                 {
                     $('.otp_msg').fadeOut();
                 },1000)
             }
         }
         );

          //end of send otp 
          

         //resend otp function

         $('#resend_otp').click(function()
         {
             var mob=$('#mob').val();

             var url="sendResendOTP.js";
                 $.getScript(url, function(){
                    $(document).ready(function(){
                    send_otp(mob);
                 });
             });
             $(this).hide();
         });
            //end of resend otp function

            
            

    });
</script>

   </body>
</html>
<?php

if(isset($_POST['changePass'])){
  $phone=$_POST['phone'];
  $changePass= $_POST['conpass'];
  $newPass= $_POST['newpass'];
  if(strcmp($changePass, $newPass) !=0){
     echo "<script>alert('Both passsword fields should have matching values !');
  </script>"; 
  }
  else{
$con=mysqli_connect("localhost","root","","car_service")or die("Can't Connect to Database");
 if($_SESSION['verified']!=1 )
    {
        echo "<div class='alert alert-success'>OTP not verified</div>";  
    }
    else{
      $enPass = password_hash($newpass,PASSWORD_DEFAULT); 
$reg="UPDATE car_users set `password` ='$enPass'";
$result=mysqli_query($con,$reg)or die(mysqli_error($con));   

 if($result)
  {       
 echo "<script>alert('Password updated successfully');
 location.href='login.php';
  </script>";  
  } 
 else
 {    
      echo "<script>alert('Password does not change ');
         location.href='forgot_password.php';
      </script>";  
  }
    }

}

}


if(isset($_POST['verify'])){
    $otp=$_POST['otp1'];
    $userOTP= $_SESSION['otp'];
    if($userOTP==$otp)
    {
       $_SESSION['verified']=1;
       echo "<div class='alert alert-success'>OTP verified successfully</div>";

       echo "<script>
       document.getElementById('sendotp').style.display='none';
            document.getElementById('otpdiv').style.display='none';
                 document.getElementById('verifyotp').style.display='none';
                 document.getElementById('passworddiv').style.display='block';

       </script>";
    }
    else
    {
        echo "<div class='alert alert-success'>OTP did not match please try again</div>";

    }
}

?>