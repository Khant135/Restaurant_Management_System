<?php
session_start();
include('admin_header.php');
include('../connect.php');

if (isset($_POST['btnpayment'])) {
    $orderid1=$_POST['txtorderid'];
    $deliveryscheduleid=$_POST['txtdeliveryscheduleid'];
    $receivetime=date("H:i");
    // $paymentstatus="Confirmed";
    // $deliverystatus="Delivered";
    // $status="Available";

    $update="UPDATE customerorder SET paymentstatus='Confirmed', deliverystatus='Delivered', receivetime='$receivetime' WHERE orderid='$orderid1'";
    $result=mysqli_query($connection,$update);

    $update1="UPDATE deliveryschedule SET status='Available' WHERE deliveryscheduleid='$deliveryscheduleid'";
    $result1=mysqli_query($connection,$update1);

    if ($result && $result1) {
        echo "<script>window.alert('Pyament Process is Successful!!')</script>";
        echo "<script>window.location='customerorderlist1.php'</script>";
    }
}

if (isset($_GET['orderid'])) {
    $orderid=$_GET['orderid'];
    $query="SELECT co.*,c.customername as customername FROM customerorder co,customer c WHERE co.customerid=c.customerid AND orderid='$orderid'";
    $result=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($result);

    $query1="SELECT cd.*,m.menuname as menuname,m.price as price FROM customerorderdetail cd,menu m WHERE cd.menuid=m.menuid AND orderid='$orderid'";
    $result1=mysqli_query($connection,$query1);
    $count1=mysqli_num_rows($result1);
    
}
else{
    $oriderid='';
    echo "<script>window.location='customerorderlist1.php'</script>";
}
?>
<html>
<head>
	<title></title>
    <!-- <script type="text/javascript">
        function COD()
        {
            document.getElementById('CardPayment').style.display="none";
        }
        function Card()
        {
            document.getElementById('CardPayment').style.display="block";
        }
    </script> -->
</head>
<body>
    <div class="page-wrapper" style="background-color: white;">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <!--                     <h4 class="page-title">Form Basic</h4> -->
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Online Order Payment</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <form action="customerorderpayment.php" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12"><h5 class="card-title">Online Order Payment</h5></div>
                                </div>
                                <br>
                                <div class="table-responsive">
                                    <table class="table" style="table-layout: fixed;">
                                        <tr>
                                            <td colspan="4" align="center"><p style="font-size: 30px;"><b>Morning Restaurant</b></p>Date: <?php echo date("Y/m/d") ?> | Time: <?php echo date("h:i A") ?> </td>
                                        </tr>
                                        <tr>
                                            <input type="hidden" name="txtorderid" value="<?php echo $arr['orderid']; ?>">
                                            <input type="hidden" name="txtdeliveryscheduleid" value="<?php echo $arr['deliveryscheduleid']; ?>">
                                            <td colspan="2"><b>OrderID:</b> <?php echo $arr['orderid']; ?></td>
                                            <!-- <td colspan="2"></td> -->
                                            <td colspan="2" align="right"><b>Customer Name:</b> <?php echo $arr['customername']; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="font-weight: bold;">Menu</th>
                                            <th style="font-weight: bold;">Quantity</th>
                                            <th style="font-weight: bold;">Price</th>
                                            <th style="font-weight: bold;">TotalPrice</th>
                                        </tr>
                                        <?php
                                        if ($count1<0) {
                                            ?>
                                            <tr>
                                                <td colspan="4">No Record Found!!</td>
                                            </tr>
                                            <?php
                                        }
                                        else{
                                            for ($i=0; $i < $count1 ; $i++) { 
                                                $arr1=mysqli_fetch_array($result1);
                                                $menuname=$arr1['menuname'];
                                                $quantity=$arr1['quantity'];
                                                $totalprice=$arr1['totalprice'];
                                                $price=$arr1['price'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $menuname ?></td>
                                                    <td><?php echo $quantity ?></td>
                                                    <td><?php echo $price ?></td>
                                                    <td><?php echo $totalprice ?> $</td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="3" align="right" style="font-weight: bold;">TotalQuantity:</td>
                                            <td><?php echo $arr['totalquantity']; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="right" style="font-weight: bold;">TotalAmount:</td>
                                            <td><?php echo $arr['grandtotal']; ?> $</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="right" style="font-weight: bold;">PaymentType:</td>
                                            <td style="color: red;">
                                                <?php echo $arr['paymenttype']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="right">
                                                <input type="submit" class="btn btn-primary" name="btnpayment" value="Make Payment">
                                                <script>var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'block';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;var pfCustomCSS = '';var pfEncodeImages = 0;var pfShowHiddenContent = 0;var pfBtVersion='2';(function(){var js,pf;pf=document.createElement('script');pf.type='text/javascript';pf.src='//cdn.printfriendly.com/printfriendly.js';document.getElementsByTagName('head')[0].appendChild(pf)})();</script><a href="https://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="//cdn.printfriendly.com/buttons/print-button.png" alt="Print Friendly and PDF"/></a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
 <!--                            <hr>
                            <div class="text-right">
                                <b>PaymentType:</b>
                                <input type="radio" name="rdopayment" onClick="COD()" value="Cash" checked> Cash Payment
                                <input type="radio" name="rdopayment" onClick="Card()" value="Card"> Card Payment
                                <div class="table-responsive" align="right" id="CardPayment" style="display: none">
                                    <table>
                                        <tr>
                                            <td style="border-style: none;">
                                                <input type="text" name="txtCardNo" placeholder="Enter Card Number" /> |
                                                <input type="text" name="txtSecurityNo" placeholder="Security Code" size="9" /> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border-style: none;">
                                                <input type="text" name="txtMonth" placeholder="JAN" size="5" />
                                                <input type="text" name="txtYear" placeholder="2021" size="5" />
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div> -->
<!--                             <hr>
                            <div class="text-right">
                                <input type="submit" class="btn btn-primary" name="btnpayment" value="Make Payment">
                                <script>var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'block';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;var pfCustomCSS = '';var pfEncodeImages = 0;var pfShowHiddenContent = 0;var pfBtVersion='2';(function(){var js,pf;pf=document.createElement('script');pf.type='text/javascript';pf.src='//cdn.printfriendly.com/printfriendly.js';document.getElementsByTagName('head')[0].appendChild(pf)})();</script><a href="https://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="//cdn.printfriendly.com/buttons/print-button.png" alt="Print Friendly and PDF"/></a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
</body>
</html>
<?php
include('admin_footer.php');
?>