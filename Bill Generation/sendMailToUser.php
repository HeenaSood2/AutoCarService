<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_FILES) && (bool) $_FILES) {

    $allowedExtensions = array("pdf", "doc", "docx", "gif", "jpeg", "jpg", "png", "txt");

    $files = array();
    foreach ($_FILES as $name => $file) {
        $file_name = $file['name'];
        $temp_name = $file['tmp_name'];
        $file_type = $file['type'];
        $path_parts = pathinfo($file_name);
        $ext = $path_parts['extension'];
        if (!in_array($ext, $allowedExtensions)) {
            die("File $file_name has the extensions $ext which is not allowed");
        }
        array_push($files, $file);
    }


    $to = $_POST['email'];
    $from = "questions@krishnarathor.com";  //your website email type here
    $subject = "Bill attachment ";
    $message = $_POST['msg'];
    $headers = "From: $from";


    $semi_rand = md5(time());
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";


    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";
    $message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";
    $message .= "--{$mime_boundary}\n";

    // preparing attachments
    for ($x = 0; $x < count($files); $x++) {
        $file = fopen($files[$x]['tmp_name'], "rb");
        $data = fread($file, filesize($files[$x]['tmp_name']));
        fclose($file);
        $data = chunk_split(base64_encode($data));
        $name = $files[$x]['name'];
        $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$name\"\n" .
                "Content-Disposition: attachment;\n" . " filename=\"$name\"\n" .
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
        $message .= "--{$mime_boundary}\n";
    }
    // send

    $ok = mail($to, $subject, $message, $headers);
    if ($ok) {
        echo "<script>alert('mail sent to $to!');</script>";
    } else {
        echo "<p>mail could not be sent!</p>";
    }
}
?>

<html>
    <head>
        <!-- <link href="style.css" rel="stylesheet" type="text/css"/> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <body>
<nav class="navbar navbar-expand-md bg-dark fixed-top">
<div class="container">
<a class="navbar-brand text-white ml-2" href="#"><span class="fa fa-car text-danger" style="margin-right: 7%;"  aria-hidden="true"></span><strong class="ml-2">AUTO CAR SERVICE</strong></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="collapsibleNavbar">
<ul class="navbar-nav ms-auto ">
<li class="nav-item mx-3">
<a class="nav-link text-white " href="../serviceProviderHome.php"><strong>Home</strong></a>
</li>
<li class="nav-item " >
<a class="nav-link text-white btn btn-danger " href="bill.php"><strong>Go Back</strong></a>
</li>
</ul>
</div>
</div>
</nav>

    <div class="container" style="margin:9% 40% 40% 35%; box-shadow: 12px 12px 22px grey;width:30%;height:65%;">
    
        <form method="post" action="" enctype="multipart/form-data" class="attachment-form">
        <div style="height:10%;background-color: #F7941E;width:106%; margin-left:-3% ">
            <h3 style="text-align:center;color:white;padding-top:2%;">Send Bill</h3>
         </div>
            <!-- <p>We will not store your email to our database you can test to type your email id at here</p> -->
            <div style="margin:10% 5% 0% 5%;">
           <div> <label class="form-label">Email</label><br>
           

 <?php
            if(isset($_SESSION['userEmail'])){
            	
            echo '<input type="email" name="email" class="form-control" placeholder="email" value="'.$_SESSION['userEmail'].'" readonly/><br>';
        }

else{
	 echo ' <input type="email" name="email" class="form-control" required/><br>';
}
            ?>


            </div>
            <div>
            <label class="form-label">Message</label><br>
            <textarea name="msg" type="text" class="form-control" required></textarea><br>
            </div>
            attach file<br>
            <input type="file" class="" name="attach1"/><br>
            <div style="margin-top:2%;">
            <input type="submit" class=" form-control btn btn-danger " value="Send"/>
            </div>
            </div>
        </form>
    
</div>
    </body>
</html>