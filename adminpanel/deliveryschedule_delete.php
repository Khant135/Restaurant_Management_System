<?php
	session_start();
	include('../connect.php');

	$scheduleid=$_GET['scheduleid'];

	$delete="DELETE FROM deliveryschedule WHERE deliveryscheduleid='$scheduleid'";
	$result=mysqli_query($connection,$delete);

	if ($result) {
		echo "<script>window.alert('Successfully Deleted!!')</script>";
		echo "<script>window.location='deliveryschedule_detail.php'</script>";
	}
	else{
		echo "<p>Something went wrong in Delivery Schedule Delete : " . mysqli_error($connection) . "</p>";		
	}
?>