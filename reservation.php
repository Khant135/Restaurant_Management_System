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

	if (isset($_POST['btnreserve'])) {
		$txtcustomerid=$_POST['txtcustomerid'];
		$txtreserveid=$_POST['txtreserveid'];
		$tdydate=date("Y-m-d");
		$tdytime=date("H:i");
		$txtarrivedate=$_POST['txtdate'];
		$txtarrivetime=$_POST['txttime'];
		$txtfinishtime=$_POST['txtfinishtime'];
		$txtperson=$_POST['txtperson'];
		$restaurantstatus="Pending";
		$customerstatus="Pending";

		$insert="INSERT INTO reservation (reserveid,reservedate,reservetime,arrivedate,arrivetime,finishtime,numberofpeople,customerid,confirmbyrestaurant,confirmbycustomer)
		VALUES ('$txtreserveid','$tdydate','$tdytime','$txtarrivedate','$txtarrivetime','$txtfinishtime','$txtperson','$txtcustomerid','$restaurantstatus','$customerstatus')";
		$result=mysqli_query($connection,$insert);

		if ($result) {
			echo "<script>window.alert('Reservation Successful!! Please wait for the Staff to Confirm!!')</script>";
			echo "<script>window.location='reservation.php'</script>";
		}
		else{
			echo "<p>Something went wrong in Table Reservation: ".mysqli_error($connection)."</p>";
		}

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
						<h1 class="mb-2 bread">Reservation</h1>
						<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Reservation <i class="ion-ios-arrow-forward"></i></span></p>
					</div>
				</div>
			</div>
		</section>
		
		<section class="ftco-section ftco-no-pt ftco-no-pb">
			<div class="container-fluid px-0">
				<div class="row d-flex no-gutters">
					<!-- 				<div class="col-md-3"></div> -->
					<!-- 				<div class="col-md-6 order-md-last ftco-animate makereservation p-4 p-md-5 pt-5"> -->
						<div class="col-md-6 ftco-animate makereservation p-4 p-md-5 pt-5">
							<div class="py-md-5">
								<div class="heading-section ftco-animate mb-5">
									<span class="subheading">Book a table</span>
									<h2 class="mb-4">Make Reservation</h2>
								</div>
								<form action="reservation.php" method="post">
									<div class="row">
										<input type="hidden" value="<?php echo $_SESSION['customerid'] ?>" name="txtcustomerid">
										<input type="hidden" value="<?php echo AutoID('reservation','reserveid','RE-',6) ?>" name="txtreserveid">

										<div class="col-md-6">
											<div class="form-group">
												<label for="">Number of Person</label>
												<div class="select-wrap one-third">
													<div class="icon"><span class="ion-ios-arrow-down"></span></div>
													<select name="txtperson" id="" class="form-control">
														<option value="">-- Person --</option>
														<?php
														$query="SELECT distinct numberofchair FROM restauranttable";
														$result=mysqli_query($connection,$query);
														$count=mysqli_num_rows($result);

														for($i=0;$i<$count;$i++)
														{
															$row=mysqli_fetch_array($result);
															$numberofchair=$row['numberofchair'];

															echo "<option value='$numberofchair'>$numberofchair</option>";
														}
														?>
													</select>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="">Date</label>
												<!-- 										<input type="text" class="form-control" id="book_date" placeholder="Date" name="txtdate" required> -->
												<input type="date" class="form-control"  placeholder="Date" name="txtdate" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="">Time</label>
												<!-- 										<input type="text" class="form-control" id="book_time" placeholder="Time" name="txttime" required> -->
												<input type="time" class="form-control" placeholder="Time" name="txttime" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="">Finish Time</label>
												<!-- 										<input type="text" class="form-control" id="book_time" placeholder="Time" name="txttime" required> -->
												<input type="time" class="form-control" placeholder="Finish Time" name="txtfinishtime" required>
											</div>
										</div>								
										<div class="col-md-12 mt-3 text-center">
											<div class="form-group">
												<input type="submit" value="Make a Reservation" name="btnreserve" class="btn btn-primary py-3 px-5">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="col-md-6 ftco-animate makereservation p-4 p-md-5 pt-5">
							<div class="py-md-5">
								<div class="heading-section ftco-animate mb-5">
									<!-- 							<span class="subheading">Book a table</span> -->
									<h2 class="mb-4">Reservation List</h2>
								</div>
								<form action="reservation.php" method="post">
									<div class="row">
										<?php
										$customerid=$_SESSION['customerid'];
										$select="SELECT * FROM reservation WHERE Customerid='$customerid' AND confirmbycustomer='Pending'";
										$query=mysqli_query($connection,$select);
										$count=mysqli_num_rows($query);

										if ($count<1) {
											echo "<p style='color: red;'>No Reservation Have Been Made!!</p>";
										}
										else{
											?>
											<div class="table-responsive">
												<table class="table table-striped table-bordered">
													<thead>
														<th>ReservationID</th>
														<th>Date</th>
														<th>Time</th>											
														<th>Confirm(Restaurant)</th>
														<th>Confirm</th>
													</thead>
													<tbody>
														<?php
														for ($i=0; $i <$count ; $i++) { 
															$rows=mysqli_fetch_array($query);
															$reservationid=$rows['reserveid'];
															$arrivedate=$rows['arrivedate'];
															$arrivetime=$rows['arrivetime'];
															$confirmrestaurant=$rows['confirmbyrestaurant'];

															echo "<tr>";
															echo "<td>".$reservationid."</td>";
															echo "<td>".$arrivedate."</td>";
															echo "<td>".$arrivetime."</td>";
															echo "<td>".$confirmrestaurant."</td>";
															echo "<td><a href='confirm.php?reservationid=$reservationid' class='btn btn-outline-success'>Confirm</i></a><a href='cancel.php?reservationid=$reservationid' class='btn btn-outline-danger'>Cancel</i></a></td>";
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
						<div class="col-md-12 ftco-animate makereservation p-4 p-md-5 pt-5">
							<div class="py-md-5">
								<div class="heading-section ftco-animate mb-5">
									<span class="subheading">Past History</span>
									<h2 class="mb-4">Reservation List</h2>
								</div>
								<form action="reservation.php" method="post">
									<div class="row">
										<p class="text-warning">*Latest Five Reservations will only be shown to User.*</p>
										<?php
										$customerid=$_SESSION['customerid'];
										$select="SELECT * FROM reservation WHERE customerid='$customerid' AND confirmbycustomer='Confirmed' AND confirmbyrestaurant='Confirmed' ORDER BY reserveid DESC LIMIT 5";
										$query=mysqli_query($connection,$select);
										$count=mysqli_num_rows($query);

										if ($count<1) {
											echo "<p style='color: red;'>No Reservation Have Been Made!!</p>";
										}
										else{
											?>
											<div class="table-responsive">
												<table class="table table-striped table-bordered">
													<thead>
														<th>ReservationID</th>
														<th>Date</th>
														<th>Time</th>										
														<th>Number of People</th>
														<th>TableID</th>
													</thead>
													<tbody>
														<?php
														for ($i=0; $i <$count ; $i++) { 
															$rows=mysqli_fetch_array($query);
															$reservationid=$rows['reserveid'];
															$arrivedate=$rows['arrivedate'];
															$arrivetime=$rows['arrivetime'];
															$confirmrestaurant=$rows['confirmbyrestaurant'];
															$numberofpeople=$rows['numberofpeople'];
															$tableid=$rows['tableid'];

															echo "<tr>";
															echo "<td>".$reservationid."</td>";
															echo "<td>".$arrivedate."</td>";
															echo "<td>".$arrivetime."</td>";
															echo "<td>".$numberofpeople."</td>";
															echo "<td>".$tableid."</td>";
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
		</body>
		</html>
		<?php
		include('footer.php');
	}
	?>