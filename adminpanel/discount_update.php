<?php
session_start();
include('admin_header.php');
include('../connect.php');

if (isset($_POST['btnupdate'])) {
    $txtdiscountid=$_POST['txtdiscountid'];
    $txtdiscountname=$_POST['txtdiscountname'];
    $txtpercentage=$_POST['txtpercentage'];
    $txtstatus=$_POST['txtstatus'];
    $txtstartdate=$_POST['txtstartdate'];
    $txtenddate=$_POST['txtenddate'];

    $update="UPDATE discount SET discountname='$txtdiscountname',percentage='$txtpercentage',startdate='$txtstartdate',enddate='$txtenddate',status='$txtstatus' WHERE discountid='$txtdiscountid'";
    $result=mysqli_query($connection,$update);

    if($result){
        echo "<script>window.alert('Successfully Updated!!')</script>";
        echo "<script>window.location='discount_detail.php'</script>";
    }
    else{
        echo "<p>Something went wrong in Discount Update : " . mysqli_error($connection) . "</p>";
    }
}

if (isset($_GET['discountid'])) {
    $discountid=$_GET['discountid'];
    $query="SELECT * FROM discount WHERE discountid='$discountid'";
    $result=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($result);
}
else{
    $discountid='';
    echo "<script>window.location='discount_detail.php'</script>";
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
                                <li class="breadcrumb-item active" aria-current="page">Discount Update</li>
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
                        <form class="form-horizontal" action="discount_update.php" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6"><h4 class="card-title">Discount</h4></div>
                                    <div class="col-md-6 text-right"><a href="discount_detail.php" class="btn btn-outline-success"><i class="fas fa-list"></i></a></div>
                                </div>
                                <br>
                                <input type="hidden" name="txtdiscountid" value="<?php echo $arr['discountid'] ?>">
                                <div class="form-group row">
                                    <label for="discount" class="col-sm-3 control-label col-form-label">Discount Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="discount" name="txtdiscountname" placeholder="Discount Name Here" value="<?php echo $arr['discountname'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="percentage" class="col-sm-3 control-label col-form-label">Percentage</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="percentage" name="txtpercentage" placeholder="Percentage Here" value="<?php echo $arr['percentage'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="start" class="col-sm-3 control-label col-form-label">Start Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="start" name="txtstartdate" placeholder="Start Date Here" value="<?php echo $arr['startdate'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="end" class="col-sm-3 control-label col-form-label">End Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="end" name="txtenddate" placeholder="End Date Here" value="<?php echo $arr['enddate'] ?>">
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label class="col-md-3">Status</label>
                                    <div class="col-md-9">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="customControlValidation1" name="txtstatus" value="Active" required <?php if ($arr['status']=='Active'){echo "checked";} ?>>
                                            <label class="custom-control-label" for="customControlValidation1">Active</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="customControlValidation2" name="txtstatus" value="InActive" required <?php if ($arr['status']=='InActive'){echo "checked";} ?>>
                                            <label class="custom-control-label" for="customControlValidation2">InActive</label>
                                        </div>
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