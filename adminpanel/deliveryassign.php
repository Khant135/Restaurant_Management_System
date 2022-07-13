<?php
session_start();
include('admin_header.php');
include('../connect.php');
include('autoid_function.php');

if (isset($_POST['btnupdate'])) {
    $txtorderid=$_POST['txtorderid'];
    $cboschedule=$_POST['cboschedule'];
    $deliverystatus="Assigned";
    $txttime=$_POST['txttime'];

    $update="UPDATE customerorder SET deliveryscheduleid='$cboschedule', deliverystatus='$deliverystatus', estimatereceivetime='$txttime' WHERE orderid='$txtorderid'";
    $result=mysqli_query($connection,$update);

    if ($result) {
        $status="UnAvailable";
        $update1="UPDATE deliveryschedule SET status ='$status' WHERE deliveryscheduleid='$cboschedule'";
        $result1=mysqli_query($connection,$update1);
    }


    if($result1){
        echo "<script>window.alert('Successfully Assigned!!')</script>";
        echo "<script>window.location='customerorderlist.php'</script>";
    }
    else{
        echo "<p>Something went wrong in Delivery Schedule Assign : " . mysqli_error($connection) . "</p>";
    }
}

if (isset($_GET['orderid'])) {
    $orderid=$_GET['orderid'];
    $query="SELECT co.*,c.customername as customername FROM customerorder co,customer c WHERE co.customerid=c.customerid AND co.orderid='$orderid'";
    $result=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($result);
}
else{
    $orderid='';
    echo "<script>window.location='customerorderlist.php'</script>";
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
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Assign Delivery Schedule</li>
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
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card border">
                        <form class="form-horizontal" action="deliveryassign.php" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6"><h4 class="card-title">Assign Delivery Schedule</h4></div>
                                    <div class="col-md-6 text-right"><a href="customerorderlist.php" class="btn btn-outline-success"><i class="fas fa-list"></i></a></div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="orderid" class="col-sm-3 control-label col-form-label">OrderID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="orderid" name="txtorderid" value="<?php echo $arr['orderid'] ?>" readonly>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="customer" class="col-sm-3 control-label col-form-label">Customer</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="customer" placeholder="Depature Time Here" name="txtdepaturetime" value="<?php echo $arr['customername'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date" class="col-sm-3 control-label col-form-label">Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="date" placeholder="Depature Time Here" name="txtdate" value="<?php echo $arr['orderdate'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 control-label col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="address" name="txtaddress" readonly=""><?php echo $arr['fulladdress'] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="time" class="col-sm-3 control-label col-form-label">Estimate Receive Time</label>
                                    <div class="col-sm-9">
                                        <input type="time" class="form-control" id="time" name="txttime" required="">
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Delivery Schedule</label>
                                    <div class="col-sm-9"> 
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="cboschedule">
                                            <option>--- Choose Delivery Schedule ---</option>
                                            <?php
                                            $query="SELECT ds.*,s.staffname as staffname FROM deliveryschedule ds,staff s WHERE ds.staffid=s.staffid AND ds.status='Available'";
                                            $result=mysqli_query($connection,$query);
                                            $count=mysqli_num_rows($result);

                                            for($i=0;$i<$count;$i++)
                                            {
                                                $row=mysqli_fetch_array($result);
                                                $scheduleid=$row['deliveryscheduleid'];
                                                $staffname=$row['staffname'];

                                                    // echo "<option value='$stafftypeid'>$stafftype</option>";
                                                ?>
                                                <option value="<?= $scheduleid?>"
                                                    <?php
                                                    if ($arr['deliveryscheduleid']==$scheduleid) {
                                                        echo "selected";
                                                    }
                                                    ?>
                                                    >
                                                    <?php echo $scheduleid ?> | <?php echo $staffname ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>                                                  
                            </div>
                            <div>
                                <div class="card-body text-right">
                                    <input type="submit" name="btnupdate" class="btn btn-primary" value="Update">
                                </div>
                            </div>
                        </form>                                                            
                    </div>
                </div>
                <div class="col-md-2"></div>
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