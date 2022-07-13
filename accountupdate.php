<?php
include('connect.php');
include('autoid_function.php');

if (isset($_POST['btnsave'])) {
    $txtcustomerid=$_POST['txtcustomerid'];
    $txtcustomername=$_POST['txtcustomername'];
    $txtusername=$_POST['txtusername'];
    $txtpassword=$_POST['txtpassword'];
    $txtemail=$_POST['txtemail'];
    $txtphonenumber=$_POST['txtphonenumber'];
    $oldimage=$_POST['oldimage'];

    //Image Upload-------------------------------------------------------

    if ($_FILES['newimage']['name']) {
        $fileStaffPhoto=$_FILES['newimage']['name']; //Alex.jpg
        $FolderName="customerphoto/"; //StaffPhoto/
        $FileName=$FolderName . '_' . $fileStaffPhoto;  //StaffPhoto/_Alex.jpg

        $copied=copy($_FILES['newimage']['tmp_name'], $FileName);

        if(!$copied) 
        {
            echo "<p>Customer Photo Cannot Upload!</p>";
            exit();
        }
    }
    else{
        $FileName=$oldimage;
    }

    $update="UPDATE customer SET username='$txtusername', image='$FileName', password='$txtpassword', customername='$txtcustomername', email='$txtemail', phonenumber='$txtphonenumber' WHERE customerid='$txtcustomerid'";
    $result=mysqli_query($connection,$update);

    if($result){
        echo "<script>window.alert('Account Successfully Updated!!')</script>";
        echo "<script>window.location='index.php'</script>";
    }
    else{
        echo "<p>Something went wrong in Account Update : " . mysqli_error($connection) . "</p>";
    }
}

if (isset($_GET['userid'])) {
    $userid=$_GET['userid'];
    $query="SELECT * FROM customer WHERE customerid='$userid'";
    $result=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($result);
}
else{
    $userid='';
    // echo "<script>window.alert('Please login first!')</script>";
    echo "<script>window.location='index.php'</script>";
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
<script type="text/javascript">
    function Old()
    {
        document.getElementById('New').style.display="none";
        document.getElementById('Old').style.display="block";
    }
    function New()
    {
        document.getElementById('Old').style.display="none";
        document.getElementById('New').style.display="block";
    }
</script>
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
        				<h1 style="color: white;">Customer Account Update</h1>
        			</div>
        			<!-- Form -->
        			<form class="form-horizontal m-t-20" action="accountupdate.php" method="post" enctype="multipart/form-data">
        				<div class="row p-b-30">
        					<div class="col-12">
        						<input type="hidden" class="form-control form-control-lg"  name="txtcustomerid" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo $arr['customerid'] ?>" required>
        						<div class="input-group mb-3">
        							<div class="input-group-prepend">
        								<span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
        							</div>
        							<input type="text" class="form-control form-control-lg" placeholder="Real Name" name="txtcustomername" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo $arr['customername'] ?>" required>
        						</div>
                                <div class="input-group mb-3">
                                    <input type="radio" name="rdoimage" onClick="Old()" checked> <span class="text-warning m-l-10" style="font-size: 15px;">Old Image</span> <span style="color: transparent;">12345</span>
                                    <input type="radio" name="rdoimage" onClick="New()"> <span class="text-success m-l-10" style="font-size: 15px;">New Image</span>
                                </div>
                                <div id="Old">
                                    <div class="input-group mb-3">
                                        <input type="hidden" value="<?php echo $arr['image'] ?>" name="oldimage">
                                        <img src="<?php echo $arr['image'] ?>"class="img-fluid" style="width: 120px; height: 120px;">
                                    </div>
                                </div>
                                <div id="New" style="display: none;">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="fas fa-user-circle"></i></span>
                                    </div>
                                    <input type="file" class="form-control form-control-lg" name="newimage" aria-label="Image" aria-describedby="basic-addon1">
                                </div>
                            </div>                           	
                            <div class="input-group mb-3">
                             <div class="input-group-prepend">
                                <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="mdi mdi-account-plus"></i></span>
                            </div>
                            <input type="text" class="form-control form-control-lg" placeholder="Username" value="<?php echo $arr['username'] ?>" aria-label="Username" aria-describedby="basic-addon1" name="txtusername" required>
                        </div>
                        <div class="input-group mb-3">
                         <div class="input-group-prepend">
                            <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                        </div>
                        <input type="password" class="form-control form-control-lg" placeholder="Password" name="txtpassword" value="<?php echo $arr['password'] ?>" aria-label="Password" aria-describedby="basic-addon1" required>
                    </div>
                    <!-- email -->
                    <div class="input-group mb-3">
                     <div class="input-group-prepend">
                        <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                    </div>
                    <input type="email" class="form-control form-control-lg" placeholder="Email Address" name="txtemail" value="<?php echo $arr['email'] ?>" aria-label="Username" aria-describedby="basic-addon1" required>
                </div>                                
                <div class="input-group mb-3">
                 <div class="input-group-prepend">
                    <span class="input-group-text bg-info text-white" id="basic-addon2"><i class="mdi mdi-phone-classic"></i></span>
                </div>
                <input type="number" class="form-control form-control-lg" placeholder=" Phone Number" name="txtphonenumber" value="<?php echo $arr['phonenumber'] ?>" aria-label="Phone Number" aria-describedby="basic-addon1" required>
            </div>
        </div>
    </div>
    <div class="row border-top border-secondary">
       <div class="col-6">
          <div class="form-group">
             <div class="p-t-20">
                <a href="index.php"class="btn btn-block btn-lg btn-danger" name="btncancel">Back</a>
            </div>
        </div>
    </div>
    <div class="col-6">
      <div class="form-group">
         <div class="p-t-20">
            <input class="btn btn-block btn-lg btn-info" type="submit" name="btnsave" value="Save">
        </div>
    </div>
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