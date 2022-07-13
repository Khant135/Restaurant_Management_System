<?php
session_start();
include('../connect.php');
include('admin_header.php');
include('menuorderfunction.php');

if (isset($_POST['btnadd'])) {
    $menuid=$_GET['id'];
    $quantity=$_POST['txtquantity'];
    // echo "<script>window.alert('$menuid')</script>";
    // echo "<script>window.alert('$quantity')</script>";
    AddMenu($menuid,$quantity);
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

        <div class="container-fluid">
            <form action="menudisplay.php" method="post">
                <div class="row">
                    <div class="col-6 text-left">
                        <label>Sort By: </label>
                        <select name="cbocategory">
                            <option>Choose Category</option>
                            <?php
                            $fquery="SELECT * FROM category";
                            $fresult=mysqli_query($connection,$fquery);
                            $fcount=mysqli_num_rows($fresult);
                            for ($i=0; $i < $fcount ; $i++) { 
                                $frows=mysqli_fetch_array($fresult);
                                $categoryid=$frows['categoryid'];
                                $category=$frows['category'];
                                ?>
                                <option value="<?= $categoryid?>"><?php echo $category; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <input type="submit" name="btnfilter" class="btn btn-primary" value="Filter">
                    </div>                
                    <div class="col-6 text-right">
                        <label>Seach By: </label>
                        <input type="search" placeholder="Menu Name" name="txtsearch">
                        <input type="submit" name="btnsearch" class="btn btn-primary" value="Search">
                    </div>
                </div>
                <br>
            </form>
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row el-element-overlay">
                    <?php
                    if (isset($_POST['btnfilter'])) {
                        $cbocategory=$_POST['cbocategory'];
                        $select2="SELECT * FROM menu WHERE categoryid='$cbocategory'";
                        $result2=mysqli_query($connection,$select2);
                        $count2=mysqli_num_rows($result2);
                        if ($count2<0) {
                            echo "<p>No Record Found!!</p>";
                        }
                        else{
                            for ($i=0; $i < $count2 ; $i++) { 
                                $rows2=mysqli_fetch_array($result2);
                                $menuid=$rows2['menuid'];
                                $image=$rows2['menuimage'];
                                $name=$rows2['menuname'];
                                $price=$rows2['price'];
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
                                                <h4 class="m-b-0"><?php echo $name ?></h4> <span style="color: red;"><?php echo $price ?> $</span>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <form action="menudisplay.php?action=add&id=<?php echo $menuid ?>" method="post">
<!--                                                         <a href="menudetail.php?menuid=<?php echo $menuid ?>">Detail</a> -->
                                                        <input type="number" name="txtquantity" placeholder="Quantity" value="1"> <input type="submit" name="btnadd" class="btn btn-primary" value="Add">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }

                    }
                    else if (isset($_POST['btnsearch'])) {
                        $txtsearch=$_POST['txtsearch'];
                    // echo "<script>window.alert('Hello')</script>";

                        $select1="SELECT * FROM menu WHERE menuname LIKE '%$txtsearch%'";
                        $result1=mysqli_query($connection,$select1);
                        $count1=mysqli_num_rows($result1);
                        if ($count1<0) {
                            echo "<p>No Record Found!!</p>";
                        }
                        else{
                            for ($i=0; $i < $count1 ; $i++) { 
                                $rows1=mysqli_fetch_array($result1);
                                $menuid=$rows1['menuid'];
                                $image=$rows1['menuimage'];
                                $name=$rows1['menuname'];
                                $price=$rows1['price'];
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
                                                <h4 class="m-b-0"><?php echo $name ?></h4> <span style="color: red;"><?php echo $price ?> $</span>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <form action="menudisplay.php?action=add&id=<?php echo $menuid ?>" method="post">
<!--                                                         <a href="menudetail.php?menuid=<?php echo $menuid ?>">Detail</a> -->
                                                        <input type="number" name="txtquantity" placeholder="Quantity" value="1"> <input type="submit" name="btnadd" class="btn btn-primary" value="Add">
                                                        </form>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }
                    else{
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
                                                <h4 class="m-b-0"><?php echo $name ?></h4> <span style="color: red;"><?php echo $price ?> $</span>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <form action="menudisplay.php?action=add&id=<?php echo $menuid ?>" method="post">
 <!--                                                        <a href="menudetail.php?menuid=<?php echo $menuid ?>">Detail</a> -->
                                                        <input type="number" name="txtquantity" placeholder="Quantity" value="1"> <input type="submit" name="btnadd" class="btn btn-primary" value="Add">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
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
<!--             </form> -->
        </div>

    </body>
    </html>
    <?php
    include('admin_footer.php');
    ?>