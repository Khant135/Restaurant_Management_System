<?php
session_start();
include('../connect.php');
include('admin_header.php');
include('autoid_function.php');

if (isset($_POST['btnsave'])) {
    $txtvehicleid=$_POST['txtvehicleid'];
    $txtvehiclebrand=$_POST['txtvehiclebrand'];
    $txtmodel=$_POST['txtmodel'];
    $txtstatus=$_POST['txtstatus'];    
    $cbovehicletype=$_POST['cbovehicletype'];

    $insert="INSERT INTO vehicle (vehicleid,vehiclebrand,model,status,vehicletypeid)
    VALUES ('$txtvehicleid','$txtvehiclebrand','$txtmodel','$txtstatus','$cbovehicletype')";
    $result=mysqli_query($connection,$insert);

    if($result) 
    {
        echo "<script>window.alert('Vehicle Successfully Added!')</script>";
        echo "<script>window.location='vehicle_detail.php'</script>";
    }
    else
    {
        echo "<p>Something went wrong in Vehicle Entry : " . mysqli_error($connection) . "</p>";
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
                                <li class="breadcrumb-item active" aria-current="page">Vehicle Entry</li>
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
                        <form class="form-horizontal" action="vehicle_entry.php" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6"><h4 class="card-title">Vehicle</h4></div>
                                    <div class="col-md-6 text-right"><a href="vehicle_detail.php" class="btn btn-outline-success"><i class="fas fa-list"></i></a></div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="vehicleid" class="col-sm-3 control-label col-form-label">VehicleID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="vehicleid" name="txtvehicleid" value="<?php echo AutoID('vehicle','vehicleid','V-',6) ?>" readonly>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="vehiclebrand" class="col-sm-3 control-label col-form-label">Vehicle Brand</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="vehiclebrand" placeholder="Vehicle Brand Here" name="txtvehiclebrand" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="model" class="col-sm-3 control-label col-form-label">Vehicle Model</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="model" placeholder="Vehicle Model Here" name="txtmodel" required="">
                                    </div>
                                </div>  
<!--                                 <div class="form-group row">
                                    <label for="status" class="col-sm-3 control-label col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="status" placeholder="Status Here" name="txtstatus" required="">
                                    </div>
                                </div>  -->
                                <div class="form-group row">
                                    <label class="col-md-3">Status</label>
                                    <div class="col-md-9">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="customControlValidation1" name="txtstatus" value="Good" required checked>
                                            <label class="custom-control-label" for="customControlValidation1">Good</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="customControlValidation2" name="txtstatus" value="In Repair" required>
                                            <label class="custom-control-label" for="customControlValidation2">In Repair</label>
                                        </div>
                                    </div>
                                </div>                                                               
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">VehicleType</label>
                                    <div class="col-sm-9"> 
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="cbovehicletype">
                                            <option>--- Choose VehicleType ---</option>
                                            <?php
                                            $query="SELECT * FROM vehicletype";
                                            $result=mysqli_query($connection,$query);
                                            $count=mysqli_num_rows($result);

                                            for($i=0;$i<$count;$i++)
                                            {
                                                $row=mysqli_fetch_array($result);
                                                $vehicletypeid=$row['vehicletypeid'];
                                                $vehicletype=$row['vehicletype'];

                                                echo "<option value='$vehicletypeid'>$vehicletype</option>";
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