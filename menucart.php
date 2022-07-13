<?php
session_start();
include('header.php');
include ('connect.php');
include('orderfunction.php');

if(isset($_GET['action'])) 
{
	$action=$_GET['action'];

	if ($action == 'Remove') 
	{
		$menuid=$_GET['menuid'];
		RemoveMenu($menuid);
	}
	elseif ($action == 'ClearAll') 
	{
		ClearAll();
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-end justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<h1 class="mb-2 bread">Our Specialties</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Order_List <i class="ion-ios-arrow-forward"></i></span></p>
				</div>
			</div>
		</div>
	</section>
	
	<section class="ftco-section">
		<div class="container-fluid px-4">
			<div class="row justify-content-center mb-5 pb-2">
				<div class="col-md-7 text-left heading-section ftco-animate">
					<span class="subheading">Order List</span>
					<h2 class="mb-4"></h2>
				</div>
				<div class="col-md-5 text-right">
					<?php
						if (isset($_SESSION['customerid'])) {
							$userid=$_SESSION['customerid'];
							?>
								<a href="orderhistory.php" class="btn btn-primary">Order List History</a>
							<?php
						}
						else{
							?>
								<a href="customerlogin.php" class="btn btn-primary" onclick="loginMessage()">Order List History</a>
							<?php
						}
					?>
				</div>
			</div>
			<form action="menucart.php" method="post">
				<div class="row">
					<div class="col-md-12">

						<?php  
						if (!isset($_SESSION['orderfunction'])) 
						{
							echo "<p>Empty OrderList</p>";
							echo "<a href='menu.php'>Back to Menu List</a>";
						}
						else
						{
							?>
							<div class="table-responsive">
								
								<table class="table table-bordered">
									<tr>
										<th>Image</th>
										<th>MenuID</th>
										<th>MenuName</th>
										<th>Price</th>
										<th>Quantity</th>
										<th>TotalPrice</th>
										<th>Action</th>
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
										echo "<td>
										<a onclick='javascript:confirmationRemove($(this));return false;' href='menucart.php?action=Remove&menuid=$menuid' class='text-danger'>Remove</a>
										</td>";
										echo "</tr>";		

									}
									?>
									<tr>
										<td colspan="7" align="right">
											Total Quantity : <b><?php echo CalculateTotalQuantity() ?> pcs</b>
											<hr/>
											Total Amount : <b><?php echo CalculateTotalAmount() ?> USD</b>
											<hr/>
											<input type="hidden" value="5" name="txttax">
											Tax (5%) : <b><?php echo CalculateTotalAmount() * 0.05 ?> USD</b>
											<hr/>

											<span style="color: red;">*</span>Please Check Ours Discount Offers Before Making Order<span style="color: red;">*</span> : <b><select name="cbodiscount" id="discount">
												<!-- <option>-- Select Discount --</option> -->
												<?php
												$select="SELECT * FROM discount WHERE status='Active'";
												$query=mysqli_query($connection,$select);
												$count=mysqli_num_rows($query);
												for ($i=0; $i <$count ; $i++) { 
													$row=mysqli_fetch_array($query);
													$discountid=$row['discountid'];
													$percentage=$row['percentage'];
													$discountname=$row['discountname'];

													echo "<option value='$discountid'>$discountname | $percentage%</option>";
												}
												?>
											</select></b>
											<hr/>
											Address : <textarea style="width: 400px;" id="address" name="txtaddress" required=""></textarea></b><hr>

											|
											<a href='menu.php'>Back to Menu List</a>
											|
											<a onclick="javascript:confirmationEmpty($(this));return false;" href="menucart.php?action=ClearAll" class="btn btn-danger">Empty List</a>
											|
											<input type="hidden" name="txtcustomerid" value="<?php echo $_SESSION['customerid'] ?>">
											<a href="javascript:;" class="btn btn-primary" onclick="this.href='menuorder.php?discount='+document.getElementById('discount').value+'&address='+document.getElementById('address').value">Confirm OrderList</a>
											<!-- <input type="submit" name="btnconfirm" value="Confirm OrderList"> -->	
										</td>
									</tr>
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