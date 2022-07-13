<?php
	session_start();
	include('../connect.php');

	$vehicletypeid=$_GET['vehicletypeid'];

	$delete="DELETE FROM vehicletype WHERE vehicletypeid='$vehicletypeid'";
	$result=mysqli_query($connection,$delete);

	if ($result) {
		echo "<script>window.alert('Successfully Deleted!!')</script>";
		echo "<script>window.location='vehicletype_detail.php'</script>";
	}
	else{
		echo "<p>Something went wrong in VehicleType Delete : " . mysqli_error($connection) . "</p>";		
	}
?>