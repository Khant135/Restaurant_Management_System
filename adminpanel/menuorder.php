<?php  
session_start();
include('../connect.php');
include('menuorderfunction.php');
include('admin_header.php');
include('autoid_function.php');


if (isset($_POST['btnconfirm'])) {
	$txttableorderid=$_POST['txtorderid'];
	$txtorderdate=$_POST['txtorderdate'];
	$txttableid=$_POST['txttableid'];
	$txtdiscountid=$_POST['txtdiscountid'];
	$txtpaymentstatus="Pending";
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

	// insert into table order table
	$insert="INSERT INTO tableorder(tableorderid,orderdate,totalquantity,totalamount,tax,grandtotal,tableid,discountid,paymenttype,cardnumber,paymentstatus)
	VALUES ('$txttableorderid','$txtorderdate','$totalquantity','$totalamount','$tax','$grandtotal','$txttableid','$txtdiscountid','$paymenttype','$cardnumber','$txtpaymentstatus')";
	$result=mysqli_query($connection,$insert);

	// insert into table order detail table
	$count=count($_SESSION['menuorderfunction']);
	for ($i=0; $i < $count ; $i++) { 
		$menuid=$_SESSION['menuorderfunction'][$i]['menuid'];
		$quantity=$_SESSION['menuorderfunction'][$i]['quantity'];
		$totalprice=$_SESSION['menuorderfunction'][$i]['price']*$_SESSION['menuorderfunction'][$i]['quantity'];

		$insert="INSERT INTO tableorderdetail(tableorderid,menuid,quantity,totalprice)
		VALUES ('$txttableorderid','$menuid','$quantity','$totalprice')";
		$result=mysqli_query($connection,$insert);
	}

	if ($result) {
		unset($_SESSION['menuorderfunction']);

		echo "<script>window.alert('Making Order is Successful!')</script>";
		echo "<script>window.location='menudisplay.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Making Order : " . mysqli_error($connection) . "</p>";
	}
}


if (isset($_GET['table']) AND isset($_GET['discount'])) {
	$table=$_GET['table'];
	$discount=$_GET['discount'];
	$diselect="SELECT * FROM discount WHERE discountid='$discount'";
	$diquery=mysqli_query($connection,$diselect);
	$diarr=mysqli_fetch_array($diquery);

	$percentage=$diarr['percentage'];
	$value=CalculateTotalAmount()* ($percentage/100);
	// $total=CalculateTotalAmount()-$value;
}

// if (isset($_POST['btngrand'])) {
// 	// echo "<script>window.alert('Hello')</script>";
// 	$discountid=$_POST['cbodiscount'];
// 	$select="SELECT * FROM discount WHERE discountid='$discountid'";
// 	$query=mysqli_query($connection,$select);
// 	$count=mysqli_num_rows($query);
// 	$rows=mysqli_fetch_array($query);
// 	$percentage=$rows['percentage'];
// 	// echo "<script>window.alert($percentage)</script>";
// 	$value=CalculateTotalAmount() * ($percentage/100);
// 	// echo "<script>window.alert($value)</script>";
// 	$total=CalculateTotalAmount() - $value;

// }


?>
<!DOCTYPE html>
<html>
<head>
	<title>Make Order</title>
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
	<div class="page-wrapper" style="background-color: white;">

		<div class="page-breadcrumb">
			<div class="row">
				<div class="col-12 d-flex no-block align-items-center">
					<h4 class="page-title">Menu Order</h4>
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

		<div class="container-fluid">
			<form action="menuorder.php" method="post">
				<div class="row">
					<div class="col-md-12">

						<?php  
						if (!isset($_SESSION['menuorderfunction'])) 
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
										<td style="border-top: white;">OrderID: <input type="text" name="txtorderid" value="<?php echo AutoID('tableorder','tableorderid','TO-',6) ?>" readonly=""></td>
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
											<td>Table: <input type="text" name="txttableid" value="<?php echo $table; ?>" readonly></td>
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
													<input type="submit" name="btnconfirm" class="btn btn-primary" value="Make Order"></td>
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
												$count=count($_SESSION['menuorderfunction']);

												for($i=0;$i<$count;$i++) 
												{ 
													$menuid=$_SESSION['menuorderfunction'][$i]['menuid'];
													$image=$_SESSION['menuorderfunction'][$i]['image'];
													echo "<tr>";
													echo "<td>
													<img src='$image' width='100px' height='100px' />
													</td>";
													echo "<td>" . $_SESSION['menuorderfunction'][$i]['menuid'] . "</td>";
													echo "<td>" . $_SESSION['menuorderfunction'][$i]['menuname'] . "</td>";
													echo "<td>" . $_SESSION['menuorderfunction'][$i]['price'] . "</td>";
													echo "<td>" . $_SESSION['menuorderfunction'][$i]['quantity'] . "</td>";
													echo "<td>" . $_SESSION['menuorderfunction'][$i]['price']  * $_SESSION['menuorderfunction'][$i]['quantity'] . "</td>";
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
					</div>
				</body>
				</html>

				<?php
				include('admin_footer.php');
				?>