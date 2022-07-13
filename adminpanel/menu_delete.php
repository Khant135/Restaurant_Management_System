<?php
	session_start();
	include('../connect.php');
	include('autoid_function.php');

	$menuid=$_GET['menuid'];

	$delete="DELETE FROM menu WHERE menuid='$menuid'";
	$result=mysqli_query($connection,$delete);

	if ($result) {
		echo "<script>window.alert('Successfully Deleted!!')</script>";
		echo "<script>window.location='menu_detail.php'</script>";
	}
	else{
		echo "<p>Something went wrong in Menu Delete : " . mysqli_error($connection) . "</p>";		
	}
?>