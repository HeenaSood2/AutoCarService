<?php
session_start();
$connect=mysqli_connect("localhost","root", "", "car_service");
include("links.php");
 //$_SESSION["userId"]='7018706040';
 //$_SESSION["center"]=  $_SESSION['centerEmail'];
 //$_SESSION["center"]=  'soodheena0001@gmail.com';
$users=mysqli_query($connect, "SELECT * FROM service_center WHERE email='". $_SESSION['user']."' ")or die("Failed to query database". mysqli_error());
$user=mysqli_fetch_assoc($users);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Chat Box</title>
</head>
<body>
<div class="container-fluid " style="background-image: url('images/chatbox.png');"  >

	<div class="row">
			<a href="serviceCenters.php" style="color:black; font-size:1.5em; border:5px solid white; background-color: white; border-radius: 6px; margin: 2% 5% 1% 92%; position:fixed;">Back</a>
		<div class="col-md-4" style="color: white; margin-top: 2%; font-family: serif;">
			<h2>Welcome <?php echo $user['centerName'];?></h2>
			<input type="hidden" id="fromUser" value="<?php $_SESSION['sender']= $user['email'];
			 echo $user['email']; ?>" name="fromUser"  />
			<h4>Send message to :</h4>
			
				

				<?php
				$u= $_SESSION['user'];
     $msgs=mysqli_query($connect, "SELECT username,phone from car_users where phone IN (select distinct rec.sender from (select * from chatbox where receiver='$u')as rec) ")
                or die("Failed to query database". mysqli_error());
                       while($msg=mysqli_fetch_assoc($msgs)){
                    
            echo '<li><a style="color:white; font-size:1.5em;font-variant: small-caps;" href="?toUser='.$msg["phone"].'">'.$msg["username"].'</a></li>';
                       }

				?>
			
		
		</div>
		<div class="col-md-4">
			
<div class="modal-dialog">
		<div class="model-content" style="border: 1px solid; border-color: lightgray; border-radius: 5%; width: 80%; background-color: white; height: 90.4%">
			<div class="modal-header">

				<h4><?php
                 if(isset($_GET['toUser'])){
         $userName=mysqli_query($connect, "SELECT * FROM car_users WHERE phone='".$_GET["toUser"]."'")
                or die("Failed to query database". mysqli_error());
                       $uName=mysqli_fetch_assoc($userName);
                        echo '<input type="hidden" value='.$_GET["toUser"].' name="toUser" id="toUser"  />';
                        $_SESSION['receiver']=$_GET["toUser"];
                          echo '<p style=" font-variant: small-caps; font-weight:bolder; font-size:1.6em">'.$uName["username"].'</p>' ;

                 }

                 else{
                 	
                          echo '<input type="hidden" value="n" name="toUser" id="toUser"  />';
                          $_SESSION['receiver']="n";
                        
                 }
				?> </h4>
			</div>
			<div class="modal-body" id="msgBody" style="height: 380px;  overflow-y: scroll; overflow-x: hidden;">
			
			<?php
               if(isset($_GET["toUser"])){
    	$chats=mysqli_query($connect, "SELECT * FROM chatbox where(sender='". $_SESSION['user']."' AND receiver= '".$_GET["toUser"]."') OR (sender='". $_GET["toUser"]."' AND receiver= '".$_SESSION['user']."') ORDER BY id ASC")
                or die("Failed to query database". mysqli_error());
                   
               }
               while($chat=mysqli_fetch_assoc($chats)){
                        
                        if($chat["sender"] == $_SESSION['user'])
                        	echo "<div style='text-align:right;'>
                             <p style='background-color:#009999; color:white; word-wrap:break-word;display:inline-block; padding:5px;border-radius:0px 8px 0px 8px;max-width:70%; '>".$chat["message"]."

                               </p></div>";

                      
                      else{

	                         echo "<div style='text-align:left;'>
                             <p style='background-color:grey;color:white; word-wrap:break-word;display:inline-block; padding:5px;border-radius:0px 8px 0px 8px;max-width:70%; '>".$chat["message"]."

                                </p></div>";
                      }

                  }

			?>
			
			</div>
			<div class="modal-footer">
				<form method="post">
				<textarea id="message" name="message" class="form-control" style="height: 12%; width: 85%;"></textarea>
				<input type="submit" id="send" name="send" class="btn btn-primary" style="height: 6%; position: absolute; top: 88%; left: 68%" value="Send">
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
$fromUser=$_SESSION['user'];
$toUser=$_SESSION['receiver'];
$message=$_POST["message"];
$output="";
$sql="INSERT INTO chatbox (sender, receiver, message) VALUES ('$fromUser','$toUser','$message')";
$result=mysqli_query($connect,$sql)or die(mysqli_error($connect)); 

if($result){

	$output.="";
		echo "<script>$('#message').val('');</script>";

		
}
else{
	$output.="Error. Please try again";
}

echo $output;
}


?>