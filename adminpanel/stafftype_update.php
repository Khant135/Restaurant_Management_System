<?php
session_start();
include('admin_header.php');
include('../connect.php');

if (isset($_POST['btnupdate'])) {
    $txtstafftypeid=$_POST['txtstafftypeid'];
    $txtstafftype=$_POST['txtstafftype'];
    $txtsalary=$_POST['txtsalary'];

    $update="UPDATE stafftype SET stafftype='$txtstafftype', salary='$txtsalary' WHERE stafftypeid='$txtstafftypeid'";
    $result=mysqli_query($connection,$update);

    if($result){
        echo "<script>window.alert('Successfully Updated!!')</script>";
        echo "<script>window.location='stafftype_detail.php'</script>";
    }
    else{
        echo "<p>Something went wrong in StaffType Update : " . mysqli_error($connection) . "</p>";
    }
}

if (isset($_GET['stafftypeid'])) {
    $stafftypeid=$_GET['stafftypeid'];
    $query="SELECT * FROM stafftype WHERE stafftypeid='$stafftypeid'";
    $result=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($result);
}
else{
    $stafftypeid='';
    echo "<script>window.location='stafftype_detail.php'</script>";
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
                                <li class="breadcrumb-item active" aria-current="page">StaffType Update</li>
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
                        <form class="form-horizontal" action="stafftype_update.php" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6"><h4 class="card-title">StaffType</h4></div>
                                    <div class="col-md-6 text-right"><a href="stafftype_detail.php" class="btn btn-outline-success"><i class="fas fa-list"></i></a></div>
                                </div>
                                <br>
                                <input type="hidden" name="txtstafftypeid" value="<?php echo $arr['stafftypeid'] ?>">
                                <div class="form-group row">
                                    <label for="stafftype" class="col-sm-3 control-label col-form-label">StaffType Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="stafftype" name="txtstafftype" placeholder="StaffType Name Here" value="<?php echo $arr['stafftype'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="salary" class="col-sm-3 control-label col-form-label">Salary</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="salary" name="txtsalary" placeholder="Salary Here" value="<?php echo $arr['salary'] ?>" required>
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