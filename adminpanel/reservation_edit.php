<?php
session_start();
include('admin_header.php');
include('../connect.php');
include('autoid_function.php');

if (isset($_POST['btnconfirm'])) {
    $txtreservationid=$_POST['txtreservationid'];
    $txtarrivedate=$_POST['txtarrivedate'];
    $txtarrivetime=$_POST['txtarrivetime'];
    $txtfinishtime=$_POST['txtfinishtime'];
    $cbotable=$_POST['cbotable'];

    // foreach ($_POST['cbotable'] as $table) {      

        $check="SELECT r.*,r.tableid FROM reservation r WHERE r.arrivedate='$txtarrivedate' AND r.tableid='$cbotable' AND r.confirmbyrestaurant='Confirmed' AND r.arrivetime<='$txtarrivetime' AND r.finishtime>='$txtarrivetime'";
        $query=mysqli_query($connection,$check);
        $count=mysqli_num_rows($query);
        // echo "<script>window.alert('$count')</script>";

        if ($count>0) {
            echo "<script>window.alert('Table is not Available at that Time!!')</script>";
            echo "<script>window.location='tablereservation.php'</script>";            
        }
        else{

            $update="UPDATE reservation SET tableid='$cbotable',confirmbyrestaurant='Confirmed' WHERE reserveid='$txtreservationid'";
            $result=mysqli_query($connection,$update);

            // $insert="INSERT INTO reservationdetail(reservationdetailid,tableid,reserveid,status)
            // VALUES('$txtreservationdetailid','$cbotable','$txtreservationid','Waiting')";
            // $result=mysqli_query($connection,$insert);
        }

        if($result) 
        {
            // $update="UPDATE reservation SET numberoftable='$tablecount', confirmbyrestaurant='Confirmed' WHERE reserveid='$txtreservationid'";
            // $query=mysqli_query($connection,$update);

            echo "<script>window.alert('Reservation Confirm Successful!')</script>";
            echo "<script>window.location='tablereservation.php'</script>";
        }
        else
        {
            echo "<p>Something went wrong in Reservation Confirm : " . mysqli_error($connection) . "</p>";
        } 
    
    // }
}

if (isset($_GET['reservationid'])) {
    $reservationid=$_GET['reservationid'];
    $query="SELECT r.*,c.customername as customername FROM reservation r,customer c WHERE reserveid='$reservationid' AND r.customerid=c.customerid";
    $result=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($result);
}
else{
    $staffid='';
    echo "<script>window.location='tablereservation.php'</script>";
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
                                <li class="breadcrumb-item active" aria-current="page">Table Reservation Confirm</li>
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
                        <form class="form-horizontal" action="reservation_edit.php" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6"><h4 class="card-title">Table Reservation Confirm</h4></div>
                                    <div class="col-md-6 text-right"><a href="tablereservation.php" class="btn btn-outline-success"><i class="fas fa-list"></i></a></div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="reservationid" class="col-sm-3 control-label col-form-label">ReservationID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="reservationid" name="txtreservationid" value="<?php echo $arr['reserveid'] ?>" readonly>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 control-label col-form-label">Customer Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="username" placeholder="Staff Name Here" name="txtCustomerName" value="<?php echo $arr['customername'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="number" class="col-sm-3 control-label col-form-label">Number of Person</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="number" placeholder="Number of Person Here" name="txtperson" value="<?php echo $arr['numberofpeople'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Arrival Date</label>
                                    <div class="input-group col-sm-9">
                                        <input type="date" class="form-control" name="txtarrivedate" value="<?php echo $arr['arrivedate'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Arrival Time</label>
                                    <div class="input-group col-sm-9">
                                        <input type="time" class="form-control" name="txtarrivetime" value="<?php echo $arr['arrivetime'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Finish Time</label>
                                    <div class="input-group col-sm-9">
                                        <input type="time" class="form-control" name="txtfinishtime" value="<?php echo $arr['finishtime'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Table</label>
                                    <div class="col-sm-9"> 
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="cbotable">
                                            <option>--- Choose Table ---</option>
                                            <?php
                                            $query="SELECT * FROM restauranttable WHERE status='Available'";
                                            $result=mysqli_query($connection,$query);
                                            $count=mysqli_num_rows($result);

                                            for($i=0;$i<$count;$i++)
                                            {
                                                $row=mysqli_fetch_array($result);
                                                $tableid=$row['tableid'];
                                                $numberofchair=$row['numberofchair'];

                                                echo "<option value='$tableid'>$tableid - $numberofchair chairs</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div>
                                <div class="card-body text-right">
                                    <input type="submit" name="btnconfirm" class="btn btn-primary" value="Confirm">
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