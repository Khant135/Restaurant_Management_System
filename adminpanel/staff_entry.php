<?php
session_start();
include('../connect.php');
include('admin_header.php');
include('autoid_function.php');

if (isset($_POST['btnsave'])) {
    $txtstaffid=$_POST['txtstaffid'];
    $txtstaffname=$_POST['txtstaffname'];
    $txtphonenumber=$_POST['txtphonenumber'];
    $txtdob=$_POST['txtdob'];
    $txtaddress=$_POST['txtaddress'];
    $txtemail=$_POST['txtemail'];
    $txtusername=$_POST['txtusername'];
    $txtpassword=$_POST['txtpassword'];
    $cbostafftype=$_POST['cbostafftype'];

    //Image Upload-------------------------------------------------------
    $fileStaffPhoto=$_FILES['txtimage']['name']; //Alex.jpg
    $FolderName="staffphoto/"; //StaffPhoto/
    $FileName=$FolderName . '_' . $fileStaffPhoto;  //StaffPhoto/_Alex.jpg

    $copied=copy($_FILES['txtimage']['tmp_name'], $FileName);

    if(!$copied) 
    {
        echo "<p>Staff Photo Cannot Upload!</p>";
        exit();
    }

    $check="SELECT * FROM staff WHERE email='$txtemail'";
    $result=mysqli_query($connection,$check);
    $count=mysqli_num_rows($result);

    if($count>0){
        echo "<script>window.alert('Email Address Already Exist!')</script>";
        echo "<script>window.location='staff_entry.php'</script>";
    }
    else{
        $insert="INSERT INTO staff(staffid,staffname,staffimage,phonenumber,dateofbirth,address,email,username,password,stafftypeid)
            VALUES ('$txtstaffid','$txtstaffname','$FileName','$txtphonenumber','$txtdob','$txtaddress','$txtemail','$txtusername','$txtpassword','$cbostafftype')";
        $result=mysqli_query($connection,$insert);
    }

    if($result) 
    {
        echo "<script>window.alert('Staff Successfully Added!')</script>";
        echo "<script>window.location='staff_detail.php'</script>";
    }
    else
    {
        echo "<p>Something went wrong in Staff Entry : " . mysqli_error($connection) . "</p>";
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
                                <li class="breadcrumb-item active" aria-current="page">Staff Entry</li>
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
                        <form class="form-horizontal" action="staff_entry.php" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6"><h4 class="card-title">Staff</h4></div>
                                    <div class="col-md-6 text-right"><a href="staff_detail.php" class="btn btn-outline-success"><i class="fas fa-list"></i></a></div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="staffname" class="col-sm-3 control-label col-form-label">StaffID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="staffid" name="txtstaffid" value="<?php echo AutoID('staff','staffid','S-',6) ?>" readonly>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="staffname" class="col-sm-3 control-label col-form-label">Staff Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="staffname" placeholder="Staff Name Here" name="txtstaffname" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staffimage" class="col-sm-3 control-label col-form-label">Staff Image</label>
                                    <div class="col-sm-9">
<!--                                         <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="staffimage" name="txtimage" required>
                                            <label class="custom-file-label" for="staffimage">Choose file...</label>
                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                        </div> -->
                                        <div>
                                            <input type="file" id="staffimage" name="txtimage" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staffph" class="col-sm-3 control-label col-form-label">Staff PhoneNumber</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="staffph" placeholder="Staff PhoneNumber Here" name="txtphonenumber" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="datepicker-autoclose" class="col-sm-3 control-label col-form-label">Date of Birth</label>
                                    <div class="input-group col-sm-9">
                                        <input type="text" class="form-control" id="datepicker-autoclose" placeholder="mm/dd/yyyy" name="txtdob" required="">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 control-label col-form-label">Staff Address</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="address" placeholder="Staff Address Here" name="txtaddress" required=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 control-label col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" placeholder="Staff Email Here" name="txtemail" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 control-label col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="username" placeholder="Username Here" name="txtusername" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-3 control-label col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password" placeholder="Password Here" name="txtpassword" required="">
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

                                                    echo "<option value='$stafftypeid'>$stafftype</option>";
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