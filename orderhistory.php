<?php
session_start();
if (!isset($_SESSION['customerid'])) {
	echo "<script>window.alert('Please login first!')</script>";
	echo "<script>window.location='customerlogin.php'</script>";
}
else{

include('header.php');
include('connect.php');
include('autoid_function.php');

?>
<html>
<head>
</head>
<body>
	<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-end justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<h1 class="mb-2 bread">Order History</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Order History <i class="ion-ios-arrow-forward"></i></span></p>
				</div>
			</div>
		</div>
	</section>
	
	<section class="ftco-section ftco-no-pt ftco-no-pb">
		<div class="container-fluid px-0">
			<div class="row d-flex no-gutters">					
				<div class="col-md-12 ftco-animate makereservation p-4 p-md-5 pt-5">
					<div class="py-md-5">
						<div class="heading-section text-center ftco-animate mb-5">
							<span class="subheading">Result</span>
							<h2 class="mb-4">Order List</h2>
						</div>
						<form action="reservation.php" method="post">
							<div class="row">
								<p class="text-warning">*Cancel button will become disable after the Order is Assigned to Deliver or Finished Delivery!!*</p>
								<?php
								$customerid=$_SESSION['customerid'];
								$select="SELECT * FROM customerorder WHERE customerid='$customerid'ORDER BY orderid DESC";
								$query=mysqli_query($connection,$select);
								$count=mysqli_num_rows($query);

								if ($count<1) {
									echo "<p style='color: red;'>No Order Have Been Made!!</p>";
								}
								else{
									?>
									<div class="table-responsive">
										<table class="table table-striped table-bordered">
											<thead>
												<th>OrderID</th>
												<th>Date</th>
												<th>Time</th>
												<th>Estimate Receive Time</th>						
												<th>Total Quantity</th>
												<th>Grand Total ($)</th>
												<th>Action</th>
											</thead>
											<tbody>
												<?php
												for ($i=0; $i <$count ; $i++) { 
													$rows=mysqli_fetch_array($query);
													$orderid=$rows['orderid'];
													$date=$rows['orderdate'];
													$time=$rows['ordertime'];
													$estimate=$rows['estimatereceivetime'];
													$totalquantity=$rows['totalquantity'];
													$grandtotal=$rows['grandtotal'];
													$deliverystatus=$rows['deliverystatus'];
													$cancel=$rows['cancel'];

													echo "<tr>";
													echo "<td>".$orderid."</td>";
													echo "<td>".$date."</td>";
													echo "<td>".$time."</td>";
													echo "<td>".$estimate."</td>";
													echo "<td>".$totalquantity."</td>";
													echo "<td>".$grandtotal." $</td>";
													if ($deliverystatus=='Pending' && $cancel=='No') {
														echo "<td><a href='orderdetail.php?orderid=$orderid' class='btn btn-outline-success'>Detail</i></a> <a onclick='javascript:confirmationCancel($(this));return false;' href='ordercancel.php?orderid=$orderid' class='btn btn-outline-danger'>Cancel</i></a></td>";
													}
													else{
														echo "<td><a href='orderdetail.php?orderid=$orderid' class='btn btn-outline-success'>Detail</i></a> <a href='ordercancel.php?orderid=$orderid' class='btn btn-outline-danger disabled'>Cancel</i></a></td>";
													}
													echo "</tr>";
												}
												?>
											</tbody>
											<tfoot></tfoot>
										</table>
									</div>
									<?php
								}
								?>

							</div>
						</form>
					</div>
				</div>	
			</div>
		</div>
	</section>
	<script type="text/javascript">
		function confirmationCancel(anchor)
		{
			var conf = confirm('Are you sure that you want to Cancel this Order?');
			if(conf)
				window.location=anchor.attr("href");
		}
	</script>  
</body>
</html>
<?php
include('footer.php');
}
?>