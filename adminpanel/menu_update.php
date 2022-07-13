<?php
session_start();
include('admin_header.php');
include('../connect.php');
include('autoid_function.php');

if (isset($_POST['btnupdate'])) {
    $txtmenuid=$_POST['txtmenuid'];
    $txtmenuname=$_POST['txtmenuname'];
    $txtmain=$_POST['txtmain'];
    $txtprice=$_POST['txtprice'];
    $txtdescription=$_POST['txtdescription'];
    $cbocategory=$_POST['cbocategory'];
    $cboregion=$_POST['cboregion'];
    $oldimage=$_POST['oldimage'];

    //Image Upload-------------------------------------------------------

    if ($_FILES['newimage']['name']) {
        $fileStaffPhoto=$_FILES['newimage']['name']; //Alex.jpg
        $FolderName="menuphoto/"; //StaffPhoto/
        $FileName=$FolderName . '_' . $fileStaffPhoto;  //StaffPhoto/_Alex.jpg

        $copied=copy($_FILES['newimage']['tmp_name'], $FileName);

        if(!$copied) 
        {
            echo "<p>Staff Photo Cannot Upload!</p>";
            exit();
        }
    }
    else{
        $FileName=$oldimage;
    }
    // $fileStaffPhoto=$_FILES['txtimage']['name']; //Alex.jpg
    // $FolderName="staffphoto/"; //StaffPhoto/
    // $FileName=$FolderName . '_' . $fileStaffPhoto;  //StaffPhoto/_Alex.jpg

    // $copied=copy($_FILES['txtimage']['tmp_name'], $FileName);

    // if(!$copied) 
    // {
    //     echo "<p>Staff Photo Cannot Upload!</p>";
    //     exit();
    // }
    // echo "<script>window.alert('$cbocategory')</script>";
    // echo "<script>window.alert('$cboregion')</script>";    

$update="UPDATE menu SET menuname='$txtmenuname', menuimage='$FileName', mainingredient='$txtmain', price='$txtprice', description='$txtdescription', categoryid='$cbocategory', regionid='$cboregion'  WHERE menuid='$txtmenuid'";
$result=mysqli_query($connection,$update);

if($result){
    echo "<script>window.alert('Successfully Updated!!')</script>";
    echo "<script>window.location='menu_detail.php'</script>";
}
else{
    echo "<p>Something went wrong in Menu Update : " . mysqli_error($connection) . "</p>";
}
}

if (isset($_GET['menuid'])) {
    $menuid=$_GET['menuid'];
    $query="SELECT * FROM menu WHERE menuid='$menuid'";
    $result=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($result);
}
else{
    $menuid='';
    echo "<script>window.location='menu_detail.php'</script>";
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
                                <li class="breadcrumb-item active" aria-current="page">Menu Update</li>
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
                        <form class="form-horizontal" action="menu_update.php" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6"><h4 class="card-title">Menu</h4></div>
                                    <div class="col-md-6 text-right"><a href="menu_detail.php" class="btn btn-outline-success"><i class="fas fa-list"></i></a></div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="menuid" class="col-sm-3 control-label col-form-label">MenuID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="menuid" name="txtmenuid" value="<?php echo $arr['menuid'] ?>" readonly>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="menuname" class="col-sm-3 control-label col-form-label">Menu Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="menuname" placeholder="Menu Name Here" name="txtmenuname" value="<?php echo $arr['menuname'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="menuimage" class="col-sm-3 control-label col-form-label">Menu Image</label>
                                    <div class="col-sm-9">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                          <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Old Menu Photo</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">New Menu Photo</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <?php
                                        $menuid1=$arr['menuid'];
                                        $query1="SELECT * FROM menu WHERE menuid='$menuid1'";
                                        $result1=mysqli_query($connection,$query1);
                                        $arr1=mysqli_fetch_array($result1);
                                        ?>
                                        <br><img src="<?php echo $arr1['menuimage'] ?>"class="img-fluid" style="width: 120px; height: 120px;">
                                        <input type="hidden" name="oldimage" value="<?php echo $arr1['menuimage'] ?>">
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <br><input type="file" name="newimage">
                                    </div>
                                </div>                                                                           
                            </div>
                        </div>

<!--                         <div class="form-group row">
                            <label for="staffimage" class="col-sm-3 control-label col-form-label">Staff Image</label>
                            <div class="col-sm-9">
                                <div>
                                    <input type="file" id="staffimage" name="txtimage" required>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label for="meat" class="col-sm-3 control-label col-form-label">Main Ingredient</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="meat" placeholder="Main Ingredient Here" name="txtmain" value="<?php echo $arr['mainingredient'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 control-label col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="price" placeholder="Price Here" name="txtprice" value="<?php echo $arr['price'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-3 control-label col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="description" placeholder="Description Here" name="txtdescription"><?php echo $arr["description"] ?></textarea>
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

                                                    // echo "<option value='$stafftypeid'>$stafftype</option>";
                                        ?>
                                        <option value="<?= $categoryid?>"
                                            <?php
                                            if ($arr['categoryid']==$categoryid) {
                                                echo "selected";
                                            }
                                            ?>
                                            >
                                            <?php echo $category ?>
                                        </option>
                                    <?php } ?>
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

                                                    // echo "<option value='$stafftypeid'>$stafftype</option>";

                                        ?>
                                        <option value="<?= $regionid?>"
                                            <?php
                                            if ($arr['regionid']==$regionid) {
                                                echo "selected";
                                            }
                                            ?>
                                            >
                                            <?php echo $region ?>
                                        </option>
                                    <?php } ?>
                                </select>
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