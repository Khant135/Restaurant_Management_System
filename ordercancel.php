<?php
	session_start();
	include('connect.php');

	$orderid=$_GET['orderid'];

	$update="UPDATE customerorder SET cancel='Yes' WHERE orderid='$orderid'";
	$result=mysqli_query($connection,$update);

	if ($result) {
		echo "<script>window.alert('Order Successfully Canceled!!')</script>";
		echo "<script>window.location='orderhistory.php'</script>";
	}
	else{
		echo "<p>Something went wrong in Order Cancel Process : " . mysqli_error($connection) . "</p>";		
	}
?>