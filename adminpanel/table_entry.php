<?php
session_start();
include('../connect.php');
include('admin_header.php');
include('autoid_function.php');

if (isset($_POST['btnsave'])) {
    $txttableid=$_POST['txttableid'];
    $txtnumber=$_POST['txtnumber'];
    $cbotabletype=$_POST['cbotabletype'];
    // $cbostatus=$_POST['cbostatus'];
    $txtstatus=$_POST['txtstatus'];

    $insert="INSERT INTO restauranttable (tableid,numberofchair,tabletypeid,status)
    VALUES ('$txttableid','$txtnumber','$cbotabletype','$txtstatus')";
    $result=mysqli_query($connection,$insert);

    if($result) 
    {
        echo "<script>window.alert('Table Successfully Added!')</script>";
        echo "<script>window.location='table_detail.php'</script>";
    }
    else
    {
        echo "<p>Something went wrong in Table Entry : " . mysqli_error($connection) . "</p>";
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
                                <li class="breadcrumb-item active" aria-current="page">Table Entry</li>
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
                        <form class="form-horizontal" action="table_entry.php" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6"><h4 class="card-title">Table</h4></div>
                                    <div class="col-md-6 text-right"><a href="table_detail.php" class="btn btn-outline-success"><i class="fas fa-list"></i></a></div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="tableid" class="col-sm-3 control-label col-form-label">TableID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="tableid" name="txttableid" value="<?php echo AutoID('restauranttable','tableid','TA-',6) ?>" readonly>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="numbers" class="col-sm-3 control-label col-form-label">Number of Chair</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="numbers" placeholder="Number of Chairs Here" name="txtnumber" required="">
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

                                                echo "<option value='$tabletypeid'>$tabletype</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
<!--                                 <div class="form-group row">
                                    <label for="status" class="col-sm-3 control-label col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="status" placeholder="Status Here" name="txtstatus" required="">
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label class="col-md-3">Status</label>
                                    <div class="col-md-9">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="customControlValidation1" name="txtstatus" value="Available" required checked>
                                            <label class="custom-control-label" for="customControlValidation1">Available</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="customControlValidation2" name="txtstatus" value="Out Of Order" required>
                                            <label class="custom-control-label" for="customControlValidation2">Out Of Order</label>
                                        </div>
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