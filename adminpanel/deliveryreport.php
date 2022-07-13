<?php
session_start();
include('admin_header.php');
include('../connect.php');

if (isset($_POST['btnsearch'])) {
    $rdosearch=$_POST['rdosearch'];
    if ($rdosearch==1) {
        $txtdate=$_POST['txtdate'];
        $query="SELECT DISTINCT ds.deliveryscheduleid,s.staffname as staffname, COUNT(DISTINCT co.orderid) as deliverycount, SUM(co.grandtotal) as grandtotal FROM customerorder co,deliveryschedule ds,staff s WHERE co.deliveryscheduleid=ds.deliveryscheduleid AND ds.staffid=s.staffid AND co.orderdate='$txtdate' GROUP BY ds.deliveryscheduleid";
        $result=mysqli_query($connection,$query);
        // echo "<script>window.alert('$cbopstatus')</script>";
    }
    else if ($rdosearch==2) {
        $cbostaff=$_POST['cbostaff'];
        $txtdate1=$_POST['txtdate1'];
        $query="SELECT DISTINCT ds.deliveryscheduleid,s.staffname as staffname, COUNT(DISTINCT co.orderid) as deliverycount, SUM(co.grandtotal) as grandtotal FROM customerorder co,deliveryschedule ds,staff s WHERE co.deliveryscheduleid=ds.deliveryscheduleid AND ds.staffid=s.staffid AND s.staffid='$cbostaff' AND co.orderdate='$txtdate1' GROUP BY ds.deliveryscheduleid";
        $result=mysqli_query($connection,$query);
        // echo "<script>window.alert('$cbodstatus')</script>";
    }
}
else{
    $query="SELECT DISTINCT ds.deliveryscheduleid,s.staffname as staffname, COUNT(DISTINCT co.orderid) as deliverycount, SUM(co.grandtotal) as grandtotal FROM customerorder co,deliveryschedule ds,staff s WHERE co.deliveryscheduleid=ds.deliveryscheduleid AND ds.staffid=s.staffid GROUP BY ds.deliveryscheduleid";
    $result=mysqli_query($connection,$query);
}

if (isset($_POST['btnall'])) {
    $query="SELECT DISTINCT ds.deliveryscheduleid,s.staffname as staffname, COUNT(DISTINCT co.orderid) as deliverycount, SUM(co.grandtotal) as grandtotal FROM customerorder co,deliveryschedule ds,staff s WHERE co.deliveryscheduleid=ds.deliveryscheduleid AND ds.staffid=s.staffid GROUP BY ds.deliveryscheduleid";
    $result=mysqli_query($connection,$query);
}

if (isset($_POST['btntdy'])) {
    $tdydate=date("Y-m-d");
    $query="SELECT DISTINCT ds.deliveryscheduleid,s.staffname as staffname, COUNT(DISTINCT co.orderid) as deliverycount, SUM(co.grandtotal) as grandtotal FROM customerorder co,deliveryschedule ds,staff s WHERE co.deliveryscheduleid=ds.deliveryscheduleid AND ds.staffid=s.staffid AND co.orderdate='$tdydate' GROUP BY ds.deliveryscheduleid";
    $result=mysqli_query($connection,$query);
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
                    <!--                     <h4 class="page-title">Form Basic</h4> -->
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Delivery Report</li>
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
                    <form action="deliveryreport.php" method="post">
                        <div class="card border border-secondary rounded">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12"><h5 class="card-title">Search Options</h5></div>
                                    <div class="form-check col-md-6">
                                        <input class="form-check-input" type="radio" name="rdosearch" id="flexRadioDefault1" checked="" value="1" required="">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Date: 
                                        </label>
                                        <input type="date" name="txtdate"> <span style="color: red;">*</span>For Day to Day Delivery Report<span style="color: red;">*</span>
                                    </div>
                                    <br><br>   
                                    <div class="form-check col-md-6">
                                        <input class="form-check-input" type="radio" name="rdosearch" id="flexRadioDefault1" value="2" required="">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Delivery Staff: 
                                        </label>
                                        <select name="cbostaff" class="custom-select" style="width: 200px;">
                                            <?php
                                            $tselect="SELECT s.* FROM staff s,stafftype st WHERE s.stafftypeid=st.stafftypeid AND st.stafftype='Delivery Staff'";
                                            $tquery=mysqli_query($connection,$tselect);
                                            $tcount=mysqli_num_rows($tquery);
                                            if ($tcount<0) {
                                                ?>
                                                <option>No Record Found!!</option>
                                                <?php
                                            }
                                            else{
                                                for ($i=0; $i < $tcount ; $i++) { 
                                                    $tarr=mysqli_fetch_array($tquery);
                                                    $staffid=$tarr['staffid'];
                                                    $staffname=$tarr['staffname'];
                                                    ?>
                                                    <option value="<?php echo $staffid ?>"><?php echo $staffname ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select><span style="color: red;"> & </span>
                                        <input type="date" name="txtdate1">
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <br>
                                        <input type="submit" class="btn btn-outline-primary" name="btnsearch" value="Search">  <input type="submit" class="btn btn-outline-primary" name="btnall" value="Show All">  <input type="submit" class="btn btn-outline-primary" name="btntdy" value="Show All Today Report">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12"><h5 class="card-title">Delivery Report</h5></div>
                            </div>
                            <br>
                            <?php
                            // $query="SELECT * FROM tableorder";
                            // $result=mysqli_query($connection,$query);
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
                                                <th>Delivery ScheduleID</th>
                                                <th>Staff Name</th>
                                                <th>Total Delivery</th>
                                                <th>GrandTotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            for ($i=0; $i < $count ; $i++) { 
                                                $rows=mysqli_fetch_array($result);
                                                $deliveryscheduleid=$rows['deliveryscheduleid'];
                                                $staffname=$rows['staffname'];
                                                $totaldelivery=$rows['deliverycount'];
                                                $grandtotal=$rows['grandtotal'];

                                                echo "<tr>";
                                                echo "<td>".$deliveryscheduleid."</td>";
                                                echo "<td>".$staffname."</td>";
                                                echo "<td>".$totaldelivery."</td>";
                                                echo "<td>".$grandtotal."</td>";               
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Delivery ScheduleID</th>
                                                <th>Staff Name</th>
                                                <th>Total Delivery</th>
                                                <th>GrandTotal</th>
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