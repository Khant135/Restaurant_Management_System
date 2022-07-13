<?php
session_start();
include('../connect.php');
include('admin_header.php');

if (isset($_POST['btnsave'])) {
    $txtstafftype=$_POST['txtstafftype'];
    $txtsalary=$_POST['txtsalary'];

    $check="SELECT * FROM stafftype WHERE stafftype='$txtstafftype'";
    $result=mysqli_query($connection,$check);
    $count=mysqli_num_rows($result);

    if ($count>0) {
        echo "<script>window.alert('StaffType already Exists!!')</script>";
        echo "<script>window.location='stafftype_entry.php'</script>";
    }
    else{
        $insert="INSERT INTO stafftype (stafftype,salary)
        VALUES ('$txtstafftype','$txtsalary')";
        $result=mysqli_query($connection,$insert);
    }
    if ($result) {
        echo "<script>window.alert('StaffType Successfully Added!!')</script>";
        echo "<script>window.location='stafftype_detail.php'</script>";
    }
    else{
        echo "<p>Something went wrong in StaffType Entry: ".msqli_error($connection)."</p>";
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
                                <li class="breadcrumb-item active" aria-current="page">StaffType Entry</li>
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
                        <form class="form-horizontal" action="stafftype_entry.php" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6"><h4 class="card-title">StaffType</h4></div>
                                    <div class="col-md-6 text-right"><a href="stafftype_detail.php" class="btn btn-outline-success"><i class="fas fa-list"></i></a></div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="stafftype" class="col-sm-3 control-label col-form-label">StaffType Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="stafftype" name="txtstafftype" placeholder="StaffType Name Here" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="salary" class="col-sm-3 control-label col-form-label">Salary</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="salary" name="txtsalary" placeholder="Salary Here" required>
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