<?php  
session_start();
include('../connect.php');
include('menuorderfunction.php');
include('admin_header.php');

$total=0;

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
	<title>Order list</title>
</head>
<body>
	<div class="page-wrapper" style="background-color: white;">

		<div class="page-breadcrumb">
			<div class="row">
				<div class="col-12 d-flex no-block align-items-center">
					<h4 class="page-title">Menu OrderList</h4>
					<div class="ml-auto text-right">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Menu OrderList</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<form action="menucart.php" method="post">
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
											<!-- <input type="hidden" value="5" name="txttax"> -->
											Tax (5%) : <b><?php echo CalculateTotalAmount() * 0.05 ?> USD</b>
											<hr/>

											Table : <b><select id="table" name="cbotable">
												<option>-- Select Table --</option>
												<?php
												$diselect="SELECT * FROM restauranttable WHERE status='Available'";
												$diquery=mysqli_query($connection,$diselect);
												$dicount=mysqli_num_rows($diquery);
												for ($i=0; $i <$dicount ; $i++) { 
													$dirow=mysqli_fetch_array($diquery);
													$tableid=$dirow['tableid'];

													echo "<option value='$tableid'>$tableid</option>";
												}
												?>
											</select></b>
											<hr/>

											Discount : <b><select id="discount" name="cbodiscount">
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

											|
											<a href='menudisplay.php'>Back to Menu List</a>
											|
											<a onclick="javascript:confirmationEmpty($(this));return false;" href="menucart.php?action=ClearAll" class="btn btn-danger">Empty List</a>
											|
											<a href="javascript:;" class="btn btn-primary" onclick="this.href='menuorder.php?table='+document.getElementById('table').value+'&discount='+document.getElementById('discount').value">Confirm OrderList</a>
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
		</div>
	</body>
	</html>

	<?php
	include('admin_footer.php');
	?>