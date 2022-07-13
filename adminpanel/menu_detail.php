<?php
session_start();
include('admin_header.php');
include('../connect.php');
include('autoid_function.php');

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
                                <li class="breadcrumb-item active" aria-current="page">Menu Detail</li>
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
                                <div class="col-md-6"><h5 class="card-title">Menu Table</h5></div>
                                <div class="col-md-6 text-right"><a href="menu_entry.php" class="btn btn-outline-success"><i class="mdi mdi-plus"></i></a></div>
                            </div>
                            <br>
                            <?php
                            $query="SELECT m.*,c.category as category, r.region as region FROM menu m, category c, region r WHERE m.categoryid=c.categoryid AND m.regionid=r.regionid";
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
                                                <th>ID</th>
                                                <th>Menu Name</th>
                                                <th>Menu Image</th>
                                                <th>Price ($)</th>
                                                <th>Main Ingredient</th>
                                                <th>Category</th>
                                                <th>Region</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for ($i=0; $i < $count ; $i++) { 
                                            $rows=mysqli_fetch_array($result);
                                            $menuid=$rows['menuid'];
                                            $menuname=$rows['menuname'];
                                            $image=$rows['menuimage'];
                                            $price=$rows['price'];
                                            $main=$rows['mainingredient'];
                                            $category=$rows['category'];
                                            $region=$rows['region'];

                                            // $query1="SELECT m.categoryid,c.* FROM menu m, category c WHERE m.categoryid='$categoryid' AND m.categoryid=c.categoryid";
                                            // $result1=mysqli_query($connection,$query1);
                                            // $count1=mysqli_num_rows($result1);

                                            // $query2="SELECT m.regionid,r.* FROM menu m, region r WHERE m.regionid='$regionid' AND m.regionid=r.regionid";
                                            // $result2=mysqli_query($connection,$query2);
                                            // $count2=mysqli_num_rows($result2);                                         
                                            echo "<tr>";
                                            echo "<td>".$menuid."</td>";
                                            echo "<td>".$menuname."</td>";
                                            echo "<td><img src='".$image."' width='100px' class='img-fluid' alt=''></td>";
                                            echo "<td>".$price."</td>";
                                            echo "<td>".$main."</td>";
                                            // for ($a=0; $a < $count1 ; $a++) { 
                                            //     $row1=mysqli_fetch_array($result1);
                                            //     $category=$row1['category'];
                                                echo "<td>".$category."</td>";                     
                                            // }
                                            // for ($a=0; $a < $count2 ; $a++) { 
                                            //     $row2=mysqli_fetch_array($result2);
                                            //     $region=$row2['region'];
                                                echo "<td>".$region."</td>";                     
                                            // }                                            
                                            echo "<td><a href='menu_update.php?menuid=$menuid' class='btn btn-outline-success'><i class='far fa-edit'></i></a>   <a onclick='javascript:confirmationDelete($(this));return false;' href='menu_delete.php?menuid=$menuid' class='btn btn-outline-danger'><i class='far fa-trash-alt'></i></a></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Menu Name</th>
                                            <th>Menu Image</th>
                                            <th>Price ($)</th>
                                            <th>Main Ingredient</th>
                                            <th>Category</th>
                                            <th>Region</th>
                                            <th>Action</th>
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