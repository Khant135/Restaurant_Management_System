<?php
session_start();
include('connect.php');

if (isset($_POST['btnlogin'])) {
    $txtemail=$_POST['txtemail'];
    $txtpassword=$_POST['txtpassword'];

    $query="SELECT * FROM customer WHERE email='$txtemail' AND password='$txtpassword'";
    $result=mysqli_query($connection,$query);
    $count=mysqli_num_rows($result);
    $arr=mysqli_fetch_array($result);

    if ($count<1) {
        echo "<script>window.alert('Email or Password Incorrect')</script>";
        echo "<script>window.location='customerlogin.php'</script>";
    }
    else{
        $_SESSION['customerid']=$arr['customerid'];
        $_SESSION['username']=$arr['username'];
        $_SESSION['email']=$arr['email'];
        $_SESSION['customername']=$arr['customername'];
        $customername=$arr['customername'];

        echo "<script>window.alert('Welcome to Morning Restaurant ".$customername."')</script>";
        echo "<script>window.location='index.php'</script>";
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
                <div id="loginform">
                    <div class="text-center p-t-20 p-b-20">
                        <h1 style="color: white;">Customer Login</h1>
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal m-t-20" id="loginform" action="customerlogin.php" method="post">
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" name="txtemail" required="">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="txtpassword" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-8">
                                <br>
                                <a href="passwordreset.php" class="btn btn-info"><i class="fa fa-lock m-r-5"></i> Lost password?</a>
                                <p style="color: white;" class="mt-1">Don't have an account, <a href="customerregister.php" class="text-success">Click Here!!</a>
                                    <!-- Forgot Password, <a href="passwordreset.php" class="text-warning">Click Here!!</a> -->  
                                </p>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <input class="btn btn-success float-right" type="submit" name="btnlogin" value="Login">
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
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    // $('#to-recover').on("click", function() {
    //     $("#loginform").slideUp();
    //     $("#recoverform").fadeIn();
    // });
    // $('#to-login').click(function(){

    //     $("#recoverform").hide();
    //     $("#loginform").fadeIn();
    // });
</script>

</body>

</html>
