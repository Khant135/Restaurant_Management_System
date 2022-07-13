<?php
session_start();
include('header.php');
include('connect.php');
include('autoid_function.php');

if (isset($_GET['orderid'])) {
	$orderid=$_GET['orderid'];
	$query="SELECT co.*,cd.quantity as quantity,cd.totalprice as totalprice,m.menuname as menuname,m.menuimage as menuimage FROM customerorder co,customerorderdetail cd,menu m WHERE co.orderid=cd.orderid AND m.menuid=cd.menuid AND co.orderid='$orderid'";
	$result=mysqli_query($connection,$query);
	$count=mysqli_num_rows($result);

}
else{
	$orderid='';
	echo "<script>window.location='customerorderlist2.php'</script>";
}

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
					<h1 class="mb-2 bread">Order Detail</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Order Detail <i class="ion-ios-arrow-forward"></i></span></p>
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
							<span class="subheading">Order Detail</span>
							<h2 class="mb-4"><?php echo $orderid ?></h2>
						</div>
						<form action="reservation.php" method="post">
							<div class="row">
								<div class="col-md-12 text-right">
									<a href="orderhistory.php" class="btn btn-primary">Back</a>
								</div>
								<br><br>
								<div class="table-responsive">
									<table class="table table-striped table-bordered">
										<thead>
											<th>Menu Name</th>
											<th>Menu Image</th>
											<th>Quantity</th>
											<th>Total Price ($)</th>						
										</thead>
										<tbody>
											<?php
											for ($i=0; $i <$count ; $i++) { 
												$rows=mysqli_fetch_array($result);
												$menuname=$rows['menuname'];
												$menuimage=$rows['menuimage'];
												$quantity=$rows['quantity'];
												$totalprice=$rows['totalprice'];

												echo "<tr>";
												echo "<td>".$menuname."</td>";
												echo "<td><img src='adminpanel/".$menuimage."' width='100px' height='100px'></td>";
												echo "<td>".$quantity."</td>";
												echo "<td>".$totalprice." $</td>";
												echo "</tr>";
											}
											?>
										</tbody>
										<tfoot></tfoot>
									</table>
								</div>

							</div>
						</form>
					</div>
				</div>	
			</div>
		</div>
	</section>  
</body>
</html>
<?php
include('footer.php');
?>