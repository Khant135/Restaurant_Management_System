<?php
session_start();
include('header.php');
include ('connect.php');
include('orderfunction.php');
include ('autoid_function.php');


if (isset($_POST['btnconfirm'])) {
	$txtorderid=$_POST['txtorderid'];
	$txtorderdate=$_POST['txtorderdate'];
	$ordertime=date("H:i");
	$txtdiscountid=$_POST['txtdiscountid'];
	$txtaddress=$_POST['txtaddress'];
	$txtpaymentstatus="Pending";
	$deliverystatus="Pending";
	$cancel="No";
	$customerid=$_SESSION['customerid'];
	if ($_POST['rdopayment']=="Cash") {
		$paymenttype=$_POST['rdopayment'];
		$cardnumber="NULL";
	}
	else if ($_POST['rdopayment']=="Card") {
		$paymenttype=$_POST['rdopayment'];
		$cardnumber=$_POST['txtCardNo'];
	}

	$totalquantity=CalculateTotalQuantity();
	$totalamount=CalculateTotalAmount();
	$tax=CalculateTotalAmount() * 0.05;
	$grandtotal=$_POST['txtgrandtotal'];

	if ($totalquantity>10) {
		echo "<script>window.alert('Order Limit has been reached!! You can only Order 10 Quatity!!')</script>";
		echo "<script>window.location='menucart.php'</script>";
	}
	else{
		// insert into customer order table
		$insert="INSERT INTO customerorder(orderid,orderdate,ordertime,totalquantity,totalamount,tax,grandtotal,fulladdress,cancel,discountid,customerid,paymenttype,cardnumber,paymentstatus,deliverystatus)
		VALUES ('$txtorderid','$txtorderdate','$ordertime','$totalquantity','$totalamount','$tax','$grandtotal','$txtaddress','$cancel','$txtdiscountid','$customerid','$paymenttype','$cardnumber','$txtpaymentstatus','$deliverystatus')";
		$result=mysqli_query($connection,$insert);

	// insert into customer order detail table
		$count=count($_SESSION['orderfunction']);
		for ($i=0; $i < $count ; $i++) { 
			$menuid=$_SESSION['orderfunction'][$i]['menuid'];
			$quantity=$_SESSION['orderfunction'][$i]['quantity'];
			$totalprice=$_SESSION['orderfunction'][$i]['price']*$_SESSION['orderfunction'][$i]['quantity'];

			$insert="INSERT INTO customerorderdetail(orderid,menuid,quantity,totalprice)
			VALUES ('$txtorderid','$menuid','$quantity','$totalprice')";
			$result=mysqli_query($connection,$insert);
		}
	}

	if ($result) {
		unset($_SESSION['orderfunction']);

		echo "<script>window.alert('Making Order is Successful!')</script>";
		echo "<script>window.location='menu.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Making Order : " . mysqli_error($connection) . "</p>";
	}	

}


if (isset($_GET['discount']) AND isset($_GET['address'])) {
	$discount=$_GET['discount'];
	$address=$_GET['address'];
	$diselect="SELECT * FROM discount WHERE discountid='$discount'";
	$diquery=mysqli_query($connection,$diselect);
	$diarr=mysqli_fetch_array($diquery);

	$percentage=$diarr['percentage'];
	$value=CalculateTotalAmount()* ($percentage/100);
	// $total=CalculateTotalAmount()-$value;
}
else{
	$discount='';
	$address='';
	echo "<script>window.location='menucart.php'</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
		function COD()
		{
			document.getElementById('CardPayment').style.display="none";
		}
		function Card()
		{
			document.getElementById('CardPayment').style.display="block";
		}
	</script>
</head>
<body>

	<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-end justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<h1 class="mb-2 bread">Our Specialties</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Menu_Order <i class="ion-ios-arrow-forward"></i></span></p>
				</div>
			</div>
		</div>
	</section>
	
	<section class="ftco-section">
		<div class="container-fluid px-4">
			<div class="row justify-content-center mb-5 pb-2">
				<div class="col-md-7 text-center heading-section ftco-animate">
					<span class="subheading">Menu Order</span>
					<h2 class="mb-4"></h2>
				</div>
			</div>
			<form action="menuorder.php" method="post">
				<div class="row">
					<div class="col-md-12">

						<?php  
						if (!isset($_SESSION['orderfunction'])) 
						{
							echo "<p>Empty OrderList</p>";
							echo "<a href='menudisplay.php'>Back to Menu List</a>";
						}
						else
						{
							?>
							<div class="table-responsive">
								
								<table class="table">
									<tr>
										<td style="border-top: white;">OrderID: <input type="text" name="txtorderid" value="<?php echo AutoID('customerorder','orderid','CO-',6) ?>" readonly=""></td>
										<td style="border-top: white;" align="right">OrderDate: <input type="" name="txtorderdate" value="<?php echo date("Y-m-d") ?>" readonly=""></td>
									</tr>
								</table>

								<table class="table table-bordered">
									<tr>
										<td>Total Quantity : <b><?php echo CalculateTotalQuantity() ?> pcs</b></td>
										<td>Total Amount : <b><?php echo CalculateTotalAmount() ?> USD</b></td>
										<td><input type="hidden" value="5" name="txttax">
											Tax (5%) : <b><?php echo CalculateTotalAmount() * 0.05 ?> USD</b></td>
										</tr>
										<tr>
											<td>Address: <textarea name="txtaddress" style="width: 400px;" required=""><?php echo $address; ?></textarea></td>
											<input type="hidden" name="txtdiscountid" value="<?php echo $diarr['discountid'] ?>">
											<td>Discount: <input type="text" name="txtdiscount" value="<?php echo $diarr['percentage'] ?>%" readonly></td>
											<input type="hidden" name="txtgrandtotal" value="<?php echo (CalculateTotalAmount() + (CalculateTotalAmount() * 0.05))-$value ?>">
											<td>GrandTotal: <b><?php echo (CalculateTotalAmount() + (CalculateTotalAmount() * 0.05))-$value ?> USD</b></td>
										</tr>
										<tr>
											<td colspan="3">
												<b>PaymentType:</b>
												<input type="radio" name="rdopayment" onClick="COD()" value="Cash" checked> Cash Payment
												<input type="radio" name="rdopayment" onClick="Card()" value="Card"> Card Payment
												<div class="table-responsive" id="CardPayment" style="display: none">
													<table>
														<tr>
															<td style="border-style: none;">
																<input type="text" name="txtCardNo" placeholder="Enter Card Number" /> |
																<input type="text" name="txtSecurityNo" placeholder="Security Code" size="10" /> 
															</td>
														</tr>
														<tr>
															<td style="border-style: none;">
																<input type="text" name="txtMonth" placeholder="JAN" size="5" value="<?php echo date("M") ?>" readonly/>
																<input type="text" name="txtYear" placeholder="2022" size="5" value="<?php echo date("Y") ?>" readonly/>
																<input type="text" name="txtDate" placeholder="10" size="5" value="<?php echo date("d") ?>" readonly/>
															</td>
														</tr>
													</table>
												</div>
											</td>
										</tr>
									</table>

									<table class="table table-bordered">

										<tr>
											<td colspan="6">
												<a href='menucart.php'>Back to Menu Cart</a>
												|
												<!-- <a href="menucart.php?action=ClearAll">Empty List</a>
													| -->
													<!-- 											<a href="checkout.php">Confirm OrderList</a> -->
													<input type="submit" class="btn btn-primary" name="btnconfirm" value="Make Order"></td>
												</tr>

												<tr>
													<th>Image</th>
													<th>MenuID</th>
													<th>MenuName</th>
													<th>Price</th>
													<th>Quantity</th>
													<th>TotalPrice</th>

												</tr>
												<?php
												$count=count($_SESSION['orderfunction']);

												for($i=0;$i<$count;$i++) 
												{ 
													$menuid=$_SESSION['orderfunction'][$i]['menuid'];
													$image=$_SESSION['orderfunction'][$i]['image'];
													echo "<tr>";
													echo "<td>
													<img src='adminpanel/$image' width='100px' height='100px' />
													</td>";
													echo "<td>" . $_SESSION['orderfunction'][$i]['menuid'] . "</td>";
													echo "<td>" . $_SESSION['orderfunction'][$i]['menuname'] . "</td>";
													echo "<td>" . $_SESSION['orderfunction'][$i]['price'] . "</td>";
													echo "<td>" . $_SESSION['orderfunction'][$i]['quantity'] . "</td>";
													echo "<td>" . $_SESSION['orderfunction'][$i]['price']  * $_SESSION['orderfunction'][$i]['quantity'] . "</td>";
													echo "</tr>";			
												}
												?>

											</table>
										</div>
										<?php
									}
									?>
								</div>
							</div>
						</form>
						<br>
					</div>
				</section>

			</body>
			</html>
			<?php
			include('footer.php');
			?>