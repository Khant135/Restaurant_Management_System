<?php
	session_start();
	include('connect.php');

	$reservationid=$_GET['reservationid'];

	$update="UPDATE reservation SET confirmbycustomer='Cancel' WHERE reserveid='$reservationid'";
	$result=mysqli_query($connection,$update);

	if ($result) {
		echo "<script>window.alert('Successfully Canceled!!')</script>";
		echo "<script>window.location='reservation.php'</script>";
	}
	else{
		echo "<p>Something went wrong in Cancel Process : " . mysqli_error($connection) . "</p>";		
	}
?>