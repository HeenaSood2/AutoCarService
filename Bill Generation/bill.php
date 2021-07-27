<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Auto Calculation</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

<nav class="navbar navbar-expand-md bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand text-white ml-2" href="#"><span class="fa fa-car text-danger" style="margin-right: 7%;" aria-hidden="true"></span><strong class="ml-2">AUTO CAR SERVICE</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="collapsibleNavbar">
  <ul class="navbar-nav ms-auto ">
    <li class="nav-item ">
        <a  class="nav-link text-white " href="../serviceProviderHome.php"><strong>Home</strong></a>
    </li>
  </ul>
</div>
</div>
 </nav>




    
    <div class="container" style="margin-top:6%;">
        <p><br/></p>
        <form name="cart" method="post">
            <table name="cart" id="tblCustomers" class="table  table-dark ">
                <thead>
                    <tr>
                        <th></th>
                        <th>Item</th>
                        <th>Tax</th>
                        <th>Price</th>
                        <th>Item Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr name="line_items">
                        <td><button name="remove" class="btn btn-danger btn-sm">Remove</button></td>
                        <td><input type="text" name="sName" class="form-control form-control-sm"/></td>
                        <td><input type="text" name="qty" value="0" class="form-control form-control-sm"/></td>
                        <td><input type="text" name="price" value="0" class="form-control form-control-sm"/></td>
                        <td><input type="text" name="item_total" jAutoCalc="{qty} + {price}" class="form-control form-control-sm"/></td>
                    </tr>
                  
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td>Total</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="grand_total" jAutoCalc="SUM({item_total})" class="form-control form-control-sm"/></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <button name="add" class="btn btn-primary">Add Row</button>
                        </td>
                    </tr>
                </tbody>
            </table>
             <input type="submit" id="sendBill" name="sendBill" class="btn btn-success" style="margin:4% 15% 5% 35%;" value="Send Bill To User" />
       
 </form>
         <input type="button" id="btnExport" class="btn btn-success" style="margin:-11% 10% 5% 50%;" value="Generate Bill" />
          
    </div>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/jautocalc.js"></script>
    <script src="js/script.js"></script>
   <script >
        $("body").on("click", "#btnExport", function () {
            html2canvas($('#tblCustomers')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("cutomer-bill.pdf");
                }
            });
        });
    </script>
   

</body>
</html>

<?php
if(isset($_POST['sendBill'])){
    echo "<script>location.href='sendMailToUser.php'</script>";
}
?>