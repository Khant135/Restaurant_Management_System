<?php
session_start();
include('../connect.php');
include('admin_header.php');

$select="SELECT * FROM staff";
$query=mysqli_query($connection,$select);
$count=mysqli_num_rows($query);

$select1="SELECT * FROM customer";
$query1=mysqli_query($connection,$select1);
$count1=mysqli_num_rows($query1);

$totaluser=$count+$count1;

$select3="SELECT * FROM tableorder";
$query3=mysqli_query($connection,$select3);
$count3=mysqli_num_rows($query3);
$select4="SELECT * FROM customerorder WHERE cancel='No'";
$query4=mysqli_query($connection,$select4);
$count4=mysqli_num_rows($query4);
$totalordercount=$count3+$count4;

$select5="SELECT * FROM menu";
$query5=mysqli_query($connection,$select5);
$count5=mysqli_num_rows($query5);

$select6="SELECT * FROM reservation WHERE confirmbyrestaurant='Confirmed' AND confirmbycustomer='Confirmed'";
$query6=mysqli_query($connection,$select6);
$count6=mysqli_num_rows($query6);

$select7="SELECT * FROM tableorder ORDER BY tableorderid DESC LIMIT 5";
$query7=mysqli_query($connection,$select7);
$count7=mysqli_num_rows($query7);

$select8="SELECT co.*,c.customername as customername FROM customerorder co,customer c WHERE co.customerid=c.customerid AND co.cancel='No' ORDER BY co.orderid DESC LIMIT 5";
$query8=mysqli_query($connection,$select8);
$count8=mysqli_num_rows($query8);

$select9="SELECT r.*,c.customername as customername FROM reservation r,customer c WHERE r.customerid=c.customerid AND r.confirmbyrestaurant='Confirmed' AND r.confirmbycustomer='Confirmed' ORDER BY r.reserveid DESC LIMIT 5";
$query9=mysqli_query($connection,$select9);
$count9=mysqli_num_rows($query9);

$select10="SELECT c.*,m.menuname as menuname,cu.customername as customername,cu.image as image FROM comment c,menu m, customer cu WHERE c.menuid=m.menuid AND c.customerid=cu.customerid ORDER BY c.commentid DESC LIMIT 5";
$query10=mysqli_query($connection,$select10);
$count10=mysqli_num_rows($query10);

$select11="SELECT * FROM customerorder WHERE cancel='Yes'";
$query11=mysqli_query($connection,$select11);
$count11=mysqli_num_rows($query11);

$select12="SELECT * FROM reservation WHERE confirmbycustomer='Cancel'";
$query12=mysqli_query($connection,$select12);
$count12=mysqli_num_rows($query12);

include('chartreport.php');
?>
<html>
<head>
	<title></title>
  <script>
    window.onload = function () {

      var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        // exportEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title:{
          text: "Table Reservation Report"
        },
        axisY: {
          title: "Number of Reservations",
          includeZero: true,
        },
        data: [{
          type: "column", //change type to bar, line, area, pie, etc  
          yValueFormatString: "#",
          indexLabel: "{y}",
          indexLabelPlacement: "inside",
          indexLabelFontWeight: "bolder",
          indexLabelFontColor: "white",
          dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart.render();

      var chart1 = new CanvasJS.Chart("chartContainer1", {
        animationEnabled: true,
        // exportEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title:{
          text: "Percentage of Table Reservations"
        },
        data: [{
          type: "pie", //change type to bar, line, area, pie, etc  
          yValueFormatString: "#,##0.00\"%\"",
          indexLabel: "{label} ({y})",
          showInLegend: true,
          legendText: "{label}",
          dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart1.render();

      var chart2 = new CanvasJS.Chart("chartContainer2", {
        animationEnabled: true,
        // exportEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title:{
          text: "Cancel Percentage of Online Order"
        },
        data: [{
          type: "pie", //change type to bar, line, area, pie, etc  
          yValueFormatString: "#,##0.00\"%\"",
          indexLabel: "{label} ({y})",
          showInLegend: true,
          legendText: "{label}",
          dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart2.render();

      var chart3 = new CanvasJS.Chart("chartContainer3", {
        animationEnabled: true,
        // exportEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title:{
          text: "Percentage Between Table & Online Order"
        },
        data: [{
          type: "pie", //change type to bar, line, area, pie, etc  
          yValueFormatString: "#,##0.00\"%\"",
          indexLabel: "{label} ({y})",
          showInLegend: true,
          legendText: "{label}",
          dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart3.render();

      var chart4 = new CanvasJS.Chart("chartContainer4", {
        animationEnabled: true,
        // exportEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title:{
          text: "Mostly Order Menu From Table"
        },
        axisY: {
          title: "Number of Menus",
          includeZero: true,
        },
        data: [{
          type: "bar", //change type to bar, line, area, pie, etc  
          yValueFormatString: "#",
          indexLabel: "{y}",
          indexLabelPlacement: "inside",
          indexLabelFontWeight: "bolder",
          indexLabelFontColor: "white",
          dataPoints: <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart4.render();

      var chart5 = new CanvasJS.Chart("chartContainer5", {
        animationEnabled: true,
        // exportEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title:{
          text: "Mostly Order Menu From Online"
        },
        axisY: {
          title: "Number of Menus",
          includeZero: true,
        },
        data: [{
          type: "bar", //change type to bar, line, area, pie, etc  
          yValueFormatString: "#",
          indexLabel: "{y}",
          indexLabelPlacement: "inside",
          indexLabelFontWeight: "bolder",
          indexLabelFontColor: "white",
          dataPoints: <?php echo json_encode($dataPoints5, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart5.render();

      var chart6 = new CanvasJS.Chart("chartContainer6", {
        animationEnabled: true,
        // exportEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title:{
          text: "Online Orders Per Customer"
        },
        axisY: {
          title: "Number of Online Orders",
          includeZero: true,
        },
        data: [{
          type: "bar", //change type to bar, line, area, pie, etc  
          yValueFormatString: "#",
          indexLabel: "{y}",
          indexLabelPlacement: "inside",
          indexLabelFontWeight: "bolder",
          indexLabelFontColor: "white",
          dataPoints: <?php echo json_encode($dataPoints6, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart6.render();

      var chart7 = new CanvasJS.Chart("chartContainer7", {
        animationEnabled: true,
        // exportEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title:{
          text: "Table Reservations Per Customer"
        },
        axisY: {
          title: "Number of Table Reservations",
          includeZero: true,
        },
        data: [{
          type: "bar", //change type to bar, line, area, pie, etc  
          yValueFormatString: "#",
          indexLabel: "{y}",
          indexLabelPlacement: "inside",
          indexLabelFontWeight: "bolder",
          indexLabelFontColor: "white",
          dataPoints: <?php echo json_encode($dataPoints7, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart7.render();
    }
  </script>
</head>
<body>
 <div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 d-flex no-block align-items-center">
        <h4 class="page-title">Dashboard</h4>
        <div class="ml-auto text-right">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Library</li>
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
    <!-- Sales Cards  -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Sales chart -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="d-md-flex align-items-center">
              <div>
                <h4 class="card-title">Site Analysis</h4>
                <h5 class="card-subtitle">Overview of the Restaurant</h5>
              </div>
            </div>
            <div class="row">
              <!-- column -->
              <div class="col-lg-12">
                <div class="row justify-content-center">
                  <div class="col-md-2 col-sm-6 m-t-15">
                    <div class="bg-cyan p-10 text-white text-center">
                      <i class="fa fa-user m-b-5 font-16"></i>
                      <h5 class="m-b-0 m-t-5"><?php echo $count ?></h5>
                      <small class="font-light">Total Staffs</small>
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-6 m-t-15">
                    <div class="bg-success p-10 text-white text-center">
                      <i class="fas fa-user-circle m-b-5 font-16"></i>
                      <h5 class="m-b-0 m-t-5"><?php echo $count1 ?></h5>
                      <small class="font-light">Total Customers</small>
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-6 m-t-15">
                    <div class="bg-warning p-10 text-white text-center">
                      <i class="fas fa-users m-b-5 font-16"></i>
                      <h5 class="m-b-0 m-t-5"><?php echo $totaluser ?></h5>
                      <small class="font-light">Total Users</small>
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-6 m-t-15">
                    <div class="bg-danger p-10 text-white text-center">
                     <i class="mdi mdi-food m-b-5 font-16"></i>
                     <h5 class="m-b-0 m-t-5"><?php echo $count5 ?></h5>
                     <small class="font-light">Total Menu</small>
                   </div>
                 </div>
                 <div class="col-md-2 col-sm-6 m-t-15">
                  <div class="bg-info p-10 text-white text-center">
                   <i class="fa fa-tag m-b-5 font-16"></i>
                   <h5 class="m-b-0 m-t-5"><?php echo $totalordercount ?></h5>
                   <small class="font-light">Total Orders</small>
                 </div>
               </div>
               <div class="col-md-2 col-sm-6 m-t-15">
                <div class="bg-danger p-10 text-white text-center">
                 <i class="fa fa-table m-b-5 font-16"></i>
                 <h5 class="m-b-0 m-t-5"><?php echo $count3 ?></h5>
                 <small class="font-light">Table Orders</small>
               </div>
             </div>
             <div class="col-md-2 col-sm-6 m-t-15">
              <div class="bg-info p-10 text-white text-center">
               <i class="fas fa-shopping-cart m-b-5 font-16"></i>
               <h5 class="m-b-0 m-t-5"><?php echo $count4 ?></h5>
               <small class="font-light">Online Orders</small>
             </div>
           </div>
           <div class="col-md-2 col-sm-6 m-t-15">
            <div class="bg-cyan p-10 text-white text-center">
             <i class="mdi mdi-cart-off m-b-5 font-16"></i>
             <h5 class="m-b-0 m-t-5"><?php echo $count11 ?></h5>
             <small class="font-light">Cancel Online Orders</small>
           </div>
         </div>
         <div class="col-md-2 col-sm-6 m-t-15">
          <div class="bg-cyan p-10 text-white text-center">
           <i class="fa fa-table m-b-5 font-16"></i>
           <h5 class="m-b-0 m-t-5"><?php echo $count6 ?></h5>
           <small class="font-light">Table Reservations</small>
         </div>
       </div>
       <div class="col-md-2 col-sm-6 m-t-15">
        <div class="bg-cyan p-10 text-white text-center">
         <i class="fa fa-table m-b-5 font-16"></i>
         <h5 class="m-b-0 m-t-5"><?php echo $count12 ?></h5>
         <small class="font-light">Cancel Table Reservations</small>
       </div>
     </div>
   </div>
 </div>
 <!-- column -->
</div>
</div>
</div>
</div>
</div>
<!-- ============================================================== -->
<!-- Sales chart -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Recent comment and chats -->
<!-- ============================================================== -->
<div class="row">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <div id="chartContainer3" style="height: 370px; width: 100%;"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <div id="chartContainer4" style="height: 370px; width: 100%;"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <div id="chartContainer5" style="height: 370px; width: 100%;"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <div id="chartContainer6" style="height: 370px; width: 100%;"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <div id="chartContainer7" style="height: 370px; width: 100%;"></div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <!-- column -->
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Latest Table Orders</h4>
      </div>
      <table class="table">
        <thead>
          <tr>
            <!-- <th scope="col">#</th> -->
            <th scope="col">OrderID</th>
            <th scope="col">OrderDate</th>
            <th scope="col">GrandTotal</th>
            <th scope="col">TableID</th>
          </tr>
        </thead>
        <tbody>
          <?php
          for ($i=0; $i < $count7 ; $i++) { 
            $row7=mysqli_fetch_array($query7);
            $orderid=$row7['tableorderid'];
            $orderdate=$row7['orderdate'];
            $grandtotal=$row7['grandtotal'];
            $tableid=$row7['tableid'];

            ?>
            <tr>
              <th scope="row"><?php echo $orderid; ?></th>
              <td><?php echo $orderdate; ?></td>
              <td><?php echo $grandtotal; ?></td>
              <td><?php echo $tableid; ?></td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
    <!-- Card -->
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Latest Comments</h4>
      </div>
      <div class="comment-widgets scrollable">
        <!-- Comment Row -->
        <?php
        for ($i=0; $i < $count10 ; $i++) { 
          $row10=mysqli_fetch_array($query10);
          $customername=$row10['customername'];
          $comment=$row10['comment'];
          $menuname=$row10['menuname'];
          $image=$row10['image'];
          $commentdate=$row10['commentdate'];
          $commenttime=$row10['commenttime'];
          ?>
          <div class="d-flex flex-row comment-row m-t-0">
            <div class="p-2"><img src="../<?php echo $image ?>" alt="user" width="50" height="50" class="rounded-circle"></div>
            <div class="comment-text w-100">
              <h6 class="font-medium"><?php echo $customername ?> for <b class="text-success"><?php echo $menuname ?></b></h6>
              <span class="m-b-15 d-block"><?php echo $comment ?></span>
              <div class="comment-footer">
                <span class="text-muted float-right"><?php echo $commentdate ?> | <?php echo $commenttime ?></span> 
<!--                             <button type="button" class="btn btn-cyan btn-sm">Edit</button>
                            <button type="button" class="btn btn-success btn-sm">Publish</button>
                            <button type="button" class="btn btn-danger btn-sm">Delete</button> -->
                          </div>
                        </div>
                      </div>
                      <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
              <!-- column -->

              <div class="col-lg-6">
                <!-- Card -->
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Latest Online Orders</h4>
                  </div>
                  <table class="table">
                    <thead>
                      <tr>
                        <!-- <th scope="col">#</th> -->
                        <th scope="col">OrderID</th>
                        <th scope="col">OrderDate</th>
                        <th scope="col">GrandTotal</th>
                        <th scope="col">Customer</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      for ($i=0; $i < $count8 ; $i++) { 
                        $row8=mysqli_fetch_array($query8);
                        $orderid=$row8['orderid'];
                        $orderdate=$row8['orderdate'];
                        $grandtotal=$row8['grandtotal'];
                        $customer=$row8['customername'];

                        ?>
                        <tr>
                          <th scope="row"><?php echo $orderid; ?></th>
                          <td><?php echo $orderdate; ?></td>
                          <td><?php echo $grandtotal; ?></td>
                          <td><?php echo $customer; ?></td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- card -->
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Latest Table Reservations</h4>
                  </div>
                  <table class="table">
                    <thead>
                      <tr>
                        <!-- <th scope="col">#</th> -->
                        <th scope="col">ReservationID</th>
                        <th scope="col">Arrival Date</th>
                        <th scope="col">TableID</th>
                        <th scope="col">Customer</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      for ($i=0; $i < $count9 ; $i++) { 
                        $row9=mysqli_fetch_array($query9);
                        $reservationid=$row9['reserveid'];
                        $arrivaldate=$row9['arrivedate'];
                        $tableid=$row9['tableid'];
                        $customer=$row9['customername'];

                        ?>
                        <tr>
                          <th scope="row"><?php echo $reservationid; ?></th>
                          <td><?php echo $arrivaldate; ?></td>
                          <td><?php echo $tableid; ?></td>
                          <td><?php echo $customer; ?></td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- ============================================================== -->
            <!-- Recent comment and chats -->
            <!-- ============================================================== -->
          </div>
            <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            <script type="text/javascript" src="dist/js/canvasjs.min.js"></script>
        </body>
        </html>
        <?php
        include('admin_footer.php');
        ?>