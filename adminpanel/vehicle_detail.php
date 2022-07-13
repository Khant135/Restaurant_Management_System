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
                                <li class="breadcrumb-item active" aria-current="page">Vehicle Detail</li>
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
                                <div class="col-md-6"><h5 class="card-title">Vehicle List</h5></div>
                                <div class="col-md-6 text-right"><a href="vehicle_entry.php" class="btn btn-outline-success"><i class="mdi mdi-plus"></i></a></div>
                            </div>
                            <br>
                            <?php
                            $query="SELECT v.*,vt.vehicletype as vehicletype FROM vehicle v, vehicletype vt WHERE v.vehicletypeid=vt.vehicletypeid";
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
                                                <th>Vehicle Brand</th>
                                                <th>Vehicle Model</th>
                                                <th>Status</th>
                                                <th>Vehicle Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for ($i=0; $i < $count ; $i++) { 
                                            $rows=mysqli_fetch_array($result);
                                            $vehicleid=$rows['vehicleid'];
                                            $vehiclebrand=$rows['vehiclebrand'];
                                            $model=$rows['model'];
                                            $status=$rows['status'];
                                            $vehicletype=$rows['vehicletype'];

                                            // $query1="SELECT s.stafftypeid,st.* FROM staff s, stafftype st WHERE s.stafftypeid='$stafftypeid' AND s.stafftypeid=st.stafftypeid";
                                            // $result1=mysqli_query($connection,$query1);
                                            // $count1=mysqli_num_rows($result1);

                                            echo "<tr>";
                                            echo "<td>".$vehicleid."</td>";
                                            echo "<td>".$vehiclebrand."</td>";
                                            echo "<td>".$model."</td>";
                                            echo "<td>".$status."</td>";
                                            echo "<td>".$vehicletype."</td>";

                                            echo "<td><a href='vehicle_update.php?vehicleid=$vehicleid' class='btn btn-outline-success'><i class='far fa-edit'></i></a>   <a onclick='javascript:confirmationDelete($(this));return false;' href='vehicle_delete.php?vehicleid=$vehicleid' class='btn btn-outline-danger'><i class='far fa-trash-alt'></i></a></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Vehicle Brand</th>
                                            <th>Vehicle Model</th>
                                            <th>Status</th>
                                            <th>Vehicle Type</th>
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