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
                                <li class="breadcrumb-item active" aria-current="page">VehicleType Detail</li>
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
                                <div class="col-md-6"><h5 class="card-title">VehicleType Table</h5></div>
                                <div class="col-md-6 text-right"><a href="vehicletype_entry.php" class="btn btn-outline-success"><i class="mdi mdi-plus"></i></a></div>
                            </div>
                            <br>
                            <?php
                            $query="SELECT * FROM vehicletype";
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
                                                <th>No.</th>
                                                <th>VehicleType</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for ($i=0; $i < $count ; $i++) { 
                                            $rows=mysqli_fetch_array($result);
                                            $vehicletypeid=$rows['vehicletypeid'];
                                            $vehicletype=$rows['vehicletype'];

                                            echo "<tr>";
                                            echo "<td>".($i+1)."</td>";
                                            echo "<td>".$vehicletype."</td>";
                                            echo "<td><a href='vehicletype_update.php?vehicletypeid=$vehicletypeid' class='btn btn-outline-success'><i class='far fa-edit'></i></a>   <a onclick='javascript:confirmationDelete($(this));return false;' href='vehicletype_delete.php?vehicletypeid=$vehicletypeid' class='btn btn-outline-danger'><i class='far fa-trash-alt'></i></a></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>VehicleType</th>
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