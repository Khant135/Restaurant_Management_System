<?php
	session_start();
	include('../connect.php');

	$regionid=$_GET['regionid'];

	$delete="DELETE FROM region WHERE regionid='$regionid'";
	$result=mysqli_query($connection,$delete);

	if ($result) {
		echo "<script>window.alert('Successfully Deleted!!')</script>";
		echo "<script>window.location='region_detail.php'</script>";
	}
	else{
		echo "<p>Something went wrong in Region Delete : " . mysqli_error($connection) . "</p>";		
	}
?>