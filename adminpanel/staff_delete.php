<?php
	session_start();
	include('../connect.php');
	include('autoid_function.php');

	$staffid=$_GET['staffid'];

	$delete="DELETE FROM staff WHERE staffid='$staffid'";
	$result=mysqli_query($connection,$delete);

	if ($result) {
		echo "<script>window.alert('Successfully Deleted!!')</script>";
		echo "<script>window.location='staff_detail.php'</script>";
	}
	else{
		echo "<p>Something went wrong in Staff Delete : " . mysqli_error($connection) . "</p>";		
	}
?>