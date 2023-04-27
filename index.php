<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invocie</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <script src="bootstrap/bootstrap.min.js"></script>
    <script src="jquery/jquery-3.6.3.min.js"></script>
</head>

<?php

    $conn=mysqli_connect("localhost","root","","invoice_db");
    if(isset($_POST['submit'])){
        $invoice_no = $_POST['invoice_no'];
        $invoice_date = date("y-m-d",strtotime($_POST['invoice_date']));
        $cname = $_POST['cname'];
        $caddress = $_POST['caddress'];
        $ccity = $_POST['ccity'];
        $grand_total = $_POST['grand_total'];

        $sql = "INSERT into `customer`(invoice_no,invoice_date,cname,caddress,ccity,grand_total)values('{$invoice_no}','{$invoice_date}','{$cname}','{$caddress}','{$ccity}','{$grand_total}')";
        
        if($conn->query($sql)){
            $sid=$conn->insert_id;

            $sql2 = "INSERT into `product`(`sid`,pname,qty,total)values ";
            $row=[];

            for($i=0;$i<count($_POST['pname']);$i++){
                
            }
        }
    }

?>


<body>
    <div class="container">
        <form action="index.php" method="post">
            <div class="row  my-5">
                <div class="col-md-5 col-sm-6">
                    <h3 class="text-success">Invocie Details</h3>
                    <div class="form-group">
                        <label >Invocie No</label><br>
                        <input type="text" name="invoice_no" class="w-100 form-control" required>
                    </div>
                    <div class="form-group">
                        <label >Invocie Date</label><br>
                        <input type="date"  name="invoice_date" class="w-100 form-control " id="date" required>
                    </div>
                </div>
                <div class="col-md-7 col-sm-6 pb-4">
                <h3 class="text-success">Customer Details</h3>
                    <div class="form-group">
                        <label >Name</label><br>
                        <input type="text" name="cname" class="w-100 form-control" required>
                    </div>
                    <div class="form-group">
                        <label >Address</label><br>
                        <input type="text" name="caddress" class="w-100 form-control" required>
                    </div>
                    <div class="form-group">
                        <label >City</label><br>
                        <input type="text" name="ccity" class="w-100 form-control" required>
                    </div>
                </div>
            </div>
            <div class="row  my-5">
            <h3 class="text-success">Product Details</h3>
                <table class="table w-100">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Totel</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="py-3" id="product_tbody">
                        <tr>
                            <td><input type="text" name="pname[]" class="form-control" required></td>
                            <td><input type="text" name="pqty[]" class="form-control price" required></td>
                            <td><input type="number" name="ptotal[]" class="form-control qty" required></td>
                            <td><input type="number" class="form-control total" required></td>    
                            <td>
                                <input type="button" value="X" class="btn btn-danger btn-sm w-100 btn-row-remove" >
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                        <td><input type="button" value="+ Add New" id="btn-add-row" class="btn btn-primary text-white btn-sm "></td>
                        <td colspan="2" class="h6" name="grand_total" >Total</td>
                        <td><input type="text" class="form-control" id="grand_total" required></td>
                        <td></td>
                        </tr>
                    </tfoot>
                </table>
                    <div class="col-md-10 col-md-offset"></div>
                    <input type="submit" value="Submit" name="submit" class="btn btn-success text-white col-md-2 ">
            </div>

             
        </form>
    </div>


    <script>
        $(document).ready(function(){
    
            // $(".date").datepicker({
            //     dateFormat: "dd-mm-yy"
            // });
          
            $("#btn-add-row").click(function(){
                var row = "<tr><td><input type='text' name='pname' class='form-control' required></td><td><input type='text' name='pqty' class='form-control price' required></td><td><input type='number' name='ptotal' class='form-control qty' required></td><td><input type='number' class='form-control total' required></td><td><input type='button' value='X' class='btn btn-danger btn-sm w-100 btn-row-remove'></td></tr>";
                
                $("#product_tbody").append(row);
            });
            $("body").on("click",".btn-row-remove",function(){
                if(confirm("Are You Sure!")){
                    $(this).closest("tr").remove();
                   
                }
                grand_total();
            });
            $("body").on("keyup",".price",function(){
                var price = Number($(this).val());
                var qty = Number($(this).closest("tr").find(".qty").val());
                $(this).closest("tr").find(".total").val(price*qty);
                grand_total();
            });
            $("body").on("keyup",".qty",function(){
                var qty = Number($(this).val());
                var price = Number($(this).closest("tr").find(".price").val());
                $(this).closest("tr").find(".total").val(price*qty);
                grand_total();
            });
            function grand_total(){
                var tot=0;
                $(".total").each(function(){
                    tot+=Number($(this).val());
                });
                $("#grand_total").val(tot);
            }
        });
    </script>
 
</body>

<style>
    .h6{
        text-align:right;
    }
</style>
</html>





