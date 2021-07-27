  //send otp function

 function send_otp(mob)
        {
            var ch= "send_otp";
            
            $.ajax({
                url: "otp_process.php",
                method:"post",
                data:{mob:mob,ch:ch},
                dataType:"text",
                success:function(data)
                {
                    if(data=='success')
                    {
                        
                        $('#otpdiv').css("display","block");
                        $('#sendotp').css("display","none");
                        $('#verifyotp').css("display","block");
                        timer();
                        $('.otp_msg').html('<div class="alert alert-success">OTP sent successfully </div>').fadeIn();
                            window.setTimeout(function(){
                               $('.otp_msg').fadeOut(); 
                            },1000)
                    }


                    else
                    {
                        $('.otp_msg').html('<div class="alert alert-danger">Error in sending OTP</div>').fadeIn();
                        window.setTimeout(function()
                        {
                           $('.otp_msg').fadeOut();
                        },1000); 
                    }
                }
            });
       }
         //end of send otp function



          //start of timer function
            function timer()
            {
                var timer2="00:31";
                var interval=setInterval(function(){

                    var timer=timer2.split(':');
                    //by parsing the integer, I avoid all extra string processing
                    var minutes=parseInt(timer[0],10);
                    var seconds=parseInt(timer[1],10);
                    --seconds;
                    minutes=(seconds<0)? --minutes:minutes;
                    seconds=(seconds<0)? 59 :seconds;
                    seconds=(seconds<10)? '0' + seconds : seconds;
                    //minutes=(minutes<0) ? minutes :minutes; 
                    $('.countdown').html("Resend otp in : <b class='text-primary'>"+minutes + ':' + seconds + "seconds</b>");
                    if((seconds<=0)&&(minutes<=0))
                    {
                        clearInterval(interval);
                        $('countdown').html('');
                        $('#resend_otp').css("display","block");
                    }
                    timer2=minutes + ':' + seconds;
                },1000);
            }
           //end of timer

