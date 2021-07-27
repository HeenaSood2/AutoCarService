<?php
session_start();
$connect=mysqli_connect("localhost","root", "", "car_service");
$fromUser=$_POST["fromUser"];
$toUser=$_POST["toUser"];
$output="";
// if(strcmp($toUser, "n")){
//   $output="choose a user to chat ";
// }


$chats=mysqli_query($connect, "SELECT * FROM chatbox where (sender='$fromUser' AND receiver= '$toUser') OR  (sender='$toUser' AND receiver= '$fromUser') ORDER BY id ASC")
                or die("Failed to query database". mysqli_error());
if($chats){
               while($chat=mysqli_fetch_assoc($chats)){
                        if($chat["sender"] == $fromUser)
                           $output.= "<div style='text-align:right;'>
                             <p style='background-color:#009999; color:white; word-wrap:break-word;display:inline-block; padding:5px;border-radius:0px 8px 0px 8px;max-width:70%; '>".$chat["message"]."

                               </p></div>";
                        
                       
                      else
                             $output.= "<div style='text-align:left;'>
                             <p style='background-color:grey; color:white;word-wrap:break-word;display:inline-block; padding:5px;border-radius:0px 8px 0px 8px;max-width:70%; '>".$chat["message"]."

                                </p></div>";
                                
                      

                  }


                }

                else
                  echo "Chat is empty. Start chat now";
                
              
echo $output;


?>