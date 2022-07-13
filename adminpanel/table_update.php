<?php
session_start();
include('admin_header.php');
include('../connect.php');
include('autoid_function.php');

if (isset($_POST['btnupdate'])) {
    $txttableid=$_POST['txttableid'];
    $txtnumber=$_POST['txtnumber'];
    $cbotabletype=$_POST['cbotabletype'];
    $txtstatus=$_POST['txtstatus'];

    $update="UPDATE restauranttable SET numberofchair='$txtnumber', tabletypeid='$cbotabletype', status='$txtstatus' WHERE tableid='$txttableid'";
    $result=mysqli_query($connection,$update);

    if($result){
        echo "<script>window.alert('Successfully Updated!!')</script>";
        echo "<script>window.location='table_detail.php'</script>";
    }
    else{
        echo "<p>Something went wrong in Table Update : " . mysqli_error($connection) . "</p>";
    }
}

if (isset($_GET['tableid'])) {
    $tableid=$_GET['tableid'];
    $query="SELECT * FROM restauranttable WHERE tableid='$tableid'";
    $result=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($result);
}
else{
    $tableid='';
    echo "<script>window.location='table_detail.php'</script>";
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
                                <li class="breadcrumb-item active" aria-current="page">Table Update</li>
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
                        <form class="form-horizontal" action="table_update.php" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6"><h4 class="card-title">Table</h4></div>
                                    <div class="col-md-6 text-right"><a href="table_detail.php" class="btn btn-outline-success"><i class="fas fa-list"></i></a></div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="tableid" class="col-sm-3 control-label col-form-label">TableID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="tableid" name="txttableid" value="<?php echo $arr['tableid'] ?>" readonly>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="number" class="col-sm-3 control-label col-form-label">Number of Chair</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="number" placeholder="Number of Chair Here" name="txtnumber" value="<?php echo $arr['numberofchair'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">TableType</label>
                                    <div class="col-sm-9"> 
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="cbotabletype">
                                            <option>--- Choose TableType ---</option>
                                            <?php
                                            $query="SELECT * FROM tabletype";
                                            $result=mysqli_query($connection,$query);
                                            $count=mysqli_num_rows($result);

                                            for($i=0;$i<$count;$i++)
                                            {
                                                $row=mysqli_fetch_array($result);
                                                $tabletypeid=$row['tabletypeid'];
                                                $tabletype=$row['tabletype'];

                                                    // echo "<option value='$stafftypeid'>$stafftype</option>";

                                                ?>
                                                <option value="<?= $tabletypeid?>"
                                                    <?php
                                                    if ($arr['tabletypeid']==$tabletypeid) {
                                                        echo "selected";
                                                    }
                                                    ?>
                                                    >
                                                    <?php echo $tabletype ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
<!--                                 <div class="form-group row">
                                    <label for="status" class="col-sm-3 control-label col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="status" placeholder="Status Here" name="txtstatus" value="<?php echo $arr['status'] ?>">
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label class="col-md-3">Status</label>
                                    <div class="col-md-9">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="customControlValidation1" name="txtstatus" value="Available" required <?php if ($arr['status']=='Available'){echo "checked";} ?>>
                                            <label class="custom-control-label" for="customControlValidation1">Available</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="customControlValidation2" name="txtstatus" value="Out Of Order" required <?php if ($arr['status']=='Out Of Order'){echo "checked";} ?>>
                                            <label class="custom-control-label" for="customControlValidation2">Out Of Order</label>
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