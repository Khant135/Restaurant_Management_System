<?php
session_start();
include('../connect.php');
include('admin_header.php');
include('autoid_function.php');

if (isset($_POST['btnsave'])) {
    $txtmenuid=$_POST['txtmenuid'];
    $txtmenuname=$_POST['txtmenuname'];
    $txtmain=$_POST['txtmain'];
    $txtprice=$_POST['txtprice'];
    $txtdescription=$_POST['txtdescription'];
    $cbocategory=$_POST['cbocategory'];
    $cboregion=$_POST['cboregion'];

    //Image Upload-------------------------------------------------------
    $fileMenuPhoto=$_FILES['txtimage']['name']; //Alex.jpg
    $FolderName="menuphoto/"; //StaffPhoto/
    $FileName=$FolderName . '_' . $fileMenuPhoto;  //StaffPhoto/_Alex.jpg

    $copied=copy($_FILES['txtimage']['tmp_name'], $FileName);

    if(!$copied) 
    {
        echo "<p>Staff Photo Cannot Upload!</p>";
        exit();
    }

    $check="SELECT * FROM menu WHERE menuname='$txtmenuname'";
    $result=mysqli_query($connection,$check);
    $count=mysqli_num_rows($result);

    if($count>0){
        echo "<script>window.alert('Menu Name Already Exist!')</script>";
        echo "<script>window.location='menu_entry.php'</script>";
    }
    else{
        $insert="INSERT INTO menu(menuid,menuname,menuimage,mainingredient,price,description,categoryid,regionid)
            VALUES ('$txtmenuid','$txtmenuname','$FileName','$txtmain','$txtprice','$txtdescription','$cbocategory','$cboregion')";
        $result=mysqli_query($connection,$insert);
    }

    if($result) 
    {
        echo "<script>window.alert('Menu Successfully Added!')</script>";
        echo "<script>window.location='menu_detail.php'</script>";
    }
    else
    {
        echo "<p>Something went wrong in Menu Entry : " . mysqli_error($connection) . "</p>";
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
                                <li class="breadcrumb-item active" aria-current="page">Menu Entry</li>
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
                        <form class="form-horizontal" action="menu_entry.php" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6"><h4 class="card-title">Menu</h4></div>
                                    <div class="col-md-6 text-right"><a href="menu_detail.php" class="btn btn-outline-success"><i class="fas fa-list"></i></a></div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="menuid" class="col-sm-3 control-label col-form-label">MenuID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="menuid" name="txtmenuid" value="<?php echo AutoID('menu','menuid','M-',6) ?>" readonly>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="menuname" class="col-sm-3 control-label col-form-label">Menu Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="menuname" placeholder="Menu Name Here" name="txtmenuname" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="menuimage" class="col-sm-3 control-label col-form-label">Menu Image</label>
                                    <div class="col-sm-9">
<!--                                         <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="staffimage" name="txtimage" required>
                                            <label class="custom-file-label" for="staffimage">Choose file...</label>
                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                        </div> -->
                                        <div>
                                            <input type="file" id="menuimage" name="txtimage" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="meat" class="col-sm-3 control-label col-form-label">Main Ingredient</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="meat" placeholder="Main  Here" name="txtmain" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="price" class="col-sm-3 control-label col-form-label">Price</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="price" placeholder="Price Here" name="txtprice" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-3 control-label col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="description" placeholder="Description Here" name="txtdescription" required=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Category</label>
                                    <div class="col-sm-9"> 
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="cbocategory">
                                            <option>--- Choose Category ---</option>
                                            <?php
                                                $query="SELECT * FROM category";
                                                $result=mysqli_query($connection,$query);
                                                $count=mysqli_num_rows($result);

                                                for($i=0;$i<$count;$i++)
                                                {
                                                    $row=mysqli_fetch_array($result);
                                                    $categoryid=$row['categoryid'];
                                                    $category=$row['category'];

                                                    echo "<option value='$categoryid'>$category</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Region</label>
                                    <div class="col-sm-9"> 
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="cboregion">
                                            <option>--- Choose Region ---</option>
                                            <?php
                                                $query="SELECT * FROM region";
                                                $result=mysqli_query($connection,$query);
                                                $count=mysqli_num_rows($result);

                                                for($i=0;$i<$count;$i++)
                                                {
                                                    $row=mysqli_fetch_array($result);
                                                    $regionid=$row['regionid'];
                                                    $region=$row['region'];

                                                    echo "<option value='$regionid'>$region</option>";
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