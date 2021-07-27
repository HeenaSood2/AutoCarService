<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
               <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" ></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" > 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" ></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>


    <title>Registration Page</title>
</head>
<body>

<!-- nav bar -->
<nav class="navbar navbar-expand-md bg-dark fixed-top">
<div class="container">
<a class="navbar-brand text-white ml-2" href="#"><span class="fa fa-car" aria-hidden="true"></span><strong class="ml-2">AUTO CAR SERVICE</strong></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="collapsibleNavbar">
<ul class="navbar-nav ms-auto ">
<li class="nav-item ">
<a class="nav-link text-white " href="home.php"><strong>Home</strong></a>
</li>
</ul>
</div>
</div>
</nav>




<section  style="margin-top:6%;" >
  <div class="container">
      <div class="row no-gutters"  style="width:70%;margin-left:15%;margin-top:3%">
        <div class="col-lg-5">
        <img class="image" src="images/registration.jpg" width="100%" height="100%" class="img-fluid" alt="">
      </div>
        <div class="col-lg-7 px-5 pt-5">
            <div style="display:table">
                 <div style="display:table-row">
                    <div style="display:table-cell">
                       <img src="images/mainlogo.jpg" class="img-fluid"   alt="nothing" height="60px" width="60car3">
                    </div>
                 <div style="display:table-cell">
                    <h4 class="font-weight-bold py-3">Register Here</h4>
                </div> 
             </div>
            </div>
             <form method="post">
                 <div class="form-row">
                       <div class="col-lg-10">
                           <input type="text" name="name" id="name" placeholder="User Name" class="form-control my-3 p-4" autocomplete="off"  value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" >
                       </div>
                 </div>
                 <div class="form-row">
                       <div class="col-lg-10">
                       <input type="password" name="password" id="password" placeholder="Password" class="form-control my-3 p-4" autocomplete="off"  value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>" >
                       </div>
                 </div>
                 <div class="form-row">
                       <div class="col-lg-10">
                       <input type="email" name="mail" id="mail" placeholder="Email" class="form-control my-3 p-4" autocomplete="off"  value="<?php if(isset($_POST['mail'])) echo $_POST['mail']; ?>" >
                       </div>
                 </div>
                 <div class="form-row">
                       <div class="col-lg-10">
                       <input type="text"  name="phone" placeholder="Mobile-No" class="form-control my-3 p-4" id="mob" autocomplete="off"  value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
                       </div>
                 </div>
                 <div class="form-row">
                       <div class="col-lg-10">
                       <input type="text" placeholder="Enter OTP" class="form-control my-3 p-4" name="otp1" id="enterotp" autocomplete="off" >
                       </div>
                 <br>
                 <div class="countdown"></div>
                 <a href="#" id="resend_otp" type="buttton">Resend</a>
                </div>
                <div class="form-row">
                       <div class="col-lg-10">
                       <button type="button" id="sendotp" class="btn1">Send OTP</button>

                       </div>
                 </div>
                <div class="form-row">
                    <div class="col-lg-10">
                      <input  type="submit" id="verifyotp" name="verify" value="Verify OTP" class="btn1"><br>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-lg-10">
                 <input  type="submit" id="register1" name="register" value="Register" class="btn1">
                 </div>
                 </div>
            </form>
        </div>
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
            var n=document.getElementById('name').value;
                var pass=document.getElementById('password').value;
                    var mail=document.getElementById('mail').value;
                        var phone =document.getElementById('mob').value;
            if(n==null || n=="" || pass==null || pass=="" || mail==null || mail==""||phone==null || phone==""){
              alert("All fields are required");
            }

            else if(phone.length !=10){
               alert("Please enter valid mobile number");
            }
else{
         document.getElementById('enterotp').style.display='block';

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
     }    );

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
 $con=mysqli_connect("localhost","root","","car_service")or die("Can't Connect to Database");
if(isset($_POST['register']))
{ 
    if($_SESSION['verified']!=1 )
    {
        echo "<div class='alert alert-success'>OTP not verified</div>";  
    }
 $uname=$_POST['name'];
$pass=$_POST['password'];
$email=$_POST['mail'];
$phone_number=$_POST['phone'];
if(!preg_match("/^[a-zA-Z]*$/",$uname))
{
    echo '<script>alert("Only characters and white spaces are allowed")</script>';
}

else
{
$enPass = password_hash($pass,PASSWORD_DEFAULT); 
$reg="INSERT INTO car_users(`username`,`password`,`email`,`phone`) VALUES ('$uname','$enPass','$email',$phone_number)";
$result=mysqli_query($con,$reg)or die(mysqli_error($con));   

 if($result)
  {       
 echo "<script>alert('Registration successfull');
  location.href='login.php'</script>";  
  } 
 else
 {    
      echo "<script>alert('Registration unsuccessfull. Please Try again !!! ');
         location.href='registration.php';
      </script>";  
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

       echo "<script>document.getElementById('register1').style.display='block';
       document.getElementById('sendotp').style.display='none';</script>";
    }
    else
    {
        echo "<div class='alert alert-success'>OTP did not match please try again</div>";

    }
}

 ?>