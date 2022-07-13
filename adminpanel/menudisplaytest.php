<?php
session_start();
include('../connect.php');
include('admin_header.php');


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
                    <h4 class="page-title">Menu List</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Menu Order</li>
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
<!--         <form action="menudisplay.php" method="post">
            <div class="row">
                <div class="col-12 text-right">
                    <label>Seach By: </label>
                    <input type="search" name="txtsearch">
                    <input type="submit" name="btnsearch" value="Search">
                </div>
            </div>
        </form> -->
        <form action="menudisplaytest.php" method="post">
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row el-element-overlay">
                    <?php
                    $select="SELECT * FROM menu";
                    $query=mysqli_query($connection,$select);
                    $count=mysqli_num_rows($query);
                    if ($count<0) {
                        echo "<p>No Record Found!!</p>";
                    }
                    else{
                        for ($i=0; $i < $count ; $i++) { 
                            $rows=mysqli_fetch_array($query);
                            $menuid=$rows['menuid'];
                            $image=$rows['menuimage'];
                            $name=$rows['menuname'];
                            $price=$rows['price'];
                            ?>
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="el-card-item">
                                        <div class="el-card-avatar el-overlay-1"> <img src="<?php echo $image ?>" class="img-fluid" style="height: 250px;" alt="user" />
                                            <div class="el-overlay">
                                                <ul class="list-style-none el-info">
                                                    <li class="el-item"><a class="btn default btn-outline image-popup-vertical-fit el-link" href="<?php echo $image ?>"><i class="mdi mdi-magnify-plus"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="el-card-content">
                                            <h4 class="m-b-0"><?php echo $name ?></h4> <span class="text-muted"><?php echo $price ?> Ks</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>

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
        </form>

    </body>
    </html>
    <?php
    include('admin_footer.php');
    ?>