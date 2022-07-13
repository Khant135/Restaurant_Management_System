<?php
session_start();
include('../connect.php');
include('admin_header.php');

if (isset($_POST['btnsave'])) {
    $txtvehicletype=$_POST['txtvehicletype'];

    $check="SELECT * FROM vehicletype WHERE vehicletype='$txtvehicletype'";
    $result=mysqli_query($connection,$check);
    $count=mysqli_num_rows($result);

    if ($count>0) {
        echo "<script>window.alert('VehicleType already Exists!!')</script>";
        echo "<script>window.location='vehicletype_entry.php'</script>";
    }
    else{
        $insert="INSERT INTO vehicletype (vehicletype)
        VALUES ('$txtvehicletype')";
        $result=mysqli_query($connection,$insert);
    }
    if ($result) {
        echo "<script>window.alert('VehicleType Successfully Added!!')</script>";
        echo "<script>window.location='vehicletype_detail.php'</script>";
    }
    else{
        echo "<p>Something went wrong in VehicleType Entry: ".msqli_error($connection)."</p>";
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
                                <li class="breadcrumb-item active" aria-current="page">VehicleType Entry</li>
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
                        <form class="form-horizontal" action="vehicletype_entry.php" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6"><h4 class="card-title">VehicleType</h4></div>
                                    <div class="col-md-6 text-right"><a href="vehicletype_detail.php" class="btn btn-outline-success"><i class="fas fa-list"></i></a></div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="vehicletype" class="col-sm-3 control-label col-form-label">VehicleType Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="vehicletype" name="txtvehicletype" placeholder="VehicleType Name Here" required>
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