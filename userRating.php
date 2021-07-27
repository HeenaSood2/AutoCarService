
<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" ></script>

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
        <button type="button" class="btn btn-primary " id="addbtn" data-bs-toggle="modal" data-bs-target="#myModal">Add feedback </button> 
       <div class="modal" id="myModal">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h4 class="modal-title">Feedback</h4>
                       <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                   </div>
                   <div class="modal-body">
                   <form action="" method="post">
                   
                    <div class="mb-3">
                        <label class="form-label">Feedback</label>
                        <textarea name="desc" id="desc" cols="60" class="form-control" rows="4" >

                        </textarea>
                       </div>
                    <!-- <div class="mb-3"> -->
                        <label class="form-label">Ratings</label>
                    <div class="rateyo" id="rating"
                    data-rateyo-rating="4"
                    data-rateyo-num-stars="5"
                    data-rateyo-score="3">
                   </div>
                    <!-- </div> -->
                   <span class="result">0</span>
                   <input type="hidden" name="rating" >
                </div>


                <!-- <div class="btn-group" role="group">  -->
                    <input type="submit" class="form-control btn btn-danger "  style="width:20%;margin-left:39%;margin-bottom:2%;" name="add" value="ADD" >

                   <!-- </div>  -->
                  
            </form>
                     

                
            </div>
    </div>
        </div>
    </div>
  </div>











<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script>

$(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :'+ rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
        });
    });

</script>


</body>
</html>

<?php
$con=mysqli_connect("localhost","root","","car_service")or die("Can't Connect to Database");
if($_SERVER["REQUEST_METHOD"]=="POST")
{
   $desc=$_POST["desc"];
   $rating=$_POST["rating"];

//    $umail=   $_SESSION['user'];
  $center=$_SESSION['center'];
//$umail="gowthamisetty57@gmail.com";
$umail=$_SESSION['user'];
//$center="center1";
   $sql="INSERT INTO ratings  (`umail`,`centerName`,`rating`,`description`) VALUES ('$umail','$center','$rating','$desc')" or die(mysqli_error($con));
   if (mysqli_query($con, $sql))
   {
    echo "<script>alert('Ratings added successfully');
    
    location.href='services.php'</script>";  
   }
   else
   {
       echo "Error: " . $sql . "<br>" . mysqli_error($con);
   }
   mysqli_close($con);

}   
?>


