<?php
session_start();
include('../connect.php');
include('admin_header.php');
include('autoid_function.php');

if (isset($_POST['btnsave'])) {
    $txtscheduleid=$_POST['txtscheduleid'];
    $txtdepaturetime=$_POST['txtdepaturetime'];
    $cbostaff=$_POST['cbostaff'];
    $cbovehicle=$_POST['cbovehicle'];
    $status="Available";

    $check1="SELECT * FROM deliveryschedule WHERE staffid='$cbostaff'";
    $result1=mysqli_query($connection,$check1);
    $count1=mysqli_num_rows($result1);

    $check2="SELECT * FROM deliveryschedule WHERE vehicleid='$cbovehicle'";
    $result2=mysqli_query($connection,$check2);
    $count2=mysqli_num_rows($result2);

    if($count1>0){
        echo "<script>window.alert('Current Staff is already Assigned!!')</script>";
        echo "<script>window.location='deliveryschedule_entry.php'</script>";
    }
    else if ($count2>0) {
        echo "<script>window.alert('Current Vehicle is already Assigned!')</script>";
        echo "<script>window.location='deliveryschedule_entry.php'</script>";
    }
    else{
        $insert="INSERT INTO deliveryschedule(deliveryscheduleid,depaturetime,staffid,vehicleid,status)
        VALUES ('$txtscheduleid','$txtdepaturetime','$cbostaff','$cbovehicle','$status')";
        $result=mysqli_query($connection,$insert);
    }

    if($result) 
    {
        echo "<script>window.alert('Delivery Schedule Successfully Created!')</script>";
        echo "<script>window.location='deliveryschedule_detail.php'</script>";
    }
    else
    {
        echo "<p>Something went wrong in Delivery Schedule Creation : " . mysqli_error($connection) . "</p>";
    }        

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
                                <li class="breadcrumb-item active" aria-current="page">Delivery Schedule Entry</li>
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
                        <form class="form-horizontal" action="deliveryschedule_entry.php" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6"><h4 class="card-title">Delivery Schedule</h4></div>
                                    <div class="col-md-6 text-right"><a href="deliveryschedule_detail.php" class="btn btn-outline-success"><i class="fas fa-list"></i></a></div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="scheduleid" class="col-sm-3 control-label col-form-label">DeliveryScheduleID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="scheduleid" name="txtscheduleid" value="<?php echo AutoID('deliveryschedule','deliveryscheduleid','DS-',6) ?>" readonly>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="depaturetime" class="col-sm-3 control-label col-form-label">Depature Time</label>
                                    <div class="col-sm-9">
                                        <input type="time" class="form-control" id="depaturetime" name="txtdepaturetime" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Staff</label>
                                    <div class="col-sm-9"> 
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="cbostaff">
                                            <option>--- Choose Staff ---</option>
                                            <?php
                                            $query="SELECT s.*,st.stafftype as stafftype FROM staff s,stafftype st WHERE s.stafftypeid=st.stafftypeid AND stafftype='Delivery Staff'";
                                            $result=mysqli_query($connection,$query);
                                            $count=mysqli_num_rows($result);

                                            for($i=0;$i<$count;$i++)
                                            {
                                                $row=mysqli_fetch_array($result);
                                                $staffid=$row['staffid'];
                                                $staffname=$row['staffname'];

                                                echo "<option value='$staffid'>$staffname</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Vehicle</label>
                                    <div class="col-sm-9"> 
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="cbovehicle">
                                            <option>--- Choose Vehicle ---</option>
                                            <?php
                                            $query="SELECT v.*,vt.vehicletype as vehicletype FROM vehicle v,vehicletype vt WHERE v.vehicletypeid=vt.vehicletypeid";
                                            $result=mysqli_query($connection,$query);
                                            $count=mysqli_num_rows($result);

                                            for($i=0;$i<$count;$i++)
                                            {
                                                $row=mysqli_fetch_array($result);
                                                $vehicleid=$row['vehicleid'];
                                                $vehicletype=$row['vehicletype'];

                                                echo "<option value='$vehicleid'>$vehicleid | $vehicletype</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>                                                                
                            </div>
                            <div>
                                <div class="card-body text-right">
                                    <input type="submit" name="btnsave" class="btn btn-primary" value="Save">
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