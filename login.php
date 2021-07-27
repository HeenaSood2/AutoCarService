<?php

session_start();
ob_start();

?>

<!DOCTYPE html>
<html >
  <head>
    
     <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <title>Login Page</title>
   </head>

  <body>


<!-- navbar -->

<nav class="navbar navbar-expand-md bg-dark fixed-top">
<div class="container">
<a class="navbar-brand text-white ml-2" href="#"><span class="fa fa-car text-danger" style="margin-right: 7%" aria-hidden="true"></span><strong class="ml-2">AUTO CAR SERVICE</strong></a>
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

    <section class="mx-5" style="margin-top:6%;">
       <div class="container">
       <div class="row no-gutters" style="width:75%;margin-left:15%;margin-top:3%">
          <div class="col-lg-5">
             <img src="images/login.jpeg" style="height: 100%" alt="" class="img-fluid max-width:100%">
          </div>
          <div class="col-lg-7 px-5 pt-5">

            <div style="display:table">
               <div style="display:table-row">
                  <div style="display:table-cell">
                     <img src="images/mainlogo.jpg" class="img-fluid"   alt="nothing" height="60px" width="60px">
                  </div>
               <div style="display:table-cell">
                  <h4 class="font-weight-bold py-3">Login Here</h4>
              </div> 
           </div>
          </div>
            <form method="post" action="">
                <div class="form-row" >
                <div class="col-lg-10">
                  <input type="email" class="form-control my-2 p-3" id="mail" placeholder="E-Mail" name="mail" autocomplete="off" required="true" value="<?php if(isset($_COOKIE['umailcookie'])){ echo $_COOKIE['umailcookie']; }  ?>">
                </div>
               </div>
               
               <div class="form-row">
                  <div class="col-lg-10">
                     <input type="password" class="form-control my-2 p-3" id="pass" placeholder="Password" name="pass" autocomplete="off" required="true" value="<?php if(isset($_COOKIE['passwordcookie'])){ echo $_COOKIE['passwordcookie']; }  ?>">
                  </div>
                 </div>

                 <div class="form-row">
                  <div class="col-lg-10">
                     <input type="tel" class="form-control my-2 p-3" pattern="[789][0-9]{9}" id="phone" placeholder="Phone Number" name="phone" autocomplete="off" required="true" value="<?php if(isset($_COOKIE['phonecookie'])){ echo $_COOKIE['phonecookie']; }  ?>">
                  </div>
                 </div>  
                 
                 <div class="form-row">
                  <div class="col-lg-10">
                     <input type="number" autocomplete="off" class="form-control my-2 p-3" id="captcha" placeholder="Captcha" name="captcha" required="true">
                  </div>
                  <div class="col-xs-2" style="margin-top:26px; padding: 0px ">
              <img src="captcha.php"/>
            </div>
                 </div>  <br>
             <div class="form-row">
               <div class="col-lg-7">
                  <input type="checkbox" name="rememberme"> &nbsp Remember Me
               </div>
              </div> 

              <div class="form-row">
               <div class="col-lg-10">
                  <input type="submit"  name="login" class="btn1" value="Login" >
               </div>
              </div> 
                <a href="forgot_password.php">Forgot Password? </a>
                <br>
                Don't have an account ?<a href="registration.php">Register here </a>
             </form>
          </div>
       </div>

      </div>

    </section>  

     </body>
</html>
<?php

if(isset($_POST['login'])){
  $email=$_POST['mail'];
  $pass=$_POST['pass'];
  $captcha=$_POST['captcha'];
  $phone=$_POST['phone'];
  if($_SESSION['CODE']==$captcha ){
    $conn=mysqli_connect("localhost","root","","car_service")or die("Can't Connect to Database");
  $query=mysqli_query($conn,"Select * from car_users where phone = $phone")
  or die(mysqli_error($conn));
  $count=mysqli_num_rows($query);
  if($count !=0){
   $row=mysqli_fetch_array($query);
   $umail=$row[2];
   $hash=$row[1];

  $verify = password_verify($pass, $hash); 
    $com=strcmp($umail, $email);
  if ($com==0 && $verify) { 
    if(isset($_POST['rememberme'])){
      setcookie('umailcookie', $email, time()+8640000);// upto 24hr user can make use of it
      setcookie('passwordcookie', $pass, time()+864000);
      setcookie('phonecookie', $phone, time()+864000);
       $_SESSION['user']=$umail;
    $_SESSION["userId"]=$phone;

      //echo 'Login sucessfull';
        if($row['centerName']){
             $_SESSION['centerN']=$row['centerName'];

 echo '<script>alert("Login successfull as service Provider");</script> ';
 echo "<script>location.href='serviceProviderHome.php'</script>";
 
}
   else{
 echo '<script>alert("Login successfull");</script> ';

 echo "<script>location.href='serviceCenters.php'</script>";
}

  }
  else{
    $_SESSION['user']=$umail;
    $_SESSION["userId"]=$phone;
    if($row['centerName']){
      $_SESSION['centerN']=$row['centerName'];
 echo '<script>alert("Login successfull as service center");</script> ';
 echo "<script>location.href='serviceProviderHome.php'</script>";

}
   else{
 echo '<script>alert("Login successfull");</script> ';

 echo "<script>location.href='serviceCenters.php'</script>"; 

 }

   
  }
    }

   else { 
      echo 'Wrong username or password'; 
  } 

}

else{
  echo "You are not registered! Register yourself and try again";
}

}

else{
  echo "<script> alert('Please enter valid captcha code');</script>";
}


}
?>