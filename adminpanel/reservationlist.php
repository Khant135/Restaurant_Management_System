<?php
session_start();
include('admin_header.php');
include('../connect.php');

if (isset($_POST['btnsearch'])) {
    $rdosearch=$_POST['rdosearch'];
    if ($rdosearch==2) {
        $cbotable=$_POST['cbotable'];
        // echo "<script>window.alert('$cbotable')</script>";
        $query="SELECT r.*,c.customername as customername FROM reservation r,customer c,restauranttable rt WHERE r.customerid=c.customerid AND r.tableid=rt.tableid AND r.confirmbyrestaurant='Confirmed' AND r.confirmbycustomer='Confirmed' AND r.tableid='$cbotable'";
        $result=mysqli_query($connection,$query);
    }
    else if ($rdosearch==1) {
        $txtdate=$_POST['txtdate'];
        // echo "<script>window.alert('$txtdate')</script>";
        $query="SELECT r.*,c.customername as customername FROM reservation r,customer c,restauranttable rt WHERE r.customerid=c.customerid AND r.tableid=rt.tableid AND r.confirmbyrestaurant='Confirmed' AND r.confirmbycustomer='Confirmed' AND r.arrivedate='$txtdate'";
        $result=mysqli_query($connection,$query);
    }
}
else{
    $query="SELECT r.*,c.customername as customername FROM reservation r,customer c,restauranttable rt WHERE r.customerid=c.customerid AND r.tableid=rt.tableid AND r.confirmbyrestaurant='Confirmed' AND r.confirmbycustomer='Confirmed'";
    $result=mysqli_query($connection,$query);
}

if (isset($_POST['btnall'])) {
    $query="SELECT r.*,c.customername as customername FROM reservation r,customer c,restauranttable rt WHERE r.customerid=c.customerid AND r.tableid=rt.tableid AND r.confirmbyrestaurant='Confirmed' AND r.confirmbycustomer='Confirmed'";
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
                                <li class="breadcrumb-item active" aria-current="page">Reservation List</li>
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
                    <form action="reservationlist.php" method="post">
                        <div class="card border border-secondary rounded">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12"><h5 class="card-title">Search Options</h5></div>
                                    <div class="form-check col-md-6">
                                        <input class="form-check-input" type="radio" name="rdosearch" id="flexRadioDefault1" checked="" value="1" required="">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Arrival Date: 
                                        </label>
                                        <input type="date" name="txtdate">
                                    </div>
                                    <br><br>   
                                    <div class="form-check col-md-6">
                                        <input class="form-check-input" type="radio" name="rdosearch" id="flexRadioDefault2" value="2" required="">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Table ID: 
                                        </label>
                                        <select name="cbotable" class="custom-select w-50">
                                            <?php
                                            $tselect="SELECT * FROM restauranttable WHERE status='Available'";
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
                                                    $tableid=$tarr['tableid'];

                                                    ?>
                                                    <option value="<?php echo $tableid ?>"><?php echo $tableid ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <br>
                                        <input type="submit" class="btn btn-outline-primary" name="btnsearch" value="Search">  <input type="submit" class="btn btn-outline-primary" name="btnall" value="Show All">
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
                                <div class="col-md-6"><h5 class="card-title">Reservation List</h5></div>
                            </div>
                            <br>
                            <?php
                            // $query="SELECT r.*,c.customername as customername FROM reservation r,customer c,restauranttable rt WHERE r.customerid=c.customerid AND r.tableid=rt.tableid AND r.confirmbyrestaurant='Confirmed' AND r.confirmbycustomer='Confirmed'";
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
                                                <th>Reservationid</th>
                                                <th>ArrivalDate</th>
                                                <th>ArrivalTime</th>
                                                <th>FinishTime</th>
                                                <th>NumberofPeople</th>
                                                <th>Customer</th>
                                                <th>Table</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            for ($i=0; $i < $count ; $i++) { 
                                                $rows=mysqli_fetch_array($result);
                                                $reservationid=$rows['reserveid'];
                                                $arrivaldate=$rows['arrivedate'];
                                                $arrivaltime=$rows['arrivetime'];
                                                $finishtime=$rows['finishtime'];
                                                $numberofpeople=$rows['numberofpeople'];
                                                $customer=$rows['customername'];
                                                $table=$rows['tableid'];

                                                echo "<tr>";
                                                echo "<td>".$reservationid."</td>";
                                                echo "<td>".$arrivaldate."</td>";
                                                echo "<td>".$arrivaltime."</td>";
                                                echo "<td>".$finishtime."</td>";
                                                echo "<td>".$numberofpeople."</td>";
                                                echo "<td>".$customer."</td>";
                                                echo "<td>".$table."</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Reservationid</th>
                                                <th>ArrivalDate</th>
                                                <th>ArrivalTime</th>
                                                <th>FinishTime</th>
                                                <th>NumberofPeople</th>
                                                <th>Customer</th>
                                                <th>Table</th>
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