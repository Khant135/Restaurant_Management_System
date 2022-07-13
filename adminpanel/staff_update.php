<?php
session_start();
include('admin_header.php');
include('../connect.php');
include('autoid_function.php');

if (isset($_POST['btnupdate'])) {
    $txtstaffid=$_POST['txtstaffid'];
    $txtstaffname=$_POST['txtstaffname'];
    $txtphonenumber=$_POST['txtphonenumber'];
    $txtdob=$_POST['txtdob'];
    $txtaddress=$_POST['txtaddress'];
    $txtemail=$_POST['txtemail'];
    $txtusername=$_POST['txtusername'];
    $txtpassword=$_POST['txtpassword'];
    $cbostafftype=$_POST['cbostafftype'];
    $oldimage=$_POST['oldimage'];

    //Image Upload-------------------------------------------------------

    if ($_FILES['newimage']['name']) {
        $fileStaffPhoto=$_FILES['newimage']['name']; //Alex.jpg
        $FolderName="staffphoto/"; //StaffPhoto/
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

$update="UPDATE staff SET staffname='$txtstaffname', staffimage='$FileName', phonenumber='$txtphonenumber', dateofbirth='$txtdob', address='$txtaddress', email='$txtemail', username='$txtusername', password='$txtpassword', stafftypeid='$cbostafftype' WHERE staffid='$txtstaffid'";
$result=mysqli_query($connection,$update);

if($result){
    echo "<script>window.alert('Successfully Updated!!')</script>";
    echo "<script>window.location='staff_detail.php'</script>";
}
else{
    echo "<p>Something went wrong in Staff Update : " . mysqli_error($connection) . "</p>";
}
}

if (isset($_GET['staffid'])) {
    $staffid=$_GET['staffid'];
    $query="SELECT * FROM staff WHERE staffid='$staffid'";
    $result=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($result);
}
else{
    $staffid='';
    echo "<script>window.location='staff_detail.php'</script>";
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
                                <li class="breadcrumb-item active" aria-current="page">Staff Update</li>
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
                        <form class="form-horizontal" action="staff_update.php" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6"><h4 class="card-title">Staff</h4></div>
                                    <div class="col-md-6 text-right"><a href="staff_detail.php" class="btn btn-outline-success"><i class="fas fa-list"></i></a></div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="staffname" class="col-sm-3 control-label col-form-label">StaffID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="staffid" name="txtstaffid" value="<?php echo $arr['staffid'] ?>" readonly>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="staffname" class="col-sm-3 control-label col-form-label">Staff Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="staffname" placeholder="Staff Name Here" name="txtstaffname" value="<?php echo $arr['staffname'] ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staffname" class="col-sm-3 control-label col-form-label">Staff Image</label>
                                    <div class="col-sm-9">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                          <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Old Profile</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">New Profile</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <?php
                                        $staffid1=$arr['staffid'];
                                        $query1="SELECT * FROM staff WHERE staffid='$staffid1'";
                                        $result1=mysqli_query($connection,$query1);
                                        $arr1=mysqli_fetch_array($result1);
                                        ?>
                                        <br><img src="<?php echo $arr1['staffimage'] ?>"class="img-fluid" style="width: 120px; height: 120px;">
                                        <input type="hidden" name="oldimage" value="<?php echo $arr1['staffimage'] ?>">
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
                            <label for="staffph" class="col-sm-3 control-label col-form-label">Staff PhoneNumber</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="staffph" placeholder="Staff PhoneNumber Here" name="txtphonenumber" value="<?php echo $arr['phonenumber'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="datepicker-autoclose" class="col-sm-3 control-label col-form-label">Date of Birth</label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" id="datepicker-autoclose" placeholder="mm/dd/yyyy" name="txtdob" value="<?php echo $arr['dateofbirth'] ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 control-label col-form-label">Staff Address</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="address" placeholder="Staff Address Here" name="txtaddress"><?php echo $arr["address"] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 control-label col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" placeholder="Staff Email Here" name="txtemail" value="<?php echo $arr['email'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-3 control-label col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="username" placeholder="Username Here" name="txtusername" value="<?php echo $arr['username'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 control-label col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" placeholder="Password Here" name="txtpassword" value="<?php echo $arr['password'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label col-form-label">StaffType</label>
                            <div class="col-sm-9"> 
                                <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="cbostafftype">
                                    <option>--- Choose StaffType ---</option>
                                    <?php
                                    $query="SELECT * FROM stafftype";
                                    $result=mysqli_query($connection,$query);
                                    $count=mysqli_num_rows($result);

                                    for($i=0;$i<$count;$i++)
                                    {
                                        $row=mysqli_fetch_array($result);
                                        $stafftypeid=$row['stafftypeid'];
                                        $stafftype=$row['stafftype'];

                                                    // echo "<option value='$stafftypeid'>$stafftype</option>";

                                        ?>
                                        <option value="<?= $stafftypeid?>"
                                            <?php
                                            if ($arr['stafftypeid']==$stafftypeid) {
                                                echo "selected";
                                            }
                                            ?>
                                            >
                                            <?php echo $stafftype ?>
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