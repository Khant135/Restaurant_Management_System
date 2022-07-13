<?php
	session_start();
	include('../connect.php');

	$reservationid=$_GET['reservationid'];

	$update="UPDATE reservation SET confirmbyrestaurant='UnAvailable' WHERE reserveid='$reservationid'";
	$result=mysqli_query($connection,$update);

	if ($result) {
		echo "<script>window.alert('Successfully Changed!!')</script>";
		echo "<script>window.location='tablereservation.php'</script>";
	}
	else{
		echo "<p>Something went wrong in Status Change : " . mysqli_error($connection) . "</p>";		
	}
?>