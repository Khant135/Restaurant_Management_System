<?php
session_start();
include('admin_header.php');
include('../connect.php');

if (isset($_GET['orderid'])) {
    $orderid=$_GET['orderid'];
    $query="SELECT co.*,cd.quantity as quantity,cd.totalprice as totalprice,m.menuname as menuname,m.menuimage as menuimage FROM customerorder co,customerorderdetail cd,menu m WHERE co.orderid=cd.orderid AND m.menuid=cd.menuid AND co.orderid='$orderid'";
    $result=mysqli_query($connection,$query);
    $count=mysqli_num_rows($result);
    
}
else{
    $orderid='';
    echo "<script>window.location='customerorderlist2.php'</script>";
}

?>
<html>
<head>
	<title></title>
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
                                <li class="breadcrumb-item active" aria-current="page">Order Detail</li>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title">Order Detail of <b class="text-info"><?php echo $orderid ?></b></h5>
                                </div>
                                <?php
                                if ($_SESSION['stafftype']=='Delivery Branch Manager' || $_SESSION['stafftype']=='Restaurant Manager' || $_SESSION['stafftype']=='Restaurant Owner') {
                                    ?>
                                    <div class="col-md-6 text-right"><a href="customerorderlist.php" class="btn btn-outline-success"><i class="fas fa-backward"></i></a></div>
                                    <?php
                                }
                                else if ($_SESSION['stafftype']=='Waiter' || $_SESSION['stafftype']=='Head Chef' || $_SESSION['stafftype']=='Chef'){
                                    ?>
                                    <div class="col-md-6 text-right"><a href="customerorderlist2.php" class="btn btn-outline-success"><i class="fas fa-backward"></i></a></div>
                                    <?php
                                }
                                else if ($_SESSION['stafftype']=='Delivery Staff') {
                                    ?>
                                    <div class="col-md-6 text-right"><a href="customerorderlist1.php" class="btn btn-outline-success"><i class="fas fa-backward"></i></a></div>
                                    <?php
                                }
                                ?>
                                <!--                                 <div class="col-md-6 text-right"><a href="customerorderlist.php" class="btn btn-outline-success"><i class="fas fa-backward"></i></a></div> -->
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>MenuName</th>
                                        <th>MenuImage</th>
                                        <th>Quantity</th>
                                        <th>TotalPrice</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i=0; $i < $count ; $i++) { 
                                        $rows=mysqli_fetch_array($result);
                                        $menuname=$rows['menuname'];
                                        $menuimage=$rows['menuimage'];
                                        $quantity=$rows['quantity'];
                                        $totalprice=$rows['totalprice'];

                                        echo "<tr>";
                                        echo "<td>".$menuname."</td>";
                                        echo "<td><img src='".$menuimage."' width='100px' height='100px'></td>";
                                        echo "<td>".$quantity."</td>";
                                        echo "<td>".$totalprice."</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>MenuName</th>
                                        <th>MenuImage</th>
                                        <th>Quantity</th>
                                        <th>TotalPrice</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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