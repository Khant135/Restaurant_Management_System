<?php
	session_start();
	include('../connect.php');

	$discountid=$_GET['discountid'];

	$delete="DELETE FROM discount WHERE discountid='$discountid'";
	$result=mysqli_query($connection,$delete);

	if ($result) {
		echo "<script>window.alert('Successfully Deleted!!')</script>";
		echo "<script>window.location='discount_detail.php'</script>";
	}
	else{
		echo "<p>Something went wrong in Discount Delete : " . mysqli_error($connection) . "</p>";		
	}
?>