<?php
session_start();
$connect=mysqli_connect("localhost","root", "", "car_service");
include("links.php");

 // $_SESSION["userId"]='7018706040';
 // $_SESSION["center"]='soodheena0001@gmail.com'; //service center email who has looged in 
$users=mysqli_query($connect, "SELECT * FROM car_users WHERE phone='". $_SESSION["userId"]."' ")or die("Failed to query database". mysqli_error());
$user=mysqli_fetch_assoc($users);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Chat Box</title>
</head>
<body>
<div class="container-fluid" style="background-image: url('images/chatbox.png');" >
  <div class="row">
    <a href="services.php" style="color:black; font-size:1.5em; border:5px solid white; background-color: white; border-radius: 6px; margin: 2% 5% 1% 92%; position:fixed;">Back</a>
    <div class="col-md-4" style="color: white; margin-top: 2%; font-family: serif;">
      <h1>Hi <?php echo $user['username'];?></h1>
      <input type="text" id="fromUser" value="<?php $_SESSION['sender']=$user['phone'];
       echo $user['phone']; ?>" name="fromUser" hidden />
     
      
    </div>
    <div class="col-md-4">
      
<div class="modal-dialog">
    <div class="model-content" style="border: 1px solid; border-color: lightgray; border-radius: 5%; width: 80%; background-color: white; height: 90.4%">
      <div class="modal-header">

        <h4><?php
            // $connect=mysqli_connect("localhost","root", "", "car_service");    
           $centerName=mysqli_query($connect, "SELECT * FROM service_center WHERE email='".$_SESSION["centerMail"]."'")
                or die("Failed to query database". mysqli_error());
               $cName=mysqli_fetch_assoc($centerName);
                        echo '<input type="text" value='.$_SESSION["centerMail"].' name="toUser" id="toUser" hidden />';
                       // $_SESSION['receiver']=$_SESSION["center"];
                    
                           echo '<p style=" font-variant: small-caps; font-weight:bolder; font-size:1.6em">'.$cName["centerName"].'</p>' ;

        ?> </h4>
      </div>
      <div class="modal-body" name="msgBody" id="msgBody" style="height: 380px;  overflow-y: scroll; overflow-x: hidden;">
      
      <?php
               
      $chats=mysqli_query($connect, "SELECT * FROM chatbox where(sender='". $_SESSION["userId"]."' AND receiver= '".$_SESSION["centerMail"]."') OR (sender='". $_SESSION["centerMail"]."' AND receiver= '".$_SESSION["userId"]."') ")
                or die("Failed to query database". mysqli_error());
                   //    $chat=mysqli_fetch_assoc($chats);
              if($chats){
               while($chat=mysqli_fetch_assoc($chats)){
                        
                        if($chat["sender"] == $_SESSION["userId"])
                          echo "<div style='text-align:right;'>
                             <p style='background-color:#009999;color:white; word-wrap:break-word;display:inline-block; padding:5px;border-radius:0px 8px 0px 8px;max-width:70%; '>".$chat["message"]."

                               </p></div>";

                      
                     else
                             echo "<div style='text-align:left;'>
                             <p style='background-color:grey;color:white; word-wrap:break-word;display:inline-block; padding:5px;border-radius:0px 8px 0px 8px;max-width:70%; '>".$chat["message"]."

                                </p></div>";
                      

                  }
                }
                else
                  echo "Chat is empty. Start chat now";
                
              

      ?>
      
      </div>
      <div class="modal-footer">
        <form method="post">
        <textarea id="message" name="message" class="form-control" style="height: 15%; width: 85%;"></textarea>
        <input type="submit" id="send" name="send" class="btn btn-primary" style="height: 6%; position: absolute; top: 82%; left: 68%" value="Send">
        </form>
      </div>
      
    </div>
    
  </div>

    </div>
    <div  class="col-md-4">
      
    </div>
  </div>
</div>
</body>

<script type="text/javascript">
  $(document).ready(function(){
    setInterval(function(){

      $.ajax({
        url:"realTimeChat.php",
        method:"post",
        data:{
          fromUser:$("#fromUser").val(),
          toUser:$("#toUser").val()
        },
        dataType:"text",
        success:function(data){
          $("#msgBody").html(data);           
 }
      });
    },700);
  });

</script>


</html>
<?php
if(isset($_POST['send'])){
$fromUser=$_SESSION['sender'];
$toUser=$_SESSION['centerMail'];
$message=$_POST["message"];
$output="";
$sql="INSERT INTO chatbox (sender, receiver, message) VALUES ('$fromUser','$toUser','$message')";
$q="SELECT * from chatbox where (sender= '$fromUser' AND receiver='$toUser')";
$result=mysqli_query($connect,$sql)or die(mysqli_error($connect)); 
$res=mysqli_query($connect,$q)or die(mysqli_error($connect)); 
if($result){
  $n=0;

  $output.="";
    echo "<script>$('#message').val('');</script>";
    if($res){
$to =$toUser;
$sub=$user['username'].' '. 'is sending you a message' ;

while($myChat=mysqli_fetch_assoc($res)){
  $arr[$n] = $myChat['message'];
$n++;
}
$msgs=$arr[$n-1];
$header='From: soodheena72@gmail.com';
if(mail($to, $sub, $msgs, $header)){
echo "<script> alert('Your message has been sent to service center. Please wait for the response.... ')</script>"; 

  //do nothing ... 
}
else
echo "failed";

}

else{
  echo "error sending a mail to car service center ";
}
}

else{
  $output.="Error. Please try again";
}

echo $output;
}


?>