<?php
	session_start();
	include('../connect.php');
	include('autoid_function.php');

	$vehicleid=$_GET['vehicleid'];

	$delete="DELETE FROM vehicle WHERE vehicleid='$vehicleid'";
	$result=mysqli_query($connection,$delete);

	if ($result) {
		echo "<script>window.alert('Successfully Deleted!!')</script>";
		echo "<script>window.location='vehicle_detail.php'</script>";
	}
	else{
		echo "<p>Something went wrong in Vehicle Delete : " . mysqli_error($connection) . "</p>";		
	}
?>