<?php
session_start();
include('admin_header.php');
include('../connect.php');

if (isset($_POST['btnupdate'])) {
    $txttabletypeid=$_POST['txttabletypeid'];
    $txttabletype=$_POST['txttabletype'];

    $update="UPDATE tabletype SET tabletype='$txttabletype' WHERE tabletypeid='$txttabletypeid'";
    $result=mysqli_query($connection,$update);

    if($result){
        echo "<script>window.alert('Successfully Updated!!')</script>";
        echo "<script>window.location='tabletype_detail.php'</script>";
    }
    else{
        echo "<p>Something went wrong in TableType Update : " . mysqli_error($connection) . "</p>";
    }
}

if (isset($_GET['tabletypeid'])) {
    $tabletypeid=$_GET['tabletypeid'];
    $query="SELECT * FROM tabletype WHERE tabletypeid='$tabletypeid'";
    $result=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($result);
}
else{
    $stafftypeid='';
    echo "<script>window.location='tabletype_detail.php'</script>";
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
                                <li class="breadcrumb-item active" aria-current="page">TableType Update</li>
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
                        <form class="form-horizontal" action="tabletype_update.php" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6"><h4 class="card-title">TableType</h4></div>
                                    <div class="col-md-6 text-right"><a href="tabletype_detail.php" class="btn btn-outline-success"><i class="fas fa-list"></i></a></div>
                                </div>
                                <br>
                                <input type="hidden" name="txttabletypeid" value="<?php echo $arr['tabletypeid'] ?>">
                                <div class="form-group row">
                                    <label for="tabletype" class="col-sm-3 control-label col-form-label">TableType Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="tabletype" name="txttabletype" placeholder="TableType Name Here" value="<?php echo $arr['tabletype'] ?>" required>
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