<?php
session_start();
include('admin_header.php');
include('../connect.php');

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
<!--                     <h4 class="page-title">Form Basic</h4> -->
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Customer List</li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6"><h5 class="card-title">Customer List</h5></div>
                            </div>
                            <br>
                            <?php
                            $query="SELECT * FROM customer";
                            $result=mysqli_query($connection,$query);
                            $count=mysqli_num_rows($result);

                            if ($count<0) {
                                echo "<p>No Record Found!!</p>";
                            }
                            else{
                                ?>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>CustomerID</th>
                                                <th>Username</th>
                                                <th>UserImage</th>
                                                <th>Password</th>
                                                <th>CustomerName</th>
                                                <th>Email</th>
                                                <th>PhoneNumber</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for ($i=0; $i < $count ; $i++) { 
                                            $rows=mysqli_fetch_array($result);
                                            $customerid=$rows['customerid'];
                                            $username=$rows['username'];
                                            $password=$rows['password'];
                                            $customername=$rows['customername'];
                                            $email=$rows['email'];
                                            $phone=$rows['phonenumber'];
                                            $image=$rows['image'];

                                            echo "<tr>";
                                            echo "<td>".$customerid."</td>";
                                            echo "<td>".$username."</td>";
                                            echo "<td><img src='../".$image."' width='100px' class='img-fluid' alt=''></td>";
                                            echo "<td>".$password."</td>";
                                            echo "<td>".$customername."</td>";
                                            echo "<td>".$email."</td>";
                                            echo "<td>".$phone."</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                                <th>CustomerID</th>
                                                <th>Username</th>
                                                <th>Image</th>
                                                <th>Password</th>
                                                <th>CustomerName</th>
                                                <th>Email</th>
                                                <th>PhoneNumber</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <?php                                    
                        }
                        ?>
                    </div>
                </div>
            </div>
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