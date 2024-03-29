<?php
include('connect.php');
include('autoid_function.php');

if (isset($_POST['btnsignup'])) {
    $txtcustomerid=$_POST['txtcustomerid'];
    $txtcustomername=$_POST['txtcustomername'];
    $txtusername=$_POST['txtusername'];
    $txtpassword=$_POST['txtpassword'];
    $txtemail=$_POST['txtemail'];
    $txtphonenumber=$_POST['txtphonenumber'];

    //Image Upload-------------------------------------------------------
    $fileStaffPhoto=$_FILES['txtimage']['name']; //Alex.jpg
    $FolderName="customerphoto/"; //StaffPhoto/
    $FileName=$FolderName . '_' . $fileStaffPhoto;  //StaffPhoto/_Alex.jpg

    $copied=copy($_FILES['txtimage']['tmp_name'], $FileName);

    if(!$copied) 
    {
        echo "<p>Staff Photo Cannot Upload!</p>";
        exit();
    }

    $check="SELECT * FROM customer WHERE email='$txtemail'";
    $result=mysqli_query($connection,$check);
    $count=mysqli_num_rows($result);

    if ($count>0) {
        echo "<script>window.alert('Email already Exists!!')</script>";
        echo "<script>window.location='customerregister.php'</script>";
    }
    else{
        $insert="INSERT INTO customer (customerid,username,image,password,customername,email,phonenumber)
        VALUES ('$txtcustomerid','$txtusername','$FileName','$txtpassword','$txtcustomername','$txtemail','$txtphonenumber')";
        $result=mysqli_query($connection,$insert);
    }
    if ($result) {
        echo "<script>window.alert('Customer Registeration Successful!!')</script>";
        echo "<script>window.location='customerlogin.php'</script>";
    }
    else{
        echo "<p>Something went wrong in Customer Registeration: ".msqli_error($connection)."</p>";
    }
}

?>
<!DOCTYPE html>
<html dir="ltr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="adminpanel/assets/images/favicon.png">
	<title>Matrix Template - The Ultimate Multipurpose admin template</title>
	<!-- Custom CSS -->
	<link href="adminpanel/dist/css/style.min.css" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
	<div class="main-wrapper">
		<!-- ============================================================== -->
		<!-- Preloader - style you can find in spinners.css -->
		<!-- ============================================================== -->
<!--         <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div> -->
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
        	<div class="auth-box bg-dark border-top border-secondary">
        		<div>
        			<div class="text-center p-t-20 p-b-20">
        				<h1 style="color: white;">Customer Registration</h1>
        			</div>
        			<!-- Form -->
        			<form class="form-horizontal m-t-20" action="customerregister.php" method="post" enctype="multipart/form-data">
        				<div class="row p-b-30">
        					<div class="col-12">
        						<input type="hidden" class="form-control form-control-lg"  name="txtcustomerid" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo AutoID('customer','customerid','CU-',6) ?>" required>
        						<div class="input-group mb-3">
        							<div class="input-group-prepend">
        								<span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
        							</div>
        							<input type="text" class="form-control form-control-lg" placeholder="Real Name" name="txtcustomername" aria-label="Username" aria-describedby="basic-addon1" required>
        						</div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="fas fa-user-circle"></i></span>
                                    </div>
                                    <input type="file" class="form-control form-control-lg" name="txtimage" aria-label="Image" aria-describedby="basic-addon1" required>
                                </div>                            	
        						<div class="input-group mb-3">
        							<div class="input-group-prepend">
        								<span class="input-group-text bg-success text-white" id="basic-addon1"><i class="mdi mdi-account-plus"></i></span>
        							</div>
        							<input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="txtusername" required>
        						</div>
        						<div class="input-group mb-3">
        							<div class="input-group-prepend">
        								<span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
        							</div>
        							<input type="password" class="form-control form-control-lg" placeholder="Password" name="txtpassword" aria-label="Password" aria-describedby="basic-addon1" required>
        						</div>
        						<!-- email -->
        						<div class="input-group mb-3">
        							<div class="input-group-prepend">
        								<span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
        							</div>
        							<input type="email" class="form-control form-control-lg" placeholder="Email Address" name="txtemail" aria-label="Username" aria-describedby="basic-addon1" required>
        						</div>                                
        						<div class="input-group mb-3">
        							<div class="input-group-prepend">
        								<span class="input-group-text bg-info text-white" id="basic-addon2"><i class="mdi mdi-phone-classic"></i></span>
        							</div>
        							<input type="number" class="form-control form-control-lg" placeholder=" Phone Number" name="txtphonenumber" aria-label="Phone Number" aria-describedby="basic-addon1" required>
        						</div>
        					</div>
        				</div>
        				<div class="row border-top border-secondary">
        					<div class="col-6">
        						<div class="form-group">
        							<div class="p-t-20">
<!--         								<input class="btn btn-block btn-lg btn-danger" type="submit" name="btncancel" value="Cancel"> -->
										<a href="index.php"class="btn btn-block btn-lg btn-danger" name="btncancel">Home</a>
        							</div>
        						</div>
        					</div>
        					<div class="col-6">
        						<div class="form-group">
        							<div class="p-t-20">
        								<input class="btn btn-block btn-lg btn-info" type="submit" name="btnsignup" value="Sign Up">
        							</div>
        						</div>
        					</div>
        				</div>
        				<div class="row">
        					<div class="col-12">
        						<p style="color: white;">Already have an account, <a href="customerlogin.php" style="">Click Here!!</a></p>
        					</div>
        				</div>
        			</form>
        		</div>
        	</div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="adminpanel/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="adminpanel/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="adminpanel/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    	$('[data-toggle="tooltip"]').tooltip();
    	$(".preloader").fadeOut();
    </script>
</body>

</html>